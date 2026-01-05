<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Payslip\Domain\ValueObjects\Concept;

final readonly class PayslipDTO
{
    public function __construct(
        private CompanyDTO $company,
        private WorkerDTO $worker,
        private PeriodDTO $period,
        private TotalDTO $totals,
        /**
         * @var ConceptDTO[] $accruals
         */
        private array $accruals,
        /**
         * @var ConceptDTO[] $deductions
         */
        private array $deductions,
        private QuoteBaseDTO $quoteBase
    ) {}

    public static function fromObject(Payslip $object): self
    {
        return new self(
            CompanyDTO::fromObject($object->company()),
            WorkerDTO::fromObject($object->worker()),
            PeriodDTO::fromObject($object->period()),
            TotalDTO::fromObject($object->totals()),
            array_map(fn (Concept $accrual) => ConceptDTO::fromObject($accrual), $object->accruals()),
            array_map(fn (Concept $deduction) => ConceptDTO::fromObject($deduction), $object->deductions()),
            QuoteBaseDTO::fromObject($object->quoteBase())
        );
    }

    public function toArray(): array
    {
        return [
            'Empresa' => $this->company->toArray(),
            'Empleado' => $this->worker->toArray(),
            'Periodo' => $this->period->toArray(),
            'Ingresos' => $this->totals->toArray(),
            'Devengos' => array_map(fn (ConceptDTO $item) => $item->toString(), $this->accruals),
            'Deducciones' => array_map(fn (ConceptDTO $item) => $item->toString(), $this->deductions),
            'Bases de cotización' => $this->quoteBase->toArray(),
        ];
    }
}
