@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('galeries.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.galeries.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.galeries.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $galery->image ? \Storage::url($galery->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.galeries.inputs.caption')</h5>
                    <span>{{ $galery->caption ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.galeries.inputs.description')</h5>
                    <span>{{ $galery->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('galeries.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Galery::class)
                <a href="{{ route('galeries.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
