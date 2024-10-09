<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAllTransactionHeadersTest extends TestCase
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
    public function it_gets_user_all_transaction_headers()
    {
        $user = User::factory()->create();
        $allTransactionHeaders = TransactionHeaders::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.all-transaction-headers.index', $user)
        );

        $response
            ->assertOk()
            ->assertSee($allTransactionHeaders[0]->transaction_date);
    }

    /**
     * @test
     */
    public function it_stores_the_user_all_transaction_headers()
    {
        $user = User::factory()->create();
        $data = TransactionHeaders::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.all-transaction-headers.store', $user),
            $data
        );

        $this->assertDatabaseHas('transaction_headers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transactionHeaders = TransactionHeaders::latest('id')->first();

        $this->assertEquals($user->id, $transactionHeaders->user_id);
    }
}
