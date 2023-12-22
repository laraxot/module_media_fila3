<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Media\Models\Media;

abstract class MediaItemRule implements ValidationRule
{
    public mixed $value;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->value = $value;

        $this->validateMediaItem();
    }

    public function getTemporaryUploadMedia(): ?Media
    {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUpload = $temporaryUploadModelClass::findByMediaUuidInCurrentSession($this->value['uuid']);

        if (! $temporaryUpload) {
            return null;
        }

        return $temporaryUpload->getFirstMedia();
    }

    abstract public function validateMediaItem(): bool;
}
