<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\TransactionHeaders;
use App\Http\Requests\Admin\TransactionDetailStoreRequest;
use App\Http\Requests\Admin\TransactionDetailUpdateRequest;

class TransactionDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TransactionDetail::class);

        $transactionDetails = TransactionDetail::get();

        return view(
            'admin.app.transaction_details.index',
            compact('transactionDetails')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TransactionDetail::class);

        $allTransactionHeaders = TransactionHeaders::pluck(
            'transaction_date',
            'id'
        );
        $tickets = Ticket::pluck('name', 'id');

        return view(
            'admin.app.transaction_details.create',
            compact('allTransactionHeaders', 'tickets')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\TransactionDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionDetailStoreRequest $request)
    {
        $this->authorize('create', TransactionDetail::class);

        $validated = $request->validated();

        $transactionDetail = TransactionDetail::create($validated);

        return redirect()
            ->route('transaction-details.edit', $transactionDetail)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionDetail $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TransactionDetail $transactionDetail)
    {
        $this->authorize('view', $transactionDetail);

        return view(
            'admin.app.transaction_details.show',
            compact('transactionDetail')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionDetail $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TransactionDetail $transactionDetail)
    {
        $this->authorize('update', $transactionDetail);

        $allTransactionHeaders = TransactionHeaders::pluck(
            'transaction_date',
            'id'
        );
        $tickets = Ticket::pluck('name', 'id');

        return view(
            'admin.app.transaction_details.edit',
            compact('transactionDetail', 'allTransactionHeaders', 'tickets')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\TransactionDetailUpdateRequest $request
     * @param \App\Models\TransactionDetail $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(
        TransactionDetailUpdateRequest $request,
        TransactionDetail $transactionDetail
    ) {
        $this->authorize('update', $transactionDetail);

        $validated = $request->validated();

        $transactionDetail->update($validated);

        return redirect()
            ->route('transaction-details.edit', $transactionDetail)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionDetail $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        TransactionDetail $transactionDetail
    ) {
        $this->authorize('delete', $transactionDetail);

        $transactionDetail->delete();

        return redirect()
            ->route('transaction-details.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
