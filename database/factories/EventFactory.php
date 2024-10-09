<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'banner' => $this->faker->text(255),
            'type' => 'Offline',
            'slug' => $this->faker->text(255),
            'description' => $this->faker->text,
            'terms' => $this->faker->text,
            'topic_mix_id' => \App\Models\TopicMix::factory(),
            'format_mix_id' => \App\Models\FormatMix::factory(),
            'city_id' => \App\Models\City::factory(),
            'organizer_id' => \App\Models\Organizer::factory(),
        ];
    }
}
