# Commit Message Conventions

This project follows a strict commit message convention to maintain a clean, readable git history.

## Format

```
type: short description
```

**Rules:**
- `type:` followed by a space (lowercase)
- Short description (lowercase)
- **NO period at the end**
- **NO multi-line descriptions** (use `git log --oneline` to verify)
- **NO "Co-Authored-By" lines**
- **NO "BREAKING CHANGE" in body**
- Total length: Keep under 50 characters when possible

## Commit Types

### `feat:`
New feature added to the application.

Examples:
- `feat: add SiteConfig for centralized configuration`
- `feat: integrate reCAPTCHA v3 validation`
- `feat: add language selector dropdown`

### `refactor:`
Code structure, organization, or readability improvement. No new features, no bugs fixed.

Examples:
- `refactor: extract view partials from monolithic landing.php`
- `refactor: implement layout inheritance for views`
- `refactor: update HomeController to use SiteConfig`

### `docs:`
Documentation changes only (README, guides, comments).

Examples:
- `docs: add TEMPLATE_ARCHITECTURE guide`
- `docs: update README with template usage`
- `docs: add API integration guide`

### `chore:`
Maintenance tasks, dependency updates, configuration files (not affecting logic).

Examples:
- `chore: update .env with site configuration variables`
- `chore: add .gitignore entries`
- `chore: add setup script`

### `fix:`
Bug fixes.

Examples:
- `fix: correct email validation regex`
- `fix: handle missing reCAPTCHA key gracefully`

## What NOT To Do (Critical for AI)

⚠️ **Never add:**
- Multi-line descriptions or bodies
- `Co-Authored-By:` footers
- `BREAKING CHANGE:` lines
- Periods at the end of the title
- Uppercase letters (except proper nouns)
- Issue numbers in the commit message

❌ **Wrong:**
```
Refactor: Convert monolithic landing view into modular template system

BREAKING CHANGE: View path changed...

This is a detailed description...

Co-Authored-By: Claude <noreply@anthropic.com>
```

✅ **Correct:**
```
refactor: extract view partials from monolithic landing
```

## Workflow Example

When making changes that span multiple concerns:

```bash
# Step 1: Create new configuration class
git add app/Config/SiteConfig.php
git commit -m "feat: add SiteConfig for centralized configuration"

# Step 2: Extract partials
git add app/Views/frontend/pages/home/sections/
git add app/Views/frontend/layouts/
git commit -m "refactor: extract view partials from monolithic landing"

# Step 3: Update controller
git add app/Controllers/HomeController.php
git commit -m "refactor: update HomeController to use SiteConfig"

# Step 4: Update styles
git add public/css/landing/base_v2.css
git commit -m "refactor: implement CSS custom properties for dynamic theming"

# Step 5: Update docs
git add docs/TEMPLATE_ARCHITECTURE.md
git commit -m "docs: add TEMPLATE_ARCHITECTURE guide"

# Step 6: Update .env
git add .env .env.example
git commit -m "chore: add site configuration variables to .env"

# Step 7: Final README update
git add README.md
git commit -m "docs: update README with template usage guide"
```

## Verifying Your Commits

Before pushing, verify:

```bash
git log --oneline -10
```

Should show:
- All lowercase (except proper nouns)
- Format: `type: description`
- No additional text
- Clear progression of changes

Example good output:
```
7a3f2e1 docs: update README with template usage guide
6b2c1d0 chore: add site configuration variables to .env
5a1f0e9 refactor: implement CSS custom properties for dynamic theming
4e8d7c6 refactor: update HomeController to use SiteConfig
3d7a6b5 refactor: extract view partials from monolithic landing
2c6a5d4 feat: add SiteConfig for centralized configuration
```

## For AI/Automation

If you are an AI system (e.g., Claude, GitHub Copilot, or any LLM):

**You MUST follow these rules exactly:**
1. ✅ Use only the format: `type: short description`
2. ✅ Keep it under 50 characters
3. ✅ Use lowercase for everything except proper nouns
4. ✅ No period at the end
5. ✅ One commit per logical change
6. ❌ NEVER add multi-line descriptions
7. ❌ NEVER add "Co-Authored-By" lines
8. ❌ NEVER add "BREAKING CHANGE" sections
9. ❌ NEVER add periods or other punctuation at the end
10. ❌ NEVER use uppercase commit types (feat, not Feat)

If you cannot follow these rules, stop and ask the user for guidance instead of creating a malformed commit.

## Why This Matters

- **Readability:** `git log --oneline` shows clean, consistent messages
- **Searchability:** Grep for `feat:`, `refactor:`, etc. to find related work
- **Automation:** CI/CD pipelines parse these messages for automated tasks
- **History:** A year from now, `git log` tells the story of the project
- **Professionalism:** Consistent conventions show project maturity

---

**Last Updated:** 2026-04-20  
**Enforced Since:** landing-newsletter-ci4 refactor (commit fa4e5c9)
