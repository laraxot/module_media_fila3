<?php
/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */
declare(strict_types=1);

namespace Modules\Media\Actions;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class GetVideoScreenshotAction
{
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
    public function __construct()
    {
        // Prepare the action for execution, leveraging constructor injection.
    }

    /**
     * Execute the action.
     */
    public function execute(string $disk_mp4, string $file_mp4, int $time, string $disk_jpg, string $file_jpg = null): array
    {
        if (! Storage::disk($disk_mp4)->exists($file_mp4)) {
            return [
                'message' => 'video not exists',
                'status' => 500,
                'disk_jpg' => $disk_jpg,
                'file_jpg' => 'video_not_exists.jpg',
            ];
        }

        if (null === $file_jpg) {
            $file_jpg = Str::replace('.mp4', '-' . $time, basename($file_mp4));
            $file_jpg = Str::slug($file_jpg) . '.jpg';
        }

        try {
            FFMpeg::fromDisk($disk_mp4)
                ->open($file_mp4)
                ->getFrameFromSeconds($time)
                ->export()
                ->toDisk($disk_jpg)
                ->save($file_jpg);
        } catch (Exception $e) {
            // dddx($e->getMessage());
            return [
                'message' => $e->getMessage(),
                'status' => 500,
                // 'disk_jpg' => $disk_jpg,
                // 'file_jpg' => $file_jpg,
            ];
        }

            return [
                'message' => 'ok',
                'status' => 200,
                'disk_jpg' => $disk_jpg,
                'file_jpg' => $file_jpg,
            ];
    }
}
