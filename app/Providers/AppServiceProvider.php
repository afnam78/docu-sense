<?php

namespace App\Providers;

use App\Listeners\FileAnalyzedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\File\Infrastructure\Events\FileAnalyzed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);

        Event::listen(
            FileAnalyzed::class,
            FileAnalyzedListener::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
