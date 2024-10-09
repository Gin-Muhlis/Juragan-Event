<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Juragan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JuraganTest extends TestCase
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
    public function it_gets_juragans_list()
    {
        $juragans = Juragan::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.juragans.index'));

        $response->assertOk()->assertSee($juragans[0]->banner_website);
    }

    /**
     * @test
     */
    public function it_stores_the_juragan()
    {
        $data = Juragan::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.juragans.store'), $data);

        $this->assertDatabaseHas('juragans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.juragans.update', $juragan),
            $data
        );

        $data['id'] = $juragan->id;

        $this->assertDatabaseHas('juragans', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_juragan()
    {
        $juragan = Juragan::factory()->create();

        $response = $this->deleteJson(route('api.juragans.destroy', $juragan));

        $this->assertModelMissing($juragan);

        $response->assertNoContent();
    }
}
