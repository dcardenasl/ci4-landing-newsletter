<?php

namespace App\Controllers;

use Config\SiteConfig;

class HomeController extends BaseController
{
    public function index(string $locale = self::DEFAULT_LOCALE): string
    {
        $locale = $this->resolvePageLocale($locale);

        $siteConfig = config(SiteConfig::class);

        return view('frontend/pages/home/index', $this->buildPageData($locale) + [
            'enabledSections' => $siteConfig->getEnabledSections(),
        ]);
    }
}
