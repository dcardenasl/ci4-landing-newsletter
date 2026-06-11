<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * Feature tests for the confirm/unsubscribe landing pages.
 *
 * The BFF is not running during unit tests, so flows that call it land on
 * the error branch — which is exactly what these tests assert: the pages
 * render (no 404s from campaign emails) and degrade gracefully.
 *
 * @internal
 */
final class NewsletterPagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testUnsubscribePageRendersFormWhenTokenPresent(): void
    {
        $result = $this->call('get', 'es/unsubscribe?token=some-token');

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.unsubscribe_title'));
        $this->assertStringContainsString('name="token"', $result->getBody());
    }

    public function testUnsubscribePageWithoutTokenShowsError(): void
    {
        $result = $this->call('get', 'es/unsubscribe');

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.missing_token'));
    }

    public function testUnsubscribePageWorksWithoutLocaleSegment(): void
    {
        $result = $this->call('get', 'unsubscribe?token=some-token');

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.unsubscribe_title'));
    }

    public function testUnsubscribePostWithoutTokenShowsError(): void
    {
        $result = $this->call('post', 'es/unsubscribe', ['token' => '']);

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.unsubscribe_error_title'));
    }

    public function testConfirmPageWithUnreachableBffShowsError(): void
    {
        $result = $this->call('get', 'es/confirm/invalid-token');

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.confirm_error_title'));
    }

    public function testConfirmPageWorksWithoutLocaleSegment(): void
    {
        $result = $this->call('get', 'confirm/invalid-token');

        $result->assertStatus(200);
        $result->assertSee(lang('LandingPage.newsletter.confirm_error_title'));
    }

    public function testConfirmPageRespectsLocale(): void
    {
        $result = $this->call('get', 'en/confirm/invalid-token');

        $result->assertStatus(200);
        $result->assertSee('We could not confirm your subscription');
    }

    public function testHomePageExposesAnalyticsEndpoint(): void
    {
        $result = $this->call('get', '/');

        $result->assertStatus(200);
        $this->assertStringContainsString('analyticsEndpoint', $result->getBody());
    }

    public function testConfirmPageInjectsAnalyticsContext(): void
    {
        $result = $this->call('get', 'confirm/invalid-token');

        $result->assertStatus(200);
        $this->assertStringContainsString('confirm_error', $result->getBody());
        $this->assertStringContainsString('pageContextEvent', $result->getBody());
    }
}
