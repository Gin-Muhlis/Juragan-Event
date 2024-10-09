<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Event;
use App\Models\FormatMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatMixEventsTest extends TestCase
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
    public function it_gets_format_mix_events()
    {
        $formatMix = FormatMix::factory()->create();
        $events = Event::factory()
            ->count(2)
            ->create([
                'format_mix_id' => $formatMix->id,
            ]);

        $response = $this->getJson(
            route('api.format-mixes.events.index', $formatMix)
        );

        $response->assertOk()->assertSee($events[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_format_mix_events()
    {
        $formatMix = FormatMix::factory()->create();
        $data = Event::factory()
            ->make([
                'format_mix_id' => $formatMix->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.format-mixes.events.store', $formatMix),
            $data
        );

        $this->assertDatabaseHas('events', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $event = Event::latest('id')->first();

        $this->assertEquals($formatMix->id, $event->format_mix_id);
    }
}
