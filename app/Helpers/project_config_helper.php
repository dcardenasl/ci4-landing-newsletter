<?php

if (!function_exists('project_config')) {
    /**
     * Fetches the project's public config from the BFF
     * (`GET /api/v1/newsletter/projects/{key}/config`), cached for 5 minutes.
     * Returns [] when the BFF is unreachable or the project is unknown.
     *
     * @return array<string, mixed>
     */
    function project_config(): array
    {
        static $memo = null;
        if ($memo !== null) {
            return $memo;
        }

        $bffUrl     = rtrim((string) env('BFF_URL', ''), '/');
        $projectKey = (string) env('PROJECT_KEY', '');

        if ($bffUrl === '' || $projectKey === '') {
            return $memo = [];
        }

        $cacheKey = 'project_config_' . md5($projectKey);
        $cached   = cache($cacheKey);
        if (is_array($cached)) {
            return $memo = $cached;
        }

        try {
            $response = service('curlrequest')->get(
                "{$bffUrl}/api/v1/newsletter/projects/{$projectKey}/config",
                ['timeout' => 5, 'http_errors' => false],
            );

            if ($response->getStatusCode() !== 200) {
                return $memo = [];
            }

            $json = json_decode((string) $response->getBody(), true);
            $data = is_array($json) ? ($json['data'] ?? $json) : null;

            if (!is_array($data)) {
                return $memo = [];
            }

            cache()->save($cacheKey, $data, 300);

            return $memo = $data;
        } catch (\Throwable $e) {
            log_message('error', '[ProjectConfig] BFF config fetch failed: {message}', ['message' => $e->getMessage()]);

            return $memo = [];
        }
    }
}

if (!function_exists('project_recaptcha_site_key')) {
    /**
     * reCAPTCHA site key from the project's runtime config, with the
     * RECAPTCHA_SITE_KEY env var as fallback.
     */
    function project_recaptcha_site_key(): string
    {
        $key = (string) (project_config()['recaptcha_site_key'] ?? '');

        return $key !== '' ? $key : (string) env('RECAPTCHA_SITE_KEY', '');
    }
}

if (!function_exists('project_display_name')) {
    /**
     * Project name from the runtime config, falling back to the configured site name.
     */
    function project_display_name(): string
    {
        $name = (string) (project_config()['name'] ?? '');

        return $name !== '' ? $name : (string) config(\Config\SiteConfig::class)->siteName;
    }
}
