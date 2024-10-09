<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\TransactionHeaders;
use App\Http\Requests\Admin\TransactionHeadersStoreRequest;
use App\Http\Requests\Admin\TransactionHeadersUpdateRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class TransactionHeadersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TransactionHeaders::class);

        $allTransactionHeaders = TransactionHeaders::latest()->get();

        return view(
            'admin.app.all_transaction_headers.index',
            compact('allTransactionHeaders')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TransactionHeaders::class);

        $events = Event::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        $payments = Payment::pluck('name', 'id');

        return view(
            'admin.app.all_transaction_headers.create',
            compact('events', 'users', 'payments')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\TransactionHeadersStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionHeadersStoreRequest $request)
    {
        $this->authorize('create', TransactionHeaders::class);

        $validated = $request->validated();
        if ($request->hasFile('proof_of_payment')) {
            $validated['proof_of_payment'] = $request->file('proof_of_payment')->store('public');
        }

        $transactionHeaders = TransactionHeaders::create($validated);

        return redirect()
            ->route('all-transaction-headers.edit', $transactionHeaders)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('view', $transactionHeaders);

        return view(
            'admin.app.all_transaction_headers.show',
            compact('transactionHeaders')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('update', $transactionHeaders);

        $events = Event::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        $payments = Payment::pluck('name', 'id');

        return view(
            'admin.app.all_transaction_headers.edit',
            compact('transactionHeaders', 'events', 'users', 'payments')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\TransactionHeadersUpdateRequest $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function update(
        TransactionHeadersUpdateRequest $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('update', $transactionHeaders);

        $validated = $request->validated();
        if ($request->hasFile('proof_of_payment')) {
            if ($transactionHeaders->proof_of_payment) {
                Storage::delete($transactionHeaders->proof_of_payment);
            }

            $validated['proof_of_payment'] = $request->file('proof_of_payment')->store('public');
        }
        $transactionHeaders->update($validated);

        return redirect()
            ->route('all-transaction-headers.edit', $transactionHeaders)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionHeaders $transactionHeaders
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        TransactionHeaders $transactionHeaders
    ) {
        $this->authorize('delete', $transactionHeaders);

        $transactionHeaders->delete();

        return redirect()
            ->route('all-transaction-headers.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function action(Request $request, TransactionHeaders $transactionHeaders)
    {
        $this->authorize('update', $transactionHeaders);

        $status = $request->input('status');
        if ($status === 'selesai') {
            $detail = $transactionHeaders->transactionDetails;
            foreach ($detail as $item) {
                $ticket = Ticket::findOrFail($item->ticket_id);
                $quantity = $item->quantity;
                $newQuantity = $ticket->quota - $quantity;
                $ticket->update(['quota' => $newQuantity]);
            }
        }
        $transactionHeaders->update(['status' => $status]);
        return redirect()
            ->route('all-transaction-headers.index', $transactionHeaders)
            ->withSuccess(__('crud.common.saved'));
    }
}
