<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Illuminate\Support\Arr;
use Modules\Media\Models\Media;
use Symfony\Component\Mime\MimeTypes;

class ExtensionRule extends MediaItemRule
{
    protected array $allowedExtensions;

    public function __construct(string|array $allowedExtensions)
    {
        $this->allowedExtensions = Arr::wrap($allowedExtensions);
    }

    public function validateMediaItem(): bool
    {
        if (! ($media = $this->getTemporaryUploadMedia()) instanceof Media) {
            return true;
        }

        if (empty($media->mime_type)) {
            $extension = pathinfo($media->file_name, PATHINFO_EXTENSION);

            return \in_array($extension, $this->allowedExtensions, true);
        }

        $actualExtensions = (new MimeTypes())->getExtensions($media->mime_type);

        return [] !== array_intersect($actualExtensions, $this->allowedExtensions);
    }

    public function message()
    {
        return __('media::validation.extension', [
            'extensions' => implode(', ', $this->allowedExtensions),
        ]);
    }
}
