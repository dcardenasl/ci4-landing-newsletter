<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    private const SUPPORTED_LOCALES = ['es', 'en', 'pt', 'it', 'fr'];
    private const DEFAULT_LOCALE = 'es';

    public function index(string $locale = self::DEFAULT_LOCALE): string
    {
        $locale = $this->validateLocale($locale);
        service('language')->setLocale($locale);

        return view('frontend/pages/home/landing', [
            'locale' => $locale,
            'supportedLocales' => get_language_selector_data($locale),
            'appConfig' => $this->buildAppConfig($locale),
        ]);
    }

    private function validateLocale(string $locale): string
    {
        return in_array($locale, self::SUPPORTED_LOCALES) ? $locale : self::DEFAULT_LOCALE;
    }

    private function buildAppConfig(string $locale): array
    {
        return [
            'siteId' => getenv('SITE_ID') ?: 'default',
            'recaptchaSiteKey' => getenv('RECAPTCHA_SITE_KEY') ?: '',
            'newsletterEndpoint' => base_url("/{$locale}/api/newsletter/subscribe"),
        ];
    }
}
