<?php

namespace App\Services\News;

use App\Models\NewsArticle;
use App\Models\Watchlist;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsQueryService
{
    /**
     * Get paginated news with optional filters.
     */
    public function getNews(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = NewsArticle::query()->latest('published_at');

        if (!empty($filters['region'])) {
            $query->where('region', $filters['region']);
        }

        if (!empty($filters['topic'])) {
            $query->where('topic', $filters['topic']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('summary', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->paginate($perPage);
    }

    /**
     * Get recent breaking/important news.
     */
    public function getHeadlines(int $limit = 5)
    {
        return NewsArticle::whereIn('priority', ['high', 'critical'])
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }
}
