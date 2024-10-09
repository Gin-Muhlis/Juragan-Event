<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Visitors;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_visitors()
    {
        $allVisitors = Visitors::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-visitors.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_visitors.index')
            ->assertViewHas('allVisitors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_visitors()
    {
        $response = $this->get(route('all-visitors.create'));

        $response->assertOk()->assertViewIs('admin.app.all_visitors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_visitors()
    {
        $data = Visitors::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-visitors.store'), $data);

        $this->assertDatabaseHas('visitors', $data);

        $visitors = Visitors::latest('id')->first();

        $response->assertRedirect(route('all-visitors.edit', $visitors));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_visitors()
    {
        $visitors = Visitors::factory()->create();

        $response = $this->get(route('all-visitors.show', $visitors));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_visitors.show')
            ->assertViewHas('visitors');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_visitors()
    {
        $visitors = Visitors::factory()->create();

        $response = $this->get(route('all-visitors.edit', $visitors));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_visitors.edit')
            ->assertViewHas('visitors');
    }

    /**
     * @test
     */
    public function it_updates_the_visitors()
    {
        $visitors = Visitors::factory()->create();

        $data = [
            'post_id' => $this->faker->randomNumber,
            'ip_address' => $this->faker->text(255),
        ];

        $response = $this->put(route('all-visitors.update', $visitors), $data);

        $data['id'] = $visitors->id;

        $this->assertDatabaseHas('visitors', $data);

        $response->assertRedirect(route('all-visitors.edit', $visitors));
    }

    /**
     * @test
     */
    public function it_deletes_the_visitors()
    {
        $visitors = Visitors::factory()->create();

        $response = $this->delete(route('all-visitors.destroy', $visitors));

        $response->assertRedirect(route('all-visitors.index'));

        $this->assertModelMissing($visitors);
    }
}
