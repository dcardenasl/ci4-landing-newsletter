# Template Architecture & Modularity

## Overview

This project is a modular, configuration-driven landing page template. Unlike the original monolithic `landing.php`, the page is now composed of independent, reusable sections that can be enabled/disabled and themed dynamically.

## View Layer Design

### Layout System (CI4 Template Inheritance)

```
Layout (landing.php)
    ↓
    Injects CSS custom properties (:root variables)
    ↓
Page (index.php)
    ↓
    Loops through enabledSections array
    ↓
Section Partials (header.php, hero.php, etc.)
    ↓
Pure HTML + lang() calls
```

**Files involved:**
- `app/Views/frontend/layouts/landing.php` - HTML shell with theme injection
- `app/Views/frontend/pages/home/index.php` - Orchestrator (simple loop over sections)
- `app/Views/frontend/pages/home/sections/*.php` - 6 individual section partials

**Key principle:** Each section is a self-contained partial view. No section knows about others.

### Section Partials

| Section | File | Purpose | Dependencies |
|---------|------|---------|--------------|
| header | `sections/header.php` | Logo + language selector | `$locale`, `$supportedLocales`, `$siteConfig->logoPath` |
| hero | `sections/hero.php` | H1 + description + form #1 + image | `$siteConfig->imageHero`, `lang('LandingPage.hero.*')` |
| options | `sections/options.php` | Feature showcase (2 cards) | `$siteConfig->imageOptions1/2`, `lang('LandingPage.options.*')` |
| faq | `sections/faq.php` | FAQ accordion (4 items) | `$siteConfig->imageFaq`, `lang('LandingPage.faq.*')` |
| invitation | `sections/invitation.php` | CTA with form #2 | `lang('LandingPage.footer.*')` |
| footer | `sections/footer.php` | Copyright footer | `$siteConfig->logoWhitePath` |

### Controller Flow

```php
HomeController::index()
    ↓
Load SiteConfig from .env
    ↓
Parse sectionsEnabled string → array
    ↓
Pass to view: $enabledSections, $siteConfig
    ↓
index.php loops:
  foreach ($enabledSections as $section)
    include("sections/{$section}.php")
```

## Configuration Layer

### SiteConfig Class

File: `app/Config/SiteConfig.php`

Loads from `.env` and provides typed properties + helper methods:

```php
class SiteConfig extends BaseConfig {
    public string $siteName;
    public string $colorPrimary;
    public string $imageHero;
    public string $sectionsEnabled;  // "header,hero,options,faq,invitation,footer"
    
    public function getEnabledSections(): array
    public function isSectionEnabled(string $section): bool
}
```

**Why a config class?**
- Type safety (PHP would silently handle env() string errors)
- Default values (documented in class)
- Helper methods (parsing comma-separated strings)
- Reusable across controllers/models

### Environment Variables

All configurable values live in `.env`:

```env
# Brand identity
siteConfig.siteName = "NewsLanding"
siteConfig.logoPath = "images/logos/logo-dark.svg"

# Theme colors (injected as CSS custom properties)
siteConfig.colorPrimary = "#e63946"
siteConfig.colorSecondary = "#457b9d"
# ... more colors

# Images (filenames in /public/images/landing/)
siteConfig.imageHero = "hero-landing.webp"
siteConfig.imageFaq = "faq-landing.webp"
# ... more images

# Section visibility (comma-separated, no spaces)
siteConfig.sectionsEnabled = "header,hero,options,faq,invitation,footer"
```

**Example: Create a minimal landing (header + hero + footer only)**
```env
siteConfig.sectionsEnabled = header,hero,footer
```

Request to `GET /` renders 3 partials instead of 6. No code change.

## Styling System

### CSS Custom Properties (Dynamic Theming)

**Layout** (`app/Views/frontend/layouts/landing.php`) injects:
```html
<style>
  :root {
    --color-primary:        #e63946;  /* from $siteConfig->colorPrimary */
    --color-secondary:      #457b9d;
    --color-accent:         #f1faee;
    --color-text-highlight: #1d3557;
    --color-bg-alt:         #f8f9fa;
    --color-bg-accent:      #1d3557;
  }
</style>
```

#### Token semantics (important!)

Cada slot tiene un rol definido — no mezclarlos:

| Token               | Rol                                            | Contraste requerido      |
|---------------------|------------------------------------------------|--------------------------|
| `colorPrimary`      | CTA, botones, highlights de marca              | debe funcionar como bg con texto blanco encima |
| `colorSecondary`    | Elementos secundarios de UI                    | libre                    |
| `colorAccent`       | Superficie decorativa (bg de tarjetas, borders)| libre (puede ser pálido) |
| `colorTextHighlight`| Énfasis de texto sobre fondo claro (`<strong>`, FAQ activo) | **AA mínimo (4.5:1 sobre blanco)** |
| `colorBgAlt`        | Fondo de secciones alternadas claras           | pálido                   |
| `colorBgAccent`     | Fondo de secciones oscuras (footer)            | oscuro                   |

