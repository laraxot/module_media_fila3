<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Forms\Components\BaseFileUpload;
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
// use Modules\Camping\Filament\Resources\AssetResource\Actions\AttachmentDownloadBulkAction;
use Modules\Media\Enums\AttachmentTypeEnum;
use Webmozart\Assert\Assert;

class AttachmentResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form, bool $asset = true): Form
    {
        return $form
            ->schema(
                self::getFormSchema($asset)
            );
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

                TextColumn::make('creator.full_name')
                    ->translateLabel()
                    ->label('camping::tables.attachments.creator')
                    // ->default(fn($record)=>dddx($record))
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->translateLabel()
                    ->label('camping::tables.attachments.uploaded_at')
                    ->dateTime('d M, Y H:i:s')
                    ->toggleable(),
            ])
            ->filters([
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view_attachment')
                        ->translateLabel()
                        ->label('camping::actions.view.labels.main_label')
                        ->icon('heroicon-s-eye')
                        ->color('gray')
                        ->url(
                            static fn ($record): string => $record->getUrl()
                        )->openUrlInNewTab(true),
                    DeleteAction::make()->requiresConfirmation(),
                    Action::make('download_attachment')
                        ->translateLabel()
                        ->label('camping::actions.download.labels.main_label')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('primary')
                        ->action(
                            // File extension obtained by substringing
                            static fn ($record) => response()->download($record->getPath(), $record->name.substr((string) strrchr((string) $record->file_name, '.'), 0))
                        ),
                ]),
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

    /**
     * @return (Radio|TextInput|BaseFileUpload|FileUpload)[]
     */
    public static function getFormSchema(bool $asset = true): array
    {
        Assert::string($disk = $asset ? config('camping.asset.attachments.disk.driver') : config('camping.operation.attachments.disk.driver'));
        Assert::isArray($file_types = $asset ? config('camping.asset.attachments.allowed_file_types') : config('camping.operation.attachments.allowed_file_types'));
        Assert::integer($max_size = config('media-library.max_file_size'));

        return [
            FileUpload::make('file')
                ->translateLabel()
                ->label('camping::forms.attachments.fields.file.field_name')
                ->hint(
                    trans('camping::forms.attachments.fields.file.hint'),
                )
                ->storeFileNamesIn('original_file_name')
                ->disk($disk)
                ->acceptedFileTypes($file_types)
                ->visibility('private')
                ->maxSize($max_size)
                ->required()
                ->columnSpanFull(),
            /*
            Radio::make('attachment_type')
                ->hiddenLabel()
                ->options(
                    AttachmentTypeEnum::descriptionsByValue($asset ? AttachmentTypeEnum::cases() : AttachmentTypeEnum::operationCases()),
                )
                ->default(AttachmentTypeEnum::Image())
                ->columns(
                    $asset ? \count(AttachmentTypeEnum::cases()) : \count(AttachmentTypeEnum::operationCases()),
                )
                ->required()
                ->columnSpanFull(),
            */
            // Radio::make('attachment_type')->columnSpanFull(),
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

    public static function formHandlerCallback(RelationManager $livewire, array $data): void
    {
        $ownerRecord = $livewire->getOwnerRecord();
        $mediaCollection = $data['attachment_type'] ?? 'default';
        // $mediaCollection = 'default';

        if (! method_exists($ownerRecord, 'addMediaFromDisk')) {
            throw new \Exception('wip');
        }

        $attachment = $ownerRecord
            ->addMediaFromDisk(
                $data['file'],
                config('attachment.upload.disk.driver'),
            )
            ->setName(
                $data['name'] ?? Str::beforeLast($data['original_file_name'], '.'),
            )
            ->preservingOriginal()
            ->toMediaCollection($mediaCollection);

        $user_id = Filament::auth()->id();
        $attachment->update([
            'created_by' => $user_id,
            'updated_by' => $user_id,
        ]);
        /*
        $attachment->created_by=$user_id;
        $attachment->created_by=$user_id;
        $attachment->save();
        */
    }
}
