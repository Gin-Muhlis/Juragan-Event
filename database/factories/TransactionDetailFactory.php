<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber,
            'unit_price' => $this->faker->randomNumber(0),
            'total_price' => $this->faker->randomNumber,
            'transaction_headers_id' => \App\Models\TransactionHeaders::factory(),
            'ticket_id' => \App\Models\Ticket::factory(),
        ];
    }
}
