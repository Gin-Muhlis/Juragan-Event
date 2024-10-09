@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\TransactionHeaders::class)
                        <a href="{{ route('all-transaction-headers.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        @lang('crud.all_transaction_headers.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">

                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.transaction_date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.no_transaction')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.total_transaction')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.event_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.user_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.payment_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.all_transaction_headers.inputs.proof_payments')
                                </th>
                                <th class="text-center">
                                    Persetujuan
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allTransactionHeaders as $transactionHeaders)
                                <tr>
                                    <td>
                                        {{ $transactionHeaders->transaction_date ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $transactionHeaders->no_transaction ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $transactionHeaders->total_transaction ?? '-' }}
                                    </td>
                                    <td>{{ $transactionHeaders->status ?? '-' }}</td>
                                    <td>
                                        {{ optional($transactionHeaders->event)->title ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($transactionHeaders->user)->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($transactionHeaders->payment)->name ?? '-' }}
                                    </td>
                                    <td>
                                        <x-partials.thumbnail
                                            src="{{ $transactionHeaders->proof_of_payment ? \Storage::url($transactionHeaders->proof_of_payment) : '' }}" />
                                    </td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        @if ($transactionHeaders->status === 'menunggu konfirmasi')
                                            <form action="{{ route('transaction.action', $transactionHeaders) }}"
                                                method="post" id="selesai-form">
                                                @csrf
                                                <input type="hidden" name="status" value="selesai">
                                                <button class="btn btn-success mr-2"
                                                    style="font-size: .8em;">Setujui</button>
                                            </form>
                                            <form action="{{ route('transaction.action', $transactionHeaders) }}"
                                                method="post" id="dibatalkan-form">
                                                @csrf
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button class="btn btn-danger"style="font-size: .8em;">Batalkan</button>
                                            </form>
                                        @else
                                            <span
                                                class="badge text-light p-2 fs-5 bg-primary">{{ $transactionHeaders->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $transactionHeaders)
                                                <a href="{{ route('all-transaction-headers.edit', $transactionHeaders) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $transactionHeaders)
                                                <a href="{{ route('all-transaction-headers.show', $transactionHeaders) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $transactionHeaders)
                                                <form
                                                    action="{{ route('all-transaction-headers.destroy', $transactionHeaders) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
