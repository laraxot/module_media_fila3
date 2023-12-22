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
class CreateMediasTable extends XotBaseMigration
{
    /**
     * i don't write table name, it take from Model, model is singular of this class wit.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $table): void {
            $table->bigIncrements('id');
            // $table->morphs('model');
            $table->uuidMorphs('model');
            $table->uuid('uuid')->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->nullableTimestamps();
            // ----------------------------------------------------------
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            if (! $this->hasColumn('user_id')) {
                $table->integer('user_id');
            }

            if (! $this->hasColumn('order_column')) {
                $table->unsignedInteger('order_column')->nullable()->index();
            }

            if (! $this->hasColumn('disk')) {
                $table->string('disk')->default('public');
            }

            if (! $this->hasColumn('directory')) {
                $table->string('directory')->default('media');
            }

            if (! $this->hasColumn('name')) {
                $table->string('name')->nullable();
            }

            if (! $this->hasColumn('path')) {
                $table->string('path')->nullable();
            }

            if (! $this->hasColumn('width')) {
                $table->unsignedInteger('width')->nullable();
            }

            if (! $this->hasColumn('height')) {
                $table->unsignedInteger('height')->nullable();
            }

            if (! $this->hasColumn('size')) {
                $table->unsignedInteger('size')->nullable();
            }

            if (! $this->hasColumn('type')) {
                $table->string('type')->default('image')->nullable();
            }

            if (! $this->hasColumn('ext')) {
                $table->string('ext')->nullable();
            }

            if (! $this->hasColumn('alt')) {
                $table->string('alt')->nullable();
            }

            if (! $this->hasColumn('title')) {
                $table->string('title')->nullable();
            }

            if (! $this->hasColumn('description')) {
                $table->text('description')->nullable();
            }

            if (! $this->hasColumn('caption')) {
                $table->text('caption')->nullable();
            }

            if (! $this->hasColumn('exif')) {
                $table->text('exif')->nullable();
            }

            if (! $this->hasColumn('curations')) {
                $table->longText('curations')->nullable();
            }
            $this->updateUser($table);
        });
    }
}
