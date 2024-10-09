@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('contacts.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.contacts.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5> @lang('crud.contacts.inputs.name')</h5>
                        <span>{{ $contact->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.contacts.inputs.email')</h5>
                        <span>{{ $contact->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.contacts.inputs.message')</h5>
                        <span>{{ $contact->message ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('contacts.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Contact::class)
                        <a href="{{ route('contacts.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
