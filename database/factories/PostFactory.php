<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->text(10),
            'image' => $this->faker->text(255),
            'content' => $this->faker->text,
            'user_id' => \App\Models\User::factory(),
            'topic_mix_id' => \App\Models\TopicMix::factory(),
        ];
    }
}
