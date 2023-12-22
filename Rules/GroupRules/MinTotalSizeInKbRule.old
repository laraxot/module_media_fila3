<?php

declare(strict_types=1);

namespace Modules\Media\Rules\GroupRules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Media\Models\Media;
use Spatie\MediaLibrary\Support\File;

class MinTotalSizeInKbRule implements Rule
{
    protected int $actualTotalSizeInBytes;

    public function __construct(protected int $minTotalSizeInKb)
    {
    }

    public function passes($attribute, $uploadedItems): bool
    {
        $uuids = collect($uploadedItems)
            ->map(fn (array $uploadedItemAttributes) => $uploadedItemAttributes['uuid'])
            ->toArray();

        $collection = Media::findWithTemporaryUploadInCurrentSession($uuids);

        $this->actualTotalSizeInBytes = $collection->totalSizeInBytes();

        return $this->actualTotalSizeInBytes >= $this->minTotalSizeInKb * 1024;
    }

    public function message(): string
    {
        return __('media::validation.total_upload_size_too_low', [
            'min' => File::getHumanReadableSize($this->minTotalSizeInKb * 1024),
            'minInKb' => $this->minTotalSizeInKb,
            'actual' => File::getHumanReadableSize(round($this->actualTotalSizeInBytes / 1024)),
            'actualTotalSizeInKb' => round($this->actualTotalSizeInBytes / 1024),
        ]);
    }
}
