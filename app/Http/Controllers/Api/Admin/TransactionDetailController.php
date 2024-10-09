<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionDetailCollection;
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

        $search = $request->get('search', '');

        $transactionDetails = TransactionDetail::search($search)
            ->latest()
            ->paginate();

        return new TransactionDetailCollection($transactionDetails);
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

        return new TransactionDetailResource($transactionDetail);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionDetail $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TransactionDetail $transactionDetail)
    {
        $this->authorize('view', $transactionDetail);

        return new TransactionDetailResource($transactionDetail);
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

        return new TransactionDetailResource($transactionDetail);
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

        return response()->noContent();
    }
}
