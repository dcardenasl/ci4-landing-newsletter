<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(string $locale = 'es'): string
    {
        $supported = ['es', 'en', 'pt', 'it', 'fr'];
        if (!in_array($locale, $supported)) {
            $locale = 'es';
        }

        service('language')->setLocale($locale);

        return view('frontend/pages/home/landing', [
            'locale'           => $locale,
            'supportedLocales' => get_language_selector_data($locale),
            'appConfig'        => [
                'siteId'             => getenv('SITE_ID') ?: 'default',
                'recaptchaSiteKey'   => getenv('RECAPTCHA_SITE_KEY') ?: '',
                'newsletterEndpoint' => base_url("/{$locale}/api/newsletter/subscribe"),
            ],
        ]);
    }
}
