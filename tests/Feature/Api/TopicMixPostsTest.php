<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Post;
use App\Models\TopicMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicMixPostsTest extends TestCase
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
    public function it_gets_topic_mix_posts()
    {
        $topicMix = TopicMix::factory()->create();
        $posts = Post::factory()
            ->count(2)
            ->create([
                'topic_mix_id' => $topicMix->id,
            ]);

        $response = $this->getJson(
            route('api.topic-mixes.posts.index', $topicMix)
        );

        $response->assertOk()->assertSee($posts[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_topic_mix_posts()
    {
        $topicMix = TopicMix::factory()->create();
        $data = Post::factory()
            ->make([
                'topic_mix_id' => $topicMix->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.topic-mixes.posts.store', $topicMix),
            $data
        );

        $this->assertDatabaseHas('posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $post = Post::latest('id')->first();

        $this->assertEquals($topicMix->id, $post->topic_mix_id);
    }
}
