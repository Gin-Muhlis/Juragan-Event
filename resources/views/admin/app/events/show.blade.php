@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('events.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.events.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.title')</h5>
                        <span>{{ $event->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.start_at')</h5>
                        <span>{{ $event->start_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.end_at')</h5>
                        <span>{{ $event->end_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.type')</h5>
                        <span>{{ $event->type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.slug')</h5>
                        <span>{{ $event->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.banner')</h5>
                        <x-partials.thumbnail src="{{ $event->banner ? \Storage::url($event->banner) : '' }}"
                            size="200" />
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.description')</h5>
                        <span>{!! $event->description ?? '-' !!}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.terms')</h5>
                        <span>{!! $event->terms ?? '-' !!}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.city_id')</h5>
                        <span>{{ optional($event->city)->id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.organizer_id')</h5>
                        <span>{{ optional($event->organizer)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.format_mix_id')</h5>
                        <span>{{ optional($event->formatMix)->format ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.events.inputs.topic_mix_id')</h5>
                        <span>{{ optional($event->topicMix)->topic ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('events.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Event::class)
                        <a href="{{ route('events.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
