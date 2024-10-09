@extends('user.layouts.main')

@section('container')
    <div class="imgBg w-100 position-relative d-flex align-items-center flex-direction-column"
        style="overflow: hidden; height: 65vh; background: #000000; color: #ffffff;">
        <img lazy="loading" src="{{ \Storage::url($data->banner_website) }}" alt="..." class="d-block w-100"
            style="object-fit: cover; min-height: 100%; filter: opacity(50%);">
        <div class="container position-absolute ms-5">
            <h1>Tentang Kami</h1>
            <p class="w-75">{!! $data->short_description !!}</p>
        </div>
    </div>
    <div class="container pt-5">
        {!! $data->long_description !!}
    </div>
@endsection
