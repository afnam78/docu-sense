<?php

namespace Modules\File\Infrastructure\Listeners;

use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Contracts\AuditServiceInterface;
use Modules\File\Infrastructure\Events\FileItemAnalyzedEvent;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

final readonly class FileItemAnalyzedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
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
        $response = json_decode($event->openAIRequest()->response, true);
        $content = data_get($response, 'choices.*.message.content', []) ?? [];
        $content = data_get($content, 0);
        $payslip = PayslipMapper::fromResponse(json_decode($content, true));

        $audit = $this->payslipAuditService->execute($payslip);

        $this->auditRepository->save($audit, $event->openAIRequest()->file_hash);
    }
}
