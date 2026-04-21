#!/bin/bash

# Landing Newsletter CI4 - Setup Script
# This script automates the initial setup of the application

set -e

echo "=================================================="
echo "Landing Newsletter CI4 - Setup"
echo "=================================================="
echo ""

# Check if .env exists
if [ -f .env ]; then
    echo "⚠️  .env file already exists, skipping creation..."
else
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env
    echo "✅ .env created"
    echo ""
    echo "⚡ IMPORTANT: Edit .env and configure:"
    echo "   - API_BASE_URL"
    echo "   - API_KEY"
    echo "   - RECAPTCHA_SITE_KEY"
    echo ""
fi

# Check if composer.json exists
if [ ! -f composer.json ]; then
    echo "❌ composer.json not found. Are you in the project root?"
    exit 1
fi

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
if command -v composer &> /dev/null; then
    composer install
else
    echo "❌ Composer not found. Please install Composer first."
    echo "   Visit: https://getcomposer.org/download/"
    exit 1
fi
echo "✅ Dependencies installed"
echo ""

# Check writable directory
echo "🔐 Checking writable directory..."
if [ ! -d writable ]; then
    mkdir -p writable
fi

if [ ! -d writable/logs ]; then
    mkdir -p writable/logs
fi

chmod -R 777 writable
echo "✅ Writable directory ready"
echo ""

# Summary
echo "=================================================="
echo "✅ Setup completed successfully!"
echo "=================================================="
echo ""
echo "Next steps:"
echo "1. Configure your .env file with API credentials"
echo "2. Run: php spark serve"
echo "3. Visit: http://localhost:8080"
echo ""
