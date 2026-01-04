<?php

namespace Modules\File\Infrastructure\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;
use Modules\File\Domain\Enums\StatusEnum;

class FileRepository implements FileRepositoryInterface
{
    public function find(string $hash): ?File
    {
        try {
            $file = \Modules\File\Infrastructure\Databases\Models\File::find($hash);

            if (! $file) {
                return null;
            }

            return new File(
                hash: $file->hash,
                mimeType: $file->mimetype,
                status: StatusEnum::from($file->status),
                jsonResponse: $file->json_response ? json_decode($file->json_response, true) : [],
                payslipResponse: $file->payslip_response ? json_decode($file->payslip_response, true) : [],
                analyzeDate: $file->analyze_date ? Carbon::createFromFormat('Y-m-d H:i:s', $file->analyze_date) : null,
            );
        } catch (\Exception $e) {
            Log::error('File Repository Error: find method '.$e->getMessage());

            throw $e;
        }
    }

    public function findByTenant(string $hash, int $userId): ?File
    {
        try {
            $file = \Modules\File\Infrastructure\Databases\Models\File::where('hash', $hash)
                ->with('aliases')
                ->whereHas('aliases', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->first();

            if (! $file) {
                return null;
            }

            return new File(
                hash: $file->hash,
                mimeType: $file->mimetype,
                status: StatusEnum::from($file->status),
                name: $file->aliases->first()->name,
                jsonResponse: $file->json_response ? json_decode($file->json_response, true) : [],
                payslipResponse: $file->payslip_response ? json_decode($file->payslip_response, true) : [],
                analyzeDate: $file->analyze_date ? Carbon::createFromFormat('Y-m-d H:i:s', $file->analyze_date) : null,
            );
        } catch (\Exception $e) {
            Log::error('File Repository Error: findByHashAndTenant method '.$e->getMessage());

            throw $e;
        }
    }

    public function save(File $file): void
    {
        try {
            \Modules\File\Infrastructure\Databases\Models\File::create([
                'hash' => $file->hash(),
                'mimetype' => $file->mimeType(),
                'status' => $file->status()->value,
                'json_response' => json_encode($file->jsonResponse()),
                'payslip_response' => json_encode($file->payslipResponse()),
                'analyze_date' => $file->analyzeDate(),
            ]);

        } catch (\Exception $e) {
            Log::error('File Repository Error: save method '.$e->getMessage());

            throw $e;
        }
    }

    public function addAliase(string $hash, string $name, int $userId): void
    {
        try {
            $model = \Modules\File\Infrastructure\Databases\Models\File::with('aliases')->find($hash);

            if ($model) {
                $model->aliases()->create([
                    'name' => $name,
                    'user_id' => $userId,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('File Repository Error: addAliase method '.$e->getMessage());

            throw $e;
        }
    }

    public function markAsDone(string $hash): void
    {
        $this->markStatus($hash, StatusEnum::DONE);
    }

    public function markAsProcessing(string $hash): void
    {
        $this->markStatus($hash, StatusEnum::PROCESSING);
    }

    public function markAsToAnalyze(string $hash): void
    {
        $this->markStatus($hash, StatusEnum::TO_ANALYZE);
    }

    public function markAsError(string $hash): void
    {
        $this->markStatus($hash, StatusEnum::ERROR);
    }

    public function update(File $file): void
    {
        try {
            \Modules\File\Infrastructure\Databases\Models\File::where('hash', $file->hash())->update([
                'mimetype' => $file->mimeType(),
                'status' => $file->status()->value,
                'json_response' => $file->jsonResponse() ? json_encode($file->jsonResponse()) : null,
                'payslip_response' => $file->payslipResponse() ? json_encode($file->payslipResponse()) : null,
                'analyze_date' => $file->analyzeDate(),
            ]);
        } catch (\Exception $e) {
            Log::error('File Repository Error: update method '.$e->getMessage());

            throw $e;
        }
    }

    private function markStatus(string $hash, StatusEnum $status): void
    {
        try {
            $file = \Modules\File\Infrastructure\Databases\Models\File::find($hash);

            if ($file) {
                $file->update(['status' => $status->value]);
            }
        } catch (\Exception $e) {
            Log::error('File Repository Error: markStatus method '.$e->getMessage());

            throw $e;
        }
    }
}
