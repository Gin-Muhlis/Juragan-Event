<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FormatMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatMixControllerTest extends TestCase
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
    public function it_displays_index_view_with_format_mixes()
    {
        $formatMixes = FormatMix::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('format-mixes.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.format_mixes.index')
            ->assertViewHas('formatMixes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_format_mix()
    {
        $response = $this->get(route('format-mixes.create'));

        $response->assertOk()->assertViewIs('admin.app.format_mixes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_format_mix()
    {
        $data = FormatMix::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('format-mixes.store'), $data);

        $this->assertDatabaseHas('format_mixes', $data);

        $formatMix = FormatMix::latest('id')->first();

        $response->assertRedirect(route('format-mixes.edit', $formatMix));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_format_mix()
    {
        $formatMix = FormatMix::factory()->create();

        $response = $this->get(route('format-mixes.show', $formatMix));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.format_mixes.show')
            ->assertViewHas('formatMix');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_format_mix()
    {
        $formatMix = FormatMix::factory()->create();

        $response = $this->get(route('format-mixes.edit', $formatMix));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.format_mixes.edit')
            ->assertViewHas('formatMix');
    }

    /**
     * @test
     */
    public function it_updates_the_format_mix()
    {
        $formatMix = FormatMix::factory()->create();

        $data = [
            'format' => $this->faker->text(255),
        ];

        $response = $this->put(route('format-mixes.update', $formatMix), $data);

        $data['id'] = $formatMix->id;

        $this->assertDatabaseHas('format_mixes', $data);

        $response->assertRedirect(route('format-mixes.edit', $formatMix));
    }

    /**
     * @test
     */
    public function it_deletes_the_format_mix()
    {
        $formatMix = FormatMix::factory()->create();

        $response = $this->delete(route('format-mixes.destroy', $formatMix));

        $response->assertRedirect(route('format-mixes.index'));

        $this->assertModelMissing($formatMix);
    }
}
