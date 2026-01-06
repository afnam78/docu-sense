<?php

namespace Modules\File\Domain\Enums;

enum StatusEnum: string
{
    case PROCESSING = 'PROCESSING';
    case DONE = 'DONE';
    case ERROR = 'ERROR';
    case TO_ANALYZE = 'TO_ANALYZE';

    public function badge(): string
    {
        return match ($this) {
            StatusEnum::PROCESSING => 'warning',
            StatusEnum::DONE => 'success',
            StatusEnum::ERROR => 'danger',
            StatusEnum::TO_ANALYZE => 'info',
        };
    }

    public function label(): string
    {
        return match ($this) {
            StatusEnum::PROCESSING => 'Procesando',
            StatusEnum::DONE => 'Finalizado',
            StatusEnum::ERROR => 'Error',
            StatusEnum::TO_ANALYZE => 'Por Analizar',
        };
    }

    public function isDone(): bool
    {
        return $this === self::DONE;
    }
}
