<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Payslip\Domain\ValueObjects\Concept;

final readonly class ArithmeticCoherence implements ArithmeticCoherenceInterface
{
    public function execute(Payslip $payslip): array
    {
        $audits = [];

        $accrualSum = collect($payslip->accruals())->sum(fn (Concept $item) => $item->amount()->amount());
        $extractedAccrualSum = $payslip->totals()->net()->amount();

        if ($accrualSum !== $extractedAccrualSum) {
            $audits[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de devengos'
            );
        } else {
            $audits[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Cálculo correcto de devengos'
            );
        }

        $deductionSum = collect($payslip->deductions())->sum(fn (Concept $item) => $item->amount()->amount());
        $extractedDeductionSum = $payslip->totals()->taxes()->amount();

        if ($deductionSum !== $extractedDeductionSum) {
            $audits[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de deducciones'
            );
        } else {
            $audits[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Cálculo correcto de deducciones'
            );
        }

        $netTotal = ($accrualSum - $deductionSum);
        $extractedNetTotal = $payslip->totals()->total()->amount();

        if ($netTotal !== $extractedNetTotal) {
            $audits[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto del total neto'
            );
        } else {
            $audits[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Cálculo correcto del total neto'
            );
        }

        return $audits;
    }
}
