@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('user/js/topicMix.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('topic-mixes.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.topic_mixes.edit_title')
                </h4>

                <x-form method="PUT" action="{{ route('topic-mixes.update', $topicMix) }}" class="mt-4">
                    <div class="form-group mb-4">
                        <input type="text" name="topic" id="input-mix-topic" class="form-control"
                            value="{{ $topicMix->topic }}">
                    </div>

                    <h5 class="mb-3">Pilih topik :</h5>
                    <div class="row">
                        @foreach ($topics as $topic)
                            <div class="col-md-2">
                                <input class="input-topic" type="checkbox" name="topics" id="topic{{ $topic->id }}"
                                    value="{{ $topic->name }}">
                                <label class="fw-light" for="topic{{ $topic->id }}">{{ $topic->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('topic-mixes.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('topic-mixes.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
