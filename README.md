# Landing Newsletter CI4

A minimal CodeIgniter 4 application that serves as a front-end only layer for a multi-tenant newsletter landing page system.

## Architecture

Browser → landing-newsletter-ci4 (CI4 SSR) → External API (multi-tenant backend)

## Quick Start

1. Clone the repository
2. Copy `.env.example` to `.env` and configure:
   - `app.baseURL`: Your domain
   - `SITE_ID`: Unique identifier for this site
   - `API_BASE_URL`: External API endpoint
   - `API_KEY`: API authentication key
   - `RECAPTCHA_SITE_KEY`: Google reCAPTCHA v3 public key

3. Install dependencies:
   ```bash
   composer install
   ```

4. Start development server:
   ```bash
   php spark serve
   ```

5. Open http://localhost:8080

## Features

- 5 language support (ES, EN, PT, IT, FR)
- Newsletter subscription form
- reCAPTCHA v3 integration
- API proxy pattern (stateless)
- Responsive design
- SEO optimized

## File Structure

```
app/
├── Config/
│   └── SiteConfig.php              (Brand & theme configuration)
├── Controllers/
│   ├── HomeController.php          (Landing page rendering)
│   └── NewsletterController.php    (API proxy)
├── Helpers/
│   ├── language_helper.php
│   └── recaptcha_helper.php
├── Language/
│   └── (5 locales)
└── Views/
    └── frontend/
        ├── layouts/
        │   └── landing.php         (HTML shell with theme variables)
        └── pages/home/
            ├── index.php           (Orchestrator - includes enabled sections)
            └── sections/
                ├── header.php      (Logo & language selector)
                ├── hero.php        (Hero section with form #1)
                ├── options.php     (Features/options showcase)
                ├── faq.php         (FAQ accordion)
                ├── invitation.php  (CTA with form #2)
                └── footer.php      (Footer with copyright)

public/
├── css/landing/    (Section-specific styles using CSS custom properties)
├── js/landing/     (Frontend logic: newsletter, animations, language selector)
└── images/         (Logo and section images)
```

## Environment Variables

### Core API Configuration
| Variable | Purpose |
|----------|---------|
| `SITE_ID` | Identifies which site this app serves |
| `API_BASE_URL` | External API endpoint |
| `API_KEY` | API authentication |
| `RECAPTCHA_SITE_KEY` | reCAPTCHA public key |
| `GA4_ID` | Google Analytics ID (optional) |
| `GTM_ID` | Google Tag Manager ID (optional) |

### Site Branding & Customization
| Variable | Purpose | Default |
|----------|---------|---------|
| `siteConfig.siteName` | Site name (meta tags, alt text) | `NewsLanding` |
| `siteConfig.siteTagline` | Tagline in header | `Subscription Landing Template` |
| `siteConfig.logoPath` | Dark logo path (relative to `/public/`) | `images/logos/logo-dark.svg` |
| `siteConfig.logoWhitePath` | White logo path (relative to `/public/`) | `images/logos/logo-light.svg` |
| `siteConfig.colorPrimary` | Primary brand color | `#e63946` |
| `siteConfig.colorSecondary` | Secondary color | `#457b9d` |
| `siteConfig.colorAccent` | Accent color | `#f1faee` |
| `siteConfig.colorBgAlt` | Alternate background | `#f8f9fa` |
| `siteConfig.colorBgAccent` | Accent background | `#1d3557` |
| `siteConfig.imageHero` | Hero section image filename | `hero-landing.webp` |
| `siteConfig.imageFaq` | FAQ section image filename | `faq-landing.webp` |
| `siteConfig.imageOptions1` | First option image filename | `op1-landing.webp` |
| `siteConfig.imageOptions2` | Second option image filename | `op2-landing.webp` |
| `siteConfig.sectionsEnabled` | Comma-separated section list | `header,hero,options,faq,invitation,footer` |

### Section Control
Control which sections appear by setting `siteConfig.sectionsEnabled`. Available sections:
- `header` - Logo & language selector
- `hero` - Hero title + first newsletter form + image + icons
- `options` - Features/options showcase
- `faq` - Frequently asked questions accordion
- `invitation` - Call-to-action with second newsletter form
- `footer` - Copyright footer

Example: To show only header, hero, and footer:
```
siteConfig.sectionsEnabled = header,hero,footer
```

## API Integration

The app proxies newsletter subscriptions to the external API:

```
POST /{locale}/api/newsletter/subscribe

Headers:
  X-Site-Id: {SITE_ID}
  X-Api-Key: {API_KEY}

Body:
  {
    "email": "user@example.com",
    "recaptcha_token": "...",
    "invitation_code": "optional"
  }
```

## Development

- **Language**: PHP 8.2+
- **Framework**: CodeIgniter 4.7
- **Frontend**: Bootstrap 5, Vanilla JS
- **No database required** - stateless architecture

## Using as a Template

This project is designed to be a reusable template for creating landing pages with newsletter subscriptions. Each new site (e.g., bodas, peliculas, etc.) is a fork/clone with its own `.env` configuration.

### Creating a New Landing Page from This Template

1. **Fork/Clone the repository**
   ```bash
   git clone https://github.com/yourusername/landing-newsletter-ci4.git my-new-landing
   cd my-new-landing
   ```

2. **Update .env with new site configuration**
   ```env
   SITE_ID = my-new-site
   siteConfig.siteName = "My New Site"
   siteConfig.siteTagline = "Your unique tagline"
   siteConfig.logoPath = images/logos/my-site-logo.svg
   siteConfig.colorPrimary = #your-color
   siteConfig.imageHero = my-hero-image.webp
   # ... other image and color settings
   siteConfig.sectionsEnabled = header,hero,invitation,footer
   ```

3. **Place new assets in `/public/images/`**
   - Logo files in `images/logos/`
   - Section images in `images/landing/`

4. **Update text content via language files** (optional)
   - Edit `app/Language/es/LandingPage.php` (and other locales)
   - Change titles, descriptions, FAQ content, etc.

5. **Install and serve**
   ```bash
   composer install
   php spark serve
   ```

### Why Configuration Over Code?

- **No PHP knowledge required** for site operators
- **Consistent structure** across all landing pages
- **Dynamic theming** without CSS editing
- **Section visibility** without code changes
- **Easy rollback** - revert `.env` to previous version

### Typical Use Cases

- **Bodas (Wedding planning)**: All sections enabled, different colors/images/text
- **Películas (Filmmaking)**: Remove FAQ, keep hero + features
- **Minimal landing**: Header + hero + footer only (set `sectionsEnabled`)

## Production Deployment

1. Set `CI_ENVIRONMENT = production` in `.env`
2. Configure `app.baseURL` with your domain
3. Ensure all environment variables are set
4. Test newsletter form integration with live API
5. Deploy via Git or FTP

---

Built with CodeIgniter 4
