<?php

declare(strict_types=1);

namespace Modules\Media\View\Components\Media;

use Illuminate\View\Component;
use Modules\Media\Traits\WithAccessingMedia;
use Spatie\MediaLibrary\HasMedia;

class Index extends Component
{
    use WithAccessingMedia;

    public string $collection;

    public array $media;

    public ?string $listView;

    public ?string $itemView;

    public ?string $propertiesView;

    public ?string $fieldsView;

    public function __construct(
        public string $name,
        public HasMedia $hasMedia,
        string $collection = null,
        public string $rules = '',
        public ?int $maxItems = null,
        public bool $sortable = true,
        public bool $editableName = true,
        public ?string $componentView = null,
        string $listView = null,
        string $itemView = null,
        string $propertiesView = null,
        string $fieldsView = null,
        public bool $multiple = true
    ) {
        $this->collection = $collection ?? 'default';

        $this->media = $this->getMedia($name, $hasMedia, $this->collection);
        $this->listView = $listView ?? 'media::livewire.partials.collection.list';
        $this->itemView = $itemView ?? 'media::livewire.partials.collection.item';
        $this->propertiesView = $propertiesView ?? 'media::livewire.partials.collection.properties';
        $this->fieldsView = $fieldsView ?? 'media::livewire.partials.collection.fields';
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('media::components.media.index');
    }
}
