<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\Enums;

enum DocumentTypeEnum: string
{
    case DNI = 'dni';
    case NIE = 'nie';
    case CIF = 'cif';
    case PASSPORT = 'passport';
}
