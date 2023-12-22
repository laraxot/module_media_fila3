<?php

declare(strict_types=1);

namespace Themes\Media\Console\Commands;

use Illuminate\Console\Command;

class removeVideoNotExitVideoCategory extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'videoCategory:removeVideoNotExis';

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
        \DB::transaction(function () {
            $videos = Video::lists('string_id');
            $videoCatNotExits = VideoCat::whereNotIn('video_id', $videos)->delete();
            echo $videoCatNotExits ? 'Success' : 'Fail';
        });
        return true;
    }
}
