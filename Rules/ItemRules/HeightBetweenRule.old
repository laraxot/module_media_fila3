<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Modules\Media\Models\Media;

use function Safe\getimagesize;

class HeightBetweenRule extends MediaItemRule
{
    public function __construct(
        protected int $minHeight = 0,
        protected int $maxHeight = 0
    ) {
    }

    public function validateMediaItem(): bool
    {
        if (! ($media = $this->getTemporaryUploadMedia()) instanceof Media) {
            return true;
        }

        $size = getimagesize($media->getPath());
        $actualHeight = $size[1];

        return $actualHeight >= $this->minHeight && $actualHeight <= $this->maxHeight;
    }

    public function message()
    {
        return __('media::validation.height_not_between', [
            'min' => $this->minHeight,
            'max' => $this->maxHeight,
        ]);
    }
}
