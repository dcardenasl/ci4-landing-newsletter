<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class SiteConfig extends BaseConfig
{
    /**
     * Site Brand & Identity
     */
    public string $siteName = 'NewsLanding';
    public string $siteTagline = 'Subscription Landing Template';
    public string $logoPath = 'images/logos/filma-black.svg';
    public string $logoWhitePath = 'images/logos/filma-white.svg';

    /**
     * Color Palette (injected as CSS custom properties)
     * Used in :root CSS variables for theme customization
     */
    public string $colorPrimary = '#2563eb';
    public string $colorSecondary = '#64748b';
    public string $colorAccent = '#f0f9ff';
    public string $colorBgAlt = '#f8fafc';
    public string $colorBgAccent = '#0f172a';

    /**
     * Images (filenames in /public/images/landing/)
     */
    public string $imageHero = 'hero-landing.webp';
    public string $imageFaq = 'faq-landing.webp';
    public string $imageOptions1 = 'op1-landing.webp';
    public string $imageOptions2 = 'op2-landing.webp';

    /**
     * Enabled Sections (comma-separated)
     * Available sections: header, hero, options, faq, invitation, footer
     * Example: 'header,hero,options,faq,invitation,footer'
     */
    public string $sectionsEnabled = 'header,hero,options,faq,invitation,footer';

    public function __construct()
    {
        parent::__construct();

        // Override from .env
        $this->siteName = env('siteConfig.siteName', $this->siteName);
        $this->siteTagline = env('siteConfig.siteTagline', $this->siteTagline);
        $this->logoPath = env('siteConfig.logoPath', $this->logoPath);
        $this->logoWhitePath = env('siteConfig.logoWhitePath', $this->logoWhitePath);

        $this->colorPrimary = env('siteConfig.colorPrimary', $this->colorPrimary);
        $this->colorSecondary = env('siteConfig.colorSecondary', $this->colorSecondary);
        $this->colorAccent = env('siteConfig.colorAccent', $this->colorAccent);
        $this->colorBgAlt = env('siteConfig.colorBgAlt', $this->colorBgAlt);
        $this->colorBgAccent = env('siteConfig.colorBgAccent', $this->colorBgAccent);

        $this->imageHero = env('siteConfig.imageHero', $this->imageHero);
        $this->imageFaq = env('siteConfig.imageFaq', $this->imageFaq);
        $this->imageOptions1 = env('siteConfig.imageOptions1', $this->imageOptions1);
        $this->imageOptions2 = env('siteConfig.imageOptions2', $this->imageOptions2);

        $this->sectionsEnabled = env('siteConfig.sectionsEnabled', $this->sectionsEnabled);
    }

    /**
     * Get enabled sections as array
     */
    public function getEnabledSections(): array
    {
        return array_filter(
            array_map('trim', explode(',', $this->sectionsEnabled))
        );
    }

    /**
     * Check if a specific section is enabled
     */
    public function isSectionEnabled(string $section): bool
    {
        return in_array($section, $this->getEnabledSections(), true);
    }
}
