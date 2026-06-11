<?php

use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

/**
 * @internal
 */
final class NewsletterControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    private string $endpoint = 'es/api/newsletter/subscribe';
    private string $validToken;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validToken = str_repeat('a', 20);
    }

    public function testPostWithInvalidEmailReturns400(): void
    {
        $result = $this->call('post', $this->endpoint, [
            'email'           => 'not-an-email',
            'recaptcha_token' => $this->validToken,
            'invitation_code' => '',
        ]);

        $result->assertStatus(400);
    }

    public function testPostWithEmptyEmailReturns400(): void
    {
        $result = $this->call('post', $this->endpoint, [
            'email'           => '',
            'recaptcha_token' => $this->validToken,
            'invitation_code' => '',
        ]);

        $result->assertStatus(400);
    }

    public function testPostWithoutRecaptchaTokenReturns400(): void
    {
        $result = $this->call('post', $this->endpoint, [
            'email'           => 'user@example.com',
            'recaptcha_token' => '',
            'invitation_code' => '',
        ]);

        $result->assertStatus(400);
    }

    public function testPostWithInvalidInvitationCodeReturns400(): void
    {
        $result = $this->call('post', $this->endpoint, [
            'email'           => 'user@example.com',
            'recaptcha_token' => $this->validToken,
            'invitation_code' => 'invalid-code!',
        ]);

        $result->assertStatus(400);
    }

    public function testPostWithValidPayloadButMissingBffConfigReturns500(): void
    {
        // CI4 test bootstrap reads the project .env, so BFF_URL / PROJECT_KEY may be set.
        // We explicitly clear them here to test the missing-config branch (→ 500).
        $prevBffUrl     = $_ENV['BFF_URL']     ?? null;
        $prevProjectKey = $_ENV['PROJECT_KEY'] ?? null;
        unset($_ENV['BFF_URL'], $_ENV['PROJECT_KEY'], $_SERVER['BFF_URL'], $_SERVER['PROJECT_KEY']);
        putenv('BFF_URL');
        putenv('PROJECT_KEY');

        try {
            $result = $this->call('post', $this->endpoint, [
                'email'           => 'user@example.com',
                'recaptcha_token' => $this->validToken,
                'invitation_code' => '',
            ]);

            $result->assertStatus(500);
        } finally {
            if ($prevBffUrl !== null) {
                $_ENV['BFF_URL'] = $prevBffUrl;
                putenv("BFF_URL={$prevBffUrl}");
            }
            if ($prevProjectKey !== null) {
                $_ENV['PROJECT_KEY'] = $prevProjectKey;
                putenv("PROJECT_KEY={$prevProjectKey}");
            }
        }
    }

    public function testPostForwardsAnalyticsSessionIdToBff(): void
    {
        $prevBffUrl     = $_ENV['BFF_URL'] ?? null;
        $prevProjectKey = $_ENV['PROJECT_KEY'] ?? null;

        $_ENV['BFF_URL'] = 'http://newsletter-bff.test';
        $_ENV['PROJECT_KEY'] = 'landing-project-key';
        putenv('BFF_URL=http://newsletter-bff.test');
        putenv('PROJECT_KEY=landing-project-key');

        $captured = null;

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('getBody')->willReturn(json_encode(['success' => true], JSON_THROW_ON_ERROR));

        $curl = $this->createMock(CURLRequest::class);
        $curl->method('post')->willReturnCallback(
            function (string $url, array $options) use (&$captured, $response): ResponseInterface {
                $captured = array_merge($options, ['url' => $url]);

                return $response;
            }
        );

        Services::injectMock('curlrequest', $curl);

        try {
            $result = $this->call('post', $this->endpoint, [
                'email'                => 'user@example.com',
                'recaptcha_token'      => $this->validToken,
                'invitation_code'      => '',
                'analytics_session_id' => 'session-abc-123',
            ]);

            $result->assertStatus(200);
            $this->assertNotNull($captured);
            $this->assertSame('http://newsletter-bff.test/api/v1/newsletter/subscribers', $captured['url'] ?? null);
            $this->assertSame('session-abc-123', json_decode((string) ($captured['body'] ?? '{}'), true)['analytics_session_id'] ?? null);
            $this->assertSame('landing-project-key', json_decode((string) ($captured['body'] ?? '{}'), true)['project_key'] ?? null);
        } finally {
            Services::resetSingle('curlrequest');

            if ($prevBffUrl !== null) {
                $_ENV['BFF_URL'] = $prevBffUrl;
                putenv("BFF_URL={$prevBffUrl}");
            } else {
                unset($_ENV['BFF_URL'], $_SERVER['BFF_URL']);
                putenv('BFF_URL');
            }

            if ($prevProjectKey !== null) {
                $_ENV['PROJECT_KEY'] = $prevProjectKey;
                putenv("PROJECT_KEY={$prevProjectKey}");
            } else {
                unset($_ENV['PROJECT_KEY'], $_SERVER['PROJECT_KEY']);
                putenv('PROJECT_KEY');
            }
        }
    }
}
