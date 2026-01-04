<?php

namespace Modules\Payslip\Domain\Contracts;

use Modules\File\Domain\Entities\File;

interface DataExtractorServiceInterface
{
    public function execute(File $file): void;
}
