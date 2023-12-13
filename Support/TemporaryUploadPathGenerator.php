<?php

declare(strict_types=1);

namespace Modules\Media\Support;

use Modules\Media\Models\Media;

// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
// use Modules\Media\Contracts\PathGenerator;

class TemporaryUploadPathGenerator // implements PathGenerator
{
    public function getPath(Media $media): string
    {
        /* @phpstan-ignore-line */
        return $this->getBasePath($media).'/'.md5($media->id.$media->uuid.'original').'/';
    }

    public function getPathForConversions(Media $media): string
    {
        /* @phpstan-ignore-line */
        return $this->getBasePath($media).'/'.md5($media->id.$media->uuid.'conversion');
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        /* @phpstan-ignore-line */
        return $this->getBasePath($media).'/'.md5($media->id.$media->uuid.'responsive');
    }

    /*
    * Get a unique base path for the given media.
    */
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');

        $key = md5($media->uuid.$media->getKey());

        if ($prefix !== '') {
            return $prefix.'/'.$key;
        }

        return $key;
    }
}
