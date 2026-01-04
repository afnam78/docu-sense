<?php

namespace Modules\File\Domain\Entities;

use Illuminate\Support\Carbon;
use Modules\File\Domain\Enums\StatusEnum;

final class File
{
    public function __construct(
        private string $hash,
        private string $mimeType,
        private StatusEnum $status,
        private ?string $base64 = null,
        private ?string $name = null,
        private array $jsonResponse = [],
        private array $payslipResponse = [],
        private ?Carbon $analyzeDate = null
    ) {}

    public function hash(): string
    {
        return $this->hash;
    }

    public function mimeType(): string
    {
        return $this->mimeType;
    }

    public function status(): StatusEnum
    {
        return $this->status;
    }

    public function base64(): ?string
    {
        return $this->base64;
    }

    public function jsonResponse(): array
    {
        return $this->jsonResponse;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function setBase64(?string $base64): void
    {
        $this->base64 = $base64;
    }

    public function payslipResponse(): array
    {
        return $this->payslipResponse;
    }

    public function setPayslipResponse(array $payslipResponse): void
    {
        $this->payslipResponse = $payslipResponse;
    }

    public function setJsonResponse(array $result): void
    {
        $this->jsonResponse = $result;
    }

    public function analyzeDate(): ?Carbon
    {
        return $this->analyzeDate;
    }

    public function setAnalyzeDate(Carbon $analyzeDate): void
    {
        $this->analyzeDate = $analyzeDate;
    }
}
