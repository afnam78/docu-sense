<?php

namespace Modules\Audit\Application\DTOs;

use Illuminate\Support\Carbon;
use Modules\Payslip\Domain\ValueObjects\Worker;

final readonly class WorkerDTO
{
    public string $name;

    public string $nif;

    public string $ccc;

    public Carbon $seniorityDate;

    public string $quotationGroup;

    public function __construct(string $name, string $nif, string $ccc, Carbon $seniorityDate, string $quotationGroup)
    {
        $this->name = $name;
        $this->nif = $nif;
        $this->ccc = $ccc;
        $this->seniorityDate = $seniorityDate;
        $this->quotationGroup = $quotationGroup;
    }

    public static function fromObject(Worker $worker): self
    {
        return new self(
            $worker->name(),
            $worker->nif(),
            $worker->ccc(),
            $worker->seniorityDate(),
            $worker->quotationGroup()
        );
    }

    public function toArray(): array
    {
        return [
            'Nombre' => $this->name,
            'NIF' => $this->nif,
            'CCC' => $this->ccc,
            'Fecha antiguedad' => $this->seniorityDate->format('d/m/Y'),
            'Grupo cotización' => $this->quotationGroup,
        ];
    }
}
