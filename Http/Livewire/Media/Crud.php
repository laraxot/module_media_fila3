<?php

declare(strict_types=1);

namespace Modules\Media\Http\Livewire\Media;

use Livewire\Component;
use Modules\Media\Traits\WithMedia;
use Spatie\MediaLibrary\HasMedia;

class Crud extends Component
{
    use WithMedia;

    public string $name;

    public HasMedia $model;

    /**
     * @var array<string>
     */
    public $mediaComponentNames = ['upload'];

    /**
     * @var array
     */
    public $upload = [];

    public string $collection;
}
