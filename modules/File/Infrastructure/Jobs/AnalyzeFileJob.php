<?php

namespace Modules\File\Infrastructure\Jobs;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Infrastructure\Events\FileItemAnalyzedEvent;
use Modules\OpenAI\Domain\Contracts\OpenAIServiceInterface;
use Throwable;

class AnalyzeFileJob implements ShouldQueue
{
    use Batchable, InteractsWithSockets, Queueable, SerializesModels;

    public int $timeout = 60;

    public int $tries = 3;

    public int $backoff = 10;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $hash,
        private readonly string $base64
    ) {}

    /**
     * Execute the job.
     */
    public function handle(OpenAIServiceInterface $openAIService, FileRepositoryInterface $fileRepository): void
    {
        $fileRepository->markAsProcessing($this->hash);
        $result = $openAIService->analyzeDocument($this->hash, $this->base64);
        $fileRepository->markAsDone($this->hash);

        $file = $fileRepository->find($this->hash);
        $file->setJsonResponse(json_decode($result, true));
        $file->setAnalyzeDate(now());
        $fileRepository->update($file);

        FileItemAnalyzedEvent::dispatch($file);
    }

    public function failed(?Throwable $exception): void
    {
        Log::critical('AnalyzeFileJob failed for file '.$this->hash.': '.$exception?->getMessage());

        $fileRepository = app(FileRepositoryInterface::class);
        $fileRepository->markAsError($this->hash);
    }

    public function tags(): array
    {
        return ['analyze-file', 'file:'.$this->hash];
    }
}
