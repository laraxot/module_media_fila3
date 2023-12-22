<?php

declare(strict_types=1);

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Modules\Media\Models\FilamentMediaLibraryModel.
 *
 * @method static Builder|FilamentMediaLibraryModel newModelQuery()
 * @method static Builder|FilamentMediaLibraryModel newQuery()
 * @method static Builder|FilamentMediaLibraryModel query()
 *
 * @property int                             $id
 * @property string                          $model_type
 * @property int                             $model_id
 * @property string                          $media_library_item_id
 * @property string                          $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $created_by
 * @property string|null                     $updated_by
 *
 * @method static Builder|FilamentMediaLibraryModel whereCreatedAt($value)
 * @method static Builder|FilamentMediaLibraryModel whereCreatedBy($value)
 * @method static Builder|FilamentMediaLibraryModel whereId($value)
 * @method static Builder|FilamentMediaLibraryModel whereMediaLibraryItemId($value)
 * @method static Builder|FilamentMediaLibraryModel whereModelId($value)
 * @method static Builder|FilamentMediaLibraryModel whereModelType($value)
 * @method static Builder|FilamentMediaLibraryModel whereNote($value)
 * @method static Builder|FilamentMediaLibraryModel whereUpdatedAt($value)
 * @method static Builder|FilamentMediaLibraryModel whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class FilamentMediaLibraryModel extends BaseMorphPivot
{
}
