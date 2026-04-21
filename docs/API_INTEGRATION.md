# API Integration Guide

This document describes how landing-newsletter-ci4 communicates with the external API.

## Overview

The application implements a **proxy pattern**:
- The browser calls a local endpoint: `POST /{locale}/api/newsletter/subscribe`
- The server proxies the request to the external API
- Sensitive credentials (API_KEY) are never exposed to the browser

## Newsletter Subscription Flow

### 1. Client-Side (Browser)

```javascript
fetch('/es/api/newsletter/subscribe', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    email: 'user@example.com',
    recaptcha_token: 'token_from_google',
    invitation_code: 'optional_code'
  })
})
.then(res => res.json())
.then(data => console.log(data))
```

### 2. Server-Side Proxy

**Endpoint:** `POST /{locale}/api/newsletter/subscribe`

**Controller:** `app/Controllers/NewsletterController.php`

**Validation:**
- Email format (RFC compliant)
- reCAPTCHA token (minimum length check)
- Invitation code (alphanumeric, optional)

**Processing:**
1. Extract and sanitize payload
2. Validate all fields
3. Forward to external API with authentication headers
4. Return API response to client

### 3. External API

**Endpoint:** `POST /newsletter/subscription` (configured in `API_BASE_URL`)

**Request Headers:**
```
Content-Type: application/json
Accept: application/json
X-Site-Id: {SITE_ID}
X-Api-Key: {API_KEY}
```

**Request Body:**
```json
{
  "email": "user@example.com",
  "recaptcha_token": "...",
  "invitation_code": "optional"
}
```

**Response (Success 200):**
```json
{
  "success": true,
  "message": "Subscription successful",
  "invitation_applied": false
}
```

**Response (Validation Error 400):**
```json
{
  "success": false,
  "message": "Email already subscribed",
  "errors": {
    "email": "This email is already registered"
  }
}
```

**Response (Server Error 500):**
```json
{
  "success": false,
  "message": "Internal server error"
}
```

## Error Handling

### Client-Side (400-499)
- Invalid input
- Email already subscribed
- Invalid invitation code

### Server-Side (500-599)
- API misconfiguration
- API timeout or unavailable
- Network error

### Special Cases
- **503**: API unreachable - network error
- **500**: Missing API configuration

## Configuration

Set in `.env`:

```ini
API_BASE_URL = https://api.yourdomain.com
API_KEY = sk_live_your_secret_key
SITE_ID = my-newsletter
```

## Testing the Integration

### Local Testing (without real API)

Mock the API endpoint by running a local server on `http://localhost:3000`:

```bash
node -e "
const http = require('http');
http.createServer((req, res) => {
  if (req.method === 'POST') {
    res.writeHead(200, {'Content-Type': 'application/json'});
    res.end(JSON.stringify({success: true, message: 'Mocked response'}));
  }
}).listen(3000);
"
```

Then set `API_BASE_URL = http://localhost:3000` in `.env`

### Production Testing

1. Deploy to staging environment
2. Configure real API credentials
3. Test full subscription flow
4. Monitor error logs: `writable/logs/`

## Monitoring

Check logs in `writable/logs/log-*.log` for:
- API connection errors
- Validation failures
- Rate limiting issues
- Timeout events

## Security Considerations

- API key is server-side only
- CORS headers handled by API (not this app)
- Email is sanitized before sending
- reCAPTCHA token validation by API
- Request timeout: 10 seconds (hardcoded)
- No request logging of sensitive data
