<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\File\Infrastructure\Events\FileItemAnalyzedEvent;
use Modules\File\Infrastructure\Listeners\FileItemAnalyzedListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);

        Event::listen(
            FileItemAnalyzedEvent::class,
            FileItemAnalyzedListener::class,
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
