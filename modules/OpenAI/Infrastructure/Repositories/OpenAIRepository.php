<?php

namespace Modules\OpenAI\Infrastructure\Repositories;

use Illuminate\Support\Facades\Log;
use Modules\OpenAI\Domain\Contracts\OpenAIRepositoryInterface;
use Modules\OpenAI\Domain\Mappers\OpenAIRequestMapper;
use Modules\OpenAI\Infrastructure\Databases\Models\OpenAiRequest;

class OpenAIRepository implements OpenAIRepositoryInterface
{
    public function find(string $fileHash): ?\Modules\OpenAI\Domain\Entities\OpenAIRequest
    {
        try {
            $model = OpenAiRequest::where('file_hash', $fileHash)->first();

            return $model ? OpenAIRequestMapper::fromDB($model->toArray()) : null;
        } catch (\Exception $e) {
            Log::error('OpenAI Repository Error: find method '.$e->getMessage());
            throw $e;
        }
    }
}
