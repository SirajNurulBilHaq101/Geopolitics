<?php

namespace App\Http\Requests\OpenClaw;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For security, you can validate tokens here or through middleware.
        // Assuming middleware handles token validation.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'run_at' => 'required|date',
            'summary' => 'required|string',
            'items' => 'required|array',
            'items.*.title' => 'required|string',
            'items.*.source' => 'nullable|string',
            'items.*.source_url' => 'required|url',
            'items.*.published_at' => 'nullable|date',
            'items.*.region' => 'nullable|string',
            'items.*.countries' => 'nullable|array',
            'items.*.countries.*' => 'string',
            'items.*.actors' => 'nullable|array',
            'items.*.actors.*' => 'string',
            'items.*.topic' => 'nullable|string',
            'items.*.priority' => 'nullable|string|in:low,normal,high,critical',
            'items.*.summary' => 'nullable|string',
            'items.*.why_it_matters' => 'nullable|string',
            'items.*.confidence' => 'nullable|numeric|between:0,1',
        ];
    }
}
