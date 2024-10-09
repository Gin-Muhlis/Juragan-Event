@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                @if (count($juragans) < 1)
                    <div class="col-md-12 text-right">
                        @can('create', App\Models\Juragan::class)
                            <a href="{{ route('juragans.create') }}" class="btn btn-primary">
                                <i class="icon ion-md-add"></i> @lang('crud.common.create')
                            </a>
                        @endcan
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.juragans.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.address')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.email')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.phone_number')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.copyright_text')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.coordinate')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.logo_website')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.facebook')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.twitter')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.instagram')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.youtube')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.short_description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.long_description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.contact_description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.juragans.inputs.banner_website')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($juragans as $juragan)
                                <tr>
                                    <td>{{ $juragan->address ?? '-' }}</td>
                                    <td>{{ $juragan->email ?? '-' }}</td>
                                    <td>{{ $juragan->phone_number ?? '-' }}</td>
                                    <td>{{ $juragan->copyright_text ?? '-' }}</td>
                                    <td>{{ $juragan->coordinate ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail
                                            src="{{ $juragan->logo_website ? \Storage::url($juragan->logo_website) : '' }}" />
                                    </td>
                                    <td>{{ $juragan->link_fb ?? '-' }}</td>
                                    <td>{{ $juragan->link_twitter ?? '-' }}</td>
                                    <td>{{ $juragan->link_instagram ?? '-' }}</td>
                                    <td>{{ $juragan->link_youtube ?? '-' }}</td>
                                    <td>{{ $juragan->short_description ?? '-' }}</td>
                                    <td>{{ $juragan->long_description ? substr(strip_tags($juragan->long_description), 0, 100) : '-' }}
                                    </td>
                                    <td>{{ $juragan->contact_description ? substr(strip_tags($juragan->contact_description), 0, 100) : '-' }}
                                    </td>
                                    <td>
                                        <x-partials.thumbnail
                                            src="{{ $juragan->banner_website ? \Storage::url($juragan->banner_website) : '' }}" />
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $juragan)
                                                <a href="{{ route('juragans.edit', $juragan) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $juragan)
                                                <a href="{{ route('juragans.show', $juragan) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $juragan)
                                                <form action="{{ route('juragans.destroy', $juragan) }}" method="POST"
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
                                    <td colspan="10">
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
