<?php

// namespace Intervention\Image\Templates;

declare(strict_types=1);

namespace Modules\Media\Filters\Images;

use Intervention\Image\Filters\FilterContract;
use Intervention\Image\Image;

class Medium implements FilterContract
{
    public function applyFilter(Image $image): Image
    {
        return $image->fit(240, 180);
    }
}
