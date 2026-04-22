<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class RecaptchaHelperTest extends CIUnitTestCase
{
    // --- recaptcha_hidden_input ---

    public function testDefaultHiddenInputHasCorrectOutput(): void
    {
        $this->assertSame(
            '<input type="hidden" name="recaptcha_token" value="">',
            recaptcha_hidden_input()
        );
    }

    public function testCustomNameHiddenInput(): void
    {
        $this->assertSame(
            '<input type="hidden" name="my_token" value="">',
            recaptcha_hidden_input('my_token')
        );
    }

    // --- recaptcha_script ---

    public function testScriptContainsGoogleRecaptchaUrl(): void
    {
        $this->assertStringContainsString(
            'https://www.google.com/recaptcha/api.js',
            recaptcha_script()
        );
    }

    // --- recaptcha_site_key_js ---

    public function testSiteKeyJsContainsWindowVariable(): void
    {
        $this->assertStringContainsString(
            'window.RECAPTCHA_SITE_KEY',
            recaptcha_site_key_js()
        );
    }
}
