@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\Event::class)
                        <a href="{{ route('events.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.events.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.events.inputs.title')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.start_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.end_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.type')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.slug')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.banner')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.terms')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.city_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.organizer_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.format_mix_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.events.inputs.topic_mix_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td>{{ $event->title ?? '-' }}</td>
                                    <td>{{ $event->start_at ?? '-' }}</td>
                                    <td>{{ $event->end_at ?? '-' }}</td>
                                    <td>{{ $event->type ?? '-' }}</td>
                                    <td>{{ $event->slug ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail
                                            src="{{ $event->banner ? \Storage::url($event->banner) : '' }}" />
                                    </td>
                                    <td>{{ $event->description ? substr($event->description, 0, 100) : '-' }}</td>
                                    <td>{{ $event->terms ? substr($event->terms, 0, 100) : '-' }}</td>
                                    <td>{{ optional($event->city)->city_name ?? '-' }}</td>
                                    <td>
                                        {{ optional($event->organizer)->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($event->formatMix)->format ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($event->topicMix)->topic ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $event)
                                                <a href="{{ route('events.edit', $event) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $event)
                                                <a href="{{ route('events.show', $event) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $event)
                                                <form action="{{ route('events.destroy', $event) }}" method="POST"
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
