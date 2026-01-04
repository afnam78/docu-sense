<?php

namespace Modules\OpenAI\Domain\Contracts;

interface OpenAIServiceInterface
{
    public function analyzeDocument(string $hash, string $base64): string;
}
