<?php

use CodeIgniter\Test\CIUnitTestCase;
use Config\App;

/**
 * @internal
 */
final class LanguageHelperTest extends CIUnitTestCase
{
    // --- get_supported_languages ---

    public function testReturnsExactlyTheLocalesFromConfig(): void
    {
        $appConfig = config(App::class);
        $result    = get_supported_languages();

        $this->assertSame($appConfig->supportedLocales, array_keys($result));
    }

    public function testEachEntryHasRequiredFields(): void
    {
        $required = ['locale', 'name', 'native_name', 'flag', 'country_code', 'iso_code'];

        foreach (get_supported_languages() as $locale => $info) {
            foreach ($required as $field) {
                $this->assertArrayHasKey(
                    $field,
                    $info,
                    "Locale '{$locale}' is missing field '{$field}'"
                );
            }
            $this->assertSame($locale, $info['locale']);
        }
    }

    // --- is_supported_locale ---

    public function testValidLocaleReturnsTrue(): void
    {
        $this->assertTrue(is_supported_locale('es'));
    }

    public function testInvalidLocaleReturnsFalse(): void
    {
        $this->assertFalse(is_supported_locale('xx'));
    }

    public function testEmptyLocaleReturnsFalse(): void
    {
        $this->assertFalse(is_supported_locale(''));
    }

    // --- get_language_name ---

    public function testReturnsCorrectNameForLocale(): void
    {
        $this->assertSame('English', get_language_name('en'));
    }

    public function testReturnsFallbackForUnknownLocale(): void
    {
        $this->assertSame('Xx', get_language_name('xx'));
    }

    // --- get_language_flag ---

    public function testReturnsCorrectFlagForEsLocale(): void
    {
        $this->assertSame('🇨🇱', get_language_flag('es'));
    }

    public function testReturnsFallbackFlagForUnknownLocale(): void
    {
        $this->assertSame('🌐', get_language_flag('xx'));
    }
}
