<?php

namespace Database\Factories;

use App\Models\Galery;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GaleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Galery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caption' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
        ];
    }
}
