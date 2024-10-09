<?php

namespace Database\Factories;

use App\Models\FormatMix;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormatMixFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormatMix::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'format' => $this->faker->text(255),
        ];
    }
}
