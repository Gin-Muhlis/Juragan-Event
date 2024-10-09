<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber,
            'quota' => $this->faker->randomNumber(0),
            'star_sale_at' => $this->faker->dateTime,
            'end_sale_at' => $this->faker->dateTime,
            'type' => 'berbayar',
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'fee_admin' => $this->faker->randomNumber(1),
            'tax_coast' => $this->faker->randomNumber(1),
            'event_id' => \App\Models\Event::factory(),
        ];
    }
}
