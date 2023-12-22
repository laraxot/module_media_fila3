<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Modules\Media\Models\Media;

use function Safe\getimagesize;

class WidthBetweenRule extends MediaItemRule
{
    public function __construct(
        protected int $minWidth = 0,
        protected int $maxWidth = 0
    ) {
    }

    public function validateMediaItem(): bool
    {
        if (! ($media = $this->getTemporaryUploadMedia()) instanceof Media) {
            return true;
        }

        $size = getimagesize($media->getPath());
        $actualWidth = $size[0];

        return $actualWidth >= $this->minWidth && $actualWidth <= $this->maxWidth;
    }

    public function message(): string
    {
        return __('media::validation.width_not_between', [
            'min' => $this->minWidth,
            'max' => $this->maxWidth,
        ]);
    }
}
