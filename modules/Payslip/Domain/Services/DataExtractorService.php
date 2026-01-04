<?php

namespace Modules\Payslip\Domain\Services;

use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;
use Modules\Payslip\Domain\Contracts\DataExtractorServiceInterface;

final readonly class DataExtractorService implements DataExtractorServiceInterface
{
    public function __construct(private FileRepositoryInterface $fileRepository) {}

    public function execute(File $file): void
    {
        $responseData = $file->jsonResponse();
        $responseData = json_decode($responseData ?? '', true);
        if (! $responseData) {
            return;
        }

        $results = data_get($responseData, 'choices.*.message.content');
        $result = data_get($results, 0);
        $result = json_decode($result ?? '', true);

        if (! $result) {
            return;
        }

        if (! $this->resultStructureIsValid($result)) {
            return;
        }

        $file->setPayslipResponse($result);

        $this->fileRepository->update($file);
    }

    private function resultStructureIsValid(array $result): bool
    {
        $keys = [
            'empresa',
            'trabajador',
            'periodo',
            'devengos',
            'deducciones',
            'totales',
            'bases_cotizacion',
        ];

        return collect($keys)->every(fn ($key) => array_key_exists($key, $result));
    }
}
