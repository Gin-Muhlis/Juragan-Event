<?php

namespace Database\Factories;

use App\Models\Organizer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organizer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'icon' => $this->faker->text(255),
        ];
    }
}
