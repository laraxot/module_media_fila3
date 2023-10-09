<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions;

use Modules\Media\Models\Media;
use Modules\Media\Models\TemporaryUpload;
use Spatie\MediaLibrary\HasMedia;
use Spatie\QueueableAction\QueueableAction;

class AttachMediaAction
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

    /**
     * Execute the action.
     */
    public function execute(HasMedia $hasMedia, array $attachments, string $collection = null): void
    {
        $order = 1;
        foreach ($attachments as $attachment) {
            $order++;
            $temporaryUpload = TemporaryUpload::findByMediaUuidInCurrentSession($attachment['uuid']);

            if ($temporaryUpload instanceof TemporaryUpload) {
                // $media = $temporaryUpload->getFirstMedia();
                $media = $temporaryUpload->moveMedia($hasMedia, $collection, '', $attachment['fileName']);
                // dddx($res);
                // $media->move($this->model, $this->collection);
            } else {
                $media = Media::findByUuid($attachment['uuid']);
                // $media->update(['order_column'=>$order]);
                // dddx(['media'=>$media,'order'=>$order]);
            }

            $media?->update(['order_column' => $order, 'custom_properties' => $attachment['custom_properties'] ?? []]);
        }
    }
}
