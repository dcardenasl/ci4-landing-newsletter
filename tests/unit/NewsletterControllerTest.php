<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

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

    public function testPostWithValidPayloadButMissingApiConfigReturns500(): void
    {
        // CI4 test bootstrap reads the project .env, so API_BASE_URL may be set.
        // We explicitly clear it here to test the missing-config branch (→ 500).
        $prevBaseUrl = $_ENV['API_BASE_URL'] ?? null;
        $prevApiKey  = $_ENV['API_KEY']      ?? null;
        unset($_ENV['API_BASE_URL'], $_ENV['API_KEY'], $_SERVER['API_BASE_URL'], $_SERVER['API_KEY']);
        putenv('API_BASE_URL');
        putenv('API_KEY');

        try {
            $result = $this->call('post', $this->endpoint, [
                'email'           => 'user@example.com',
                'recaptcha_token' => $this->validToken,
                'invitation_code' => '',
            ]);

            $result->assertStatus(500);
        } finally {
            if ($prevBaseUrl !== null) {
                $_ENV['API_BASE_URL'] = $prevBaseUrl;
                putenv("API_BASE_URL={$prevBaseUrl}");
            }
            if ($prevApiKey !== null) {
                $_ENV['API_KEY'] = $prevApiKey;
                putenv("API_KEY={$prevApiKey}");
            }
        }
    }
}
