@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\User::class)
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.users.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.users.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.email')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.id_google')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.id_facebook')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.phone_number')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.image')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name ?? '-' }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td>{{ $user->google_id ?? '-' }}</td>
                                    <td>{{ $user->facebook_id ?? '-' }}</td>
                                    <td>{{ $user->phone_number ?? '-' }}</td>
                                    @php
                                        $imageProfile = '';
                                        if (is_null($user->image)) {
                                            $imageProfile = \Storage::url('public/default.jpg');
                                        } elseif (\Str::contains($user->image, 'https://graph.facebook.com/') || \Str::contains($user->image, 'https://lh3.googleusercontent.com/')) {
                                            $imageProfile = $user->image;
                                        } else {
                                            $imageProfile = \Storage::url($user->image);
                                        }
                                    @endphp
                                    <td>
                                        <x-partials.thumbnail src="{{ $imageProfile }}" />
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $user)
                                                <a href="{{ route('users.edit', $user) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $user)
                                                <a href="{{ route('users.show', $user) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $user)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
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
                                    <td colspan="4">
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
