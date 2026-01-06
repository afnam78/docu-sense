<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    Modules\File\Infrastructure\Providers\ModuleProvider::class,
    Modules\OpenAI\Infrastructure\Providers\ModuleProvider::class,
    Modules\Audit\Infrastructure\Providers\ModuleProvider::class,
    Modules\Shared\Infrastructure\Providers\SharedModuleProvider::class,
];
