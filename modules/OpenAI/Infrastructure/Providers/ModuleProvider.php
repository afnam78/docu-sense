<?php

namespace Modules\OpenAI\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\OpenAI\Domain\Contracts\OpenAIServiceInterface;
use Modules\OpenAI\Infrastructure\Services\OpenAIService;

class ModuleProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OpenAIServiceInterface::class, OpenAIService::class);
    }
}
