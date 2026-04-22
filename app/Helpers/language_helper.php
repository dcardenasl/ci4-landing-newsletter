<?php

use Config\App;

if (!function_exists('get_supported_languages')) {
    /**
     * Obtiene la configuración de idiomas activos según App::$supportedLocales.
     * Los metadatos (flags, nombres, iso_code) son opinionados y se mantienen aquí;
     * App::$supportedLocales es la única fuente de verdad sobre qué locales están activos.
     *
     * @return array<string, array{locale: string, name: string, native_name: string, flag: string, country_code: string, iso_code: string}>
     */
    function get_supported_languages(): array
    {
        $meta = [
            'es' => ['name' => 'Español',    'native_name' => 'Español',   'flag' => '🇨🇱', 'country_code' => 'CL', 'iso_code' => 'es-CL'],
            'en' => ['name' => 'English',    'native_name' => 'English',   'flag' => '🇺🇸', 'country_code' => 'US', 'iso_code' => 'en-US'],
            'pt' => ['name' => 'Portuguese', 'native_name' => 'Português', 'flag' => '🇧🇷', 'country_code' => 'BR', 'iso_code' => 'pt-BR'],
            'it' => ['name' => 'Italian',    'native_name' => 'Italiano',  'flag' => '🇮🇹', 'country_code' => 'IT', 'iso_code' => 'it-IT'],
            'fr' => ['name' => 'French',     'native_name' => 'Français',  'flag' => '🇫🇷', 'country_code' => 'FR', 'iso_code' => 'fr-FR'],
        ];

        $result = [];
        foreach (config(App::class)->supportedLocales as $locale) {
            $result[$locale] = array_merge(
                ['locale' => $locale],
                $meta[$locale] ?? [
                    'name'         => ucfirst($locale),
                    'native_name'  => ucfirst($locale),
                    'flag'         => '🌐',
                    'country_code' => strtoupper($locale),
                    'iso_code'     => $locale,
                ]
            );
        }
        return $result;
    }
}

if (!function_exists('get_language_flag')) {
    /**
     * Obtiene la bandera del idioma
     * 
     * @param string $locale Código del idioma
     * @return string Emoji de la bandera
     */
    function get_language_flag(string $locale): string
    {
        $languages = get_supported_languages();
        return $languages[$locale]['flag'] ?? '🌐';
    }
}

if (!function_exists('get_language_name')) {
    /**
     * Obtiene el nombre del idioma
     * 
     * @param string $locale Código del idioma
     * @param bool $native Si true, devuelve el nombre nativo del idioma
     * @return string Nombre del idioma
     */
    function get_language_name(string $locale, bool $native = false): string
    {
        $languages = get_supported_languages();

        if (!isset($languages[$locale])) {
            return ucfirst($locale);
        }

        return $native ? $languages[$locale]['native_name'] : $languages[$locale]['name'];
    }
}

if (!function_exists('get_all_language_flags')) {
    /**
     * Obtiene todas las banderas de idiomas soportados
     * 
     * @param array|null $locales Array de locales específicos. Si es null, devuelve todos
     * @return array Array asociativo [locale => flag]
     */
    function get_all_language_flags(?array $locales = null): array
    {
        $languages = get_supported_languages();
        $flags = [];

        $targetLocales = $locales ?? array_keys($languages);

        foreach ($targetLocales as $locale) {
            if (isset($languages[$locale])) {
                $flags[$locale] = $languages[$locale]['flag'];
            }
        }

        return $flags;
    }
}

if (!function_exists('get_all_language_names')) {
    /**
     * Obtiene todos los nombres de idiomas soportados
     * 
     * @param array|null $locales Array de locales específicos. Si es null, devuelve todos
     * @param bool $native Si true, devuelve los nombres nativos
     * @return array Array asociativo [locale => name]
     */
    function get_all_language_names(?array $locales = null, bool $native = false): array
    {
        $languages = get_supported_languages();
        $names = [];

        $targetLocales = $locales ?? array_keys($languages);
        $nameKey = $native ? 'native_name' : 'name';

        foreach ($targetLocales as $locale) {
            if (isset($languages[$locale])) {
                $names[$locale] = $languages[$locale][$nameKey];
            }
        }

        return $names;
    }
}

