#!/bin/bash

# NewsLanding Template - Unified Setup & Customization Script
# This script handles both initial project setup and template customization
# Usage: ./scripts/setup.sh [PROJECT_NAME] [OPTIONS]
#   ./scripts/setup.sh                          # Interactive mode
#   ./scripts/setup.sh "My Project"             # Argument-based mode
#   ./scripts/setup.sh "My Project" --skip-commit

set -e

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Configuration
PROJECT_NAME=""
SKIP_COMMIT=false
FORCE_COMMIT=false
CUSTOMIZE_MODE=false

# Detect OS for sed compatibility
OS_TYPE=$(uname -s)
if [ "$OS_TYPE" = "Darwin" ]; then
    SED_OPTS="-i ''"
else
    SED_OPTS="-i"
fi

# ============================================================================
# HELPER FUNCTIONS
# ============================================================================

print_banner() {
    echo -e "${BLUE}=================================================="
    echo "NewsLanding Template - Setup & Customization"
    echo "==================================================${NC}"
    echo ""
}

print_step() {
    echo -e "${YELLOW}→ $1${NC}"
}

print_success() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}❌${NC} $1" >&2
}

print_info() {
    echo -e "${CYAN}ℹ${NC} $1"
}

# Check if composer is installed
check_composer() {
    if ! command -v composer &> /dev/null; then
        print_error "Composer not found. Please install Composer first."
        echo "   Visit: https://getcomposer.org/download/" >&2
        exit 1
    fi
    print_success "Composer found"
}

# Check if git is initialized
check_git() {
    if ! git rev-parse --git-dir > /dev/null 2>&1; then
        print_error "Not a git repository"
        exit 1
    fi
    print_success "Git repository found"
}

