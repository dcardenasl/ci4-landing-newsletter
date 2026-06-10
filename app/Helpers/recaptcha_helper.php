<?php

if (!function_exists('recaptcha_script')) {
    function recaptcha_script(): string
    {
        $siteKey = project_recaptcha_site_key();
        return '<script src="https://www.google.com/recaptcha/api.js?render=' . $siteKey . '"></script>';
    }
}

if (!function_exists('recaptcha_site_key_js')) {
    function recaptcha_site_key_js(): string
    {
        $siteKey = project_recaptcha_site_key();
        return "<script>window.RECAPTCHA_SITE_KEY = '{$siteKey}';</script>";
    }
}

if (!function_exists('recaptcha_js')) {
    function recaptcha_js(string $action = 'submit', ?string $callback = null, string $elementId = 'recaptcha_token'): string
    {
        $siteKey = project_recaptcha_site_key();
        $callbackFunction = $callback ?: "function(token) {
            const element = document.querySelector('[name=\"{$elementId}\"]');
            if (element) element.value = token;
        }";

        return "
        <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{$siteKey}', {action: '{$action}'}).then({$callbackFunction});
        });
        </script>";
    }
}

if (!function_exists('verify_recaptcha')) {
    /**
     * Verifica el token de reCAPTCHA con Google.
     * Requiere RECAPTCHA_SECRET_KEY en el .env.
     *
     * @return array{success: bool, score?: float, action?: string|null, challenge_ts?: string|null, hostname?: string|null, error?: string, error_codes?: list<string>}
     */
    function verify_recaptcha(string $token, ?string $action = null, float $threshold = 0.5): array
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY', '');

        if (empty($secretKey) || empty($token)) {
            return [
                'success' => false,
                'error'   => 'Configuración de reCAPTCHA incompleta',
            ];
        }

        $postData = [
            'secret'   => $secretKey,
            'response' => $token,
            'remoteip' => service('request')->getIPAddress(),
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($postData),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response   = curl_exec($ch);
        $httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError  = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['success' => false, 'error' => 'Error de conexión con reCAPTCHA: ' . $curlError];
        }

        if ($httpCode !== 200) {
            return ['success' => false, 'error' => 'Error HTTP en verificación reCAPTCHA: ' . $httpCode];
        }

        $result = json_decode((string) $response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'error' => 'Error al decodificar respuesta de reCAPTCHA'];
        }

        if (!$result['success']) {
            return [
                'success'     => false,
                'error'       => 'Verificación reCAPTCHA fallida',
                'error_codes' => $result['error-codes'] ?? [],
            ];
        }

        if ($action !== null && isset($result['action']) && $result['action'] !== $action) {
            return ['success' => false, 'error' => 'Acción reCAPTCHA no válida'];
        }

        $score = (float) ($result['score'] ?? 0);
        if ($score < $threshold) {
            return ['success' => false, 'error' => 'Puntuación reCAPTCHA muy baja', 'score' => $score];
        }

        return [
            'success'      => true,
            'score'        => $score,
            'action'       => $result['action'] ?? null,
            'challenge_ts' => $result['challenge_ts'] ?? null,
            'hostname'     => $result['hostname'] ?? null,
        ];
    }
}

if (!function_exists('recaptcha_hidden_input')) {
    /**
     * Genera un input hidden para el token de reCAPTCHA.
     * El JS lo localiza por el atributo name dentro del scope del formulario.
     */
    function recaptcha_hidden_input(string $name = 'recaptcha_token'): string
    {
        return '<input type="hidden" name="' . $name . '" value="">';
    }
}
