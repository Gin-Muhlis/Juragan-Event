<?php

namespace Database\Factories;

use App\Models\Visitors;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->randomNumber,
            'ip_address' => $this->faker->text(255),
        ];
    }
}
