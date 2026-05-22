<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class NewsletterController extends BaseController
{
    private const TIMEOUT_SECONDS = 10;

    public function subscribe(): ResponseInterface
    {
        $bffUrl     = rtrim(env('BFF_URL', ''), '/');
        $projectKey = env('PROJECT_KEY', '');

        if (!$bffUrl || !$projectKey) {
            return $this->errorResponse('BFF configuration is incomplete', 500);
        }

        $payload                = $this->extractPayload();
        $payload['project_key'] = $projectKey;

        if (!$this->isValidPayload($payload)) {
            return $this->errorResponse('Invalid email or reCAPTCHA token', 400);
        }

        return $this->callBff($bffUrl, $payload);
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

    private function callBff(string $bffUrl, array $payload): ResponseInterface
    {
        try {
            $client      = service('curlrequest');
            $apiResponse = $client->post("{$bffUrl}/api/v1/subscribe", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
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
            log_message('error', '[Newsletter] BFF call failed: {message}', ['message' => $e->getMessage()]);

            return $this->errorResponse('Failed to reach the BFF', 503);
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
