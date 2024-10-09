<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TopicMix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicMixControllerTest extends TestCase
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
    public function it_displays_index_view_with_topic_mixes()
    {
        $topicMixes = TopicMix::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('topic-mixes.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.topic_mixes.index')
            ->assertViewHas('topicMixes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_topic_mix()
    {
        $response = $this->get(route('topic-mixes.create'));

        $response->assertOk()->assertViewIs('admin.app.topic_mixes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_topic_mix()
    {
        $data = TopicMix::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('topic-mixes.store'), $data);

        $this->assertDatabaseHas('topic_mixes', $data);

        $topicMix = TopicMix::latest('id')->first();

        $response->assertRedirect(route('topic-mixes.edit', $topicMix));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $response = $this->get(route('topic-mixes.show', $topicMix));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.topic_mixes.show')
            ->assertViewHas('topicMix');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $response = $this->get(route('topic-mixes.edit', $topicMix));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.topic_mixes.edit')
            ->assertViewHas('topicMix');
    }

    /**
     * @test
     */
    public function it_updates_the_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $data = [
            'topic' => $this->faker->text,
        ];

        $response = $this->put(route('topic-mixes.update', $topicMix), $data);

        $data['id'] = $topicMix->id;

        $this->assertDatabaseHas('topic_mixes', $data);

        $response->assertRedirect(route('topic-mixes.edit', $topicMix));
    }

    /**
     * @test
     */
    public function it_deletes_the_topic_mix()
    {
        $topicMix = TopicMix::factory()->create();

        $response = $this->delete(route('topic-mixes.destroy', $topicMix));

        $response->assertRedirect(route('topic-mixes.index'));

        $this->assertModelMissing($topicMix);
    }
}
