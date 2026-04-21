<?php

if (!function_exists('recaptcha_script')) {
    /**
     * Genera el script de reCAPTCHA v3
     */
    function recaptcha_script()
    {
        $siteKey = env('RECAPTCHA_SITE_KEY');
        return '<script src="https://www.google.com/recaptcha/api.js?render=' . $siteKey . '"></script>';
    }
}

if (!function_exists('recaptcha_site_key_js')) {
    /**
     * Genera el JavaScript para establecer la site key globalmente
     */
    function recaptcha_site_key_js()
    {
        $siteKey = env('RECAPTCHA_SITE_KEY');
        return "<script>window.RECAPTCHA_SITE_KEY = '{$siteKey}';</script>";
    }
}

if (!function_exists('recaptcha_js')) {
    /**
     * Genera el JavaScript para ejecutar reCAPTCHA
     * @param string $action Acción específica para reCAPTCHA
     * @param string|null $callback Función callback personalizada
     * @param string $elementId ID del elemento donde guardar el token
     */
    function recaptcha_js($action = 'submit', $callback = null, $elementId = 'recaptcha_token')
    {
        $siteKey = env('RECAPTCHA_SITE_KEY');
        $callbackFunction = $callback ?: "function(token) { 
            const element = document.getElementById('{$elementId}');
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
     * Verifica el token de reCAPTCHA con Google
     * @param string $token Token de reCAPTCHA
     * @param string $action Acción esperada (opcional)
     * @param float $threshold Umbral mínimo de puntuación (0.0 - 1.0)
     * @return array Resultado de la verificación
     */
    function verify_recaptcha($token, $action = null, $threshold = 0.5)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');

        if (empty($secretKey) || empty($token)) {
            return [
                'success' => false,
                'error' => 'Configuración de reCAPTCHA incompleta'
            ];
        }

        // Preparar datos para la verificación
        $postData = [
            'secret' => $secretKey,
            'response' => $token,
            'remoteip' => service('request')->getIPAddress()
        ];

        // Realizar petición a Google reCAPTCHA API
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_error($ch)) {
            curl_close($ch);
            return [
                'success' => false,
                'error' => 'Error de conexión con reCAPTCHA: ' . curl_error($ch)
            ];
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            return [
                'success' => false,
                'error' => 'Error HTTP en verificación reCAPTCHA: ' . $httpCode
            ];
        }

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'error' => 'Error al decodificar respuesta de reCAPTCHA'
            ];
        }

        // Verificar respuesta básica
        if (!$result['success']) {
            $errorCodes = $result['error-codes'] ?? [];
            return [
                'success' => false,
                'error' => 'Verificación reCAPTCHA fallida',
                'error_codes' => $errorCodes
            ];
        }

        // Verificar acción si se especifica
        if ($action && isset($result['action']) && $result['action'] !== $action) {
            return [
                'success' => false,
                'error' => 'Acción reCAPTCHA no válida'
            ];
        }

        // Verificar puntuación
        $score = $result['score'] ?? 0;
        if ($score < $threshold) {
            return [
                'success' => false,
                'error' => 'Puntuación reCAPTCHA muy baja',
                'score' => $score
            ];
        }

        return [
            'success' => true,
            'score' => $score,
            'action' => $result['action'] ?? null,
            'challenge_ts' => $result['challenge_ts'] ?? null,
            'hostname' => $result['hostname'] ?? null
        ];
    }
}

if (!function_exists('recaptcha_hidden_input')) {
    /**
     * Genera un input hidden para el token de reCAPTCHA
     * @param string $id ID del input
     * @param string $name Nombre del input
     */
    function recaptcha_hidden_input($id = 'recaptcha_token', $name = 'recaptcha_token')
    {
        return '<input type="hidden" id="' . $id . '" name="' . $name . '" value="">';
    }
}
