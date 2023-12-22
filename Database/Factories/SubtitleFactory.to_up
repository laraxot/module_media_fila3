<?php

declare(strict_types=1);

namespace Modules\Media\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubtitleFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = \Modules\Media\Models\Subtitle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id' => $this->faker->randomNumber(5, false),
            'media_id' => $this->faker->randomNumber(5, false),
            'sentence_i' => $this->faker->randomNumber(5, false),
            'item_i' => $this->faker->randomNumber(5, false),
            'start' => $this->faker->randomFloat(),
            'end' => $this->faker->randomFloat(),
            'time' => $this->faker->time,
            'text' => $this->faker->text,
        ];
    }
}
