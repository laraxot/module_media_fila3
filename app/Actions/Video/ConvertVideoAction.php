<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions\Video;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class ConvertVideoAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $disk_mp4, string $file_mp4, string $format): ?string
    {
        if (! Storage::disk($disk_mp4)->exists($file_mp4)) {
            return '';
        }
        $format = new \FFMpeg\Format\Video\WebM;
        $extension = mb_strtolower(class_basename($format));
        $file_new = Str::of($file_mp4)
            ->replaceLast('.mp4', '.'.$extension)
            ->toString();

        /**
         * -preset ultrafast.
         */
        FFMpeg::fromDisk($disk_mp4)
            ->open($file_mp4)
            ->export()
            // ->addFilter(function (VideoFilters $filters) {
            //    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            // })
            // ->resize(640, 480)
            // ->onProgress(function ($percentage, $remaining, $rate) {
            //    echo "{$percentage}% transcoded";
            //    echo "{$remaining} seconds left at rate: {$rate}";
            // });
            // ->addFilter('-preset', 'ultrafast')
            // ->addFilter('-crf', 22)
            ->toDisk($disk_mp4)
            ->inFormat($format)
            ->save($file_new);

        return Storage::disk($disk_mp4)->url($file_new);
    }
}
