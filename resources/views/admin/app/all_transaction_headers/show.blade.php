@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('all-transaction-headers.index') }}" class="mr-4"><i
                            class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.all_transaction_headers.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.transaction_date')
                        </h5>
                        <span>{{ $transactionHeaders->transaction_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.no_transaction')
                        </h5>
                        <span>{{ $transactionHeaders->no_transaction ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.total_transaction')
                        </h5>
                        <span>{{ $transactionHeaders->total_transaction ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.all_transaction_headers.inputs.status')</h5>
                        <span>{{ $transactionHeaders->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.event_id')
                        </h5>
                        <span>{{ optional($transactionHeaders->event)->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.user_id')
                        </h5>
                        <span>{{ optional($transactionHeaders->user)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>
                            @lang('crud.all_transaction_headers.inputs.payment_id')
                        </h5>
                        <span>{{ optional($transactionHeaders->payment)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.all_transaction_headers.inputs.proof_payments')</h5>
                        <x-partials.thumbnail
                            src="{{ $transactionHeaders->proof_of_payment ? \Storage::url($transactionHeaders->proof_of_payment) : '' }}"
                            size="200" />
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('all-transaction-headers.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\TransactionHeaders::class)
                        <a href="{{ route('all-transaction-headers.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
