<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected const DEFAULT_LOCALE = 'es';

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * Validates the locale against the supported list and activates it.
     */
    protected function resolvePageLocale(string $locale): string
    {
        $supportedLocales = config(\Config\App::class)->supportedLocales ?? [self::DEFAULT_LOCALE];
        $locale = in_array($locale, $supportedLocales, true) ? $locale : self::DEFAULT_LOCALE;
        service('language')->setLocale($locale);

        return $locale;
    }

    /**
     * Common view data every page rendered with the landing layout needs.
     *
     * @return array<string, mixed>
     */
    protected function buildPageData(string $locale): array
    {
        return [
            'locale'           => $locale,
            'supportedLocales' => get_language_selector_data($locale),
            'siteConfig'       => config(\Config\SiteConfig::class),
            'appConfig'        => [
                'projectKey'         => env('PROJECT_KEY', ''),
                'projectName'        => project_display_name(),
                'recaptchaSiteKey'   => project_recaptcha_site_key(),
                'newsletterEndpoint' => base_url("/{$locale}/api/newsletter/subscribe"),
                'locale'             => $locale,
            ],
        ];
    }

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
}
