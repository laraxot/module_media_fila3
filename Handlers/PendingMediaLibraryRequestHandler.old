<?php

declare(strict_types=1);

namespace Modules\Media\Handlers;

use Illuminate\Support\Collection;
use Modules\Media\Dto\PendingMediaItem;
use Spatie\MediaLibrary\MediaCollections\FileAdderFactory;

class PendingMediaLibraryRequestHandler
{
    protected Collection $mediaLibraryRequestItems;

    protected ?array $processCustomProperties = null;

    protected ?array $customHeaders = null;

    public function toMediaCollection(string $collectionName = 'default', string $diskName = ''): void
    {
        $mediaLibraryRequestHandler = MediaLibraryRequestHandler::createForMediaLibraryRequestItems($this->model, $this->mediaLibraryRequestItems, $collectionName)
            ->updateExistingMedia();

        if (! $this->preserveExisting) {
            $mediaLibraryRequestHandler->deleteObsoleteMedia();
        }
        $mediaLibraryRequestHandler
            ->getPendingMediaItems()
            ->each(
                function (PendingMediaItem $pendingMediaItem) use ($diskName, $collectionName): void {
                    $fileAdder = app(FileAdderFactory::class)->createForPendingMedia($this->model, $pendingMediaItem);

                    if (null !== $this->processCustomProperties) {
                        $fileAdder->withCustomProperties($pendingMediaItem->getCustomProperties($this->processCustomProperties));
                    }

                    if (null !== $this->customHeaders) {
                        $fileAdder = $fileAdder->addCustomHeaders($this->customHeaders);
                    }

                    if (null !== $pendingMediaItem->fileName) {
                        $fileAdder->setFileName($pendingMediaItem->fileName);
                    }

                    $fileAdder->toMediaCollection($collectionName, $diskName);
                });
    }
}
