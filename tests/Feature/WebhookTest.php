<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\NewsArticle;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_openclaw_webhook_ingests_payload_successfully()
    {
        $payload = [
            'run_at' => '2026-03-13T08:00:00Z',
            'summary' => 'Daily geopolitics summary',
            'items' => [
                [
                    'title' => 'Test News Article',
                    'source' => 'Test Source',
                    'source_url' => 'https://example.com/test-article',
                    'published_at' => '2026-03-13T06:30:00Z',
                    'region' => 'Test Region',
                    'countries' => ['Test Country'],
                    'actors' => ['Test Actor'],
                    'topic' => 'Security',
                    'priority' => 'high',
                    'summary' => 'This is a test summary.',
                    'why_it_matters' => 'Because it is a test.',
                    'confidence' => 0.99
                ]
            ]
        ];

        $response = $this->postJson(route('webhook.openclaw'), $payload);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('news_articles', [
            'title' => 'Test News Article',
            'source_url' => 'https://example.com/test-article'
        ]);

        $this->assertDatabaseHas('daily_briefs', [
            'summary' => 'Daily geopolitics summary'
        ]);
    }
}
