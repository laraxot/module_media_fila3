<?php

declare(strict_types=1);

namespace Modules\Media\Console\Commands;

use Illuminate\Console\Command;

class DeleteTemporaryUploadsCommand extends Command
{
    protected $signature = 'media-library:delete-old-temporary-uploads';

    protected $description = 'Delete old temporary uploads';

    public function handle(): void
    {
        $this->info('Start removing old temporary uploads...');

        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUploads = $temporaryUploadModelClass::old()->get();

        $temporaryUploads->each->delete();

        $this->comment($temporaryUploads->count() . ' old temporary upload(s) deleted!');
    }
}
