<?php

/**
 * Syntax error or access violation: 1118 Row size too large. The maximum row size for the used table type, not counting BLOBs, is 8126. This includes storage overhead, check the manual. You have to change some columns to TEXT or BLOBs (SQL: alter table `places` add `address` text null).
 */

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ----- models -----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateVideosTable.
 */
class CreateMediaLibraryItemsTable extends XotBaseMigration
{
    /**
     * i don't write table name, it take from Model, model is singular of this class wit.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $table): void {
            $table->id();
            // $table->foreignId('uploaded_by_user_id')
            //    ->nullable()
            // ->constrained('users')
            // ->nullOnDelete()
            // ->cascadeOnUpdate()

            $table->foreignUuid('uploaded_by_user_id')->nullable();
            $table->string('caption')->nullable();
            $table->string('alt_text')->nullable();
            $table->integer('order_column')->nullable();
            $this->timestamps($table);
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            if (! $this->hasColumn('order_column')) {
                $table->integer('order_column')->nullable();
            }

            if (! $this->hasColumn('folder_id')) {
                $table->foreignId('folder_id')->nullable()->after('alt_text');
                // ->constrained('filament_media_library_folders');
            }
        });
    }
}
