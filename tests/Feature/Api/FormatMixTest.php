<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FormatMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormatMixTest extends TestCase
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
    public function it_gets_format_mixes_list()
    {
        $formatMixes = FormatMix::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.format-mixes.index'));

        $response->assertOk()->assertSee($formatMixes[0]->format);
    }

    /**
     * @test
     */
    public function it_stores_the_format_mix()
    {
        $data = FormatMix::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.format-mixes.store'), $data);

        $this->assertDatabaseHas('format_mixes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.format-mixes.update', $formatMix),
            $data
        );

        $data['id'] = $formatMix->id;

        $this->assertDatabaseHas('format_mixes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_format_mix()
    {
        $formatMix = FormatMix::factory()->create();

        $response = $this->deleteJson(
            route('api.format-mixes.destroy', $formatMix)
        );

        $this->assertModelMissing($formatMix);

        $response->assertNoContent();
    }
}
