<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionHeaders;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionDetailCollection;

class TransactionHeadersTransactionDetailsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('view', $transactionHeaders);

        $search = $request->get('search', '');

        $transactionDetails = $transactionHeaders
            ->transactionDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransactionDetailCollection($transactionDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('create', TransactionDetail::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'max:255'],
            'ticket_id' => ['required', 'exists:tickets,id'],
        ]);

        $transactionDetail = $transactionHeaders
            ->transactionDetails()
            ->create($validated);

        return new TransactionDetailResource($transactionDetail);
    }
}
