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
        $incoherence = [];

        $accrualSum = collect($payslip->accruals())->sum(fn (Concept $item) => $item->amount());
        $extractedAccrualSum = $payslip->totals()->net();

        if ($accrualSum !== $extractedAccrualSum) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de devengos'
            );
        }

        $deductionSum = collect($payslip->deductions())->sum(fn (Concept $item) => $item->amount());
        $extractedDeductionSum = $payslip->totals()->taxes();

        if ($deductionSum !== $extractedDeductionSum) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de deducciones'
            );
        }

        $netTotal = $accrualSum - $deductionSum;
        $extractedNetTotal = $payslip->totals()->total();

        if ($netTotal !== $extractedNetTotal) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto del total neto'
            );
        }

        return $incoherence;
    }
}
