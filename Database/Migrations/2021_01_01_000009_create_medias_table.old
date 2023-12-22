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
     *
     * @return void
     */
    public function up()
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->morphs('model');
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
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('url')) {
                //    $table->string('url')->nullable();
                // }
                if (! $this->hasColumn('user_id')) {
                    $table->integer('user_id');
                }
                if (! $this->hasColumn('order_column')) {
                    $table->unsignedInteger('order_column')->nullable()->index();
                }
                /*
                if(!$this->hasColumn('time_from')){
                    $table->decimal('time_from',10,3);
                    $table->decimal('time_to',10,3);
                }
                */
            }
        );
    }
}
