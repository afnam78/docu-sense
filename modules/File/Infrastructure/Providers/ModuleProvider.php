<?php

namespace Modules\File\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\File\Application\Contracts\FilesAlreadyAnalyzedServiceInterface;
use Modules\File\Application\Contracts\FilesToAnalyzeServiceInterface;
use Modules\File\Application\Services\FilesAlreadyAnalyzedService;
use Modules\File\Application\Services\FilesToAnalyzeService;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Contracts\OcrExtractServiceInterface;
use Modules\File\Domain\Services\OcrExtractService;
use Modules\File\Infrastructure\Repositories\FileRepository;
use Modules\File\Presentation\Livewire\FileUploader;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(FilesToAnalyzeServiceInterface::class, FilesToAnalyzeService::class);
        $this->app->bind(FilesAlreadyAnalyzedServiceInterface::class, FilesAlreadyAnalyzedService::class);
        $this->app->bind(OcrExtractServiceInterface::class, OcrExtractService::class);
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
        $this->loadViewsFrom(__DIR__.'/../../Presentation/Views', 'file');
        Livewire::component('file-uploader', FileUploader::class);
    }
}
