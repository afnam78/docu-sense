<?php

namespace Modules\Shared\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Shared\Presentation\Livewire\AuditLanding;

class SharedModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        Livewire::component('shared::audit-landing', AuditLanding::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../Presentation/Views', 'shared');
    }
}
