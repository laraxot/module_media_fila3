<?php

declare(strict_types=1);

namespace Modules\Media\Database\Factories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Modules\Media\Models\TemporaryUpload;

class TemporaryUploadFactory
{
    private int $fakeImageWidth = 10;

    private int $fakeImageHeight = 10;

    public function create(array $attributes = []): TemporaryUpload
    {
        $file = UploadedFile::fake()->image('test.jpg', $this->fakeImageWidth, $this->fakeImageHeight);

        return TemporaryUpload::createForFile(
            $file,
            session()->getId(),
            $attributes['uuid'] ?? Str::uuid(),
            $attributes['name'] ?? 'name',
        );
    }
}