> **Error común:** usar el mismo valor para `colorAccent` y `colorTextHighlight`. Son roles distintos. El accent puede ser cualquier tono decorativo; el text-highlight debe ser oscuro para leerse.

**Base CSS** (`public/css/landing/base.css`) mapea a tokens semánticos:
```css
:root {
  --primary:        var(--color-primary,        #F59E0B);
  --secondary:      var(--color-secondary,      #6366F1);
  --accent:         var(--color-accent,         #FEF3C7);
  --text-highlight: var(--color-text-highlight, #92400E);

  --text-secondary: var(--text-highlight);                        /* énfasis */
  --primary-hover:  color-mix(in srgb, var(--primary) 82%, black); /* auto   */
}
```

**Ventaja:** cambiar `siteConfig.colorPrimary = "#ff6b6b"` en `.env` → todos los `.bg-primary` y los hovers de botón se adaptan. Sin rebuild.

### Per-Section CSS Files

Each section has its own CSS file (optional, but cleaner):
- `header.css` - language dropdown, logo spacing
- `hero.css` - hero layout, spacing
- `options.css` - card styling
- `faq.css` - accordion styling
- `form-newsletter.css` - input, button, feedback messages
- `footer.css` - footer background, alignment

These use the CSS custom properties, so they inherit theme colors automatically.

## Adding a New Section

### Scenario: Add a "Team" section

1. **Create the partial**
   ```php
   // app/Views/frontend/pages/home/sections/team.php
   <section class="team-section d-flex justify-content-center">
       <div class="container py-5">
           <h2><?= lang('LandingPage.team.title') ?></h2>
           <p><?= lang('LandingPage.team.description') ?></p>
           <!-- team members here -->
       </div>
   </section>
   ```

2. **Add language strings**
   ```php
   // app/Language/es/LandingPage.php
   'team' => [
       'title' => 'Nuestro equipo',
       'description' => '...',
   ],
   ```

3. **Enable it in `.env`**
   ```env
   siteConfig.sectionsEnabled = header,hero,options,team,faq,invitation,footer
   ```

4. **Optional: Add CSS**
   ```css
   /* public/css/landing/team.css */
   .team-section { /* ... */ }
   ```

   Add to layout:
   ```php
   <link rel="stylesheet" href="<?= base_url('css/landing/team.css') ?>">
   ```

Done. The new section renders between options and faq.

## Removing a Section

**To hide options, faq, invitation:**
```env
siteConfig.sectionsEnabled = header,hero,footer
```

No files deleted. Just toggle in `.env`.

## Multi-Language Support

All text content lives in language files:
- `app/Language/es/LandingPage.php` (Spanish - default)
- `app/Language/en/LandingPage.php` (English)
- `app/Language/pt/LandingPage.php` (Portuguese)
- `app/Language/it/LandingPage.php` (Italian)
- `app/Language/fr/LandingPage.php` (French)

Access via `lang('LandingPage.hero.title')` in any section partial. No hardcoded text in views.

## Deployment Workflow

### For a New Site (e.g., "bodas-landing")

1. Fork this repo
2. Update `.env`:
   ```env
   SITE_ID = bodas
   siteConfig.siteName = "Bodas y Matrimonios"
   siteConfig.colorPrimary = "#d4448e"       # pink
   siteConfig.logoPath = "images/logos/bodas-logo.svg"
   siteConfig.imageHero = "bodas-hero.webp"
   # ... customize all images, colors, sections
   ```
3. Replace logo and section images in `/public/images/`
4. Optionally translate `app/Language/es/LandingPage.php`
5. Deploy

**Total setup time: ~30 minutes** (no PHP coding required).

## Key Design Decisions

### 1. CI4 View Inheritance (extend/section/include)
- **Why?** Built into framework, no extra dependencies
- **Alternative?** Custom templating (more control, more code)

### 2. Comma-Separated Sections in .env
- **Why?** Simple, human-readable, no JSON parsing
- **Alternative?** JSON config, but less readable in .env

### 3. PHP Injection of CSS Variables
- **Why?** Zero build step, dynamic, respects .env values at request time
- **Alternative?** SCSS/PostCSS, but requires build pipeline

### 4. No Database
- **Why?** Stateless, ultra-fast, easy to cache/CDN
- **Content?** Language files (version-controlled), configuration in .env

## Testing the Configuration

### Test 1: Change colors
```env
siteConfig.colorPrimary = #00ff00
```
Load page → all primary buttons should be green.

### Test 2: Hide a section
```env
siteConfig.sectionsEnabled = header,hero,footer
```
Load page → no options/faq/invitation sections visible.

### Test 3: Multi-language
Visit `/en/`, `/pt/`, `/es/` → content translates, layout stays the same.

## Performance Considerations

- No database queries
- Layout + included sections = 7 file operations (cached by PHP opcode cache in production)
- CSS custom properties are native browser feature (no JS overhead)
- Images lazy-loaded via `loading="lazy"` attribute
- Static files versioned via `?key=time()` for newsletter.js

---

**Next Steps:** Fork this repo, customize `.env`, replace images, and deploy to your domain.
