<?php

namespace App\Http\Controllers\OpenClaw;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenClaw\StoreWebhookRequest;
use App\Services\News\NewsIngestionService;
use App\Services\OpenClaw\OpenClawPayloadService;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{
    public function __construct(
        private OpenClawPayloadService $payloadService,
        private NewsIngestionService $ingestionService
    ) {}

    public function handle(StoreWebhookRequest $request): JsonResponse
    {
        try {
            $parsedPayload = $this->payloadService->parsePayload($request->validated());
            $this->ingestionService->ingest($parsedPayload);

            return response()->json([
                'success' => true,
                'message' => 'Payload processed successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Log error in real app
            return response()->json([
                'success' => false,
                'message' => 'Failed to process payload: ' . $e->getMessage()
            ], 500);
        }
    }
}
