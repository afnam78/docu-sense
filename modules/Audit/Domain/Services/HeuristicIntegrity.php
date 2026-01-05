<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Shared\Domain\ValueObjects\NIF;

final readonly class HeuristicIntegrity implements HeuristicIntegrityInterface
{
    public function execute(Payslip $payslip): array
    {
        return array_merge(
            $this->nifValidations($payslip),
            $this->temporalSanity($payslip)
        );
    }

    private function nifValidations(Payslip $payslip): array
    {
        $incoherence = [];

        $employee = $payslip->worker();

        if (! NIF::isValidDniOrNie($employee->nif())) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'NIF del empleado inválido'
            );
        }

        if (! NIF::isValidCIF($payslip->company()->cif())) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'CIF de la empresa inválido'
            );
        }

        return $incoherence;
    }

    private function temporalSanity(Payslip $payslip): array
    {
        $incoherence = [];

        $period = $payslip->period();
        $startDate = $period->startDate();
        $endDate = $period->endDate();
        $extractedDays = $period->totalDays();

        if ($startDate->greaterThan($endDate)) {

            return [
                new AuditMessage(
                    status: StatusEnum::CRITICAL,
                    message: 'La fecha de inicio del período es posterior a la fecha de fin'
                ),
            ];
        }

        if ($endDate->greaterThan(now()->addMonth())) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::WARNING,
                message: 'La nómina indica una fecha futura. Posible error de lectura.'
            );
        }

        $calendarDays = $startDate->diffInDays($endDate) + 1;
        if ($extractedDays !== 30 && $extractedDays !== $calendarDays) {
            $incoherence[] = new AuditMessage(
                status: StatusEnum::WARNING,
                message: "Los días extraídos ({$extractedDays}) no coinciden con el calendario ({$calendarDays})."
            );
        }

        return $incoherence;
    }
}
