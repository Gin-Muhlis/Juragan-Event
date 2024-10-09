@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\TransactionDetail::class)
                        <a href="{{ route('transaction-details.create') }}" class="btn btn-primary">
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
                        @lang('crud.transaction_details.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-right">
                                    @lang('crud.transaction_details.inputs.quantity')
                                </th>
                                <th class="text-right">
                                    @lang('crud.transaction_details.inputs.unit_price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction_details.inputs.total_price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction_details.inputs.transaction_headers_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction_details.inputs.ticket_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactionDetails as $transactionDetail)
                                <tr>
                                    <td>{{ $transactionDetail->quantity ?? '-' }}</td>
                                    <td>{{ $transactionDetail->unit_price ?? '-' }}</td>
                                    <td>
                                        {{ $transactionDetail->total_price ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($transactionDetail->transactionHeaders)->no_transaction ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($transactionDetail->ticket)->name ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $transactionDetail)
                                                <a href="{{ route('transaction-details.edit', $transactionDetail) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $transactionDetail)
                                                <a href="{{ route('transaction-details.show', $transactionDetail) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $transactionDetail)
                                                <form action="{{ route('transaction-details.destroy', $transactionDetail) }}"
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
                                    <td colspan="6">
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
