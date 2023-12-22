<?php

declare(strict_types=1);

namespace Themes\Media\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class removeVideoCategoryEmptyCatId extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'videoCategory:removeEmptyCatId';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove record empty category (cat_id == 0).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function handle():bool {
        DB::transaction(function () {
            $status = VideoCat::where('cat_id', 0)->delete();
            echo $status ? 'Success' : 'Fail';
        });
        return true;
    }
}
