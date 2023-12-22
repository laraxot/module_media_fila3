<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ---- models ---

use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateInvitationsTable.
 */
class CreateTemporaryUploadsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->uuid('id')->primary();
                $table->string('session_id');
                $table->timestamps();
            }
        );
    }
}
