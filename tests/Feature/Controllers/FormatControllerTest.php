<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Format;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatControllerTest extends TestCase
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
    public function it_displays_index_view_with_formats()
    {
        $formats = Format::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('formats.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.formats.index')
            ->assertViewHas('formats');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_format()
    {
        $response = $this->get(route('formats.create'));

        $response->assertOk()->assertViewIs('admin.app.formats.create');
    }

    /**
     * @test
     */
    public function it_stores_the_format()
    {
        $data = Format::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('formats.store'), $data);

        $this->assertDatabaseHas('formats', $data);

        $format = Format::latest('id')->first();

        $response->assertRedirect(route('formats.edit', $format));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_format()
    {
        $format = Format::factory()->create();

        $response = $this->get(route('formats.show', $format));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.formats.show')
            ->assertViewHas('format');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_format()
    {
        $format = Format::factory()->create();

        $response = $this->get(route('formats.edit', $format));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.formats.edit')
            ->assertViewHas('format');
    }

    /**
     * @test
     */
    public function it_updates_the_format()
    {
        $format = Format::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(route('formats.update', $format), $data);

        $data['id'] = $format->id;

        $this->assertDatabaseHas('formats', $data);

        $response->assertRedirect(route('formats.edit', $format));
    }

    /**
     * @test
     */
    public function it_deletes_the_format()
    {
        $format = Format::factory()->create();

        $response = $this->delete(route('formats.destroy', $format));

        $response->assertRedirect(route('formats.index'));

        $this->assertModelMissing($format);
    }
}
