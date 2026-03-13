<x-layout.app title="Dashboard - GeoBase">
    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Geopolitics Overview</h2>
                <p class="text-base-content/70 mt-1">Global intelligence and news summarized by OpenClaw.</p>
            </div>
            <div class="flex border border-base-300 rounded-lg p-1 bg-base-100/50">
                <span class="px-3 py-1 text-xs opacity-70">Last update: {{ now()->format('H:i') }}</span>
            </div>
        </div>
    </x-slot:header>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.stat title="Total Ingested" value="{{ number_format($stats['total_articles']) }}" desc="News items tracked" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>' />
        <x-ui.stat title="High Priority" value="{{ number_format($stats['high_priority']) }}" desc="Critical alerts" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>' />
        <x-ui.stat title="Target Regions" value="{{ count($articlesPerRegion) }}" desc="Monitored globally" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' />
    </div>

    <!-- Daily Brief -->
    @if($stats['recent_brief'])
    <x-ui.card class="bg-primary/5 border-primary/20">
        <div class="flex gap-4">
            <div class="pt-1 hidden sm:block">
                <div class="avatar placeholder">
                    <div class="bg-primary text-primary-content rounded-full w-12">
                        <span class="text-xl">OC</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-bold text-primary tracking-widest uppercase mb-1">OpenClaw Daily Brief</h3>
                <p class="text-base text-base-content leading-relaxed">{{ $stats['recent_brief']->summary }}</p>
                <div class="mt-2 text-xs opacity-60">Prepared at {{ $stats['recent_brief']->run_at->format('M j, Y, H:i') }}</div>
            </div>
        </div>
    </x-ui.card>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Left: Headlines & Feed -->
        <div class="lg:col-span-2 space-y-6">
            <x-ui.card title="High Priority Headlines" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>'>
                @forelse($headlines as $news)
                    <div class="{{ !$loop->last ? 'border-b border-base-200 pb-4 mb-4' : '' }}">
                        <div class="flex items-center gap-2 mb-1">
                            <x-ui.badge type="error">{{ strtoupper($news->priority) }}</x-ui.badge>
                            @if($news->region) <x-ui.badge type="ghost">{{ $news->region }}</x-ui.badge> @endif
                            <span class="text-xs opacity-60 ml-auto">{{ $news->published_at?->diffForHumans() }}</span>
                        </div>
                        <a href="{{ route('news.show', $news) }}" class="text-lg font-semibold hover:text-primary transition-colors line-clamp-2">
                            {{ $news->title }}
                        </a>
                        <p class="text-sm text-base-content/70 mt-1 line-clamp-2">{{ $news->summary }}</p>
                    </div>
                @empty
                    <div class="text-center py-6 text-base-content/50">No high priority headlines currently.</div>
                @endforelse
            </x-ui.card>

            <x-ui.card title="Recent Ingested" footer="<a href='route('news.index')' class='hover:underline'>View all news &rarr;</a>">
                <div class="space-y-4">
                    @forelse($recentNews as $news)
                        <a href="{{ route('news.show', $news) }}" class="group block p-3 -mx-3 rounded-lg hover:bg-base-200 transition-colors">
                            <div class="flex justify-between items-start mb-1 gap-2">
                                <h4 class="font-medium group-hover:text-primary transition-colors line-clamp-1">{{ $news->title }}</h4>
                                <span class="text-xs opacity-50 whitespace-nowrap">{{ $news->published_at?->format('H:i') }}</span>
                            </div>
                            <div class="flex gap-2 text-xs opacity-70">
                                <span>{{ $news->source }}</span>
                                <span>&bull;</span>
                                <span>{{ $news->topic ?? 'General' }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-4 text-base-content/50">Waiting for OpenClaw to ingest data...</div>
                    @endforelse
                </div>
            </x-ui.card>
        </div>

        <!-- Right: Filters & Stats -->
        <div class="space-y-6">
            <x-ui.card title="By Region">
                <div class="space-y-3">
                    @forelse($articlesPerRegion as $reg)
                        <div class="flex items-center justify-between">
                            <a href="{{ route('news.index', ['region' => $reg->region]) }}" class="hover:text-primary text-sm font-medium">{{ $reg->region }}</a>
                            <span class="badge badge-sm badge-ghost">{{ $reg->total }}</span>
                        </div>
                    @empty
                        <div class="text-sm opacity-50">No data</div>
                    @endforelse
                </div>
            </x-ui.card>

            <x-ui.card title="By Topic">
                <div class="space-y-3">
                    @forelse($articlesPerTopic as $top)
                        <div class="flex items-center justify-between">
                            <a href="{{ route('news.index', ['topic' => $top->topic]) }}" class="hover:text-primary text-sm font-medium">{{ $top->topic }}</a>
                            <span class="badge badge-sm badge-ghost">{{ $top->total }}</span>
                        </div>
                    @empty
                        <div class="text-sm opacity-50">No data</div>
                    @endforelse
                </div>
            </x-ui.card>
        </div>
        
    </div>

</x-layout.app>
