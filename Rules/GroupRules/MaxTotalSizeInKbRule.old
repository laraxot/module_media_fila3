<?php

declare(strict_types=1);

namespace Modules\Media\Rules\GroupRules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Media\Models\Media;
use Spatie\MediaLibrary\Support\File;

class MaxTotalSizeInKbRule implements Rule
{
    protected int $actualTotalSizeInKb;

    public function __construct(protected int $maxTotalSizeInKb)
    {
    }

    public function passes($attribute, $uploadedItems): bool
    {
        $uuids = collect($uploadedItems)
            ->map(fn (array $uploadedItemAttributes) => $uploadedItemAttributes['uuid'])
            ->toArray();

        $collection = Media::findWithTemporaryUploadInCurrentSession($uuids);

        $this->actualTotalSizeInKb = $collection->totalSizeInBytes();

        return $this->actualTotalSizeInKb <= $this->maxTotalSizeInKb * 1024;
    }

    public function message(): string
    {
        return __('media::validation.total_upload_size_too_high', [
            'max' => File::getHumanReadableSize($this->maxTotalSizeInKb * 1024),
            'maxInKb' => $this->maxTotalSizeInKb,
            'actual' => File::getHumanReadableSize($this->actualTotalSizeInKb * 1024),
            'actualInKb' => $this->actualTotalSizeInKb,
        ]);
    }
}
