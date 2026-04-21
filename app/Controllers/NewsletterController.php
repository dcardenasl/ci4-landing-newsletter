<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class NewsletterController extends BaseController
{
    private const TIMEOUT_SECONDS = 10;

    public function subscribe(): ResponseInterface
    {
        $apiBase = rtrim(getenv('API_BASE_URL'), '/');
        $siteId = getenv('SITE_ID') ?: 'default';
        $apiKey = getenv('API_KEY');

        if (!$apiBase || !$apiKey) {
            return $this->errorResponse('API configuration is incomplete', 500);
        }

        $payload = $this->extractPayload();

        if (!$this->isValidPayload($payload)) {
            return $this->errorResponse('Invalid email or reCAPTCHA token', 400);
        }

        $response = $this->callExternalApi($apiBase, $siteId, $apiKey, $payload);

        return $response;
    }

    private function extractPayload(): array
    {
        return [
            'email' => sanitize_email($this->request->getPost('email') ?? ''),
            'recaptcha_token' => $this->request->getPost('recaptcha_token') ?? '',
            'invitation_code' => $this->request->getPost('invitation_code') ?? '',
        ];
    }

    private function isValidPayload(array $payload): bool
    {
        $hasValidEmail = !empty($payload['email']) && validate_email($payload['email']);
        $hasValidToken = !empty($payload['recaptcha_token']) && validate_recaptcha_token($payload['recaptcha_token']);
        $hasValidCode = validate_invitation_code($payload['invitation_code']);

        return $hasValidEmail && $hasValidToken && $hasValidCode;
    }

    private function callExternalApi(string $apiBase, string $siteId, string $apiKey, array $payload): ResponseInterface
    {
        $ch = curl_init("{$apiBase}/newsletter/subscription");

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT_SECONDS,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                "X-Site-Id: {$siteId}",
                "X-Api-Key: {$apiKey}",
            ],
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return $this->errorResponse('Failed to reach the API', 503);
        }

        return $this->response
            ->setStatusCode($statusCode)
            ->setContentType('application/json')
            ->setBody($response ?? '{}');
    }

    private function errorResponse(string $message, int $statusCode = 500): ResponseInterface
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setContentType('application/json')
            ->setBody(json_encode([
                'success' => false,
                'message' => $message,
            ]));
    }
}
