<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TransactionHeaders;

use App\Models\Event;
use App\Models\Payment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionHeadersControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_transaction_headers()
    {
        $allTransactionHeaders = TransactionHeaders::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-transaction-headers.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_transaction_headers.index')
            ->assertViewHas('allTransactionHeaders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transaction_headers()
    {
        $response = $this->get(route('all-transaction-headers.create'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_transaction_headers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_headers()
    {
        $data = TransactionHeaders::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-transaction-headers.store'), $data);

        $this->assertDatabaseHas('transaction_headers', $data);

        $transactionHeaders = TransactionHeaders::latest('id')->first();

        $response->assertRedirect(
            route('all-transaction-headers.edit', $transactionHeaders)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transaction_headers()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();

        $response = $this->get(
            route('all-transaction-headers.show', $transactionHeaders)
        );

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_transaction_headers.show')
            ->assertViewHas('transactionHeaders');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transaction_headers()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();

        $response = $this->get(
            route('all-transaction-headers.edit', $transactionHeaders)
        );

        $response
            ->assertOk()
            ->assertViewIs('admin.app.all_transaction_headers.edit')
            ->assertViewHas('transactionHeaders');
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

        $response = $this->put(
            route('all-transaction-headers.update', $transactionHeaders),
            $data
        );

        $data['id'] = $transactionHeaders->id;

        $this->assertDatabaseHas('transaction_headers', $data);

        $response->assertRedirect(
            route('all-transaction-headers.edit', $transactionHeaders)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_transaction_headers()
    {
        $transactionHeaders = TransactionHeaders::factory()->create();

        $response = $this->delete(
            route('all-transaction-headers.destroy', $transactionHeaders)
        );

        $response->assertRedirect(route('all-transaction-headers.index'));

        $this->assertModelMissing($transactionHeaders);
    }
}
