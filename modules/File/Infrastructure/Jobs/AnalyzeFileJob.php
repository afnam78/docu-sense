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
use OpenAI\Exceptions\RateLimitException;
use Throwable;

class AnalyzeFileJob implements ShouldQueue
{
    use Batchable, InteractsWithSockets, Queueable, SerializesModels;

    public int $timeout = 60;

    public int $tries = 3;

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
        try {
            $fileRepository->markAsProcessing($this->hash);
            $openAIRequest = $openAIService->analyzeDocument($this->hash, $this->base64);

            $fileRepository->markAsDone($this->hash);

            FileItemAnalyzedEvent::dispatchIf($openAIRequest->valid_structure, $openAIRequest);
        } catch (RateLimitException $e) {
            $this->release(30);
        }
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

    public function backoff(): array
    {
        return [10, 20, 40, 80];
    }
}
