<?php

declare(strict_types=1);

namespace Modules\Media\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Media\Models\Media;

class CreateTemporaryUploadFromDirectS3UploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => "unique:{$this->getDatabaseConnection()}{$this->getMediaTableName()}",
            'key' => 'required',
            'bucket' => 'required',
            'name' => 'required',
            'content_type' => 'required',
            'size' => 'required',
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
