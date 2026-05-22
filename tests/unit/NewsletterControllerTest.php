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
}
