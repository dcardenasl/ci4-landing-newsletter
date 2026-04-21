<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class NewsletterController extends BaseController
{
    public function subscribe(): ResponseInterface
    {
        $apiBase = rtrim(getenv('API_BASE_URL'), '/');
        $siteId  = getenv('SITE_ID') ?: 'default';
        $apiKey  = getenv('API_KEY');

        if (!$apiBase || !$apiKey) {
            return $this->response
                ->setStatusCode(500)
                ->setContentType('application/json')
                ->setBody(json_encode([
                    'success' => false,
                    'message' => 'API configuration is missing',
                ]));
        }

        $payload = [
            'email'             => $this->request->getPost('email') ?? '',
            'recaptcha_token'   => $this->request->getPost('recaptcha_token') ?? '',
            'invitation_code'   => $this->request->getPost('invitation_code') ?? '',
        ];

        $ch = curl_init("{$apiBase}/newsletter/subscription");
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
                "X-Site-Id: {$siteId}",
                "X-Api-Key: {$apiKey}",
            ],
        ]);

        $response   = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError  = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return $this->response
                ->setStatusCode(500)
                ->setContentType('application/json')
                ->setBody(json_encode([
                    'success' => false,
                    'message' => 'Failed to reach the API',
                ]));
        }

        return $this->response
            ->setStatusCode($statusCode)
            ->setContentType('application/json')
            ->setBody($response);
    }
}
