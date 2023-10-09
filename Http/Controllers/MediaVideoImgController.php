<?php

declare(strict_types=1);

namespace Modules\Media\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\Media\Actions\GetVideoFrameContentAction;
use Psr\Http\Message\ResponseInterface;

class MediaVideoImgController extends Controller
{
    /**
     * @return ResponseInterface
     */
    public function getSecond(int $second)
    {
        $disk = 'cache';
        $file = 'test.mp4';
        $cache_key = Str::slug($disk . '-' . $file . '-' . $second);
        $bin = Cache::rememberForever($cache_key, fn () => app(GetVideoFrameContentAction::class)->execute($disk, $file, $second));
        /*
        $res = Response::make(Image::cache(function ($image) use ($binaryImageContent) {
            $image = $image->make($binaryImageContent);
        }, 10))->header('Content-Type', 'image/jpeg');

        return $res;
        */
        // return Image::make($binaryImageContent)->stream('jpg', 60);

        return Image::make($bin)->psrResponse('jpg', 60);
    }
}
