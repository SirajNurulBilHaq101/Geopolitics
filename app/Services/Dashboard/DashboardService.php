<?php

namespace App\Services\Dashboard;

use App\Models\NewsArticle;
use App\Models\DailyBrief;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getStats(): array
    {
        return [
            'total_articles' => NewsArticle::count(),
            'high_priority' => NewsArticle::whereIn('priority', ['high', 'critical'])->count(),
            'recent_brief' => DailyBrief::latest('run_at')->first(),
        ];
    }

    public function getArticlesPerRegion()
    {
        return NewsArticle::select('region', DB::raw('count(*) as total'))
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderByDesc('total')
            ->get();
    }

    public function getArticlesPerTopic()
    {
        return NewsArticle::select('topic', DB::raw('count(*) as total'))
            ->whereNotNull('topic')
            ->groupBy('topic')
            ->orderByDesc('total')
            ->get();
    }
}
