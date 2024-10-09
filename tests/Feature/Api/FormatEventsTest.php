<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Event;
use App\Models\Format;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatEventsTest extends TestCase
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
    public function it_gets_format_events()
    {
        $format = Format::factory()->create();
        $events = Event::factory()
            ->count(2)
            ->create([
                'format_id' => $format->id,
            ]);

        $response = $this->getJson(route('api.formats.events.index', $format));

        $response->assertOk()->assertSee($events[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_format_events()
    {
        $format = Format::factory()->create();
        $data = Event::factory()
            ->make([
                'format_id' => $format->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.formats.events.store', $format),
            $data
        );

        $this->assertDatabaseHas('events', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $event = Event::latest('id')->first();

        $this->assertEquals($format->id, $event->format_id);
    }
}
