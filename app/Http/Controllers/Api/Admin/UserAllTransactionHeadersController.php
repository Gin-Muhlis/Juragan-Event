<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionHeadersResource;
use App\Http\Resources\TransactionHeadersCollection;

class UserAllTransactionHeadersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $allTransactionHeaders = $user
            ->allTransactionHeaders()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransactionHeadersCollection($allTransactionHeaders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', TransactionHeaders::class);

        $validated = $request->validate([
            'transaction_date' => ['required', 'date'],
            'no_transaction' => [
                'required',
                'unique:transaction_headers,no_transaction',
                'max:255',
            ],
            'total_transaction' => ['required', 'max:255'],
            'status' => [
                'required',
                'in:menunggu pembayaran,selesai,dibatalkan',
            ],
            'event_id' => ['required', 'exists:events,id'],
            'payment_id' => ['required', 'exists:payments,id'],
        ]);

        $transactionHeaders = $user
            ->allTransactionHeaders()
            ->create($validated);

        return new TransactionHeadersResource($transactionHeaders);
    }
}
