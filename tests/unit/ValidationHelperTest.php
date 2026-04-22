<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class ValidationHelperTest extends CIUnitTestCase
{
    // --- validate_email ---

    public function testValidEmailReturnsTrue(): void
    {
        $this->assertTrue(validate_email('user@example.com'));
    }

    public function testInvalidEmailReturnsFalse(): void
    {
        $this->assertFalse(validate_email('not-an-email'));
    }

    public function testEmptyEmailReturnsFalse(): void
    {
        $this->assertFalse(validate_email(''));
    }

    public function testEmailWithSpacesReturnsFalse(): void
    {
        $this->assertFalse(validate_email('user @example.com'));
    }

    public function testEmailWithoutAtReturnsFalse(): void
    {
        $this->assertFalse(validate_email('userexample.com'));
    }

    public function testEmailWithoutDomainReturnsFalse(): void
    {
        $this->assertFalse(validate_email('user@'));
    }

    // --- validate_invitation_code ---

    public function testEmptyCodeReturnsTrue(): void
    {
        $this->assertTrue(validate_invitation_code(''));
    }

    public function testValidAlphanumericCodeReturnsTrue(): void
    {
        $this->assertTrue(validate_invitation_code('ABC123'));
    }

    public function testCodeTooShortReturnsFalse(): void
    {
        $this->assertFalse(validate_invitation_code('ab'));
    }

    public function testCodeTooLongReturnsFalse(): void
    {
        $this->assertFalse(validate_invitation_code(str_repeat('a', 51)));
    }

    public function testCodeWithHyphenReturnsFalse(): void
    {
        $this->assertFalse(validate_invitation_code('ABC-123'));
    }

    public function testCodeWithSpacesReturnsFalse(): void
    {
        $this->assertFalse(validate_invitation_code('ABC 123'));
    }

    // --- validate_recaptcha_token ---

    public function testLongTokenReturnsTrue(): void
    {
        $this->assertTrue(validate_recaptcha_token(str_repeat('a', 20)));
    }

    public function testShortTokenReturnsFalse(): void
    {
        $this->assertFalse(validate_recaptcha_token(str_repeat('a', 19)));
    }

    public function testEmptyTokenReturnsFalse(): void
    {
        $this->assertFalse(validate_recaptcha_token(''));
    }

    // --- sanitize_email ---

    public function testSanitizeEmailLowercasesUppercase(): void
    {
        $this->assertSame('user@example.com', sanitize_email('USER@EXAMPLE.COM'));
    }

    public function testSanitizeEmailTrimsSpaces(): void
    {
        $this->assertSame('user@example.com', sanitize_email('  user@example.com  '));
    }

    public function testSanitizeEmailAppliesBoth(): void
    {
        $this->assertSame('user@example.com', sanitize_email('  USER@EXAMPLE.COM  '));
    }
}
