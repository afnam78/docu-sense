<?php

namespace Modules\File\Domain\Contracts;

interface OcrExtractServiceInterface
{
    public function getText(string $path): string;

    public function getHexagonalText(string $path): string;
}
