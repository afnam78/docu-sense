<?php

namespace Modules\OpenAI\Domain\Contracts;

use Modules\OpenAI\Infrastructure\Databases\Models\OpenAiRequest;

interface OpenAIServiceInterface
{
    public function analyzeDocument(string $hash, string $base64, string $ocr, string $hocr): OpenAiRequest;
}
