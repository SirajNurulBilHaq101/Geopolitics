<?php

namespace App\Services\News;

use App\Models\NewsArticle;
use App\Models\DailyBrief;

class NewsIngestionService
{
    /**
     * Ingest parsed payload, deduplicate and save articles.
     */
    public function ingest(array $parsedPayload): void
    {
        // 1. Save Daily Brief
        if (!empty($parsedPayload['summary'])) {
            DailyBrief::create([
                'run_at' => $parsedPayload['run_at'],
                'summary' => $parsedPayload['summary'],
            ]);
        }

        // 2. Insert or Update Articles (Deduplication based on source_url)
        foreach ($parsedPayload['items'] as $item) {
            NewsArticle::updateOrCreate(
                ['source_url' => $item['source_url']],
                [
                    'title' => $item['title'],
                    'source' => $item['source'],
                    'published_at' => $item['published_at'],
                    'region' => $item['region'],
                    'topic' => $item['topic'],
                    'priority' => $item['priority'],
                    'summary' => $item['summary'],
                    'why_it_matters' => $item['why_it_matters'],
                    'countries' => $item['countries'],
                    'actors' => $item['actors'],
                    'confidence' => $item['confidence'],
                    'payload_raw' => $item['payload_raw'],
                ]
            );
        }
    }
}
