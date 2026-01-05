<?php

namespace Modules\OpenAI\Domain\Contracts;

use Modules\OpenAI\Domain\Entities\OpenAIRequest;

interface OpenAIRepositoryInterface
{
    public function find(string $fileHash): ?OpenAIRequest;
}
