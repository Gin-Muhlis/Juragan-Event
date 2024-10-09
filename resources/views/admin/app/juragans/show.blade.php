@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('juragans.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.juragans.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.address')</h5>
                        <span>{{ $juragan->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.email')</h5>
                        <span>{{ $juragan->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.phone_number')</h5>
                        <span>{{ $juragan->phone_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.copyritht_text')</h5>
                        <span>{{ $juragan->copyritht_text ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.short_description')</h5>
                        <span>{!! $juragan->short_description ?? '-' !!}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.long_description')</h5>
                        <span>{!! $juragan->long_description ?? '-' !!}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.contact_description')</h5>
                        <span>{!! $juragan->contact_description ?? '-' !!}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.facebook')</h5>
                        <span>{{ $juragan->link_fb ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.instagram')</h5>
                        <span>{{ $juragan->link_instagram ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.twitter')</h5>
                        <span>{{ $juragan->link_twitter ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.youtube')</h5>
                        <span>{{ $juragan->link_youtube ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.logo_website')</h5>
                        <x-partials.thumbnail
                            src="{{ $juragan->logo_website ? \Storage::url($juragan->logo_website) : '' }}"
                            size="100" />
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.juragans.inputs.banner_website')</h5>
                        <x-partials.thumbnail
                            src="{{ $juragan->banner_website ? \Storage::url($juragan->banner_website) : '' }}"
                            size="200" />
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('juragans.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Juragan::class)
                        <a href="{{ route('juragans.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
