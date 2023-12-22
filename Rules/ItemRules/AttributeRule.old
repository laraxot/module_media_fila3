<?php

declare(strict_types=1);

namespace Modules\Media\Rules\ItemRules;

use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;

class AttributeRule extends MediaItemRule
{
    protected array $rules;

    protected Validator $validator;

    public function __construct(public string $attribute, array|string $rules)
    {
        if (is_string($rules)) {
            $rules = explode('|', $rules);
        }

        $this->rules = [$this->shortAttributeName() => $rules];
    }

    public function validateMediaItem(): bool
    {
        $this->validator = ValidatorFacade::make(
            [$this->shortAttributeName() => $this->value],
            $this->rules
        );

        return $this->validator->passes();
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->validator->messages()->first($this->shortAttributeName());
    }

    protected function shortAttributeName(): string
    {
        return str_replace('custom_properties.', '', $this->attribute);
    }
}
