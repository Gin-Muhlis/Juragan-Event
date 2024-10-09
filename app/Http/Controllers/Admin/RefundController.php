<?php

namespace App\Http\Controllers\Admin;

use App\Models\Refund;
use Illuminate\Http\Request;
use App\Models\TransactionHeaders;
use App\Http\Requests\Admin\RefundStoreRequest;
use App\Http\Requests\Admin\RefundUpdateRequest;
use App\Models\Ticket;

class RefundController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Refund::class);

        $refunds = Refund::latest()->get();
        

        return view('admin.app.refunds.index', compact('refunds'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Refund::class);

        $allTransactionHeaders = TransactionHeaders::pluck(
            'transaction_date',
            'id'
        );

        return view(
            'admin.app.refunds.create',
            compact('allTransactionHeaders')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\RefundStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefundStoreRequest $request)
    {
        $this->authorize('create', Refund::class);

        $validated = $request->validated();

        $refund = Refund::create($validated);

        return redirect()
            ->route('refunds.edit', $refund)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Refund $refund
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Refund $refund)
    {
        $this->authorize('view', $refund);

        return view('admin.app.refunds.show', compact('refund'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Refund $refund
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Refund $refund)
    {
        $this->authorize('update', $refund);

        $allTransactionHeaders = TransactionHeaders::pluck(
            'transaction_date',
            'id'
        );

        return view(
            'admin.app.refunds.edit',
            compact('refund', 'allTransactionHeaders')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\RefundUpdateRequest $request
     * @param \App\Models\Refund $refund
     * @return \Illuminate\Http\Response
     */
    public function update(RefundUpdateRequest $request, Refund $refund)
    {
        $this->authorize('update', $refund);

        $validated = $request->validated();

        $refund->update($validated);

        return redirect()
            ->route('refunds.edit', $refund)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Refund $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Refund $refund)
    {
        $this->authorize('delete', $refund);

        $refund->delete();

        return redirect()
            ->route('refunds.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function action(Request $request, Refund $refund)
    {
        $status = $request->input('status');

        $refund->update(['status' => $status]);

        $transactionHeader = TransactionHeaders::with('transactionDetails')->findOrFail($refund->transaction_headers_id);
        $transactionHeader->update(['status' => $status === 'disetujui' ? 'pengajuan pengembalian disetujui' : 'pengajuan pengembalian ditolak']);

        if ($status === 'disetujui') {
            $transactionDetail = $transactionHeader->transactionDetails;
            foreach ($transactionDetail as $detail) {
                $ticket = Ticket::findOrFail($detail->ticket_id);
                $ticket->update(['quota' => $ticket->quota + $detail->quantity]);
            }
        }
        return redirect()
            ->route('refunds.index')
            ->withSuccess(__('crud.common.saved'));
    }
}
