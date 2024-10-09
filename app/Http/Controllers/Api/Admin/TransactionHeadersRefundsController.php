<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionHeaders;
use App\Http\Controllers\Controller;
use App\Http\Resources\RefundResource;
use App\Http\Resources\RefundCollection;

class TransactionHeadersRefundsController extends Controller
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

        $refunds = $transactionHeaders
            ->refunds()
            ->search($search)
            ->latest()
            ->paginate();

        return new RefundCollection($refunds);
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
        $this->authorize('create', Refund::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'reason' => ['required', 'max:255', 'string'],
        ]);

        $refund = $transactionHeaders->refunds()->create($validated);

        return new RefundResource($refund);
    }
}
