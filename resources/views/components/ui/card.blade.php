@props(['title' => null, 'icon' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'card bg-base-100 shadow-sm border border-base-300 w-full rounded-xl']) }}>
    @if($title)
        <div class="card-body pb-2 p-5 border-b border-base-200/50">
            <h2 class="card-title text-base font-semibold flex items-center gap-2">
                @if($icon)
                    {!! $icon !!}
                @endif
                {{ $title }}
            </h2>
        </div>
    @endif
    <div class="card-body p-5">
        {{ $slot }}
    </div>
    @if($footer)
        <div class="bg-base-200/50 px-5 py-3 border-t border-base-200 rounded-b-xl text-xs text-base-content/70 flex justify-between items-center">
            {{ $footer }}
        </div>
    @endif
</div>
