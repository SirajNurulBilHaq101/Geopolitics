@props(['title', 'value', 'desc' => null, 'icon' => null, 'trend' => null])

<div {{ $attributes->merge(['class' => 'stat bg-base-100 shadow-sm border border-base-300 rounded-xl px-5 py-4']) }}>
    @if($icon)
        <div class="stat-figure text-primary opacity-80">
            {!! $icon !!}
        </div>
    @endif
    <div class="stat-title text-xs font-medium uppercase tracking-wider opacity-60">{{ $title }}</div>
    <div class="stat-value text-2xl mt-1 tracking-tight">{{ $value }}</div>
    @if($desc)
        <div class="stat-desc mt-2 text-xs flex items-center gap-1 opacity-70">
            @if($trend === 'up')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            @elseif($trend === 'down')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
            @endif
            {{ $desc }}
        </div>
    @endif
</div>
