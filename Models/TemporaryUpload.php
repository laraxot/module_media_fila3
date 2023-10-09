<?php

declare(strict_types=1);

namespace Modules\Media\Models;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\Media\Exceptions\CouldNotAddUpload;
use Modules\Media\Exceptions\TemporaryUploadDoesNotBelongToCurrentSession;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use function is_string;

class TemporaryUpload extends Model implements HasMedia
{
    use InteractsWithMedia;
    use MassPrunable;

    public static ?Closure $manipulatePreview = null;

    public static ?string $disk = null;

    protected $guarded = [];

    public static function previewManipulation(Closure $closure): void
    {
        static::$manipulatePreview = $closure;
    }

    public static function findByMediaUuid(?string $mediaUuid): ?self
    {
        $mediaModelClass = (string) config('media-library.media_model');

        /** @var Media $media */
        $media = $mediaModelClass::query()
            ->where('uuid', $mediaUuid)
            ->first();

        if (! $media) {
            return null;
        }

        $temporaryUpload = $media->model;

        if (! $temporaryUpload instanceof self) {
            return null;
        }

        return $temporaryUpload;
    }

    public static function findByMediaUuidInCurrentSession(?string $mediaUuid): ?self
    {
        if (! ($temporaryUpload = static::findByMediaUuid($mediaUuid)) instanceof \Modules\Media\Models\TemporaryUpload) {
            return null;
        }

        if (config('media-library.enable_temporary_uploads_session_affinity', true) && $temporaryUpload->session_id !== session()->getId()) {
            return null;
        }

        return $temporaryUpload;
    }

    public static function createForFile(
        UploadedFile $uploadedFile,
        string $sessionId,
        string $uuid,
        string $name
    ): self {
        /** @var \Modules\Media\Models\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'session_id' => $sessionId,
        ]);

        if (static::findByMediaUuid($uuid) instanceof \Modules\Media\Models\TemporaryUpload) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMedia($uploadedFile)
            ->setName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());
        // Debugbar::info('TemporaruUpload UUID', $uuid);
        $temporaryUpload->fresh();

        return $temporaryUpload;
    }

    public static function createForRemoteFile(
        string $file,
        string $sessionId,
        string $uuid,
        string $name,
        string $diskName
    ): self {
        /** @var \Modules\Media\Models\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'session_id' => $sessionId,
        ]);

        if (static::findByMediaUuid($uuid) instanceof \Modules\Media\Models\TemporaryUpload) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMediaFromDisk($file, $diskName)
            ->setName($name)
            ->usingFileName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        $temporaryUpload->fresh();

        return $temporaryUpload;
    }

    protected static function getDiskName(): string
    {
        $res = static::$disk ?? config('media-library.disk_name');
        if (is_string($res)) {
            return $res;
        }
        throw new Exception('[' . __LINE__ . '][' . __FILE__ . ']');
    }

    public function scopeOld(Builder $builder): void
    {
        $builder->where('created_at', '<=', Carbon::now()->subDay()->toDateTimeString());
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        if (! config('media-library.generate_thumbnails_for_temporary_uploads')) {
            return;
        }

        $conversion = $this
            ->addMediaConversion('preview')
            ->nonQueued();

        $previewManipulation = $this->getPreviewManipulation();

        $previewManipulation($conversion);
    }

    public function moveMedia(HasMedia $hasMedia, string $collectionName, string $diskName, string $fileName): Media
    {
        if (config('media-library.enable_temporary_uploads_session_affinity', true) && $this->session_id !== session()->getId()) {
            throw TemporaryUploadDoesNotBelongToCurrentSession::create();
        }

        $media = $this->getFirstMedia();

        if (! $media instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media) {
            throw new Exception('[' . __LINE__ . '][' . __FILE__ . ']');
        }

        $temporaryUploadModel = $media->model;
        $uuid = $media->uuid;

        $newMedia = $media->move($hasMedia, $collectionName, $diskName, $fileName);

        $temporaryUploadModel->delete();

        $newMedia->update(['uuid' => $uuid]);

        return $newMedia;
    }

    public function prunable(): Builder
    {
        return self::query()->old();
    }

    protected function getPreviewManipulation(): Closure
    {
        return static::$manipulatePreview ?? function (Conversion $conversion): void {
            $conversion->fit(Manipulations::FIT_CROP, 300, 300);
        };
    }
}
