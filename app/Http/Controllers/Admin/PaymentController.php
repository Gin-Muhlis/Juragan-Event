<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PaymentStoreRequest;
use App\Http\Requests\Admin\PaymentUpdateRequest;

class PaymentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Payment::class);

        $payments = Payment::get();

        return view('admin.app.payments.index', compact('payments'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Payment::class);

        return view('admin.app.payments.create');
    }

    /**
     * @param \App\Http\Requests\Admin\PaymentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentStoreRequest $request)
    {
        $this->authorize('create', Payment::class);

        $validated = $request->validated();
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('public');
        }

        $payment = Payment::create($validated);

        return redirect()
            ->route('payments.edit', $payment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Payment $payment)
    {
        $this->authorize('view', $payment);

        return view('admin.app.payments.show', compact('payment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        return view('admin.app.payments.edit', compact('payment'));
    }

    /**
     * @param \App\Http\Requests\Admin\PaymentUpdateRequest $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentUpdateRequest $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $validated = $request->validated();
        if ($request->hasFile('icon')) {
            if ($payment->icon) {
                Storage::delete($payment->icon);
            }

            $validated['icon'] = $request->file('icon')->store('public');
        }

        $payment->update($validated);

        return redirect()
            ->route('payments.edit', $payment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Payment $payment)
    {
        $this->authorize('delete', $payment);

        if ($payment->icon) {
            Storage::delete($payment->icon);
        }

        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
