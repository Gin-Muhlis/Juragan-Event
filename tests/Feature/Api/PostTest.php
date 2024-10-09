<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Post;

use App\Models\TopicMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_posts_list()
    {
        $posts = Post::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.posts.index'));

        $response->assertOk()->assertSee($posts[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_post()
    {
        $data = Post::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.posts.store'), $data);

        $this->assertDatabaseHas('posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_post()
    {
        $post = Post::factory()->create();

        $user = User::factory()->create();
        $topicMix = TopicMix::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'brief-description' => $this->faker->text(255),
            'image' => $this->faker->text(255),
            'content' => $this->faker->text,
            'user_id' => $user->id,
            'topic_mix_id' => $topicMix->id,
        ];

        $response = $this->putJson(route('api.posts.update', $post), $data);

        $data['id'] = $post->id;

        $this->assertDatabaseHas('posts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson(route('api.posts.destroy', $post));

        $this->assertModelMissing($post);

        $response->assertNoContent();
    }
}
