<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\PayslipFieldsSanityServiceInterface;
use Modules\Audit\Domain\Entities\AuditItem;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Payslip\Domain\ValueObjects\Company;
use Modules\Payslip\Domain\ValueObjects\Period;
use Modules\Payslip\Domain\ValueObjects\QuoteBase;
use Modules\Payslip\Domain\ValueObjects\Total;
use Modules\Payslip\Domain\ValueObjects\Worker;

class PayslipFieldsSanityService implements PayslipFieldsSanityServiceInterface
{
    public function execute(Payslip $payslip): AuditItem
    {
        $logs = array_merge(
            $this->companySanity($payslip->company()),
            $this->workerSanity($payslip->worker()),
            $this->periodSanity($payslip->period()),
            $this->totalSanity($payslip->totals()),
            $this->quoteBaseSanity($payslip->quoteBase()),
        );

        return new AuditItem(
            StatusEnum::getStatusByPriority(array_map(fn (Log $log) => $log->status(), $logs)),
            $logs
        );
    }

    private function quoteBaseSanity(QuoteBase $quoteBase): array
    {
        $audits = [];

        if (! $quoteBase->irpf()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Base imponible del IRPF',
            );
        }

        if (! $quoteBase->professionalContingencies()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Base de contingencias profesionales',
            );
        }

        if (! $quoteBase->commonContingencies()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Base de contingencias comunes',
            );
        }

        return $audits;
    }

    private function companySanity(Company $company): array
    {
        $audits = [];

        if (! $company->name()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Nombre de la empresa',
            );
        }

        if (! $company->cif()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'CIF de la empresa',
            );
        }

        if (! $company->ccc()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'CCC de la empresa',
            );
        }

        return $audits;
    }

    private function workerSanity(Worker $worker): array
    {
        $audits = [];

        if (! $worker->name()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Nombre del trabajador',
            );
        }

        if (! $worker->nif()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'NIF del trabajador',
            );
        }

        if (! $worker->ccc()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'SS del trabajador',
            );
        }

        if (! $worker->seniorityDate()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Fecha de antigüedad del trabajador',
            );
        }

        if (! $worker->quotationGroup()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Grupo de cotización del trabajador',
            );
        }

        return $audits;
    }

    private function periodSanity(Period $period): array
    {
        $audits = [];

        if (! $period->startDate()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Inicio del periodo',
            );
        }

        if (! $period->endDate()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Fin del periodo',
            );
        }

        if (! $period->totalDays()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Total de días del periodo',
            );
        }

        return $audits;
    }

    private function totalSanity(Total $total): array
    {
        $audits = [];

        if (! $total->net()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Neto',
            );
        }

        if (! $total->taxes()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Impuestos',
            );
        }

        if (! $total->total()) {
            $audits[] = new Log(
                status: StatusEnum::WARNING,
                title: 'Bruto',
            );
        }

        return $audits;
    }
}
