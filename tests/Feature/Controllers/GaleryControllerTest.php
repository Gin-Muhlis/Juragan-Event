<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Galery;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GaleryControllerTest extends TestCase
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
    public function it_displays_index_view_with_galeries()
    {
        $galeries = Galery::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('galeries.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.galeries.index')
            ->assertViewHas('galeries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_galery()
    {
        $response = $this->get(route('galeries.create'));

        $response->assertOk()->assertViewIs('admin.app.galeries.create');
    }

    /**
     * @test
     */
    public function it_stores_the_galery()
    {
        $data = Galery::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('galeries.store'), $data);

        $this->assertDatabaseHas('galeries', $data);

        $galery = Galery::latest('id')->first();

        $response->assertRedirect(route('galeries.edit', $galery));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_galery()
    {
        $galery = Galery::factory()->create();

        $response = $this->get(route('galeries.show', $galery));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.galeries.show')
            ->assertViewHas('galery');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_galery()
    {
        $galery = Galery::factory()->create();

        $response = $this->get(route('galeries.edit', $galery));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.galeries.edit')
            ->assertViewHas('galery');
    }

    /**
     * @test
     */
    public function it_updates_the_galery()
    {
        $galery = Galery::factory()->create();

        $data = [
            'caption' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('galeries.update', $galery), $data);

        $data['id'] = $galery->id;

        $this->assertDatabaseHas('galeries', $data);

        $response->assertRedirect(route('galeries.edit', $galery));
    }

    /**
     * @test
     */
    public function it_deletes_the_galery()
    {
        $galery = Galery::factory()->create();

        $response = $this->delete(route('galeries.destroy', $galery));

        $response->assertRedirect(route('galeries.index'));

        $this->assertModelMissing($galery);
    }
}
