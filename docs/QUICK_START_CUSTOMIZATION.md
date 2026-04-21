# Quick Start: Customizing Your Landing Page

This guide is for site operators who want to customize their landing page **without touching code**.

## What You Can Customize (Without Code)

✅ **Brand Name & Logo**
- Site name that appears in meta tags and footer
- Logo images (dark and white versions)

✅ **Colors**
- Primary brand color (buttons, accents)
- Secondary color
- Accent colors
- Background colors

✅ **Images**
- Hero section image
- FAQ section image
- Feature showcase images (2 different images)

✅ **Visible Sections**
- Show/hide header, hero, features, FAQ, CTA, footer
- Reorder sections (if needed)

✅ **Newsletter Integration**
- API endpoint configuration
- reCAPTCHA keys

❌ **Cannot customize without code:**
- Text content (use language files if multilingual)
- Layout/HTML structure
- Form behavior

---

## Step-by-Step: Customize Your Site

### 1. Edit Your `.env` File

Open `.env` in a text editor. You'll see:

```env
#--------------------------------------------------------------------
# SITE BRANDING & CONFIGURATION
#--------------------------------------------------------------------

# Site identity
siteConfig.siteName = "Filma"
siteConfig.siteTagline = "Find your crew"
siteConfig.logoPath = images/logos/filma-black.svg
siteConfig.logoWhitePath = images/logos/filma-white.svg

# Color palette (used in CSS custom properties)
siteConfig.colorPrimary = #e63946
siteConfig.colorSecondary = #457b9d
siteConfig.colorAccent = #f1faee
siteConfig.colorBgAlt = #f8f9fa
siteConfig.colorBgAccent = #1d3557

# Image paths (relative to /public/images/landing/)
siteConfig.imageHero = hero-landing.webp
siteConfig.imageFaq = faq-landing.webp
siteConfig.imageOptions1 = op1-landing.webp
siteConfig.imageOptions2 = op2-landing.webp

# Enabled sections (comma-separated, no spaces)
siteConfig.sectionsEnabled = header,hero,options,faq,invitation,footer
```

### 2. Update Site Identity

Change these values to match your brand:

```env
siteConfig.siteName = "Bodas y Matrimonios"
siteConfig.siteTagline = "Tu boda, tu forma"
```

These appear in:
- Page title
- Meta tags (for Google search results)
- Footer copyright text

### 3. Update Logo

Replace the logo file:
1. Save your logo as SVG or PNG in `/public/images/logos/`
2. Update the paths:

```env
siteConfig.logoPath = images/logos/my-dark-logo.svg
siteConfig.logoWhitePath = images/logos/my-white-logo.svg
```

**Note:** You need two versions:
- Dark logo (appears in header)
- White logo (appears in dark footer)

### 4. Update Colors

Pick your brand colors and replace these hex values:

```env
siteConfig.colorPrimary = #d4448e       # Your main brand color (buttons, links)
siteConfig.colorSecondary = #6c757d     # Secondary accent
siteConfig.colorAccent = #fff5f7         # Light text/highlights
siteConfig.colorBgAlt = #f9f9f9         # Light backgrounds
siteConfig.colorBgAccent = #2d2d2d      # Dark backgrounds
```

**Online tools to pick colors:**
- https://coolors.co (Color palette generator)
- https://htmlcolorcodes.com (Find hex codes for colors)

### 5. Update Images

1. Place your images in `/public/images/landing/`
2. Update file references in `.env`:

```env
siteConfig.imageHero = my-hero-image.webp
siteConfig.imageFaq = my-faq-image.webp
siteConfig.imageOptions1 = my-feature1.webp
siteConfig.imageOptions2 = my-feature2.webp
```

**Image requirements:**
- Format: WebP (best), PNG, JPG
- Recommended sizes:
  - Hero image: 800x600px (landscape)
  - FAQ image: 400x500px (portrait-ish)
  - Feature images: 600x400px (landscape)

### 6. Control Visible Sections

The default shows all sections:

```env
siteConfig.sectionsEnabled = header,hero,options,faq,invitation,footer
```

**Hide sections by removing them:**

Example 1: Hide FAQ (wedding site without FAQs):
```env
siteConfig.sectionsEnabled = header,hero,options,invitation,footer
```

Example 2: Minimal landing (just hero + CTA):
```env
siteConfig.sectionsEnabled = header,hero,invitation,footer
```

Example 3: Feature showcase (no CTA invitation):
```env
siteConfig.sectionsEnabled = header,hero,options,faq,footer
```

**Available sections:**
- `header` - Logo and language selector
- `hero` - Big title, description, first form, hero image
- `options` - Two feature cards with images
- `faq` - Frequently Asked Questions accordion
- `invitation` - Call-to-action with second form
- `footer` - Copyright footer

### 7. Save and Deploy

1. Save your `.env` file
2. Restart the development server or redeploy to production
3. Open your site → changes should be visible immediately

---

## Testing Your Changes

### Test Colors Changed

1. Edit `.env`: Change `siteConfig.colorPrimary = #ff0000` (red)
2. Save
3. Reload your site in browser
4. Buttons and accents should turn red
5. Change it back

### Test Sections Hidden

1. Edit `.env`: Change to `siteConfig.sectionsEnabled = header,hero,footer`
2. Save
3. Reload your site
4. Options and FAQ sections should disappear
5. Change it back

### Test Image Updated

1. Replace an image file (e.g., `public/images/landing/hero-landing.webp`)
2. Save
3. Reload your site → new image should appear

---

## Troubleshooting

### Changes don't appear after editing .env

**Solution:** Hard-refresh your browser:
- Chrome/Firefox: `Ctrl+Shift+R` (or `Cmd+Shift+R` on Mac)
- Or clear your browser cache

### Site won't start after editing .env

**Check:**
1. File is saved (check file was actually saved)
2. String values have quotes if they contain spaces: `siteConfig.siteName = "My New Site"`
3. Hex colors start with `#`: `#d4448e` not `d4448e`
4. No extra spaces in section list: `header,hero,footer` not `header, hero, footer`

**Restart server:**
```bash
# Stop the server (Ctrl+C)
# Start it again:
php spark serve
```

### Images not appearing

**Check:**
1. Image file exists in `/public/images/landing/`
2. Filename matches exactly in `.env` (case-sensitive on Linux)
3. File format is WebP, PNG, or JPG
4. Hard-refresh browser

### Logo not updating

**Check:**
1. Image file exists in `/public/images/logos/`
2. File is SVG or PNG (not JPG)
3. Filename and path match exactly in `.env`

---

## Common Customizations

### Make a Dark Theme

```env
siteConfig.colorPrimary = #1a1a1a
siteConfig.colorSecondary = #404040
siteConfig.colorAccent = #ffffff
siteConfig.colorBgAlt = #2a2a2a
siteConfig.colorBgAccent = #0d0d0d
```

### Hide Everything But Hero

```env
siteConfig.sectionsEnabled = header,hero,footer
```

### Add More Spacing (Minimal Look)

This requires **code changes** (see documentation). For now, stick to the provided layout.

### Change Font

This requires **code changes**. Fonts are in CSS files.

### Translate Content

Language files are in `app/Language/`. This requires **code changes** or a developer's help.

---

## Next Steps

1. ✅ Customize `.env` with your brand
2. ✅ Replace logo files
3. ✅ Replace section images
4. ✅ Test and review your site
5. 🚀 Deploy to production

**Questions?** Check `docs/TEMPLATE_ARCHITECTURE.md` for technical details or contact your developer.

---

**Remember:** All customizations in this guide are **non-destructive**. You can always revert changes by editing `.env` again.
