@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-12 text-right">
                    @can('create', App\Models\Post::class)
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.posts.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.posts.inputs.title')
                                </th>
                                <th class="text-left">
                                    @lang('crud.posts.inputs.slug')
                                </th>
                                <th class="text-left">
                                    @lang('crud.posts.inputs.content')
                                </th>
                                <th class="text-left">
                                    @lang('crud.posts.inputs.image')
                                </th>
                                <th class="text-left">
                                    @lang('crud.posts.inputs.user_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.posts.inputs.topic_mix_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $post->title ?? '-' }}</td>
                                    <td>{{ $post->slug ?? '-' }}</td>
                                    <td>{{ $post->content ? substr($post->content, 0, 200) . '...' : '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail src="{{ $post->image ? \Storage::url($post->image) : '' }}" />
                                    </td>
                                    <td>{{ optional($post->user)->name ?? '-' }}</td>
                                    <td>
                                        {{ optional($post->topicMix)->topic ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $post)
                                                <a href="{{ route('posts.edit', $post) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $post)
                                                <a href="{{ route('posts.show', $post) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $post)
                                                <form action="{{ route('posts.destroy', $post) }}" method="POST"
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
                                    <td colspan="6">
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
