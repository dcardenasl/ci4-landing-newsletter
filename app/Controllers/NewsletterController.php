<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class NewsletterController extends BaseController
{
    private const TIMEOUT_SECONDS = 10;

    public function subscribe(): ResponseInterface
    {
        $apiBase = rtrim(env('API_BASE_URL', ''), '/');
        $siteId  = env('SITE_ID', 'default');
        $apiKey  = env('API_KEY', '');

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
        try {
            $client      = service('curlrequest');
            $apiResponse = $client->post("{$apiBase}/newsletter/subscription", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                    'X-Site-Id'    => $siteId,
                    'X-Api-Key'    => $apiKey,
                ],
                'body'        => json_encode($payload),
                'timeout'     => self::TIMEOUT_SECONDS,
                'http_errors' => false,
            ]);

            return $this->response
                ->setStatusCode($apiResponse->getStatusCode())
                ->setContentType('application/json')
                ->setBody($apiResponse->getBody() ?: '{}');
        } catch (\Exception $e) {
            log_message('error', '[Newsletter] API call failed: {message}', ['message' => $e->getMessage()]);

            return $this->errorResponse('Failed to reach the API', 503);
        }
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
