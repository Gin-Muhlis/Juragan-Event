<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransactionDetail;
use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionHeadersTransactionDetailsTest extends TestCase
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
    public function it_gets_transaction_headers_transaction_details()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();
        $transactionDetails = TransactionDetail::factory()
            ->count(2)
            ->create([
                'transaction_headers_id' => $transactionHeaders->id,
            ]);

        $response = $this->getJson(
            route(
                'api.all-transaction-headers.transaction-details.index',
                $transactionHeaders
            )
        );

        $response->assertOk()->assertSee($transactionDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_headers_transaction_details()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();
        $data = TransactionDetail::factory()
            ->make([
                'transaction_headers_id' => $transactionHeaders->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.all-transaction-headers.transaction-details.store',
                $transactionHeaders
            ),
            $data
        );

        $this->assertDatabaseHas('transaction_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transactionDetail = TransactionDetail::latest('id')->first();

        $this->assertEquals(
            $transactionHeaders->id,
            $transactionDetail->transaction_headers_id
        );
    }
}
