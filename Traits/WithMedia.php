<?php

declare(strict_types=1);

namespace Modules\Media\Traits;

use Livewire\Component;

/** @mixin Component */
trait WithMedia
{
    /**
     * @return string[]
     *
     * @psalm-return array<string>
     */
    public function getMediaComponentNames(): array
    {
        // return $this->mediaComponentNames ?? []; // on left side of ?? is not nullable.
        return $this->mediaComponentNames;
    }

    public function mountWithMedia(): void
    {
        foreach ($this->getMediaComponentNames() as $mediaComponentName) {
            $this->$mediaComponentName = null;
        }
    }

    public function hydrateWithMedia(): void
    {
        foreach ($this->getMediaComponentNames() as $mediaComponentName) {
            $this->listeners[sprintf('%s:mediaChanged', $mediaComponentName)] = 'onMediaChanged';
        }
    }

    public function onMediaChanged(string $name, array $media): void
    {
        $media = $this->makeSureCustomPropertiesUseRightCasing($media);

        $this->$name = $media;
    }

    public function renderingWithMedia(): void
    {
        $errorBag = $this->getErrorBag();

        foreach ($this->getMediaComponentNames() as $mediaComponentName) {
            $this->dispatch(sprintf('%s:mediaComponentValidationErrors', $mediaComponentName), $mediaComponentName, $errorBag->toArray());
        }
    }

    /**
     * @param  array|null  $mediaComponentNames
     */
    public function clearMedia($mediaComponentNames = null): void
    {
        if ($mediaComponentNames === null) {
            $mediaComponentNames = $this->getMediaComponentNames();
        }

        foreach ($mediaComponentNames as $mediumComponentName) {
            $this->dispatch(sprintf('%s:clearMedia', $mediumComponentName), $mediumComponentName);

            $this->{$mediumComponentName} = [];
        }
    }

    protected function makeSureCustomPropertiesUseRightCasing(array $media): array
    {
        return collect($media)
            ->map(function (array $mediaItemAttributes): array {
                if (! isset($mediaItemAttributes['custom_properties']) && isset($mediaItemAttributes['customProperties'])) {
                    $mediaItemAttributes['custom_properties'] = $mediaItemAttributes['customProperties'];
                    unset($mediaItemAttributes['customProperties']);
                }

                return $mediaItemAttributes;
            })
            ->toArray();
    }
}
