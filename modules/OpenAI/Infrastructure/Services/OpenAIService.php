<?php

namespace Modules\OpenAI\Infrastructure\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\OpenAI\Domain\Contracts\OpenAIServiceInterface;
use Modules\OpenAI\Infrastructure\Connectors\OpenAIConnector;
use Modules\OpenAI\Infrastructure\Requests\CompletionRequest;

final readonly class OpenAIService implements OpenAIServiceInterface
{
    public function __construct(private OpenAIConnector $connector) {}

    public function analyzeDocument(string $hash, string $base64): string
    {
        try {
            $request = new CompletionRequest($base64);
            $response = $this->connector->send($request);

            Storage::disk('local')->put($hash.'.json', $response->body());

            return $response->body();
        } catch (\Exception $e) {
            Log::error('Analyze Document Error: '.$e->getMessage());

            throw $e;
        }
    }
}
