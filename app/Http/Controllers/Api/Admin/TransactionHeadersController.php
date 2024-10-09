<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionHeaders;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionHeadersResource;
use App\Http\Resources\TransactionHeadersCollection;
use App\Http\Requests\Admin\TransactionHeadersStoreRequest;
use App\Http\Requests\Admin\TransactionHeadersUpdateRequest;

class TransactionHeadersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TransactionHeaders::class);

        $search = $request->get('search', '');

        $allTransactionHeaders = TransactionHeaders::search($search)
            ->latest()
            ->paginate();

        return new TransactionHeadersCollection($allTransactionHeaders);
    }

    /**
     * @param \App\Http\Requests\Admin\TransactionHeadersStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionHeadersStoreRequest $request)
    {
        $this->authorize('create', TransactionHeaders::class);

        $validated = $request->validated();

        $transactionHeaders = TransactionHeaders::create($validated);

        return new TransactionHeadersResource($transactionHeaders);
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

        return new TransactionHeadersResource($transactionHeaders);
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

        $transactionHeaders->update($validated);

        return new TransactionHeadersResource($transactionHeaders);
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

        return response()->noContent();
    }
}
