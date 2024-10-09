<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Visitors;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorsTest extends TestCase
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
    public function it_gets_all_visitors_list()
    {
        $allVisitors = Visitors::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-visitors.index'));

        $response->assertOk()->assertSee($allVisitors[0]->ip_address);
    }

    /**
     * @test
     */
    public function it_stores_the_visitors()
    {
        $data = Visitors::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-visitors.store'), $data);

        $this->assertDatabaseHas('visitors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-visitors.update', $visitors),
            $data
        );

        $data['id'] = $visitors->id;

        $this->assertDatabaseHas('visitors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_visitors()
    {
        $visitors = Visitors::factory()->create();

        $response = $this->deleteJson(
            route('api.all-visitors.destroy', $visitors)
        );

        $this->assertModelMissing($visitors);

        $response->assertNoContent();
    }
}
