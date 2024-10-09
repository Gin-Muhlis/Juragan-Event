@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('tickets.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.tickets.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.name')</h5>
                        <span>{{ $ticket->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.description')</h5>
                        <span>{{ $ticket->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.price')</h5>
                        <span>{{ $ticket->price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.quota')</h5>
                        <span>{{ $ticket->quota ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.star_sale_at')</h5>
                        <span>{{ $ticket->star_sale_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.end_sale_at')</h5>
                        <span>{{ $ticket->end_sale_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.type')</h5>
                        <span>{{ $ticket->type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.event_id')</h5>
                        <span>{{ optional($ticket->event)->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.discount')</h5>
                        <span>{{ $ticket->discount ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.fee_admin')</h5>
                        <span>{{ $ticket->fee_admin ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tickets.inputs.tax_coast')</h5>
                        <span>{{ $ticket->tax_coast ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Ticket::class)
                        <a href="{{ route('tickets.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
