<?php

declare(strict_types=1);

namespace Modules\Media\Dto;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class ViewMediaItem
{
    public function __construct(
        protected string $formFieldName,
        protected array $mediaAttributes
    ) {
    }

    public function customPropertyAttributes(string $name): HtmlString
    {
        return new HtmlString(implode(PHP_EOL, [
            "name='{$this->customPropertyAttributeName($name)}'",
            "value='{$this->customPropertyAttributeValue($name)}'",
        ]));
    }

    public function customPropertyAttributeName(string $name): string
    {
        return "{$this->formFieldName}[{$this->uuid}][custom_properties][{$name}]";
    }

    public function customPropertyAttributeValue(string $name)
    {
        $value = Arr::get($this->mediaAttributes['customProperties'] ?? [], $name);

        return old($this->customPropertyErrorName($name), $value);
    }

    public function customPropertyErrorName(string $name): string
    {
        return "{$this->formFieldName}.{$this->uuid}.custom_properties.{$name}";
    }

    public function __get($name)
    {
        return $this->mediaAttributes[$name] ?? null;
    }
}
