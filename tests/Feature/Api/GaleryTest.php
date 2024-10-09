<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Galery;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GaleryTest extends TestCase
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
    public function it_gets_galeries_list()
    {
        $galeries = Galery::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.galeries.index'));

        $response->assertOk()->assertSee($galeries[0]->image);
    }

    /**
     * @test
     */
    public function it_stores_the_galery()
    {
        $data = Galery::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.galeries.store'), $data);

        $this->assertDatabaseHas('galeries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.galeries.update', $galery),
            $data
        );

        $data['id'] = $galery->id;

        $this->assertDatabaseHas('galeries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_galery()
    {
        $galery = Galery::factory()->create();

        $response = $this->deleteJson(route('api.galeries.destroy', $galery));

        $this->assertModelMissing($galery);

        $response->assertNoContent();
    }
}
