<?php

namespace Modules\OpenAI\Infrastructure\Connectors;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

class OpenAIConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.openai.com/v1/';
    }

    public function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(config('services.openai.secret'));
    }
}
