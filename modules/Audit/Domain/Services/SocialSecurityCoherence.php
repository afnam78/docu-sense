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
        $baseCC = $payslip->quoteBase()->commonContingencies()->amount();
        $audits = [];

        /**
         * @var Concept $deduction
         */
        foreach ($payslip->deductions() as $deduction) {
            $percentage = $deduction->percentage();

            if (! $percentage) {
                continue;
            }

            $calculatedAmountCents = $baseCC * $percentage / 100;
            $extractedAmountCents = $deduction->amount()->amount();

            $diff = abs(round($calculatedAmountCents) - $extractedAmountCents);

            if ($diff > 2) {
                $audits[] = new AuditMessage(
                    status: StatusEnum::WARNING,
                    title: "Desviación en {$deduction->concept()}",
                    message: sprintf(
                        'Se esperaba una retención de %.2f€ (%s%% de la base), pero se extrajo %.2f€. Posible error de cálculo en origen o manipulación.',
                        $calculatedAmountCents / 100,
                        number_format($percentage, 2, ',', '.'),
                        $extractedAmountCents / 100
                    )
                );
            } else {
                $audits[] = new AuditMessage(
                    status: StatusEnum::OK,
                    title: "Verificación correcta de {$deduction->concept()}",
                );
            }
        }

        return $audits;
    }
}
