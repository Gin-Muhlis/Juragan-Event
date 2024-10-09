<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Refund;
use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionHeadersRefundsTest extends TestCase
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
    public function it_gets_transaction_headers_refunds()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();
        $refunds = Refund::factory()
            ->count(2)
            ->create([
                'transaction_headers_id' => $transactionHeaders->id,
            ]);

        $response = $this->getJson(
            route(
                'api.all-transaction-headers.refunds.index',
                $transactionHeaders
            )
        );

        $response->assertOk()->assertSee($refunds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_headers_refunds()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();
        $data = Refund::factory()
            ->make([
                'transaction_headers_id' => $transactionHeaders->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.all-transaction-headers.refunds.store',
                $transactionHeaders
            ),
            $data
        );

        $this->assertDatabaseHas('refunds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $refund = Refund::latest('id')->first();

        $this->assertEquals(
            $transactionHeaders->id,
            $refund->transaction_headers_id
        );
    }
}
