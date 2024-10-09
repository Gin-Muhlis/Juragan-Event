<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AddressEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->text,
            'longitude' => $this->faker->text(255),
            'latitutde' => $this->faker->text(255),
            'event_id' => \App\Models\Event::factory(),
        ];
    }
}
