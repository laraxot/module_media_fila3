<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Modules\Media\Models\Media;
use Spatie\MediaLibrary\Support\File;

class MaxItemSizeInKbRule extends MediaItemRule
{
    protected int $actualSizeInBytes;

    public function __construct(protected int $maxSizeInKb)
    {
    }

    public function validateMediaItem(): bool
    {
        if (! ($media = $this->getTemporaryUploadMedia()) instanceof Media) {
            return true;
        }

        $this->actualSizeInBytes = $media->size;

        return $this->actualSizeInBytes <= $this->maxSizeInKb * 1024;
    }

    public function message()
    {
        return __('media::validation.file_too_big', [
            'max' => File::getHumanReadableSize($this->maxSizeInKb * 1024),
            'maxInKb' => $this->maxSizeInKb,
            'actual' => File::getHumanReadableSize($this->actualSizeInBytes),
            'actualInKb' => round($this->actualSizeInBytes / 1024),
        ]);
    }
}
