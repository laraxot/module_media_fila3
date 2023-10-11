<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Media\Filament\Resources\MediaResource\Pages;
use Modules\Media\Models\Media;

// use Modules\Camping\Constants\AttachmentType;
// use Modules\Camping\Filament\Resources\AssetResource\Actions\AttachmentDownloadBulkAction;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form, bool $asset = true): Form
    {
        return $form
            ->schema(
                static::getFormSchema($asset)
            );
    }

    public static function getFormSchema(bool $asset = true): array
    {
        return [
            FileUpload::make('file')
                ->translateLabel()
                ->label('camping::forms.attachments.fields.file.field_name')
                ->hint(
                    trans('camping::forms.attachments.fields.file.hint'),
                )
                ->storeFileNamesIn('original_file_name')
                ->disk(
                    $asset ? config('camping.asset.attachments.disk.driver') : config('camping.operation.attachments.disk.driver'),
                )
                ->acceptedFileTypes(
                    $asset ? config('camping.asset.attachments.allowed_file_types') : config('camping.operation.attachments.allowed_file_types'),
                )
                ->visibility('private')
                ->maxSize(
                    config('media-library.max_file_size'),
                )
                ->required()
                ->columnSpanFull(),

            Radio::make('attachment_type')
                ->hiddenLabel()
                ->options(
                    AttachmentType::descriptionsByValue($asset ? AttachmentType::cases() : AttachmentType::operationCases()),
                )
                ->default(AttachmentType::Image())
                ->columns(
                    $asset ? count(AttachmentType::cases()) : count(AttachmentType::operationCases()),
                )
                ->required()
                ->columnSpanFull(),

            TextInput::make('name')
                ->translateLabel()
                ->label('camping::forms.attachments.fields.name.field_name')
                ->hint(
                    trans('camping::forms.attachments.fields.name.hint'),
                )
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('collection_name')
                    ->translateLabel()
                    ->label('camping::tables.attachments.collection_name'),

                TextColumn::make('name')
                    ->translateLabel()
                    ->label('camping::tables.attachments.filename'),

                TextColumn::make('human_readable_size')
                    ->translateLabel()
                    ->label('camping::tables.attachments.size'),

                TextColumn::make('creator.name')
                    ->translateLabel()
                    ->label('camping::tables.attachments.creator')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->translateLabel()
                    ->label('camping::tables.attachments.uploaded_at')
                    ->dateTime()
                    ->toggleable(),
            ])
            ->filters([
            ])
            ->actions([
                // ActionGroup::make([
                Action::make('view_attachment')
                    // ->translateLabel()
                    // ->label('camping::actions.view.labels.main_label')
                    ->label('')
                    ->icon('heroicon-s-eye')
                    ->color('gray')
                    ->url(
                        fn ($record): string => $record->getUrl()
                    )->openUrlInNewTab(true),
                DeleteAction::make()->label('')->requiresConfirmation(),
                Action::make('download_attachment')
                    // ->translateLabel()
                    // ->label('camping::actions.download.labels.main_label')
                    ->label('')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(
                        fn ($record) => response()->download($record->getPath(), $record->file_name)
                    ),
                // ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                // AttachmentDownloadBulkAction::make(),
            ])
            ->defaultSort(
                column: 'created_at',
                direction: 'DESC',
            );
    }

    public static function formHandlerCallback(RelationManager $livewire, array $data): void
    {
        $disk = config('attachment.upload.disk.driver');

        $attachment = $livewire
            ->getOwnerRecord()
            ->addMediaFromDisk(
                $data['file'],
                $disk,
            )
            ->setName(
                $data['name'] ?? Str::beforeLast($data['original_file_name'], '.'),
            )
            ->preservingOriginal()
            ->toMediaCollection($data['attachment_type']);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}