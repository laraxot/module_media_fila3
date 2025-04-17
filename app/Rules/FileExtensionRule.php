<?php

declare(strict_types=1);

namespace Modules\Media\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

use function in_array;

class FileExtensionRule implements Rule
{
    protected array $validExtensions = [];

    public function __construct(array $validExtensions = [])
    {
        $this->validExtensions = array_map(
            static fn (string $extension): string => mb_strtolower($extension),
            $validExtensions,
        );
    }

    /**
     * @param  string  $attribute
     * @param  UploadedFile  $value
     */
    public function passes($attribute, $value): bool
    {
        return in_array(
            mb_strtolower($value->getClientOriginalExtension()),
            $this->validExtensions,
            strict: false,
        );
    }

    public function message(): array|string
    {
        return trans(
            'media::validation.mime',
            [
                'mimes' => implode(', ', $this->validExtensions),
            ]
        );
    }
}
