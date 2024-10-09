<?php

namespace Database\Factories;

use App\Models\Refund;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Refund::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'reason' => $this->faker->text,
            'transaction_headers_id' => \App\Models\TransactionHeaders::factory(),
        ];
    }
}
