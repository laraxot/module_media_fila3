<?php
/**
 * https://protone.media/en/blog/how-to-use-ffmpeg-in-your-laravel-projects
 * $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
 *  $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');.
 */

declare(strict_types=1);

namespace Modules\Media\Jobs;

use Carbon\Carbon;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Media\Models\Video;

class ConvertVideoForStreaming implements ShouldQueue {
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public Video $video;

    public function __construct(Video $video) {
        $this->video = $video;
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function handle() {
        // create some video formats...
        $lowBitrateFormat = (new X264())->setKiloBitrate(500);
        $midBitrateFormat = (new X264())->setKiloBitrate(1500);
        $highBitrateFormat = (new X264())->setKiloBitrate(3000);

        // open the uploaded video from the right disk...
        FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path)

        // call the 'exportForHLS' method and specify the disk to which we want to export...
            ->exportForHLS()
            ->toDisk('streamable_videos')

        // we'll add different formats so the stream will play smoothly
        // with all kinds of internet connections...
            ->addFormat($lowBitrateFormat)
            ->addFormat($midBitrateFormat)
            ->addFormat($highBitrateFormat)

        // call the 'save' method with a filename...
            ->save($this->video->id.'.m3u8');

        // update the database so we know the convertion is done!
        $this->video->update([
            'converted_for_streaming_at' => Carbon::now(),
        ]);
    }
}
