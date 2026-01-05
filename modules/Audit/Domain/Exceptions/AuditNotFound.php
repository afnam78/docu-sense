<?php

namespace Modules\Audit\Domain\Exceptions;

class AuditNotFound extends \Exception
{
    public function __construct(string $hash)
    {
        parent::__construct("Audit with hash '{$hash}' not found.", 404);
    }
}
