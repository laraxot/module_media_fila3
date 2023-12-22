<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Modules\Media\Models\Media;
use Spatie\MediaLibrary\Support\File;

class MinItemSizeInKbRule extends MediaItemRule
{
    protected int $actualSizeInBytes;

    public function __construct(protected int $minSizeInKb)
    {
    }

    public function validateMediaItem(): bool
    {
        if (! ($media = $this->getTemporaryUploadMedia()) instanceof Media) {
            return true;
        }

        $this->actualSizeInBytes = $media->size;

        return $this->actualSizeInBytes >= $this->minSizeInKb * 1024;
    }

    public function message(): string
    {
        return __('media::validation.file_too_small', [
            'min' => File::getHumanReadableSize($this->minSizeInKb * 1024),
            'minInKb' => $this->minSizeInKb,
            'actual' => File::getHumanReadableSize($this->actualSizeInBytes),
            'actualInKb' => round($this->actualSizeInBytes / 1024),
        ]);
    }
}
