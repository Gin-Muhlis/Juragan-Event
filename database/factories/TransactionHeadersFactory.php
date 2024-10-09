<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransactionHeaders;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHeadersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionHeaders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transaction_date' => $this->faker->date,
            'no_transaction' => $this->faker->unique->randomNumber,
            'total_transaction' => $this->faker->randomNumber,
            'status' => 'menunggu pembayaran',
            'proof_of_payment' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
            'event_id' => \App\Models\Event::factory(),
            'payment_id' => \App\Models\Payment::factory(),
        ];
    }
}
