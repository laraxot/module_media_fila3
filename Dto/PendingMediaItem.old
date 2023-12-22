<?php

declare(strict_types=1);

namespace Modules\Media\Dto;

use Illuminate\Support\Arr;
use Modules\Media\Models\TemporaryUpload;
use Webmozart\Assert\Assert;

class PendingMediaItem
{
    public TemporaryUpload $temporaryUpload;

    public function __construct(
        string $uuid,
        public string $name,
        public int $order,
        public array $customProperties,
        // array $customHeaders,
        public ?string $fileName = null
    ) {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');
        Assert::string($temporaryUploadModelClass);

        if (! $temporaryUpload = $temporaryUploadModelClass::findByMediaUuidInCurrentSession($uuid)) {
            throw new \Exception('invalid uuid');
        }

        $this->temporaryUpload = $temporaryUpload;
    }

    /**
     * @return (array|int|mixed|string)[]
     *
     * @psalm-return array{uuid: string, name: string, order: int, custom_properties: array, size: int, mime: mixed}
     */
    public function toArray(): array
    {
        Assert::notNull($media = $this->temporaryUpload->getFirstMedia());

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
