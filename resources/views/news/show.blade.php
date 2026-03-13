<x-layout.app title="{{ $newsArticle->title }} - GeoBase">
    <x-slot:header>
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('news.index') }}" class="text-sm hover:underline opacity-70">&larr; Back to Feed</a>
        </div>
        <div class="flex flex-wrap gap-2 mb-3">
            @if($newsArticle->priority === 'critical' || $newsArticle->priority === 'high')
                <x-ui.badge type="error">{{ strtoupper($newsArticle->priority) }}</x-ui.badge>
            @else
                <x-ui.badge type="ghost">{{ strtoupper($newsArticle->priority) }}</x-ui.badge>
            @endif
            @if($newsArticle->region) <x-ui.badge type="primary">{{ $newsArticle->region }}</x-ui.badge> @endif
            @if($newsArticle->topic) <x-ui.badge type="secondary">{{ $newsArticle->topic }}</x-ui.badge> @endif
        </div>
        <h2 class="text-3xl font-bold tracking-tight leading-tight mb-2">{{ $newsArticle->title }}</h2>
        <div class="flex items-center gap-4 text-xs opacity-70">
            <span>By <span class="font-medium">{{ $newsArticle->source ?? 'Unknown Source' }}</span></span>
            <span>&bull;</span>
            <span>Published: {{ $newsArticle->published_at?->format('M j, Y, H:i') }}</span>
        </div>
    </x-slot:header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            <x-ui.card title="Summary">
                <p class="text-base leading-relaxed whitespace-pre-line">{{ $newsArticle->summary }}</p>
            </x-ui.card>

            @if($newsArticle->why_it_matters)
                <x-ui.card class="bg-warning/5 border-warning/20">
                    <x-slot:title>
                        <div class="text-warning flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Why It Matters
                        </div>
                    </x-slot:title>
                    <p class="font-medium leading-relaxed">{{ $newsArticle->why_it_matters }}</p>
                </x-ui.card>
            @endif
            
            <div class="text-center pt-4">
                <a href="{{ $newsArticle->source_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
                    Read Original Article
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
            </div>
        </div>

        <div class="space-y-6">
            <x-ui.card title="Entities">
                @if(!empty($newsArticle->countries))
                    <div class="mb-4">
                        <h4 class="text-xs font-bold uppercase opacity-60 mb-2">Countries Involved</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($newsArticle->countries as $country)
                                <span class="badge badge-outline">{{ $country }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if(!empty($newsArticle->actors))
                    <div>
                        <h4 class="text-xs font-bold uppercase opacity-60 mb-2">Key Actors</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($newsArticle->actors as $actor)
                                <span class="badge badge-outline badge-secondary">{{ $actor }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if(empty($newsArticle->countries) && empty($newsArticle->actors))
                    <p class="text-sm opacity-60">No entities extracted by OpenClaw.</p>
                @endif
            </x-ui.card>

            <x-ui.card title="Meta">
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between border-b border-base-200 pb-1">
                        <span class="opacity-70">Ingested At</span>
                        <span>{{ $newsArticle->created_at->format('M j, H:i') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-base-200 pb-1">
                        <span class="opacity-70">AI Confidence</span>
                        <span>{{ $newsArticle->confidence ? ($newsArticle->confidence * 100) . '%' : 'N/A' }}</span>
                    </div>
                </div>
            </x-ui.card>
            
            <x-ui.card title="Raw Payload" class="mt-4">
                <div class="mockup-code text-xs bg-base-300 text-base-content max-h-64 overflow-y-auto w-full">
                    <pre><code>{{ json_encode($newsArticle->payload_raw, JSON_PRETTY_PRINT) }}</code></pre>
                </div>
            </x-ui.card>
        </div>
        
    </div>

</x-layout.app>
