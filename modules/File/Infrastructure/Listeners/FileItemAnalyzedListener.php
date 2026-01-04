<?php

namespace Modules\File\Infrastructure\Listeners;

use Modules\File\Infrastructure\Events\FileItemAnalyzedEvent;
use Modules\Payslip\Domain\Contracts\DataExtractorServiceInterface;

final readonly class FileItemAnalyzedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private DataExtractorServiceInterface $extractorService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileItemAnalyzedEvent $event): void
    {
        $this->extractorService->execute($event->file());
    }
}
