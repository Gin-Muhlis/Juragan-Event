<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransactionDetail;

use App\Models\Ticket;
use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionDetailTest extends TestCase
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
    public function it_gets_transaction_details_list()
    {
        $transactionDetails = TransactionDetail::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transaction-details.index'));

        $response->assertOk()->assertSee($transactionDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_detail()
    {
        $data = TransactionDetail::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.transaction-details.store'),
            $data
        );

        $this->assertDatabaseHas('transaction_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transaction_detail()
    {
        $transactionDetail = TransactionDetail::factory()->create();

        $transactionHeaders = TransactionHeaders::factory()->create();
        $ticket = Ticket::factory()->create();

        $data = [
            'quantity' => $this->faker->randomNumber,
            'unit_price' => $this->faker->randomNumber(0),
            'total_price' => $this->faker->randomNumber,
            'transaction_headers_id' => $transactionHeaders->id,
            'ticket_id' => $ticket->id,
        ];

        $response = $this->putJson(
            route('api.transaction-details.update', $transactionDetail),
            $data
        );

        $data['id'] = $transactionDetail->id;

        $this->assertDatabaseHas('transaction_details', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transaction_detail()
    {
        $transactionDetail = TransactionDetail::factory()->create();

        $response = $this->deleteJson(
            route('api.transaction-details.destroy', $transactionDetail)
        );

        $this->assertModelMissing($transactionDetail);

        $response->assertNoContent();
    }
}
