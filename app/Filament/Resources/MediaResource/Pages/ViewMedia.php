<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Infolists\Infolist;
use Filament\Actions\DeleteAction;
use Modules\Media\Datas\ConvertData;
use Filament\Infolists\Components\Split;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Modules\Media\Filament\Infolists\VideoEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;

class ViewMedia extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
{
    protected static string $resource = MediaResource::class;

    public function getInfolistSchema(): array
    {
        return [
            Split::make([
                Section::make()->schema([
                    ImageEntry::make('url')
                        ->defaultImageUrl(fn ($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn ($record): bool => $record->type === 'image'),

                    VideoEntry::make('url')
                        ->defaultImageUrl(fn ($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn ($record): bool => $record->type === 'video'),
                ]),
                Section::make()->schema([
                    Actions::make([
                        Action::make('convert')
                            ->tooltip('convert')
                            ->icon('heroicon-o-scale')
                            ->form(MediaConvertResource::getFormSchema())
                            ->action(function ($record, array $data): void {
                                $data['disk'] = $record->disk;
                                $data['file'] = $record->id.'/'.$record->file_name;
                                $convert_data = ConvertData::from($data);
                                $record->mediaConverts()->create($convert_data->toArray());
                            }),
                    ]),
                    TextEntry::make('name'),
                    TextEntry::make('collection_name'),
                    TextEntry::make('mime_type'),
                    TextEntry::make('human_readable_size'),
                    TextEntry::make('created_at'),
                ])
            ]),
            
            RepeatableEntry::make('entry_conversions')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('src'),
                    ImageEntry::make('src'),
                ])
                ->columns(4)
        ];
    }

    /**
     * @return DeleteAction[]
     *
     * @psalm-return list{DeleteAction}
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ConvertWidget::make(['record' => $this->record]),
        ];
    }
}
