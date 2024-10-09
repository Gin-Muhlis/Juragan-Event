@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\Ticket::class)
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.tickets.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.price')
                                </th>
                                <th class="text-right">
                                    @lang('crud.tickets.inputs.quota')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.star_sale_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.end_sale_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.type')
                                </th>
                                <th class="text-left">
                                    @lang('crud.tickets.inputs.event_id')
                                </th>
                                <th class="text-right">
                                    @lang('crud.tickets.inputs.discount')
                                </th>
                                <th class="text-right">
                                    @lang('crud.tickets.inputs.fee_admin')
                                </th>
                                <th class="text-right">
                                    @lang('crud.tickets.inputs.tax_coast')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->name ?? '-' }}</td>
                                    <td>{{ $ticket->description ?? '-' }}</td>
                                    <td>{{ $ticket->price ?? '-' }}</td>
                                    <td>{{ $ticket->quota ?? '-' }}</td>
                                    <td>{{ $ticket->star_sale_at ?? '-' }}</td>
                                    <td>{{ $ticket->end_sale_at ?? '-' }}</td>
                                    <td>{{ $ticket->type ?? '-' }}</td>
                                    <td>
                                        {{ optional($ticket->event)->title ?? '-' }}
                                    </td>
                                    <td>{{ $ticket->discount ?? '-' }}</td>
                                    <td>{{ $ticket->fee_admin ?? '-' }}</td>
                                    <td>{{ $ticket->tax_coast ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $ticket)
                                                <a href="{{ route('tickets.edit', $ticket) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $ticket)
                                                <a href="{{ route('tickets.show', $ticket) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $ticket)
                                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
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
                                    <td colspan="13">
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
