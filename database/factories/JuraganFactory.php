<?php

namespace Database\Factories;

use App\Models\Juragan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JuraganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Juragan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'banner_website' => $this->faker->text(255),
            'address' => $this->faker->text(255),
            'email' => $this->faker->text(255),
            'phone_number' => $this->faker->phoneNumber,
            'copyright_text' => $this->faker->text(255),
            'coordinate' => $this->faker->text(255),
            'logo_website' => $this->faker->text(255),
            'link_fb' => $this->faker->text(255),
            'link_twitter' => $this->faker->text(255),
            'link_instagram' => $this->faker->text(255),
            'link_youtube' => $this->faker->text(255),
            'short_description' => $this->faker->text,
            'long_description' => $this->faker->text,
            'contact_description' => $this->faker->text,
        ];
    }
}
