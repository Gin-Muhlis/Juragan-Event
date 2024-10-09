<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\City;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityControllerTest extends TestCase
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
    public function it_displays_index_view_with_cities()
    {
        $cities = City::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('cities.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.cities.index')
            ->assertViewHas('cities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_city()
    {
        $response = $this->get(route('cities.create'));

        $response->assertOk()->assertViewIs('admin.app.cities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_city()
    {
        $data = City::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('cities.store'), $data);

        $this->assertDatabaseHas('cities', $data);

        $city = City::latest('id')->first();

        $response->assertRedirect(route('cities.edit', $city));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_city()
    {
        $city = City::factory()->create();

        $response = $this->get(route('cities.show', $city));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.cities.show')
            ->assertViewHas('city');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_city()
    {
        $city = City::factory()->create();

        $response = $this->get(route('cities.edit', $city));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.cities.edit')
            ->assertViewHas('city');
    }

    /**
     * @test
     */
    public function it_updates_the_city()
    {
        $city = City::factory()->create();

        $data = [
            'city_name' => $this->faker->text,
        ];

        $response = $this->put(route('cities.update', $city), $data);

        $data['id'] = $city->id;

        $this->assertDatabaseHas('cities', $data);

        $response->assertRedirect(route('cities.edit', $city));
    }

    /**
     * @test
     */
    public function it_deletes_the_city()
    {
        $city = City::factory()->create();

        $response = $this->delete(route('cities.destroy', $city));

        $response->assertRedirect(route('cities.index'));

        $this->assertModelMissing($city);
    }
}
