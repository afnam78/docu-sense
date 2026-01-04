<?php

namespace Modules\Payslip\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Payslip\Domain\Contracts\DataExtractorServiceInterface;
use Modules\Payslip\Domain\Services\DataExtractorService;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DataExtractorServiceInterface::class, DataExtractorService::class);
    }
}
