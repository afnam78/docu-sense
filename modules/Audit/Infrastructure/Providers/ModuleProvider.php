<?php

namespace Modules\Audit\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Contracts\AuditServiceInterface;
use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Services\ArithmeticCoherence;
use Modules\Audit\Domain\Services\AuditServiceService;
use Modules\Audit\Domain\Services\HeuristicIntegrity;
use Modules\Audit\Domain\Services\SocialSecurityCoherence;
use Modules\Audit\Infrastructure\Repositories\AuditRepository;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuditServiceInterface::class, AuditServiceService::class);
        $this->app->bind(HeuristicIntegrityInterface::class, HeuristicIntegrity::class);
        $this->app->bind(SocialSecurityCoherenceInterface::class, SocialSecurityCoherence::class);
        $this->app->bind(ArithmeticCoherenceInterface::class, ArithmeticCoherence::class);
        $this->app->bind(AuditRepositoryInterface::class, AuditRepository::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
    }
}
