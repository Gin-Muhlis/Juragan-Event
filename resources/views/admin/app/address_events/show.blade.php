@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('address-events.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.address_events.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.address_events.inputs.address')</h5>
                    <span>{{ $addressEvent->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.address_events.inputs.longitude')</h5>
                    <span>{{ $addressEvent->longitude ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.address_events.inputs.latitutde')</h5>
                    <span>{{ $addressEvent->latitutde ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.address_events.inputs.event_id')</h5>
                    <span
                        >{{ optional($addressEvent->event)->title ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('address-events.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\AddressEvent::class)
                <a
                    href="{{ route('address-events.create') }}"
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
