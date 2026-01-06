<?php

namespace Modules\File\Domain\Entities;

use Modules\File\Domain\Enums\StatusEnum;

final class File
{
    public function __construct(
        private string $hash,
        private string $mimeType,
        private StatusEnum $status,
        private ?string $base64 = null,
        private ?string $name = null,
        private ?string $fileHash = null
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

    public function name(): ?string
    {
        return $this->name;
    }

    public function fileHash(): ?string
    {
        return $this->fileHash;
    }

    public function setBase64(?string $base64): void
    {
        $this->base64 = $base64;
    }
}
