<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Event;
use App\Models\TopicMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicMixEventsTest extends TestCase
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
    public function it_gets_topic_mix_events()
    {
        $topicMix = TopicMix::factory()->create();
        $events = Event::factory()
            ->count(2)
            ->create([
                'topic_mix_id' => $topicMix->id,
            ]);

        $response = $this->getJson(
            route('api.topic-mixes.events.index', $topicMix)
        );

        $response->assertOk()->assertSee($events[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_topic_mix_events()
    {
        $topicMix = TopicMix::factory()->create();
        $data = Event::factory()
            ->make([
                'topic_mix_id' => $topicMix->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.topic-mixes.events.store', $topicMix),
            $data
        );

        $this->assertDatabaseHas('events', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $event = Event::latest('id')->first();

        $this->assertEquals($topicMix->id, $event->topic_mix_id);
    }
}
