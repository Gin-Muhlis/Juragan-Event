@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('user/js/formatMix.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('format-mixes.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.format_mixes.create_title')
                </h4>

                <x-form method="POST" action="{{ route('format-mixes.store') }}" class="mt-4">
                    <div class="form-group">
                        <input type="text" name="format" id="input-format-mix" class="form-control" value="">
                    </div>

                    <div class="row">
                        @foreach ($formats as $format)
                            <div class="col-md-2">
                                <input type="checkbox" name="formats" id="format{{ $format->id }}"
                                    value="{{ $format->name }}" class="input-formats" style="pointer-events: none;">
                                <label for="format{{ $format->id }}">{{ $format->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('format-mixes.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
