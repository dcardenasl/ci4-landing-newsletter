<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class ProjectConfigHelperTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        helper('project_config');
    }

    public function testProjectRecaptchaSiteKeyFallsBackToEnv(): void
    {
        // Without a reachable BFF, project_config() is empty and the helper
        // must fall back to the RECAPTCHA_SITE_KEY env var.
        $expected = (string) env('RECAPTCHA_SITE_KEY', '');

        $this->assertSame($expected, project_recaptcha_site_key());
    }

    public function testProjectDisplayNameFallsBackToSiteName(): void
    {
        $name = project_display_name();

        $this->assertNotSame('', $name);
    }

    public function testProjectConfigReturnsArray(): void
    {
        $this->assertIsArray(project_config());
    }
}
