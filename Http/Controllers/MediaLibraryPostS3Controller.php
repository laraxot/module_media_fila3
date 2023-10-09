<?php

declare(strict_types=1);

namespace Modules\Media\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\Media;
use Modules\Media\Request\CreateTemporaryUploadFromDirectS3UploadRequest;
use Spatie\MediaLibrary\Conversions\FileManipulator;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;

class MediaLibraryPostS3Controller
{
    public function __invoke(
        CreateTemporaryUploadFromDirectS3UploadRequest $createTemporaryUploadFromDirectS3UploadRequest,
        FileManipulator $fileManipulator
    ) {
        $diskName = config('media-library.disk_name');

        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUpload = $temporaryUploadModelClass::create([
            'session_id' => session()->getId(),
        ]);

        /** @var Media $media */
        $media = $temporaryUpload->media()->create([
            'name' => $createTemporaryUploadFromDirectS3UploadRequest->name,
            'uuid' => $createTemporaryUploadFromDirectS3UploadRequest->uuid,
            'collection_name' => 'default',
            'file_name' => $createTemporaryUploadFromDirectS3UploadRequest->name,
            'mime_type' => $createTemporaryUploadFromDirectS3UploadRequest->content_type,
            'disk' => $diskName,
            'conversions_disk' => $diskName,
            'manipulations' => [],
            'custom_properties' => [],
            'responsive_images' => [],
            'generated_conversions' => [],
            'size' => $createTemporaryUploadFromDirectS3UploadRequest->size,
        ]);

        /** @var PathGenerator $pathGenerator */
        $pathGenerator = PathGeneratorFactory::create($media);

        Storage::disk($diskName)->copy(
            $createTemporaryUploadFromDirectS3UploadRequest->key,
            $pathGenerator->getPath($media) . $createTemporaryUploadFromDirectS3UploadRequest->name,
        );

        $fileManipulator->createDerivedFiles($media);

        return response()->json([
            'name' => $media->name,
            'file_name' => $media->file_name,
            'uuid' => $media->uuid,
            'preview_url' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
            'original_url' => $media->getUrl(),
            'order' => $media->order_column,
            'custom_properties' => $media->custom_properties,
            'extension' => $media->extension,
            'size' => $media->size,
        ]);
    }
}
