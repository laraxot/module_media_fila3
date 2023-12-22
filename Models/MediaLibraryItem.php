<?php

declare(strict_types=1);

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\User\Models\User;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem as BaseMediaLibraryItem;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\Media\Models\MediaLibraryItem.
 *
 * @property MediaCollection<int, Media> $media
 * @property int|null                    $media_count
 * @property User|null                   $user
 *
 * @method static \RalphJSmit\Filament\MediaLibrary\Database\Factories\Media\MediaLibraryFactory factory($count = null, $state = [])
 * @method static Builder|MediaLibraryItem                                                       newModelQuery()
 * @method static Builder|MediaLibraryItem                                                       newQuery()
 * @method static Builder|MediaLibraryItem                                                       ordered(string $direction = 'asc')
 * @method static Builder|MediaLibraryItem                                                       query()
 *
 * @property int                                           $id
 * @property string|null                                   $uploaded_by_user_id
 * @property string|null                                   $caption
 * @property string|null                                   $alt_text
 * @property int|null                                      $folder_id
 * @property int|null                                      $order_column
 * @property \Illuminate\Support\Carbon|null               $created_at
 * @property \Illuminate\Support\Carbon|null               $updated_at
 * @property string|null                                   $user_id
 * @property string|null                                   $updated_by
 * @property string|null                                   $created_by
 * @property \Modules\Media\Models\MediaLibraryFolder|null $folder
 *
 * @method static Builder|MediaLibraryItem whereAltText($value)
 * @method static Builder|MediaLibraryItem whereCaption($value)
 * @method static Builder|MediaLibraryItem whereCreatedAt($value)
 * @method static Builder|MediaLibraryItem whereCreatedBy($value)
 * @method static Builder|MediaLibraryItem whereFolderId($value)
 * @method static Builder|MediaLibraryItem whereId($value)
 * @method static Builder|MediaLibraryItem whereOrderColumn($value)
 * @method static Builder|MediaLibraryItem whereUpdatedAt($value)
 * @method static Builder|MediaLibraryItem whereUpdatedBy($value)
 * @method static Builder|MediaLibraryItem whereUploadedByUserId($value)
 * @method static Builder|MediaLibraryItem whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MediaLibraryItem extends BaseMediaLibraryItem implements Sortable
{
    use SortableTrait;

    /**
     * @var string
     */
    protected $connection = 'media';

    /**
     * @var string
     */
    protected $table = 'media_library_items';
}
