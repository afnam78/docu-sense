<?php

namespace Modules\File\Infrastructure\Listeners;

use Modules\Audit\Domain\Contracts\PayslipAuditServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;
use Modules\File\Infrastructure\Events\FileAnalyzed;
use Modules\OpenAI\Domain\Contracts\OpenAIRepositoryInterface;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

class FileAnalyzedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly FileRepositoryInterface $repository,
        private readonly OpenAIRepositoryInterface $openAIRepository,
        private readonly PayslipAuditServiceInterface $payslipAuditService
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileAnalyzed $event): void
    {
        $this->manageSheets($event->fileHash());
        $this->generateAudit($event->fileHash(), $event->sheetHash());
    }

    private function manageSheets(string $fileHash): void
    {
        $sheets = $this->repository->sheets($fileHash);
        $allSheetsAnalyzed = collect($sheets)->every(fn (File $sheet) => $sheet->status()->isDone());

        if ($allSheetsAnalyzed) {
            $this->repository->markAsDone($fileHash);
        }
    }

    private function generateAudit(string $fileHash, string $sheetHash): void
    {
        $openAiRequest = $this->openAIRepository->find($sheetHash);

        if (! $openAiRequest) {
            return;
        }

        $content = $openAiRequest->content();

        $isValidStructure = PayslipMapper::isValidStructure($content);

        if (! $isValidStructure) {
            return;
        }

        $payslip = PayslipMapper::fromResponse($content);

        $this->payslipAuditService->generate($payslip, $fileHash, $sheetHash);
    }
}
