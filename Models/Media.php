<?php

declare(strict_types=1);

namespace Modules\Media\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

/**
 * Modules\Media\Models\Media.
 *
 * @property int                  $id
 * @property string               $model_type
 * @property int                  $model_id
 * @property string|null          $uuid
 * @property string               $collection_name
 * @property string               $name
 * @property string               $file_name
 * @property string|null          $mime_type
 * @property string               $disk
 * @property string|null          $conversions_disk
 * @property int                  $size
 * @property array                $manipulations
 * @property array                $custom_properties
 * @property array                $generated_conversions
 * @property array                $responsive_images
 * @property int|null             $order_column
 * @property Carbon|null          $created_at
 * @property Carbon|null          $updated_at
 * @property string|null          $created_by
 * @property string|null          $updated_by
 * @property int                  $user_id
 * @property Model|Eloquent      $model
 * @property TemporaryUpload|null $temporaryUpload
 *
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static Builder|Media                newModelQuery()
 * @method static Builder|Media                newQuery()
 * @method static Builder|Media                ordered()
 * @method static Builder|Media                query()
 * @method static Builder|Media                whereCollectionName($value)
 * @method static Builder|Media                whereConversionsDisk($value)
 * @method static Builder|Media                whereCreatedAt($value)
 * @method static Builder|Media                whereCreatedBy($value)
 * @method static Builder|Media                whereCustomProperties($value)
 * @method static Builder|Media                whereDisk($value)
 * @method static Builder|Media                whereFileName($value)
 * @method static Builder|Media                whereGeneratedConversions($value)
 * @method static Builder|Media                whereId($value)
 * @method static Builder|Media                whereManipulations($value)
 * @method static Builder|Media                whereMimeType($value)
 * @method static Builder|Media                whereModelId($value)
 * @method static Builder|Media                whereModelType($value)
 * @method static Builder|Media                whereName($value)
 * @method static Builder|Media                whereOrderColumn($value)
 * @method static Builder|Media                whereResponsiveImages($value)
 * @method static Builder|Media                whereSize($value)
 * @method static Builder|Media                whereUpdatedAt($value)
 * @method static Builder|Media                whereUpdatedBy($value)
 * @method static Builder|Media                whereUserId($value)
 * @method static Builder|Media                whereUuid($value)
 *
 * @mixin \Eloquent
 */
class Media extends SpatieMedia
{
    public static function findWithTemporaryUploadInCurrentSession(array $uuids): Collection
    {
        // MediaLibraryPro::ensureInstalled();

        return static::query()
            ->whereIn('uuid', $uuids)
            ->whereHasMorph(
                'model',
                [TemporaryUpload::class],
                fn (Builder $builder) => $builder->where('session_id', session()->getId())
            )
            ->get();
    }

    public function temporaryUpload(): BelongsTo
    {
        // MediaLibraryPro::ensureInstalled();

        return $this->belongsTo(TemporaryUpload::class);
    }

    public function setCustomProperties(array $data): void
    {
        foreach ($data as $k => $v) {
            $this->setCustomProperty($k, $v);
        }
    }
}
