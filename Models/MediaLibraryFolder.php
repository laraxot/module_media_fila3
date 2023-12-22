<?php

declare(strict_types=1);

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder as BaseMediaLibraryFolder;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Modules\Media\Models\MediaLibraryItem.
 *
 * @property Collection<int, MediaLibraryFolder> $children
 * @property int|null                            $children_count
 *
 * @method static Builder|MediaLibraryFolder newModelQuery()
 * @method static Builder|MediaLibraryFolder newQuery()
 * @method static Builder|MediaLibraryFolder ordered(string $direction = 'asc')
 * @method static Builder|MediaLibraryFolder query()
 *
 * @property int                                                     $id
 * @property int|null                                                $parent_id
 * @property string                                                  $name
 * @property \Illuminate\Support\Carbon|null                         $created_at
 * @property \Illuminate\Support\Carbon|null                         $updated_at
 * @property string|null                                             $user_id
 * @property string|null                                             $updated_by
 * @property string|null                                             $created_by
 * @property int|null                                                $order_column
 * @property Collection<int, \Modules\Media\Models\MediaLibraryItem> $mediaLibraryItems
 * @property int|null                                                $media_library_items_count
 *
 * @method static Builder|MediaLibraryFolder whereCreatedAt($value)
 * @method static Builder|MediaLibraryFolder whereCreatedBy($value)
 * @method static Builder|MediaLibraryFolder whereId($value)
 * @method static Builder|MediaLibraryFolder whereName($value)
 * @method static Builder|MediaLibraryFolder whereOrderColumn($value)
 * @method static Builder|MediaLibraryFolder whereParentId($value)
 * @method static Builder|MediaLibraryFolder whereUpdatedAt($value)
 * @method static Builder|MediaLibraryFolder whereUpdatedBy($value)
 * @method static Builder|MediaLibraryFolder whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MediaLibraryFolder extends BaseMediaLibraryFolder implements Sortable
{
    use SortableTrait;

    /**
     * @var string
     */
    protected $connection = 'media';

    /**
     * @var string
     */
    protected $table = 'media_library_folders';
}
