<?php
/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */
declare(strict_types=1);

namespace Modules\Media\Actions;

use FFMpeg\Filters\Video\VideoFilters;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class GetVideoResizedAction {
    use QueueableAction;

    /**
     * The number of seconds to wait before retrying the action.
     *
     * @var array<int>|int
     */
    public $backoff = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct() {
        // Prepare the action for execution, leveraging constructor injection.
    }

    /**
     * Execute the action.
     */
    public function execute(string $from_disk, string $from_file, int $width, int $height, string $to_disk, string $to_file): array {
        
        FFMpeg::fromDisk($from_disk)
            ->open($from_file)
            ->addFilter(function (VideoFilters $filters) use($width,$height) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension($width, $height));
            })
            ->export()
            ->toDisk($to_disk)
            // ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save($to_file);

        return [
            'message' => 'ok',
            'status' => 200,
            'to_disk' => $to_disk,
            'to_file' => $to_file,
        ];
    }
}
