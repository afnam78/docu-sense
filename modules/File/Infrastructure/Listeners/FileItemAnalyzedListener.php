<?php

namespace Modules\File\Infrastructure\Listeners;

use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Contracts\AuditServiceInterface;
use Modules\File\Infrastructure\Events\FileItemAnalyzedEvent;
use Modules\Payslip\Domain\Contracts\DataExtractorServiceInterface;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

final readonly class FileItemAnalyzedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private DataExtractorServiceInterface $extractorService,
        private AuditServiceInterface $payslipAuditService,
        private AuditRepositoryInterface $auditRepository,
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileItemAnalyzedEvent $event): void
    {
        $this->extractorService->execute($event->file());

        $payslip = PayslipMapper::fromResponse($event->file()->payslipResponse());

        $audit = $this->payslipAuditService->execute($payslip);
        $this->auditRepository->save($audit, $event->file()->hash());
    }
}
