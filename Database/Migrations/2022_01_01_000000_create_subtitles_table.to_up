<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ---- models ---

use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateInvitationsTable.
 */
class CreateSubtitlesTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('press_id')->nullable();
                $table->integer('sentence_i')->nullable();
                $table->integer('item_i')->nullable();
                $table->decimal('start', 10, 3)->nullable();
                $table->decimal('end', 10, 3)->nullable();
                $table->string('time')->nullable();
                $table->string('text')->nullable();

                $table->timestamps();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('channel_id')) { //+"source": "Internazionali" +"channel": "BBCnews"
                //    $table->integer('channel_id')->nullable();
                // }
            }
        );
    }
}
