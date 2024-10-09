<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Format;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatTest extends TestCase
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
    public function it_gets_formats_list()
    {
        $formats = Format::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.formats.index'));

        $response->assertOk()->assertSee($formats[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_format()
    {
        $data = Format::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.formats.store'), $data);

        $this->assertDatabaseHas('formats', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.formats.update', $format), $data);

        $data['id'] = $format->id;

        $this->assertDatabaseHas('formats', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_format()
    {
        $format = Format::factory()->create();

        $response = $this->deleteJson(route('api.formats.destroy', $format));

        $this->assertModelMissing($format);

        $response->assertNoContent();
    }
}
