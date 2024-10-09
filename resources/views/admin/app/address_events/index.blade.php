@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-12 text-right">
                    @can('create', App\Models\AddressEvent::class)
                        <a href="{{ route('address-events.create') }}" class="btn btn-primary">
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
                        @lang('crud.address_events.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.address_events.inputs.address')
                                </th>
                                <th class="text-right">
                                    @lang('crud.address_events.inputs.longitude')
                                </th>
                                <th class="text-right">
                                    @lang('crud.address_events.inputs.latitutde')
                                </th>
                                <th class="text-left">
                                    @lang('crud.address_events.inputs.event_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($addressEvents as $addressEvent)
                                <tr>
                                    <td>{{ $addressEvent->address ?? '-' }}</td>
                                    <td>{{ $addressEvent->longitude ?? '-' }}</td>
                                    <td>{{ $addressEvent->latitutde ?? '-' }}</td>
                                    <td>
                                        {{ optional($addressEvent->event)->title ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $addressEvent)
                                                <a href="{{ route('address-events.edit', $addressEvent) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $addressEvent)
                                                <a href="{{ route('address-events.show', $addressEvent) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $addressEvent)
                                                <form action="{{ route('address-events.destroy', $addressEvent) }}"
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
                                    <td colspan="5">
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
