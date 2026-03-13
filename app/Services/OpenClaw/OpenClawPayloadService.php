<?php

namespace App\Services\OpenClaw;

use Carbon\Carbon;

class OpenClawPayloadService
{
    /**
     * Parse and structure the raw webhook payload.
     */
    public function parsePayload(array $payload): array
    {
        return [
            'run_at' => Carbon::parse($payload['run_at']),
            'summary' => $payload['summary'] ?? null,
            'items' => array_map(function ($item) {
                return [
                    'title' => $item['title'],
                    'source' => $item['source'] ?? null,
                    'source_url' => $item['source_url'],
                    'published_at' => isset($item['published_at']) ? Carbon::parse($item['published_at']) : null,
                    'region' => $item['region'] ?? null,
                    'countries' => $item['countries'] ?? [],
                    'actors' => $item['actors'] ?? [],
                    'topic' => $item['topic'] ?? null,
                    'priority' => $item['priority'] ?? 'normal',
                    'summary' => $item['summary'] ?? null,
                    'why_it_matters' => $item['why_it_matters'] ?? null,
                    'confidence' => $item['confidence'] ?? null,
                    // Keep original in payload_raw for auditing
                    'payload_raw' => $item,
                ];
            }, $payload['items'] ?? [])
        ];
    }
}
