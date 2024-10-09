<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Refund;

use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RefundTest extends TestCase
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
    public function it_gets_refunds_list()
    {
        $refunds = Refund::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.refunds.index'));

        $response->assertOk()->assertSee($refunds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_refund()
    {
        $data = Refund::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.refunds.store'), $data);

        $this->assertDatabaseHas('refunds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_refund()
    {
        $refund = Refund::factory()->create();

        $transactionHeaders = TransactionHeaders::factory()->create();

        $data = [
            'date' => $this->faker->date,
            'reason' => $this->faker->text,
            'transaction_headers_id' => $transactionHeaders->id,
        ];

        $response = $this->putJson(route('api.refunds.update', $refund), $data);

        $data['id'] = $refund->id;

        $this->assertDatabaseHas('refunds', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_refund()
    {
        $refund = Refund::factory()->create();

        $response = $this->deleteJson(route('api.refunds.destroy', $refund));

        $this->assertModelMissing($refund);

        $response->assertNoContent();
    }
}
