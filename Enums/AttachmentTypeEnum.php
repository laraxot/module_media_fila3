<?php

declare(strict_types=1);

namespace Modules\Media\Enums;

use Datomatic\LaravelEnumHelper\LaravelEnumHelper;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;

enum AttachmentTypeEnum: string implements HasLabel
{
    use LaravelEnumHelper;

    case IMAGE = 'image';
    case VIDEO = 'video';
    case DOCUMENT = 'document';
    case MANUAL = 'manual';

    public function getTypeNote(): ?string
    {
        $translationKey = sprintf('media::attachments.type_notes.%s', $this->value);
        if (Lang::has($translationKey)) {
            return trans($translationKey);
        }

        return null;
    }

    public static function getTypeNoteDescriptionsByValues(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                static fn (self $case): array => [$case->value => $case->getTypeNote()],
            )
            ->toArray();
    }

    protected static function translateBaseUniquePath(): string
    {
        return 'media::attachments.types';
    }

    public function getLabel(): ?string
    {
        return trans('media::attachments.types.'.$this->value);
    }

    public static function operationCases(): ?array
    {
        $originalCases = self::cases();
        array_pop($originalCases);

        return $originalCases;
    }
}
