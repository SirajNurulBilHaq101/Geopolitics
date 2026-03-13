<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    /** @use HasFactory<\Database\Factories\NewsArticleFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'countries' => 'array',
            'actors' => 'array',
            'payload_raw' => 'array',
        ];
    }
}
