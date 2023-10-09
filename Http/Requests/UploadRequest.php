<?php

declare(strict_types=1);

namespace Modules\Media\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Media\Models\Media;
use Modules\Media\Rules\FileExtensionRule;
use Modules\Media\Support\DefaultAllowedExtensions;

class UploadRequest extends FormRequest
{
    public function rules(): array
    {
        $configuredAllowedExtensions = config('media-library.temporary_uploads_allowed_extensions');

        $allowedExtensions = $configuredAllowedExtensions ?? DefaultAllowedExtensions::all();

        $allowedExtensionsString = implode(',', $allowedExtensions);

        return [
            'uuid' => "unique:{$this->getDatabaseConnection()}{$this->getMediaTableName()}",
            'name' => '',
            'custom_properties' => '',
            'file' => [
                'max:' . config('media-library.max_file_size') / 1024,
                'mimes:' . $allowedExtensionsString,
                new FileExtensionRule($allowedExtensions),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.unique' => trans('medialibrary-pro::upload_request.uuid_not_unique'),
        ];
    }

    protected function getDatabaseConnection(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        if ('default' === $mediaModel->getConnectionName()) {
            return '';
        }

        return "{$mediaModel->getConnectionName()}.";
    }

    protected function getMediaTableName(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        return $mediaModel->getTable();
    }
}
