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
├── Controllers/
│   ├── HomeController.php       (Landing page rendering)
│   └── NewsletterController.php (API proxy)
├── Helpers/
│   ├── language_helper.php
│   └── recaptcha_helper.php
└── Language/
    └── (5 locales)

public/
├── css/landing/    (Styling)
├── js/landing/     (Frontend logic)
└── images/         (Assets)
```

## Environment Variables

| Variable | Purpose |
|----------|---------|
| `SITE_ID` | Identifies which site this app serves |
| `API_BASE_URL` | External API endpoint |
| `API_KEY` | API authentication |
| `RECAPTCHA_SITE_KEY` | reCAPTCHA public key |
| `GA4_ID` | Google Analytics ID (optional) |
| `GTM_ID` | Google Tag Manager ID (optional) |

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

## Production Deployment

1. Set `CI_ENVIRONMENT = production` in `.env`
2. Configure `app.baseURL` with your domain
3. Ensure all environment variables are set
4. Test newsletter form integration with live API
5. Deploy via Git or FTP

---

Built with CodeIgniter 4
