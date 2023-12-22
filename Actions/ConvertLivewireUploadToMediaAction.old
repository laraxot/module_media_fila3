<?php

declare(strict_types=1);

namespace Modules\Media\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\FileUploadConfiguration;
use Livewire\TemporaryUploadedFile;
use Modules\Media\Models\Media;
use Modules\Media\Models\TemporaryUpload;

class ConvertLivewireUploadToMediaAction
{
    public function execute(TemporaryUploadedFile $temporaryUploadedFile): Media
    {
        return $this->isLocalTemporaryDisk()
            ? $this->createFromLocalLivewireUpload($temporaryUploadedFile)
            : $this->createFromRemoteLivewireUpload($temporaryUploadedFile);
    }

    protected function isLocalTemporaryDisk(): bool
    {
        // See \Livewire\FileUploadConfiguration::isUsingS3()

        $diskBeforeTestFake = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');

        return 'local' === config('filesystems.disks.'.strtolower((string) $diskBeforeTestFake).'.driver');
    }

    protected function createFromLocalLivewireUpload(TemporaryUploadedFile $temporaryUploadedFile): ?\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        $uploadedFile = new UploadedFile($temporaryUploadedFile->path(), $temporaryUploadedFile->getClientOriginalName());

        /** @var class-string<TemporaryUpload> $temporaryUploadModelClass */
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUpload = $temporaryUploadModelClass::createForFile(
            $uploadedFile,
            session()->getId(),
            (string) Str::uuid(),
            $temporaryUploadedFile->getClientOriginalName()
        );

        return $temporaryUpload->getFirstMedia();
    }

    protected function createFromRemoteLivewireUpload(TemporaryUploadedFile $temporaryUploadedFile): ?\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        /** @var class-string<TemporaryUpload> $temporaryUploadModelClass */
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $livewireDisk = config('livewire.temporary_file_upload.disk', 's3');

        $livewireDirectory = FileUploadConfiguration::directory();

        $remotePath = Str::of($livewireDirectory)->start('/')->finish('/').$temporaryUploadedFile->getFilename();

        $temporaryUpload = $temporaryUploadModelClass::createForRemoteFile(
            $remotePath,
            session()->getId(),
            (string) Str::uuid(),
            $temporaryUploadedFile->getClientOriginalName(),
            $livewireDisk
        );

        return $temporaryUpload->getFirstMedia();
    }
}
