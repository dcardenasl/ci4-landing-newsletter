# Development Guide

This guide explains how to set up your local development environment and work on landing-newsletter-ci4.

## Prerequisites

- PHP 8.2 or higher
- Composer
- Git

## Local Setup

### 1. Clone and Install

```bash
git clone <repository-url>
cd landing-newsletter-ci4
./scripts/setup.sh
```

Or manually:

```bash
cp .env.example .env
composer install
chmod -R 777 writable
```

### 2. Configure Environment

Edit `.env` with your settings:

```ini
CI_ENVIRONMENT = development
app.baseURL = http://localhost:8080/

SITE_ID = my-newsletter
API_BASE_URL = http://localhost:3000
API_KEY = dev_key_12345
RECAPTCHA_SITE_KEY = your_test_key
```

### 3. Start Development Server

```bash
php spark serve
```

Server will run on `http://localhost:8080`

## Project Structure

```
landing-newsletter-ci4/
├── app/
│   ├── Config/              Framework configuration
│   ├── Controllers/         Route handlers
│   ├── Helpers/             Reusable functions
│   ├── Language/            i18n strings (5 locales)
│   └── Views/               HTML templates
├── public/
│   ├── css/                 Stylesheets
│   ├── js/                  Client-side JavaScript
│   ├── images/              Assets
│   └── index.php            Entry point
├── docs/                    Documentation
├── scripts/                 Utility scripts
├── .env.example             Environment template
├── composer.json            PHP dependencies
└── README.md                Project overview
```

## Key Files

| File | Purpose |
|------|---------|
| `app/Controllers/HomeController.php` | Landing page rendering |
| `app/Controllers/NewsletterController.php` | Newsletter API proxy |
| `app/Config/Routes.php` | URL routing |
| `public/js/landing/newsletter.js` | Form handling |
| `public/css/landing/base_v2.css` | Main styles |

## Development Workflow

### Adding a New Feature

1. Create a feature branch: `git checkout -b feature/my-feature`
2. Make changes with small, focused commits
3. Test thoroughly locally
4. Create a pull request when ready

### Fixing a Bug

1. Create a fix branch: `git checkout -b fix/issue-name`
2. Write a minimal fix with test coverage
3. Commit with `fix:` prefix
4. Submit for review

### Code Style

- Follow PSR-12 for PHP
- Use meaningful variable/function names
- Keep functions small and focused
- Add comments only for non-obvious logic

### Commit Messages

Follow the conventional commits format:

```
type: short description

feat:    New feature
fix:     Bug fix
refactor: Code reorganization
docs:    Documentation
chore:   Build, deps, config
perf:    Performance improvement
```

Examples:
```
feat: add email validation helper
fix: handle missing API configuration gracefully
refactor: improve newsletter controller error handling
docs: add API integration guide
chore: add setup script
```

## Testing Locally

### Without Real API

Mock the API endpoint on `localhost:3000`:

```bash
node -e "
const http = require('http');
http.createServer((req, res) => {
  console.log('Request:', req.method, req.url);
  if (req.method === 'POST') {
    res.writeHead(200, {'Content-Type': 'application/json'});
    res.end(JSON.stringify({
      success: true,
      message: 'Mock subscription successful'
    }));
  }
}).listen(3000);
"
```

Then update `.env`:
```ini
API_BASE_URL = http://localhost:3000
```

### With Real API

1. Get real API credentials from your team
2. Configure in `.env`
3. Test newsletter form submission
4. Monitor logs: `tail -f writable/logs/log-*.log`

## Debugging

### Enable Debug Mode

Set in `.env`:
```ini
CI_ENVIRONMENT = development
```

Then access debug toolbar at `http://localhost:8080/?debugbar`

### Check Logs

```bash
tail -f writable/logs/log-*.log
```

Look for errors in newsletter submissions or API calls.

### Browser DevTools

1. Open DevTools (F12)
2. Check Console tab for JavaScript errors
3. Check Network tab for failed requests
4. Verify APP_CONFIG is injected in page source

## Common Tasks

### Update Language Strings

Edit files in `app/Language/{locale}/LandingPage.php`

Example:
```php
return [
    'hero.title' => 'Mi Nuevo Título',
    'form.email_placeholder' => 'Tu email...',
];
```

### Modify Styles

CSS files are in `public/css/landing/`:
- `base_v2.css` - Core layout
- `header.css` - Header styles
- `hero.css` - Hero section
- `form-newsletter.css` - Form styles
- `footer.css` - Footer styles

### Update Form Behavior

JavaScript is in `public/js/landing/newsletter.js`

Key class: `Newsletter` with methods:
- `handleSubmit()` - Form submission
- `getRecaptchaToken()` - reCAPTCHA integration
- `handleSuccess()` - Success response
- `handleError()` - Error handling

## Troubleshooting

### "Failed to load resource" 404 errors

Check that:
- CSS files are in `public/css/landing/`
- JS files are in `public/js/landing/`
- Images are in `public/images/`
- Base URL in `.env` is correct

### "API configuration is incomplete"

Ensure `.env` has:
- `API_BASE_URL` set
- `API_KEY` set

### reCAPTCHA not working

1. Check `RECAPTCHA_SITE_KEY` in `.env`
2. Verify key is for v3, not v2
3. Check browser console for reCAPTCHA script errors

### Language not changing

1. Verify URL matches pattern `/{locale}/`
2. Check locale is in supported list: es, en, pt, it, fr
3. Verify language file exists: `app/Language/{locale}/LandingPage.php`

## Next Steps

- Read API_INTEGRATION.md for backend details
- Check README.md for project overview
- Review routing in app/Config/Routes.php
