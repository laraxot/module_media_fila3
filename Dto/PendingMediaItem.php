<?php

declare(strict_types=1);

namespace Modules\Media\Dto;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\Media\Models\TemporaryUpload;

class PendingMediaItem
{
    public TemporaryUpload $temporaryUpload;

    public function __construct(
        string $uuid,
        public string $name,
        public int $order,
        public array $customProperties,
        array $customHeaders,
        public ?string $fileName = null
    ) {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        if (! $temporaryUpload = $temporaryUploadModelClass::findByMediaUuidInCurrentSession($uuid)) {
            throw new Exception('invalid uuid');
        }

        $this->temporaryUpload = $temporaryUpload;
    }

    public static function createFromArray(array $pendingMediaItems): Collection
    {
        return collect($pendingMediaItems)
            ->map(fn (array $uploadAttributes): static => new static(
                $uploadAttributes['uuid'],
                $uploadAttributes['name'] ?? '',
                $uploadAttributes['order'] ?? 0,
                $uploadAttributes['custom_properties'] ?? [],
                $uploadAttributes['fileName'] ?? null,
            ));
    }

    public function toArray(): array
    {
        $media = $this->temporaryUpload->getFirstMedia();

        return [
            'uuid' => $media->uuid,
            'name' => $this->name,
            'order' => $this->order,
            'custom_properties' => $this->customProperties,
            'size' => $media->size,
            'mime' => $media->mime,
        ];
    }

    public function getCustomProperties(array $customPropertyNames): array
    {
        if ([] === $customPropertyNames) {
            return $this->customProperties;
        }

        return collect($customPropertyNames)
            ->filter(fn (string $customProperty) => Arr::has($this->customProperties, $customProperty))
            ->mapWithKeys(fn ($name): array => [$name => Arr::get($this->customProperties, $name)])
            ->toArray();
    }
}
