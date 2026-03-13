<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;
use App\Services\News\NewsQueryService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardService $dashboardService,
        private NewsQueryService $newsQueryService
    ) {}

    public function index(): View
    {
        $stats = $this->dashboardService->getStats();
        $articlesPerRegion = $this->dashboardService->getArticlesPerRegion();
        $articlesPerTopic = $this->dashboardService->getArticlesPerTopic();
        $headlines = $this->newsQueryService->getHeadlines(5);
        $recentNews = $this->newsQueryService->getNews([], 10);

        return view('dashboard.index', compact(
            'stats',
            'articlesPerRegion',
            'articlesPerTopic',
            'headlines',
            'recentNews'
        ));
    }
}
