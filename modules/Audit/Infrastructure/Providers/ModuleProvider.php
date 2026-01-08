<?php

namespace Modules\Audit\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Contracts\PayslipAuditServiceInterface;
use Modules\Audit\Domain\Contracts\PayslipFieldsSanityServiceInterface;
use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Services\ArithmeticCoherence;
use Modules\Audit\Domain\Services\HeuristicIntegrity;
use Modules\Audit\Domain\Services\PayslipAuditServiceService;
use Modules\Audit\Domain\Services\PayslipFieldsSanityService;
use Modules\Audit\Domain\Services\SocialSecurityCoherence;
use Modules\Audit\Infrastructure\Repositories\AuditRepository;
use Modules\Audit\Presentation\Livewire\AuditDetail;
use Modules\Audit\Presentation\Livewire\AuditList;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PayslipAuditServiceInterface::class, PayslipAuditServiceService::class);
        $this->app->bind(HeuristicIntegrityInterface::class, HeuristicIntegrity::class);
        $this->app->bind(SocialSecurityCoherenceInterface::class, SocialSecurityCoherence::class);
        $this->app->bind(ArithmeticCoherenceInterface::class, ArithmeticCoherence::class);
        $this->app->bind(PayslipFieldsSanityServiceInterface::class, PayslipFieldsSanityService::class);
        $this->app->bind(AuditRepositoryInterface::class, AuditRepository::class);

        $this->app->register(RouteServiceProvider::class);

        Livewire::component('audit-detail', AuditDetail::class);
        Livewire::component('audit-list', AuditList::class);

    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
        $this->loadViewsFrom(__DIR__.'/../../Presentation/Views', 'audit');
    }
}
