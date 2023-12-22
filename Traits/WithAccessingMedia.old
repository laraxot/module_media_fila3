<?php

declare(strict_types=1);

namespace Modules\Media\Traits;

use Modules\Media\Models\Media;
use Spatie\MediaLibrary\HasMedia;

trait WithAccessingMedia
{
    protected function getMedia(string $name, HasMedia $hasMedia, string $collection): array
    {
        /**
         * @var HasMedia
         */
        $myMedia = old($name) ?: $hasMedia;

        return $myMedia
            ->getMedia($collection)
            ->map(/**
             * @return (array|float|int|string|null)[]
             *
             * - psalm-return array{name: string, fileName: string, uuid: string, previewUrl: string, order: int|null, customProperties: array, extension: string, size: int, createdAt: float|int|null|string}
             */
                fn (Media $media): array => [
                    'name' => $media->name,
                    'fileName' => $media->file_name,
                    'uuid' => $media->uuid,
                    'previewUrl' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
                    'order' => $media->order_column,
                    'customProperties' => $media->custom_properties,
                    'extension' => $media->extension,
                    'size' => $media->size,
                    'createdAt' => null != $media->created_at ? $media->created_at->timestamp : null,
                ])
            ->keyBy('uuid')
            ->toArray();
    }

    /*
    public function mapMedia(Media $media): array
    {
        return [
            'name' => $media->name,
            'fileName' => $media->file_name,
            'uuid' => $media->uuid,
            'previewUrl' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
            'order' => $media->order_column,
            'customProperties' => $media->custom_properties,
            'extension' => $media->extension,
            'size' => $media->size,
            'createdAt' => $media->created_at?->timestamp,
        ];
    }
    */
}
