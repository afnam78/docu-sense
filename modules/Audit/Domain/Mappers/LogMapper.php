<?php

namespace Modules\Audit\Domain\Mappers;

use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;

class LogMapper
{
    public static function fromDB(array $data): Log
    {
        return new Log(
            status: StatusEnum::from($data['status']),
            title: $data['title'],
            message: $data['message'],
        );
    }
}
