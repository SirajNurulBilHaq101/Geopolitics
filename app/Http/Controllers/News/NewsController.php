<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Services\News\NewsQueryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __construct(private NewsQueryService $newsQueryService) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['region', 'topic', 'priority', 'search']);
        $news = $this->newsQueryService->getNews($filters, 15);

        return view('news.index', compact('news', 'filters'));
    }

    public function show(NewsArticle $newsArticle): View
    {
        return view('news.show', compact('newsArticle'));
    }
}
