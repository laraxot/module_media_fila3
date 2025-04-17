<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions\Image;

// use Intervention\Image\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Spatie\QueueableAction\QueueableAction;

class Merge
{
    use QueueableAction;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Prepare the action for execution, leveraging constructor injection.
    }

    public function execute(array $filenames, string $filenameOut): void
    {
        $width = 0;
        $height = 0;
        $imgs = [];
        foreach ($filenames as $filename) {
            // $img = Image::make(public_path($filename));
            if (! is_string($filename)) {
                continue;
            }
            $manager = new ImageManager(new Driver);
            $img = $manager->read(public_path($filename));

            $imgs[] = $img;
            $width += $img->width();
            $height = max($height, $img->height());
        }

        if (! is_numeric($height)) {
            throw new \Exception('['.__LINE__.']['.class_basename(self::class).']');
        }
        $height = (int) $height;
        // $img_canvas = Image::canvas($width, $height);

        $manager = new ImageManager(Driver::class);
        $img_canvas = $manager->create($width, $height);

        $delta = 0;
        foreach ($imgs as $img) {
            // $img_canvas->insert($img, 'top-left ', $delta, 0);
            $img_canvas->place($img, 'top-left ', $delta, 0);
            $delta += $img->width();
        }

        $img_canvas->save(public_path().'/'.$filenameOut, 100);
    }
}
