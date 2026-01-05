<?php

namespace Modules\Audit\Domain\Enums;

enum StatusEnum: string
{
    case CRITICAL = 'CRITICAL';
    case WARNING = 'WARNING';
    case OK = 'OK';
    case INFO = 'INFO';

    public function badge(): string
    {
        return match ($this) {
            StatusEnum::WARNING => 'warning',
            StatusEnum::OK => 'success',
            StatusEnum::CRITICAL => 'danger',
            StatusEnum::INFO => 'info',
        };
    }

    public function isWarning(): bool
    {
        return $this === StatusEnum::WARNING;
    }

    public function isCritical(): bool
    {
        return $this === StatusEnum::CRITICAL;
    }

    public function isOk(): bool
    {
        return $this === StatusEnum::OK;
    }

    public function isInfo(): bool
    {
        return $this === StatusEnum::INFO;
    }
}
