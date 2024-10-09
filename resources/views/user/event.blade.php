@php
    use App\Service\Helper;
@endphp

@extends('user.layouts.main')

@section('style')
    <style>
        :root {
            --bs-link-color: #DC3545;
            --bs-link-hover-color: #DC3545;
        }

        .active>.page-link,
        .page-link.active {
            background-image: var(--primary-color);
            border-color: #DC3545;
        }
    </style>
@endsection

@section('container')
    <div class="container-fluid mt-4">
        <div class="row">
            {{-- Kategori --}}
            <div class="col-md-3" style="border-right: 1px solid;">
                <form action="{{ route('events') }}" method="GET" class="filter-form">

                    <div class="content ms-4 ms-xl-5 my-4">
                        <div class="filter d-flex align-items-center justify-content-between">
                            <span class="fw-bold fs-5">
                                Filter</span>
                            <a href="{{ route('events') }}">
                                <i class="bi bi-arrow-clockwise text-danger fs-5 fw-bold" style="cursor: pointer;"></i></a>
                        </div>
                    </div>

                    <div class="content ms-4 ms-xl-5 my-4">
                        <a class="text-decoration-none text-dark mb-4" data-bs-toggle="collapse" href="#lokasi"
                            role="button" aria-expanded="false" aria-controls="lokasi">
                            <div class="lokasi">
                                <h6>Lokasi</h6>
                            </div>
                        </a>
                        <div class="collapse mt-2 pt-1" id="lokasi">
                            <div class="search d-flex align-items-center position-relative mb-3">

                                <i class="bi bi-search position-absolute" style="right: 20px;"></i>
                                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                                    id="search-city" autocomplete="off">
                            </div>
                            <div class="isi ms-1 field-cities">
                                <input type="hidden" name="filterCity" value="{{ $filterCity ?? null }}" id="filterCity">
                                @foreach ($cities as $city)
                                    <button type="button" value="{{ $city->id }}" class="fs-6 pb-2 input-city d-block"
                                        style="border: none; background: none;">{{ $city->city_name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="content ms-4 ms-xl-5 my-4">
                        <a class="text-decoration-none text-dark mb-4" data-bs-toggle="collapse" href="#format"
                            role="button" aria-expanded="false" aria-controls="format">
                            <div class="format">
                                <h6>Format</h6>
                            </div>
                        </a>
                        <div class="collapse mt-2 pt-1" id="format">
                            <div class="search d-flex align-items-center position-relative mb-3">

                                <i class="bi bi-search position-absolute" style="right: 20px;"></i>
                                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                                    id="search-city" autocomplete="off">
                            </div>
                            <div class="isi ms-1 field-cities">
                                <input type="hidden" name="filterFormat" value="{{ $filterFormat ?? null }}"
                                    id="filterFormat">
                                @foreach ($formats as $format)
                                    <button type="button" value="{{ $format->id }}"
                                        class="fs-6 pb-2 input-format d-block"
                                        style="border: none; background: none;">{{ $format->format }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="content ms-4 ms-xl-5 my-4">
                        <a class="text-decoration-none text-dark mb-4" data-bs-toggle="collapse" href="#topik"
                            role="button" aria-expanded="false" aria-controls="topik">
                            <div class="topik">
                                <h6>Topik</h6>
                            </div>
                        </a>
                        <div class="collapse mt-2 pt-1" id="topik">
                            <div class="search d-flex align-items-center position-relative mb-3">
                                <i class="bi bi-search position-absolute" style="right: 20px;"></i>
                                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                                    id="search-topic" autocomplete="off">
                            </div>
                            <div class="isi ms-1 field-topics">
                                <input type="hidden" name="filterTopic" value="{{ $filterTopic ?? null }}"
                                    id="filterTopic">
                                @foreach ($topics as $topic)
                                    @php
                                        $words = explode(' ', $topic->topic);
                                    @endphp
                                    <button type="button" value="{{ $topic->id }}" class="fs-6 pb-2 input-topic d-block"
                                        style="border: none; background: none; text-align: left;">{{ implode(' ', array_slice($words, 0, 3)) }}{{ count($words) > 3 ? '...' : '' }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="content ms-4 ms-xl-5 my-4">
                        <a class="text-decoration-none text-dark mb-4" data-bs-toggle="collapse" href="#waktu"
                            role="button" aria-expanded="false" aria-controls="waktu">
                            <div class="waktu">
                                <h6>Waktu</h6>
                            </div>
                        </a>
                        <div class="collapse mt-2 pt-1" id="waktu">
                            <div class="isi ms-1 d-flex flex-column">
                                <input type="hidden" name="filterTime" value="{{ $filterTime ?? null }}"
                                    id="filterTime">
                                @php
                                    $times = ['minggu ini', 'bulan ini', 'bulan depan'];
                                @endphp
                                @foreach ($times as $item)
                                    <button type="button" value="{{ $item }}"
                                        class="fs-6 pb-2 input-time d-block"
                                        style="border: none; background: none; text-align: left;">{{ ucwords($item) }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="content ms-4 ms-xl-5 my-4">
                        <a class="text-decoration-none text-dark mb-4" data-bs-toggle="collapse" href="#harga"
                            role="button" aria-expanded="false" aria-controls="harga">
                            <div class="harga">
                                <h6>Harga</h6>
                            </div>
                        </a>
                        <div class="collapse mt-2 pt-1" id="harga">
                            <div class="isi ms-1 d-flex flex-column">
                                <input type="hidden" name="filterType" value="{{ $filterType ?? null }}"
                                    id="filterType">
                                @php
                                    $types = ['berbayar', 'gratis'];
                                @endphp
                                @foreach ($types as $item)
                                    <button type="button" value="{{ $item }}"
                                        class="fs-6 pb-2 input-type d-block"
                                        style="border: none; background: none; text-align: left;">{{ ucwords($item) }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            {{-- Event --}}
            <div class="col">
                <div class="d-flex align-items-center gap-2" style="font-size: .9em">
                    <p class="text-danger">Filter :</p>
                    @if ($valueFilterCity)
                        <p class="d-flex align-items-center gap-1 text-light p-1"
                            style="font-size: .8em; border-radius: 2px; background-image: var(--primary-color);">
                            {{ $valueFilterCity->city_name }}
                            <i class="bi bi-x-lg reset-city" style="cursor: pointer"></i>
                        </p>
                    @endif
                    @if ($valueFilterFormat)
                        <p class="d-flex align-items-center gap-1 text-light p-1"
                            style="font-size: .8em; border-radius: 2px; background-image: var(--primary-color);">
                            {{ $valueFilterFormat->format }}
                            <i class="bi bi-x-lg reset-format" style="cursor: pointer"></i>
                        </p>
                    @endif
                    @if ($valueFilterTopic)
                        <p class="d-flex align-items-center gap-1 text-light p-1"
                            style="font-size: .8em; border-radius: 2px;  background-image: var(--primary-color); ">
                            {{ $valueFilterTopic->topic }}
                            <i class="bi bi-x-lg reset-topic" style="cursor: pointer"></i>
                        </p>
                    @endif
                    @if ($filterTime)
                        <p class="d-flex align-items-center gap-1 text-light p-1"
                            style="font-size: .8em; border-radius: 2px; background-image: var(--primary-color);">
                            {{ ucwords($filterTime) }}
                            <i class="bi bi-x-lg reset-topic" style="cursor: pointer"></i>
                        </p>
                    @endif
                    @if ($filterType)
                        <p class="d-flex align-items-center gap-1 text-light p-1"
                            style="font-size: .8em; border-radius: 2px; background-image: var(--primary-color);">
                            {{ ucwords($filterType) }}
                            <i class="bi bi-x-lg reset-type" style="cursor: pointer"></i>
                        </p>
                    @endif
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 text-center mt-3 mx-3 ">

                    @if (count($events) > 0)
                        @foreach ($events as $event)
                            <div class="col item rounded-4 mb-4" style="overflow: hidden;">
                                <div class="card">
                                    <a href="/event/detail/{{ $event->slug }}">
                                        <img lazy="loading" src="{{ \Storage::url($event->banner) }}"
                                            class="card-img-top" alt="..."
                                            style="height: 170px; object-fit: cover;">
                                    </a>
                                    <div class="card-body text-white"
                                        style="height: 130px; background-image: var(--primary-color);">
                                        @php
                                            $words = explode(' ', $event->title);
                                        @endphp
                                        <h6 class="card-title fw-bold">
                                            {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}
                                        </h6>
                                        <p class="card-text" style="font-size: .9em;">
                                            {{ Helper::generateDateEvent($event->start_at, $event->end_at) }}</p>

                                        @if ($event->tickets[0]->type === 'gratis')
                                            <span class="font-style-italic f-6">Gratis</span>
                                        @endif
                                        @if ($event->tickets[0]->type === 'berbayar')
                                            @php
                                                $hargaAwal = $event->tickets[0]->price;
                                                $discount = ($hargaAwal * $event->tickets[0]->discount) / 100;

                                                $hargaDiscount = $hargaAwal - $discount;

                                                $fee_admin = ($hargaDiscount * $event->tickets[0]->fee_admin) / 100;
                                                $tax_coast = ($hargaDiscount * $event->tickets[0]->tax_coast) / 100;

                                                $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                            @endphp
                                            <span class="font-style-italic f-6">Rp.
                                                {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                        @endif

                                    </div>
                                    <div class="card-footer text-white profile d-flex align-items-center justify-content-center"
                                        style="cursor: pointer; height: 70px; background-image: var(--primary-color);">

                                        @php
                                            $organizer = $event->organizer->name;
                                            $words = explode(' ', $organizer);
                                        @endphp
                                        <a href="/auth/organizer/{{ implode('-', $words) }}"
                                            class="fw-lighter text-decoration-none text-white"> <img lazy="loading"
                                                class="d-inline me-1" src="{{ \Storage::url($event->organizer->icon) }}"
                                                alt="icon"
                                                style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">{{ $event->organizer->name }}</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="col item py-3 w-100 d-flex gap-3 flex-column justify-content-center align-items-center">
                            <img lazy="loading" src="{{ asset('user/image/sad.png') }}" alt="icon"
                                style="width: 150px">
                            <p class="fs-5 fw-bold">Event yang anda cari tidak ada!</p>
                        </div>
                    @endif
                </div>

                <div class="my-4 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // search lokasi
            $("#search-city").on("input", function() {
                let value = $(this).val()
                $.ajax({
                    url: '/citySearch',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        valueCity: value
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            let markupCity = ""
                            if (data.length > 0) {
                                data.forEach(item => {
                                    markupCity += `<button value="${item.id}" name="filterCity" class="fs-6 pb-2 input-city d-block"
                                        style="border: none; background: none;">${item.city_name}</button>`
                                })
                            }
                            $(".field-cities").html(markupCity)

                        } else {
                            $(".field-cities").html('<span>Kota tidak ditemukan!</span>')
                        }
                    },
                })
            })

            // format search
            $("#search-format").on("input", function() {
                let value = $(this).val()
                $.ajax({
                    url: "/formatSearch",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        valueFormat: value
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            let markupFormat = ""
                            if (data.length > 0) {
                                data.forEach(item => {
                                    markupFormat += ` <p class="fs-6 pb-2 input-city"
                                        style="border-bottom: 1px solid rgba(0, 0, 0, .2); cursor: pointer;"
                                        data-id="${item.id}">${item.format}</p>`
                                })
                            }
                            $(".field-formats").html(markupFormat)
                        } else {
                            $(".field-formats").html('<span>Format tidak ditemukan!</span>')
                        }
                    }
                })
            })

            // topic search
            $("#search-topic").on("input", function() {
                let value = $(this).val()
                $.ajax({
                    url: "/topicSearch",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        valueTopic: value
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            let markupTopic = ""
                            if (data.length > 0) {
                                data.forEach(item => {
                                    markupTopic += ` <p class="fs-6 pb-2 input-city"
                                        style="border-bottom: 1px solid rgba(0, 0, 0, .2); cursor: pointer;"
                                        data-id="${item.id}">${item.topic}</p>`
                                })
                            }
                            $(".field-topics").html(markupTopic)
                        } else {
                            $(".field-topics").html('<span>Topik tidak ditemukan</span>')
                        }
                    }
                })
            })

            // search event by city
            const cities = Array.from($(".input-city"))

            cities.forEach(city => {
                $(city).on("click", function() {
                    $("#filterCity").val($(this).val())
                    $(".filter-form").submit()
                })

            })

            // reset filter city
            $(".reset-city").on("click", function() {
                $("#filterCity").val(null)
                $(".filter-form").submit()
            })

            // search event by format
            const formats = Array.from($(".input-format"))

            formats.forEach(format => {
                $(format).on("click", function() {
                    $("#filterFormat").val($(this).val())
                    $(".filter-form").submit()
                })

            })

            // reset filter city
            $(".reset-format").on("click", function() {
                $("#filterFormat").val(null)
                $(".filter-form").submit()
            })

            // search event by topic
            const topics = Array.from($(".input-topic"))

            topics.forEach(topic => {
                $(topic).on("click", function() {
                    $("#filterTopic").val($(this).val())
                    $(".filter-form").submit()
                })

            })

            // reset filter topic
            $(".reset-topic").on("click", function() {
                $("#filterTopic").val(null)
                $(".filter-form").submit()
            })

            // search event by time
            const times = Array.from($(".input-time"))

            times.forEach(topic => {
                $(topic).on("click", function() {
                    $("#filterTime").val($(this).val())
                    $(".filter-form").submit()
                })

            })

            // reset filter time
            $(".reset-topic").on("click", function() {
                $("#filterTime").val(null)
                $(".filter-form").submit()
            })

            // search event by type
            const types = Array.from($(".input-type"))

            types.forEach(type => {
                $(type).on("click", function() {
                    $("#filterType").val($(this).val())
                    $(".filter-form").submit()
                })

            })

            // reset filter type
            $(".reset-type").on("click", function() {
                $("#filterType").val(null)
                $(".filter-form").submit()
            })

        })
    </script>
@endsection
