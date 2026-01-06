<?php

namespace Modules\File\Infrastructure\Repositories;

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
            );
        } catch (\Exception $e) {
            Log::error('File Repository Error: find method '.$e->getMessage());

            throw $e;
        }
    }

    public function analyzable(string $hash): bool
    {
        try {
            $file = \Modules\File\Infrastructure\Databases\Models\File::find($hash);

            if (! $file) {
                return false;
            }

            return in_array($file->status, [
                StatusEnum::TO_ANALYZE->value,
            ], true);
        } catch (\Exception $e) {
            Log::error('File Repository Error: analyzable method '.$e->getMessage());

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
            ]);

        } catch (\Exception $e) {
            Log::error('File Repository Error: save method '.$e->getMessage());

            throw $e;
        }
    }

    public function sync(File $file): void
    {
        try {
            if (! $file->fileHash()) {
                return;
            }

            $model = \Modules\File\Infrastructure\Databases\Models\File::find($file->fileHash());

            if (! $model) {
                return;
            }

            $model->sheets()->syncWithoutDetaching($file->hash());
        } catch (\Exception $e) {
            Log::error('File Repository Error: sync method '.$e->getMessage());

            throw $e;
        }
    }

    public function addAlias(string $hash, string $name, int $userId): void
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
            Log::error('File Repository Error: addAlias method '.$e->getMessage());

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
            ]);
        } catch (\Exception $e) {
            Log::error('File Repository Error: update method '.$e->getMessage());

            throw $e;
        }
    }

    public function sheets(string $fileHash): array
    {
        try {
            $model = \Modules\File\Infrastructure\Databases\Models\File::with('sheets')->find($fileHash);

            if (! $model) {
                return [];
            }

            $sheets = [];

            foreach ($model->sheets as $sheet) {
                $sheets[] = new File(
                    hash: $sheet->hash,
                    mimeType: $sheet->mimetype,
                    status: StatusEnum::from($sheet->status),
                    fileHash: $fileHash,
                );
            }

            return $sheets;
        } catch (\Exception $e) {
            Log::error('File Repository Error: sheets method '.$e->getMessage());

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
