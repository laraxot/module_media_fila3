<?php

declare(strict_types=1);

namespace Modules\Media\Http\Livewire\Concerns;

use Livewire\Component;

/** @mixin Component */
trait WithMedia
{
    public function getMediaComponentNames(): array
    {
        return $this->mediaComponentNames ?? [];
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

    public function onMediaChanged($name, $media): void
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

    public function clearMedia($mediaComponentNames = null): void
    {
        if (is_null($mediaComponentNames)) {
            $mediaComponentNames = $this->getMediaComponentNames();
        }

        if (is_string($mediaComponentNames)) {
            $mediaComponentNames = [$mediaComponentNames];
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
