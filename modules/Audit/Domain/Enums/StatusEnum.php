<?php

namespace Modules\Audit\Domain\Enums;

enum StatusEnum: string
{
    case CRITICAL = 'CRITICAL';
    case WARNING = 'WARNING';
    case OK = 'OK';
    case INFO = 'INFO';
}
