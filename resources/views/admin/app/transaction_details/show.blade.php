@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('transaction-details.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.transaction_details.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.transaction_details.inputs.quantity')</h5>
                    <span>{{ $transactionDetail->quantity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transaction_details.inputs.unit_price')</h5>
                    <span>{{ $transactionDetail->unit_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.transaction_details.inputs.total_price')
                    </h5>
                    <span>{{ $transactionDetail->total_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.transaction_details.inputs.transaction_headers_id')
                    </h5>
                    <span
                        >{{
                        optional($transactionDetail->transactionHeaders)->transaction_date
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transaction_details.inputs.ticket_id')</h5>
                    <span
                        >{{ optional($transactionDetail->ticket)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('transaction-details.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\TransactionDetail::class)
                <a
                    href="{{ route('transaction-details.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