# Validate project name
validate_project_name() {
    local name="$1"

    # Check length
    if [ ${#name} -lt 2 ] || [ ${#name} -gt 50 ]; then
        print_error "Project name must be between 2 and 50 characters"
        return 1
    fi

    # Check for reserved words
    if [[ "$name" == *"NewsLanding"* ]] || [[ "$name" == *"newslanding"* ]]; then
        print_error "Project name cannot contain 'NewsLanding'"
        return 1
    fi

    # Warn about special characters
    if [[ "$name" =~ [^a-zA-Z0-9\ \-] ]]; then
        print_info "Project name contains special characters, they will be removed in SITE_ID"
    fi

    return 0
}

# Generate SITE_ID from project name
generate_site_id() {
    local name="$1"
    # Convert to lowercase, remove special chars, replace spaces with hyphens, remove consecutive hyphens
    echo "$name" | tr '[:upper:]' '[:lower:]' | sed 's/[^a-z0-9 -]//g' | sed 's/ /-/g' | sed 's/-\+/-/g' | sed 's/^-\|-$//'
}

# Prompt for project name interactively
prompt_for_project_name() {
    local name=""
    while [ -z "$name" ]; do
        read -p "$(echo -e ${CYAN}Enter project name${NC}): " name
        if ! validate_project_name "$name"; then
            name=""
        fi
    done
    echo "$name"
}

# Show customization confirmation
confirm_customization() {
    local name="$1"
    local site_id="$2"
    local year="$3"

    echo ""
    echo -e "${CYAN}Configuration Summary:${NC}"
    echo "  Project Name:  $name"
    echo "  Site ID:       $site_id"
    echo "  Copyright:     © $year"
    echo ""

    read -p "Continue with customization? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        return 1
    fi
    return 0
}

# Safe replace function with proper sed escaping
safe_replace() {
    local file="$1"
    local old="$2"
    local new="$3"

    if [ ! -f "$file" ]; then
        return 0
    fi

    # Escape special characters for sed
    old=$(printf '%s\n' "$old" | sed -e 's/[\/&]/\\&/g')
    new=$(printf '%s\n' "$new" | sed -e 's/[\/&]/\\&/g')

    # Apply replacement - use -e with proper quoting to avoid eval issues
    if [ "$OS_TYPE" = "Darwin" ]; then
        sed -i '' "s|$old|$new|g" "$file"
    else
        sed -i "s|$old|$new|g" "$file"
    fi
}

# Perform all template replacements
perform_replacements() {
    local project_name="$1"
    local site_id="$2"
    local current_year="$3"

    echo ""
    print_step "Customizing template files..."
    echo ""

    # 1. Language files - Update project name
    print_step "Updating language files (5 locales)..."
    for locale in en es fr it pt; do
        local lang_file="app/Language/$locale/LandingPage.php"
        if [ -f "$lang_file" ]; then
            safe_replace "$lang_file" "NewsLanding" "$project_name"
            safe_replace "$lang_file" "2026" "$current_year"
            print_success "$lang_file"
        fi
    done
    echo ""

    # 2. Update SITE_ID
    print_step "Updating SITE_ID..."
    safe_replace ".env.example" "SITE_ID = my-newsletter" "SITE_ID = $site_id"
    safe_replace ".env" "SITE_ID = my-newsletter" "SITE_ID = $site_id"
    # Also handle the case where .env might have been pre-existing with the old value
    safe_replace ".env" "SITE_ID = landing-kit" "SITE_ID = $site_id"
    safe_replace "env" "SITE_ID = landing-kit" "SITE_ID = $site_id"
    print_success "SITE_ID configuration updated"
    echo ""

    # 3. Update siteName in config
    print_step "Updating configuration..."
    safe_replace "app/Config/SiteConfig.php" "public string \$siteName = 'NewsLanding';" "public string \$siteName = '$project_name';"
    safe_replace ".env.example" 'siteConfig.siteName = "NewsLanding"' "siteConfig.siteName = \"$project_name\""
    safe_replace ".env" 'siteConfig.siteName = "NewsLanding"' "siteConfig.siteName = \"$project_name\""
    print_success "SiteConfig updated"
    echo ""

    # 4. Update web manifest
    print_step "Updating web manifest..."
    safe_replace "public/site.webmanifest" '"name": "NewsLanding Template"' "\"name\": \"$project_name\""
    safe_replace "public/site.webmanifest" '"short_name": "NewsLanding"' "\"short_name\": \"$project_name\""
    print_success "Web manifest updated"
    echo ""

    print_success "All template customizations completed"
}

# Create git commit if requested
create_git_commit() {
    local project_name="$1"
    local current_year="$2"

    echo ""
    print_step "Creating git commit..."

    git add -A
    git commit -m "chore: customize template for '$project_name'

- Update project name from NewsLanding to '$project_name'
- Update SITE_ID to match project identifier
- Update copyright year to $current_year
- Customize all language files and web manifest

Template is now personalized and ready for development.

Co-Authored-By: Setup Script <setup@newslanding.local>"

    print_success "Git commit created"
}

# ============================================================================
# MAIN SETUP FLOW
# ============================================================================

main() {
    print_banner

    # Parse command line arguments
    if [ $# -gt 0 ] && [ "$1" != "--skip-commit" ] && [ "$1" != "--commit" ]; then
        PROJECT_NAME="$1"
        shift
    fi

    # Parse options
    while [ $# -gt 0 ]; do
        case "$1" in
            --skip-commit) SKIP_COMMIT=true ;;
            --commit) FORCE_COMMIT=true ;;
            *) ;;
        esac
        shift
    done

    # Step 1: Pre-flight checks
    print_step "Checking environment..."
    check_composer
    check_git
    echo ""

    # Step 2: Check if .env exists
    if [ ! -f .env ]; then
        print_step "Creating .env from .env.example..."
        cp .env.example .env
        print_success ".env created"
        echo ""
    fi

    # Step 3: Determine if customization is needed
    if grep -q "NewsLanding" .env 2>/dev/null; then
        echo -e "${YELLOW}This appears to be a fresh clone of the NewsLanding template.${NC}"
        echo ""

        # Interactive prompt if no project name provided
        if [ -z "$PROJECT_NAME" ]; then
            read -p "Customize template for your project? (y/n) " -n 1 -r
            echo
            if [[ $REPLY =~ ^[Yy]$ ]]; then
                CUSTOMIZE_MODE=true
                PROJECT_NAME=$(prompt_for_project_name)
            fi
        else
            CUSTOMIZE_MODE=true
        fi

        # Perform customization if enabled
        if [ "$CUSTOMIZE_MODE" = true ]; then
            if ! validate_project_name "$PROJECT_NAME"; then
                print_error "Invalid project name"
                exit 1
            fi

            SITE_ID=$(generate_site_id "$PROJECT_NAME")
            CURRENT_YEAR=$(date +%Y)

            if confirm_customization "$PROJECT_NAME" "$SITE_ID" "$CURRENT_YEAR"; then
                perform_replacements "$PROJECT_NAME" "$SITE_ID" "$CURRENT_YEAR"

                # Handle git commit
                if [ "$FORCE_COMMIT" = true ] || [ "$SKIP_COMMIT" != true ]; then
                    if [ "$SKIP_COMMIT" != true ]; then
                        read -p "Create git commit with customizations? (y/n) " -n 1 -r
                        echo
                    fi
                    if [ "$FORCE_COMMIT" = true ] || [[ $REPLY =~ ^[Yy]$ ]]; then
                        create_git_commit "$PROJECT_NAME" "$CURRENT_YEAR"
                    fi
                fi
            else
                print_info "Skipping customization. Using NewsLanding defaults."
                echo ""
            fi
        fi
    fi

    # Step 4: Install composer dependencies
    echo ""
    print_step "Installing PHP dependencies..."
    composer install
    print_success "Dependencies installed"
    echo ""

    # Step 5: Setup writable directories
    print_step "Setting up writable directories..."
    mkdir -p writable/logs
    mkdir -p writable/cache
    mkdir -p writable/session
    chmod -R 755 writable
    print_success "Writable directories ready"
    echo ""

    # Step 6: Summary and next steps
    echo -e "${BLUE}=================================================="
    echo -e "✅ Setup completed successfully!${NC}"
    echo -e "${BLUE}==================================================${NC}"
    echo ""

    if [ "$CUSTOMIZE_MODE" = true ]; then
        echo -e "${CYAN}Project Details:${NC}"
        echo "  Name: $PROJECT_NAME"
        echo "  Site ID: $SITE_ID"
        echo ""
    fi

    echo -e "${CYAN}Next steps:${NC}"
    echo "1. Edit .env and configure:"
    echo "   - API_BASE_URL (your subscription API endpoint)"
    echo "   - API_KEY (your API authentication key)"
    echo "   - RECAPTCHA_SITE_KEY (public key from Google reCAPTCHA v3)"
    echo "   - RECAPTCHA_SECRET_KEY (private key from Google reCAPTCHA v3)"
    echo "   - Optional: GA4_ID, GTM_ID for analytics"
    echo ""
    echo "2. Customize project assets:"
    echo "   - Update images in public/images/landing/"
    echo "   - Review language files in app/Language/{locale}/"
    echo "   - Customize hero section copy and colors via .env"
    echo ""
    echo "3. Run the development server:"
    echo "   php spark serve"
    echo ""
    echo "4. Visit http://localhost:8080 to see your landing page"
    echo ""
}

# Run main function
main "$@"
