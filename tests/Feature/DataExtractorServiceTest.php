<?php

namespace Tests\Payslip\Domain\Services;

use Modules\Payslip\Domain\Services\DataExtractorService;

test('execute', function () {

    $service = app()->make(DataExtractorService::class);

    $service->execute('6d7cd2bc9500df5a3f16e0885df727d998961b352ce61a57ddd188778b07f3a1');
});
