@props(['type' => 'neutral'])

@php
    $colorClass = match ($type) {
        'high', 'critical', 'error' => 'badge-error',
        'warning' => 'badge-warning',
        'info' => 'badge-info',
        'success' => 'badge-success',
        'primary' => 'badge-primary',
        'secondary' => 'badge-secondary',
        'ghost' => 'badge-ghost',
        default => 'badge-neutral',
    };
@endphp

<div {{ $attributes->merge(['class' => "badge {$colorClass} badge-sm font-semibold tracking-wide"]) }}>
    {{ $slot }}
</div>
