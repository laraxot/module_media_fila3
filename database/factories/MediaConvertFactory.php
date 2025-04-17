<?php

declare(strict_types=1);

namespace Modules\Media\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Media\Models\MediaConvert>
 */
class MediaConvertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Media\Models\MediaConvert::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
