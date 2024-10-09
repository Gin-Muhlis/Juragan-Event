@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('organizers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.organizers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.organizers.inputs.name')</h5>
                    <span>{{ $organizer->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.organizers.inputs.icon')</h5>
                    <x-partials.thumbnail
                        src="{{ $organizer->icon ? \Storage::url($organizer->icon) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('organizers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Organizer::class)
                <a
                    href="{{ route('organizers.create') }}"
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
