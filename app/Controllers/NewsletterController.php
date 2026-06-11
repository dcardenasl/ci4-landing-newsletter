<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class NewsletterController extends BaseController
{
    private const TIMEOUT_SECONDS = 10;

    public function subscribe(string $locale = self::DEFAULT_LOCALE): ResponseInterface
    {
        $bffUrl     = rtrim(env('BFF_URL', ''), '/');
        $projectKey = env('PROJECT_KEY', '');

        if (!$bffUrl || !$projectKey) {
            return $this->errorResponse('BFF configuration is incomplete', 500);
        }

        $payload                = $this->extractPayload();
        $payload['project_key'] = $projectKey;

        if (empty($payload['locale'])) {
            $payload['locale'] = $locale;
        }

        if (!$this->isValidPayload($payload)) {
            return $this->errorResponse('Invalid email or reCAPTCHA token', 400);
        }

        return $this->callBff($bffUrl, $payload);
    }

    /**
     * Double opt-in landing page: consumes the BFF confirm endpoint and
     * renders a human-readable success/error page.
     */
    public function confirmPage(string $locale = self::DEFAULT_LOCALE, string $token = ''): string
    {
        $locale = $this->resolvePageLocale($locale);
        $pageData = $this->buildPageData($locale);

        $confirmed = $token !== '' && $this->callBffConfirm($token);

        $pageData['appConfig'] = $pageData['appConfig'] + [
            'pageType' => 'confirm',
            'pageState' => $confirmed ? 'success' : 'error',
            'pageContextEvent' => $confirmed ? 'confirm_accepted' : 'confirm_error',
        ];

        return view('frontend/pages/newsletter/confirm', $pageData + [
            'confirmed' => $confirmed,
        ]);
    }

    /**
     * Unsubscribe landing page: shows a confirmation form for the token
     * carried in `?token=` (campaign emails link here).
     */
    public function unsubscribePage(string $locale = self::DEFAULT_LOCALE): string
    {
        $locale = $this->resolvePageLocale($locale);
        $pageData = $this->buildPageData($locale);
        $token  = (string) ($this->request->getGet('token') ?? '');

        $pageData['appConfig'] = $pageData['appConfig'] + [
            'pageType' => 'unsubscribe',
            'pageState' => $token !== '' ? 'prompt' : 'missing_token',
            'pageContextEvent' => 'unsubscribe_view',
        ];

        return view('frontend/pages/newsletter/unsubscribe', $pageData + [
            'token'  => $token,
            'result' => null,
        ]);
    }

    /**
     * Handles the unsubscribe form POST and renders the outcome.
     */
    public function unsubscribe(string $locale = self::DEFAULT_LOCALE): string
    {
        $locale = $this->resolvePageLocale($locale);
        $pageData = $this->buildPageData($locale);
        $token  = (string) ($this->request->getPost('token') ?? '');

        $result = $token !== '' && $this->callBffUnsubscribe($token);

        $pageData['appConfig'] = $pageData['appConfig'] + [
            'pageType' => 'unsubscribe',
            'pageState' => $result ? 'success' : 'error',
            'pageContextEvent' => $result ? 'unsubscribe_accepted' : 'unsubscribe_error',
        ];

        return view('frontend/pages/newsletter/unsubscribe', $pageData + [
            'token'  => $token,
            'result' => $result,
        ]);
    }

    public function analyticsEvents(string $locale = self::DEFAULT_LOCALE): ResponseInterface
    {
        $bffUrl = rtrim(env('BFF_URL', ''), '/');
        if (!$bffUrl) {
            return $this->errorResponse('BFF configuration is incomplete', 500);
        }

        try {
            $client = service('curlrequest');
            $apiResponse = $client->post("{$bffUrl}/api/v1/newsletter/analytics/events", [
                'headers' => [
                    'Content-Type' => $this->request->getHeaderLine('Content-Type') ?: 'application/json',
                    'Accept'       => 'application/json',
                ],
                'body'        => $this->request->getBody(),
                'timeout'     => self::TIMEOUT_SECONDS,
                'http_errors' => false,
            ]);

            return $this->response
                ->setStatusCode($apiResponse->getStatusCode())
                ->setContentType('application/json')
                ->setBody($apiResponse->getBody() ?: '{}');
        } catch (\Exception $e) {
            log_message('error', '[Newsletter] BFF analytics proxy failed: {message}', ['message' => $e->getMessage()]);

            return $this->errorResponse('Failed to reach the BFF', 503);
        }
    }

    private function callBffConfirm(string $token): bool
    {
        $bffUrl = rtrim(env('BFF_URL', ''), '/');
        if (!$bffUrl) {
            return false;
        }

        try {
            $response = service('curlrequest')->get(
                "{$bffUrl}/api/v1/newsletter/subscribers/confirm/" . urlencode($token),
                ['headers' => ['Accept' => 'application/json'], 'timeout' => self::TIMEOUT_SECONDS, 'http_errors' => false],
            );

            return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
        } catch (\Exception $e) {
            log_message('error', '[Newsletter] BFF confirm call failed: {message}', ['message' => $e->getMessage()]);

            return false;
        }
    }

    private function callBffUnsubscribe(string $token): bool
    {
        $bffUrl = rtrim(env('BFF_URL', ''), '/');
        if (!$bffUrl) {
            return false;
        }

        try {
            $response = service('curlrequest')->post("{$bffUrl}/api/v1/newsletter/subscribers/unsubscribe", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                'body'        => json_encode(['token' => $token]),
                'timeout'     => self::TIMEOUT_SECONDS,
                'http_errors' => false,
            ]);

            return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
        } catch (\Exception $e) {
            log_message('error', '[Newsletter] BFF unsubscribe call failed: {message}', ['message' => $e->getMessage()]);

            return false;
        }
    }

    private function extractPayload(): array
    {
        return [
            'email' => sanitize_email($this->request->getPost('email') ?? $this->request->getJsonVar('email') ?? ''),
            'recaptcha_token' => $this->request->getPost('recaptcha_token') ?? $this->request->getJsonVar('recaptcha_token') ?? '',
            'invitation_code' => $this->request->getPost('invitation_code') ?? $this->request->getJsonVar('invitation_code') ?? '',
            'analytics_session_id' => $this->request->getPost('analytics_session_id') ?? $this->request->getJsonVar('analytics_session_id') ?? null,
            'locale' => $this->request->getPost('locale') ?? $this->request->getJsonVar('locale') ?? null,
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
            $apiResponse = $client->post("{$bffUrl}/api/v1/newsletter/subscribers", [
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
