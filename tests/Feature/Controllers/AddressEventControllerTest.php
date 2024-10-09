<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AddressEvent;

use App\Models\Event;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressEventControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_address_events()
    {
        $addressEvents = AddressEvent::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('address-events.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.address_events.index')
            ->assertViewHas('addressEvents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_address_event()
    {
        $response = $this->get(route('address-events.create'));

        $response->assertOk()->assertViewIs('admin.app.address_events.create');
    }

    /**
     * @test
     */
    public function it_stores_the_address_event()
    {
        $data = AddressEvent::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('address-events.store'), $data);

        $this->assertDatabaseHas('address_events', $data);

        $addressEvent = AddressEvent::latest('id')->first();

        $response->assertRedirect(route('address-events.edit', $addressEvent));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_address_event()
    {
        $addressEvent = AddressEvent::factory()->create();

        $response = $this->get(route('address-events.show', $addressEvent));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.address_events.show')
            ->assertViewHas('addressEvent');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_address_event()
    {
        $addressEvent = AddressEvent::factory()->create();

        $response = $this->get(route('address-events.edit', $addressEvent));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.address_events.edit')
            ->assertViewHas('addressEvent');
    }

    /**
     * @test
     */
    public function it_updates_the_address_event()
    {
        $addressEvent = AddressEvent::factory()->create();

        $event = Event::factory()->create();

        $data = [
            'address' => $this->faker->text,
            'longitude' => $this->faker->randomNumber(1),
            'latitutde' => $this->faker->randomNumber(1),
            'event_id' => $event->id,
        ];

        $response = $this->put(
            route('address-events.update', $addressEvent),
            $data
        );

        $data['id'] = $addressEvent->id;

        $this->assertDatabaseHas('address_events', $data);

        $response->assertRedirect(route('address-events.edit', $addressEvent));
    }

    /**
     * @test
     */
    public function it_deletes_the_address_event()
    {
        $addressEvent = AddressEvent::factory()->create();

        $response = $this->delete(
            route('address-events.destroy', $addressEvent)
        );

        $response->assertRedirect(route('address-events.index'));

        $this->assertModelMissing($addressEvent);
    }
}
