<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source')->nullable();
            $table->string('source_url')->unique();
            $table->timestamp('published_at')->nullable();
            $table->string('region')->index()->nullable();
            $table->string('topic')->index()->nullable();
            $table->string('priority')->index()->default('normal');
            $table->text('summary')->nullable();
            $table->text('why_it_matters')->nullable();
            $table->json('countries')->nullable();
            $table->json('actors')->nullable();
            $table->decimal('confidence', 5, 4)->nullable();
            $table->json('payload_raw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
