<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TopicMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicMixTest extends TestCase
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
    public function it_gets_topic_mixes_list()
    {
        $topicMixes = TopicMix::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.topic-mixes.index'));

        $response->assertOk()->assertSee($topicMixes[0]->topic);
    }

    /**
     * @test
     */
    public function it_stores_the_topic_mix()
    {
        $data = TopicMix::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.topic-mixes.store'), $data);

        $this->assertDatabaseHas('topic_mixes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $data = [
            'topic' => $this->faker->text,
        ];

        $response = $this->putJson(
            route('api.topic-mixes.update', $topicMix),
            $data
        );

        $data['id'] = $topicMix->id;

        $this->assertDatabaseHas('topic_mixes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $response = $this->deleteJson(
            route('api.topic-mixes.destroy', $topicMix)
        );

        $this->assertModelMissing($topicMix);

        $response->assertNoContent();
    }
}
