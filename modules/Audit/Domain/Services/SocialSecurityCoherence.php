<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Payslip\Domain\ValueObjects\Concept;

final readonly class SocialSecurityCoherence implements SocialSecurityCoherenceInterface
{
    public function execute(Payslip $payslip): array
    {
        $baseCC = $payslip->quoteBase()->commonContingencies();

        /**
         * @var Concept $deduction
         */
        $incoherence = [];

        foreach ($payslip->deductions() as $deduction) {
            $percentage = $deduction->percentage();

            if (! $percentage) {
                continue;
            }

            $calculatedAmount = $baseCC * $percentage / 100;
            $extractedAmount = $deduction->amount();

            if (abs($calculatedAmount - $extractedAmount) > 0.02) {
                $incoherence[] = new AuditMessage(
                    status: StatusEnum::WARNING,
                    message: "Inconsistencia en la deducción {$deduction->concept()}: monto extraído {$extractedAmount}, monto calculado {$calculatedAmount}"
                );
            }
        }

        return $incoherence;
    }
}
