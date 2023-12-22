<?php

// namespace Intervention\Image\Templates;

declare(strict_types=1);

namespace Modules\Media\Filters\Images;

use Intervention\Image\Filters\FilterContract;
use Intervention\Image\Image;

class Small implements FilterContract
{
    public function applyFilter(Image $image): Image
    {
        // return $image->fit(120, 90);
        $width = 120;
        $height = 120;

        return $image->fit($width, $height);

        /*
        $image->resize($width, $height, function ($constraint): void {
            $constraint->aspectRatio();
        });

        return $image->resizeCanvas($width, $height, 'center', false, '#fff');
        */
    }
}