if (!function_exists('get_language_info')) {
    /**
     * Obtiene toda la información de un idioma específico
     * 
     * @param string $locale Código del idioma
     * @return array|null Array con toda la información del idioma o null si no existe
     */
    function get_language_info(string $locale): ?array
    {
        $languages = get_supported_languages();
        return $languages[$locale] ?? null;
    }
}

if (!function_exists('get_current_url_with_locale')) {
    /**
     * Obtiene la URL actual con un idioma específico
     * 
     * @param string $locale Código del idioma
     * @return string URL con el nuevo locale
     */
    function get_current_url_with_locale(string $locale): string
    {
        $request = service('request');
        $currentUrl = current_url();
        $baseUrl = base_url();

        // Obtener la ruta actual sin el dominio
        $path = str_replace($baseUrl, '', $currentUrl);
        $segments = array_filter(explode('/', trim($path, '/')));

        // Obtener los idiomas configurados
        $appConfig = config(App::class);
        $supportedLocales = $appConfig->supportedLocales ?? ['es', 'en', 'pt', 'it', 'fr'];

        // Si el primer segmento es un idioma, reemplazarlo
        if (!empty($segments) && in_array($segments[0], $supportedLocales)) {
            $segments[0] = $locale;
        } else {
            // Si no hay idioma en la URL, agregarlo al inicio
            array_unshift($segments, $locale);
        }

        // Construir la nueva URL
        $newPath = implode('/', $segments);
        $queryString = $request->getUri()->getQuery();

        $newUrl = rtrim($baseUrl, '/') . '/' . $newPath;

        // Agregar query string si existe
        if (!empty($queryString)) {
            $newUrl .= '?' . $queryString;
        }

        return $newUrl;
    }
}

if (!function_exists('is_supported_locale')) {
    /**
     * Verifica si un locale está soportado
     * 
     * @param string $locale Código del idioma a verificar
     * @return bool True si está soportado, false en caso contrario
     */
    function is_supported_locale(string $locale): bool
    {
        $languages = get_supported_languages();
        return isset($languages[$locale]);
    }
}

if (!function_exists('get_language_selector_data')) {
    /**
     * Obtiene todos los datos necesarios para el selector de idiomas
     * Función de conveniencia que combina toda la información necesaria
     * 
     * @param string $currentLocale Idioma actual
     * @return array Array con toda la información del selector
     */
    function get_language_selector_data(string $currentLocale): array
    {
        $configuredLanguages = get_supported_languages();
        $languages = [];

        foreach ($configuredLanguages as $locale => $info) {
            $languages[] = [
                'locale' => $locale,
                'name' => $info['name'],
                'native_name' => $info['native_name'],
                'flag' => $info['flag'],
                'country_code' => $info['country_code'],
                'iso_code' => $info['iso_code'],
                'url' => get_current_url_with_locale($locale),
                'is_current' => $locale === $currentLocale
            ];
        }

        // Información del idioma actual
        $currentLanguageInfo = get_language_info($currentLocale);
        $currentLanguage = $currentLanguageInfo ? [
            'locale' => $currentLocale,
            'name' => $currentLanguageInfo['name'],
            'native_name' => $currentLanguageInfo['native_name'],
            'flag' => $currentLanguageInfo['flag'],
            'code' => strtoupper($currentLocale),
            'country_code' => $currentLanguageInfo['country_code'],
            'iso_code' => $currentLanguageInfo['iso_code']
        ] : [
            'locale' => $currentLocale,
            'name' => ucfirst($currentLocale),
            'native_name' => ucfirst($currentLocale),
            'flag' => '🌐',
            'code' => strtoupper($currentLocale),
            'country_code' => '',
            'iso_code' => $currentLocale
        ];

        return [
            'current_language' => $currentLanguage,
            'languages' => $languages,
            'total_languages' => count($languages)
        ];
    }
}
