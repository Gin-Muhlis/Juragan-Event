<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TransactionDetail;

use App\Models\Ticket;
use App\Models\TransactionHeaders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionDetailControllerTest extends TestCase
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
    public function it_displays_index_view_with_transaction_details()
    {
        $transactionDetails = TransactionDetail::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('transaction-details.index'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.transaction_details.index')
            ->assertViewHas('transactionDetails');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transaction_detail()
    {
        $response = $this->get(route('transaction-details.create'));

        $response
            ->assertOk()
            ->assertViewIs('admin.app.transaction_details.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_detail()
    {
        $data = TransactionDetail::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('transaction-details.store'), $data);

        $this->assertDatabaseHas('transaction_details', $data);

        $transactionDetail = TransactionDetail::latest('id')->first();

        $response->assertRedirect(
            route('transaction-details.edit', $transactionDetail)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transaction_detail()
    {
        $transactionDetail = TransactionDetail::factory()->create();

        $response = $this->get(
            route('transaction-details.show', $transactionDetail)
        );

        $response
            ->assertOk()
            ->assertViewIs('admin.app.transaction_details.show')
            ->assertViewHas('transactionDetail');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transaction_detail()
    {
        $transactionDetail = TransactionDetail::factory()->create();

        $response = $this->get(
            route('transaction-details.edit', $transactionDetail)
        );

        $response
            ->assertOk()
            ->assertViewIs('admin.app.transaction_details.edit')
            ->assertViewHas('transactionDetail');
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

        $response = $this->put(
            route('transaction-details.update', $transactionDetail),
            $data
        );

        $data['id'] = $transactionDetail->id;

        $this->assertDatabaseHas('transaction_details', $data);

        $response->assertRedirect(
            route('transaction-details.edit', $transactionDetail)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_transaction_detail()
    {
        $transactionDetail = TransactionDetail::factory()->create();

        $response = $this->delete(
            route('transaction-details.destroy', $transactionDetail)
        );

        $response->assertRedirect(route('transaction-details.index'));

        $this->assertModelMissing($transactionDetail);
    }
}
