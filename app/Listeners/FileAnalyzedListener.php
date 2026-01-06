<?php

namespace App\Listeners;

use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;
use Modules\File\Infrastructure\Events\FileAnalyzed;

class FileAnalyzedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly FileRepositoryInterface $repository)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileAnalyzed $event): void
    {
        $fileHash = $event->fileHash();

        $sheets = $this->repository->sheets($fileHash);

        $allSheetsAnalyzed = collect($sheets)->every(fn (File $sheet) => $sheet->status()->isDone());

        if ($allSheetsAnalyzed) {
            $this->repository->markAsDone($fileHash);
        }
    }
}
