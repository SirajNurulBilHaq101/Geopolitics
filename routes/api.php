<?php

use App\Http\Controllers\OpenClaw\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Webhook endpoint for OpenClaw
// In production, protect this using a middleware that checks a shared secret/token
Route::post('/webhook/openclaw', [WebhookController::class, 'handle'])->name('webhook.openclaw');
