<?php

use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

/**
 * @internal
 */
final class NewsletterAnalyticsControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function tearDown(): void
    {
        Services::resetSingle('curlrequest');
        parent::tearDown();
    }

    public function testAnalyticsEventsAreProxiedToTheBff(): void
    {
        $prevBffUrl = $_ENV['BFF_URL'] ?? null;
        $_ENV['BFF_URL'] = 'http://newsletter-bff.test';
        putenv('BFF_URL=http://newsletter-bff.test');

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
            $payload = [
                'events' => [
                    [
                        'analytics_session_id' => 'session-abc-123',
                        'project_key' => 'landing-project-key',
                        'event_name' => 'pageview',
                        'page_path' => '/es',
                        'occurred_at' => '2026-06-10T12:00:00Z',
                        'metadata' => [
                            'locale' => 'es',
                        ],
                    ],
                ],
            ];

            $result = $this
                ->withHeaders(['Content-Type' => 'application/json'])
                ->withBody(json_encode($payload, JSON_THROW_ON_ERROR))
                ->post('es/api/newsletter/analytics/events');

            $result->assertStatus(200);
            $this->assertNotNull($captured);
            $this->assertSame('http://newsletter-bff.test/api/v1/newsletter/analytics/events', $captured['url'] ?? null);
            $this->assertSame('session-abc-123', json_decode((string) ($captured['body'] ?? '{}'), true)['events'][0]['analytics_session_id'] ?? null);
        } finally {
            if ($prevBffUrl !== null) {
                $_ENV['BFF_URL'] = $prevBffUrl;
                putenv("BFF_URL={$prevBffUrl}");
            } else {
                unset($_ENV['BFF_URL'], $_SERVER['BFF_URL']);
                putenv('BFF_URL');
            }
        }
    }
}
