<?php

declare(strict_types=1);

namespace Modules\Media\Http\Livewire\Media;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property ComponentContainer $form
 */
class CustomProperty extends Component implements HasForms
{
    use InteractsWithForms;

    public string $attributeName;

    public Media $media;

    public function mount(Media $media, string $attributeName = 'description'): void
    {
        $this->media = $media;
        $this->attributeName = $attributeName;
        $value = $this->media->getCustomProperty($attributeName);
        $this->form->fill([
            $this->attributeName => $value,
        ]);
    }

    public function render(): View
    {
        /**
         * @phpstan-var view-string
         */
        // $view = app(GetViewAction::class)->execute();
        $view = 'media::livewire.media.custom-property';

        return view($view);
    }

    /**
     * @return Textarea[]
     *
     * @psalm-return list{Textarea}
     */
    protected function getFormSchema(): array
    {
        return [
            Textarea::make($this->attributeName)
                ->label('')
                // ->reactive()
                ->lazy()
                ->afterStateUpdated(function ($state): void {
                    $this->media->setCustomProperty($this->attributeName, $state);
                    $this->media->save();
                }),
            // ...
        ];
    }
}
