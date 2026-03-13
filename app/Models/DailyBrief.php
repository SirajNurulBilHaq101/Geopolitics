<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyBrief extends Model
{
    /** @use HasFactory<\Database\Factories\DailyBriefFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'run_at' => 'datetime',
        ];
    }
}
