<?php
/*
 * https://raw.githubusercontent.com/seregazhuk/reactphp-blog-series/master/http/streaming-refactoring.php.
 */

declare(strict_types=1);

namespace Modules\Media\Services;

use Psr\Http\Message\ServerRequestInterface;
use React\Filesystem\FilesystemInterface;
use React\Filesystem\Stream\ReadableStream;
use React\Http\Response;
use React\Promise\PromiseInterface;

final class VideoStreaming {
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem) {
        $this->filesystem = $filesystem;
    }
    /*
    public function __invoke(ServerRequestInterface $request) {
        return new \React\Http\Message\Response(
            200,
            [
                'Content-Type' => 'text/plain',
            ],
            'Hello World !! '.now()."\n"
        );
    }
    */

    /**
     * @return Response|PromiseInterface
     */
    public function __invoke(ServerRequestInterface $request) {
        $filePath = $this->getFilePath($request);
        $filePath = public_path('videos/test.mp4');

        if (null === $filePath) {
            return new Response(200, ['Content-Type' => 'text/plain'], 'Video streaming server');
        }
        /*
        $file = $this->filesystem->file($filePath);

        dddx($file);
        if (! $file->exists()) {
            return new Response(200, ['Content-Type' => 'text/plain'], '['.$filePath.' not Exists]');
        }
        */
        return $this->makeResponseFromFile($filePath);
    }

    /**
     * @param string $filePath
     *
     * @return PromiseInterface
     */
    private function makeResponseFromFile($filePath) {
        $file = $this->filesystem->file($filePath);

        return $file->exists()->then(
            function () use ($file) {
                return $file->open('r')->then(
                    function (ReadableStream $stream) {
                        return new Response(200, ['Content-Type' => 'video/mp4'], $stream);
                    }
                );
            }, function () {
                return new Response(404, ['Content-Type' => 'text/plain'], "This video doesn't exist on server.");
            });
    }

    /**
     * @return string|null
     */
    private function getFilePath(ServerRequestInterface $request) {
        $file = $request->getQueryParams()['video'] ?? null;

        if (null === $file) {
            return null;
        }

        return __DIR__.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.basename($file);
    }
}
