<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransactionHeaders;

use App\Models\Event;
use App\Models\Payment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionHeadersTest extends TestCase
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
    public function it_gets_all_transaction_headers_list()
    {
        $allTransactionHeaders = TransactionHeaders::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-transaction-headers.index'));

        $response
            ->assertOk()
            ->assertSee($allTransactionHeaders[0]->transaction_date);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_headers()
    {
        $data = TransactionHeaders::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.all-transaction-headers.store'),
            $data
        );

        $this->assertDatabaseHas('transaction_headers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transaction_headers()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();

        $user = User::factory()->create();
        $event = Event::factory()->create();
        $payment = Payment::factory()->create();

        $data = [
            'transaction_date' => $this->faker->date,
            'no_transaction' => $this->faker->unique->randomNumber,
            'total_transaction' => $this->faker->randomNumber,
            'status' => 'menunggu pembayaran',
            'user_id' => $user->id,
            'event_id' => $event->id,
            'payment_id' => $payment->id,
        ];

        $response = $this->putJson(
            route('api.all-transaction-headers.update', $transactionHeaders),
            $data
        );

        $data['id'] = $transactionHeaders->id;

        $this->assertDatabaseHas('transaction_headers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transaction_headers()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();

        $response = $this->deleteJson(
            route('api.all-transaction-headers.destroy', $transactionHeaders)
        );

        $this->assertModelMissing($transactionHeaders);

        $response->assertNoContent();
    }
}
