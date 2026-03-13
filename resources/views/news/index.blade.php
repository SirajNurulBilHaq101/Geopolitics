<x-layout.app title="News Feed - GeoBase">
    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Intelligence Feed</h2>
                <p class="text-base-content/70 mt-1">Browse all geopolitical news tracked by the system.</p>
            </div>
            
            <form method="GET" action="{{ route('news.index') }}" class="flex gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search articles..." class="input input-sm input-bordered w-full md:w-64" />
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                @if(array_filter($filters))
                    <a href="{{ route('news.index') }}" class="btn btn-sm btn-ghost">Clear</a>
                @endif
            </form>
        </div>
    </x-slot:header>

    <x-ui.card class="mb-6">
        <form method="GET" action="{{ route('news.index') }}" class="flex flex-wrap gap-4 items-end">
            @if(isset($filters['search']))
                <input type="hidden" name="search" value="{{ $filters['search'] }}">
            @endif
            
            <div class="form-control w-full max-w-xs md:w-48">
                <label class="label"><span class="label-text text-xs">Priority</span></label>
                <select name="priority" class="select select-sm select-bordered" onchange="this.form.submit()">
                    <option value="">All Priorities</option>
                    <option value="critical" {{ ($filters['priority'] ?? '') == 'critical' ? 'selected' : '' }}>Critical</option>
                    <option value="high" {{ ($filters['priority'] ?? '') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="normal" {{ ($filters['priority'] ?? '') == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="low" {{ ($filters['priority'] ?? '') == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            
            <!-- Realistically we'd fetch unique regions/topics from DB, but keeping it simple for now -->
            <div class="form-control w-full max-w-xs md:w-48">
                <label class="label"><span class="label-text text-xs">Region</span></label>
                <input type="text" name="region" value="{{ $filters['region'] ?? '' }}" placeholder="e.g. Asia" class="input input-sm input-bordered" onblur="this.form.submit()">
            </div>
            
            <div class="form-control w-full max-w-xs md:w-48">
                <label class="label"><span class="label-text text-xs">Topic</span></label>
                <input type="text" name="topic" value="{{ $filters['topic'] ?? '' }}" placeholder="e.g. Economy" class="input input-sm input-bordered" onblur="this.form.submit()">
            </div>
        </form>
    </x-ui.card>

    <div class="space-y-4">
        @forelse($news as $article)
            <x-ui.card>
                <div class="flex flex-col md:flex-row gap-4 justify-between items-start">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            @if($article->priority === 'critical' || $article->priority === 'high')
                                <x-ui.badge type="error">{{ strtoupper($article->priority) }}</x-ui.badge>
                            @else
                                <x-ui.badge type="ghost">{{ strtoupper($article->priority) }}</x-ui.badge>
                            @endif
                            
                            @if($article->region)
                                <x-ui.badge type="primary">{{ $article->region }}</x-ui.badge>
                            @endif
                            
                            @if($article->topic)
                                <x-ui.badge type="secondary">{{ $article->topic }}</x-ui.badge>
                            @endif
                            
                            <span class="text-xs opacity-60 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $article->published_at?->format('M j, Y H:i') }}
                            </span>
                        </div>
                        
                        <a href="{{ route('news.show', $article) }}" class="text-xl font-bold hover:text-primary transition-colors block mb-2">
                            {{ $article->title }}
                        </a>
                        
                        <p class="text-base-content/80 text-sm mb-3 line-clamp-3">
                            {{ $article->summary }}
                        </p>
                        
                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-xs opacity-70">
                            <span class="font-medium">Source: {{ $article->source ?? 'Unknown' }}</span>
                            @if($article->confidence)
                                <span>Confidence: {{ $article->confidence * 100 }}%</span>
                            @endif
                        </div>
                    </div>
                </div>
            </x-ui.card>
        @empty
            <div class="py-12 text-center text-base-content/50 border border-dashed border-base-300 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                <p>No intelligence records matching your criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $news->links() }} <!-- Make sure using tailwind pagination in AppServiceProvider -->
    </div>

</x-layout.app>
