<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\NewsArticle;
use App\Models\DailyBrief;
use App\Models\Watchlist;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Create Watchlists for Admin
        if ($admin->watchlists()->count() === 0) {
            $admin->watchlists()->createMany([
                ['type' => 'region', 'value' => 'Asia'],
                ['type' => 'topic', 'value' => 'Security'],
                ['type' => 'actor', 'value' => 'USA'],
            ]);
        }

        // 3. Create Daily Brief
        if (DailyBrief::count() === 0) {
            DailyBrief::create([
                'run_at' => Carbon::now()->subHours(2),
                'summary' => "Global tensions remain high as trade negotiations between major powers stall. Environmental concerns dictate new policies in Europe, while technological advancements in Asia pose new security challenges. The Middle East sees renewed peace talks amidst sporadic conflicts.",
            ]);
        }

        // 4. Create Dummy News Articles
        if (NewsArticle::count() === 0) {
            NewsArticle::insert([
                [
                    'title' => 'Tensions escalate in the South China Sea',
                    'source' => 'Reuters',
                    'source_url' => 'https://example.com/scs-tensions',
                    'published_at' => Carbon::now()->subHours(1),
                    'region' => 'Asia',
                    'topic' => 'Security',
                    'priority' => 'critical',
                    'summary' => 'Recent naval drills have sparked diplomatic protests. Analysts warn of potential miscalculations.',
                    'why_it_matters' => 'This restricts a critical global shipping lane and could involve direct clashes between superpowers.',
                    'countries' => json_encode(['China', 'Philippines', 'USA']),
                    'actors' => json_encode(['PLA', 'US Navy']),
                    'confidence' => 0.95,
                    'payload_raw' => json_encode(['dummy' => 'data']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'EU passes comprehensive AI regulation act',
                    'source' => 'Bloomberg',
                    'source_url' => 'https://example.com/eu-ai-act',
                    'published_at' => Carbon::now()->subHours(3),
                    'region' => 'Europe',
                    'topic' => 'Technology',
                    'priority' => 'high',
                    'summary' => 'The European Parliament overwhelming voted in favor of the new AI Act, setting global precedents.',
                    'why_it_matters' => 'Companies worldwide will need to comply with these strict data privacy and transparency standards or face heavy fines.',
                    'countries' => json_encode(['France', 'Germany']),
                    'actors' => json_encode(['EU Commission']),
                    'confidence' => 0.88,
                    'payload_raw' => json_encode(['dummy' => 'data']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'OPEC+ announces surprise production cuts',
                    'source' => 'Financial Times',
                    'source_url' => 'https://example.com/opec-cuts',
                    'published_at' => Carbon::now()->subHours(5),
                    'region' => 'Middle East',
                    'topic' => 'Economy',
                    'priority' => 'high',
                    'summary' => 'In a move to stabilize prices, OPEC+ members agreed to voluntarily cut oil production by 1.16 million barrels per day.',
                    'why_it_matters' => 'This will likely trigger renewed inflation fears globally and strain diplomatic ties with importing nations.',
                    'countries' => json_encode(['Saudi Arabia', 'Russia', 'UAE']),
                    'actors' => json_encode(['OPEC+']),
                    'confidence' => 0.92,
                    'payload_raw' => json_encode(['dummy' => 'data']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'New trade agreement signed in South America',
                    'source' => 'AP News',
                    'source_url' => 'https://example.com/sa-trade',
                    'published_at' => Carbon::now()->subDays(1),
                    'region' => 'Americas',
                    'topic' => 'Economy',
                    'priority' => 'normal',
                    'summary' => 'A landmark free trade agreement aims to boost regional economic integration and lower tariffs on agricultural goods.',
                    'why_it_matters' => 'Enhances regional stability and economic growth prospects in the post-pandemic recovery phase.',
                    'countries' => json_encode(['Brazil', 'Argentina']),
                    'actors' => json_encode(['Mercosur']),
                    'confidence' => 0.85,
                    'payload_raw' => json_encode(['dummy' => 'data']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
