<?php

namespace App\Controllers;

use Config\App;
use Config\SiteConfig;

class HomeController extends BaseController
{
    private const DEFAULT_LOCALE = 'es';

    public function index(string $locale = self::DEFAULT_LOCALE): string
    {
        $locale = $this->validateLocale($locale);
        service('language')->setLocale($locale);

        $siteConfig = config(SiteConfig::class);

        return view('frontend/pages/home/index', [
            'locale' => $locale,
            'supportedLocales' => get_language_selector_data($locale),
            'appConfig' => $this->buildAppConfig($locale),
            'siteConfig' => $siteConfig,
            'enabledSections' => $siteConfig->getEnabledSections(),
        ]);
    }

    private function validateLocale(string $locale): string
    {
        $appConfig = config(App::class);
        $supportedLocales = $appConfig->supportedLocales ?? [self::DEFAULT_LOCALE];
        return in_array($locale, $supportedLocales) ? $locale : self::DEFAULT_LOCALE;
    }

    private function buildAppConfig(string $locale): array
    {
        return [
            'siteId'             => env('SITE_ID', 'default'),
            'recaptchaSiteKey'   => env('RECAPTCHA_SITE_KEY', ''),
            'newsletterEndpoint' => base_url("/{$locale}/api/newsletter/subscribe"),
        ];
    }
}
