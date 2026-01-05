<?php

namespace Modules\Audit\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Contracts\PayslipAuditServiceInterface;
use Modules\Audit\Domain\Contracts\PayslipFieldsSanityServiceInterface;
use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Services\ArithmeticCoherence;
use Modules\Audit\Domain\Services\HeuristicIntegrity;
use Modules\Audit\Domain\Services\PayslipAuditServiceService;
use Modules\Audit\Domain\Services\PayslipFieldsSanityService;
use Modules\Audit\Domain\Services\SocialSecurityCoherence;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PayslipAuditServiceInterface::class, PayslipAuditServiceService::class);
        $this->app->bind(HeuristicIntegrityInterface::class, HeuristicIntegrity::class);
        $this->app->bind(SocialSecurityCoherenceInterface::class, SocialSecurityCoherence::class);
        $this->app->bind(ArithmeticCoherenceInterface::class, ArithmeticCoherence::class);
        $this->app->bind(PayslipFieldsSanityServiceInterface::class, PayslipFieldsSanityService::class);
        $this->app->register(RouteServiceProvider::class);

        Livewire::component('audit-detail', \Modules\Audit\Presentation\Livewire\AuditDetail::class);

    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
        $this->loadViewsFrom(__DIR__.'/../../Presentation/Views', 'audit');
    }
}
