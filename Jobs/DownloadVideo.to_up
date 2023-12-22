<?php
/**
 * https://mayahi.net/laravel/queues-in-laravel-building-a-video-downloader-website/.
 */

declare(strict_types=1);

namespace Modules\Media\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Media\Models\Video;
use Symfony\Component\Process\Process;
use Throwable;

class DownloadVideo implements ShouldQueue {
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var Video
     */
    private $video;

    /**
     * Create a new job instance.
     */
    public function __construct(Video $video) {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     *
     * @return void
     */
    public function handle() {
        $process = new Process([
            'youtube-dl',
            $this->video->url,
            '-o',
            storage_path('app/public/videos/%(title)s.%(ext)s'), '--print-json',
        ]);

        try {
            $process->mustRun();

            $output = json_decode($process->getOutput(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                /*
                switch (json_last_error()) {
                    case JSON_ERROR_NONE:
                        echo ' - No errors';
                    break;
                    case JSON_ERROR_DEPTH:
                        echo ' - Maximum stack depth exceeded';
                    break;
                    case JSON_ERROR_STATE_MISMATCH:
                        echo ' - Underflow or the modes mismatch';
                    break;
                    case JSON_ERROR_CTRL_CHAR:
                        echo ' - Unexpected control character found';
                    break;
                    case JSON_ERROR_SYNTAX:
                        echo ' - Syntax error, malformed JSON';
                    break;
                    case JSON_ERROR_UTF8:
                        echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
                    default:
                        echo ' - Unknown error';
                    break;
                }
                */
                $this->video->status = 'failed';
            } else {
                $this->video->status = 'completed';
                $this->video->info = $output;

                $this->video->save();
            }
        } catch (Throwable $exception) {
            $this->video->status = 'failed';
            $this->video->save();
            logger(sprintf('Could not download video id %d with url %s', $this->video->id, $this->video->url));

            dddx($exception);
        }
    }
}
