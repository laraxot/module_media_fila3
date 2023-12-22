<?php

/**
 * @see https://github.com/spatie/laravel-medialibrary/blob/main/database/migrations/create_media_table.php.stub
 */

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ----- models -----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateImagesTable.
 */
class CreateFilamentMediaLibraryModelTable extends XotBaseMigration
{
    /**
     * i don't write table name, it take from Model, model is singular of this class wit.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->string('media_library_item_id');
            $table->text('note');
            $table->nullableTimestamps();
            // ----------------------------------------------------------
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        // -- UPDATE --

        $this->tableUpdate(function (Blueprint $table): void {
            if ($this->hasColumn('media_library_item_id')) {
                return;
            }
            if (! $this->hasColumn('media_library_id')) {
                return;
            }
            $table->renameColumn('media_library_id', 'media_library_item_id');
        });
    }
}
