@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('refunds.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.refunds.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.refunds.inputs.date')</h5>
                        <span>{{ $refund->date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.refunds.inputs.reason')</h5>
                        <span>{{ $refund->reason ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.refunds.inputs.status')</h5>
                        <span>{{ $refund->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.refunds.inputs.transaction_headers_id')</h5>
                        <span>{{ optional($refund->transactionHeaders)->transaction_date ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('refunds.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Refund::class)
                        <a href="{{ route('refunds.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
