<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Juragan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JuraganControllerTest extends TestCase
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
    public function it_displays_index_view_with_juragans()
    {
        $juragans = Juragan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('juragans.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.juragans.index')
            ->assertViewHas('juragans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_juragan()
    {
        $response = $this->get(route('juragans.create'));

        $response->assertOk()->assertViewIs('admin.app.juragans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_juragan()
    {
        $data = Juragan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('juragans.store'), $data);

        $this->assertDatabaseHas('juragans', $data);

        $juragan = Juragan::latest('id')->first();

        $response->assertRedirect(route('juragans.edit', $juragan));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_juragan()
    {
        $juragan = Juragan::factory()->create();

        $response = $this->get(route('juragans.show', $juragan));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.juragans.show')
            ->assertViewHas('juragan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_juragan()
    {
        $juragan = Juragan::factory()->create();

        $response = $this->get(route('juragans.edit', $juragan));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.juragans.edit')
            ->assertViewHas('juragan');
    }

    /**
     * @test
     */
    public function it_updates_the_juragan()
    {
        $juragan = Juragan::factory()->create();

        $data = [
            'banner_website' => $this->faker->text(255),
            'address' => $this->faker->text(255),
            'email' => $this->faker->text(255),
            'phone_number' => $this->faker->phoneNumber,
            'latitude' => $this->faker->text(255),
            'longitude' => $this->faker->text(255),
            'short_description' => $this->faker->text,
            'long_description' => $this->faker->text,
            'contact_description' => $this->faker->text,
        ];

        $response = $this->put(route('juragans.update', $juragan), $data);

        $data['id'] = $juragan->id;

        $this->assertDatabaseHas('juragans', $data);

        $response->assertRedirect(route('juragans.edit', $juragan));
    }

    /**
     * @test
     */
    public function it_deletes_the_juragan()
    {
        $juragan = Juragan::factory()->create();

        $response = $this->delete(route('juragans.destroy', $juragan));

        $response->assertRedirect(route('juragans.index'));

        $this->assertModelMissing($juragan);
    }
}
