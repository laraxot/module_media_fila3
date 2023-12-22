<?php

declare(strict_types=1);

namespace Modules\Media\Rules\GroupRules;

use Illuminate\Contracts\Validation\Rule;

class MinItemsRule implements Rule
{
    public function __construct(protected int $minItemCount)
    {
    }

    public function passes($attribute, $value): bool
    {
        return (is_countable($value) ? count($value) : 0) >= $this->minItemCount;
    }

    /**
     * @return string
     */
    public function message()
    {
        return trans_choice('media::validation.min_items', $this->minItemCount, [
            'min' => $this->minItemCount,
        ]);
    }
}
