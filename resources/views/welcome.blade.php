@extends('user.layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('user/css/home.css') }}">
    <style>
        .owl-dots,
        .owl-nav {
            display: none;
        }

        .wrapper-image-category {
            max-width: 1200px;
        }

        .carousel-image-category {
            overflow: hidden;
            white-space: nowrap;
            font-size: 0;
        }

        .carousel-image-category .images {
            display: inline-block;
            width: calc(100% / 4);
            overflow: hidden;
            padding: 7px;
        }

        .images a {
            display: inline-block;
            width: 100%;
        }

        .carousel-image-category a img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-image-category a:first-child {
            margin-left: 0;
        }
    </style>
@endsection

@section('carousel')
    {{-- Carousel Slider --}}
    <div class="carousel slide carousel-fade hero" id="carouselExampleIndicators" data-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">

            @foreach ($carouselEvent as $item)
                <div class="carousel-item {{ $loop->index === 0 ? 'active' : '' }}">
                    <img lazy="loading" src="{{ \Storage::url($item->banner) }}" class="d-block w-100" alt="...">
                    <div class="carousel-container container text-center px-5">
                        <h1 class="fw-bold mb-4">{{ $item->title }}</h1>
                        <a href="event/detail/{{ $item->slug }}"
                            class="btn border border-white px-3 py-2 fw-bold text-white fs-6">
                            Lihat Event
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Mitra Juragan --}}
    <div class="content w-100 py-5"
        style=" background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% );">
        <div class="container text-center text-white">
            <div class="row owl-carousel owl-theme" id="mitra">
                @foreach ($partners as $partner)
                    <div class="col mitra item">
                        <img lazy="loading" src="{{ \Storage::url($partner->icon) }}" alt="img1">
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('container')
    {{-- Kategori Pilihan --}}
    <div class="container mt-4 text-white rounded-4 py-4 px-5 kategoriPilihan"
        style=" background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% );">
        <h4 class="mb-3 title-choiced-category">Kategori Pilihan</h4>
        <div class="wrapper-image-category">
            <div class="carousel-image-category">
                @foreach ($eventCategories as $event)
                    <div class="images">
                        <a href="/event/detail/{{ $event->slug }}">
                            <img lazy="loading" src="{{ \Storage::url($event->banner) }}" alt="banner" class="d-blok">
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="row mt-2">
            <div class="col mt-lg-3 owl-carousel owl-theme" id="category">

                @foreach ($choicedCategory as $category)
                    <div class="item">
                        <span data-id="{{ $category->id }}"
                            class="btn btn-outline-light rounded-2 d-flex align-items-center py-1 px-2 kategori button-category"
                            style="width: 99%;">
                            @php
                                $words = explode(', ', $category->format);
                            @endphp
                            <span
                                class="fs-6">{{ implode(', ', array_slice($words, 0, 3)) }}{{ count($words) > 3 ? '...' : '' }}</span>
                            </sp>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- List Event Terdekat --}}
    @if (count($weekEvents) > 0)
        <div class="container mt-5">
            <div class="judul d-flex justify-content-between">
                <h4 class="fw-bold">Event Di <span style="color: rgba(252,37,103,1);">Minggu ini</span></h4>
                <a href="{{ route('events') }}" class="text-decoration-none" style="color: rgba(252,37,103,1);">Lihat
                    Semua</a>
            </div>
            <div class="row rounded-5 text-center mt-3 owl-carousel owl-theme" id="evenTerdekat">

                @foreach ($weekEvents as $event)
                    <div class="col item rounded-4" style="overflow: hidden;">
                        <div class="card">
                            <a href="/event/detail/{{ $event['slug'] }}">
                                <img src="{{ \Storage::url($event['banner']) }}" class="card-img-top" alt="..."
                                    style="height: 170px; object-fit: cover;">
                            </a>
                            <div class="card-body text-white"
                                style="height: 130px;  background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% );;">
                                @php
                                    $words = explode(' ', $event['title']);
                                @endphp
                                <h6 class="card-title fw-bold">
                                    {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}</h6>
                                <p class="card-text" style="font-size: .9em;">{{ $event['date'] }}</p>
                                @if ($event['tickets'][0]->type === 'gratis')
                                    <span class="font-style-italic f-6">Gratis</span>
                                @endif
                                @if ($event['tickets'][0]->type === 'berbayar')
                                    @php
                                        $hargaAwal = $event['tickets'][0]->price;
                                        $discount = ($hargaAwal * $event['tickets'][0]->discount) / 100;
                                        
                                        $hargaDiscount = $hargaAwal - $discount;
                                        
                                        $fee_admin = ($hargaDiscount * $event['tickets'][0]->fee_admin) / 100;
                                        $tax_coast = ($hargaDiscount * $event['tickets'][0]->tax_coast) / 100;
                                        
                                        $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                    @endphp
                                    <span class="font-style-italic f-6">Rp.
                                        {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                @endif
                                @if ($event['tickets'][0]->type === 'bayar sesukamu')
                                    <span class="font-style-italic f-6">Rp.
                                        {{ number_format($event['tickets'][0]->min_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="card-footer text-white profile d-flex align-items-center justify-content-center"
                                style="cursor: pointer; height: 70px;  background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% );;">
                                @php
                                    $organizer = $event['organizer'];
                                    $words = explode(' ', $organizer);
                                @endphp
                                <a href="/auth/organizer/{{ implode('-', $words) }}"
                                    class="fw-lighter text-decoration-none text-white"> <img lazy="loading"
                                        class="d-inline me-1" src="{{ \Storage::url($event['icon_organizer']) }}"
                                        alt="icon"
                                        style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">{{ $event['organizer'] }}</a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif

    {{-- Slider Image --}}
    <div class="container mt-5">
        <div id="carouselExampleSlidesOnly" class="carousel slide rounded-5" data-bs-ride="carousel"
            style="overflow: hidden; height: 22rem">
            <div class="carousel-inner imgSlider">

                @foreach ($carouselEvent as $item)
                    <div class="carousel-item {{ $loop->index === 0 ? 'active' : '' }}" data-bs-interval="6000">
                        <a href="/event/detail/{{ $item->slug }}">
                            <img lazy="loading" src="{{ \Storage::url($item->banner) }}" class="d-block w-100"
                                alt="image Slider" style="object-fit: cover">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Berita Dan Blog --}}
    <div class="container mt-5">
        <div class="judul d-flex justify-content-between">
            <h4 class="fw-bold">Berita Dan Blog</h4>
            <a href="/blog" class="text-danger text-decoration-none" style="color: rgba(252,37,103,1);">Lihat Semua</a>
        </div>
        <div class="row mt-3 owl-carousel owl-theme blog" id="blog">

            @foreach ($posts as $post)
                <div class="col item rounded-4 shadow-sm" style="overflow: hidden;">
                    <a href="/blog/detailBlog/{{ $post->slug }}">
                        <img lazy="loading" src="{{ \Storage::url($post->image) }}" class="card-img-top" alt="..."
                            style="height: 200px;">
                    </a>
                    <div class="card-body bg-lightp-3 mt-1 mx-3" style="height: 200px;">
                        @php
                            $words = explode(' ', $post->title);
                        @endphp
                        <h6 class="card-title fw-bolder lh-base" style="color: rgba(252,37,103,1);">
                            {{ implode(' ', array_slice($words, 0, 5)) }}{{ count($words) > 5 ? '...' : '' }}
                        </h6>
                        <p class="card-text text-dark text-card-event mt-3">
                            {{ substr(strip_tags($post->content), 0, 100) }}...</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if ($errors->any())
        @component('components.user.error', ['message' => $errors->first()])
        @endcomponent
    @endif
@endsection

@section('script')
    {{-- Jquery cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Owl Carousel Min .js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            let isDraggable = false,
                pageX, prevScrollLeft;

            $(".carousel-image-category").on("mousedown", function(e) {
                isDraggable = true;
                e.preventDefault();
                pageX = e.pageX;
                prevScrollLeft = $(".carousel-image-category").scrollLeft();
                $(".carousel-image-category").css("cursor", "grab");
            });

            $(".carousel-image-category").on("mousemove", function(e) {
                if (!isDraggable) return;
                e.preventDefault();
                let positionDiff = pageX - e.pageX;
                let newScrollLeft = prevScrollLeft + positionDiff;
                let carouselWidth = $(".carousel-image-category").width();
                let scrollWidth = $(".carousel-image-category")[0].scrollWidth;

                $(".carousel-image-category").css("cursor", "grabbing");

                if (newScrollLeft >= scrollWidth - carouselWidth || newScrollLeft <= 0) {
                    isDraggable = false;
                    $(".carousel-image-category").css("cursor", "default");
                    console.log(newScrollLeft);
                } else {
                    $(".carousel-image-category").scrollLeft(newScrollLeft);
                }
            });


            $(".carousel-image-category").on("mouseup", function() {
                $(".carousel-image-category").css("cursor", "default");
                isDraggable = false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let categories = Array.from($(".button-category"))
            categories.forEach(category => {
                $(category).on("click", function() {
                    let id = $(this).data("id");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/event/category',
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            let markup = ""
                            data.forEach(item => {
                                markup += `<div class="images">
                                            <a href="/event/detail/${item['slug']}">
                                                <img lazy="loading" src="${item['banner']}" alt="banner" class="d-blok">
                                            </a>
                                        </div>`;

                                $(".carousel-image-category").html(markup)
                            })
                        }
                    })
                })
            })
        })
    </script>

    <script>
        $('#mitra').owlCarousel({
            margin: 70,
            loop: false,
            autoWidth: true,
            items: 1
        });

        $('#image-category').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#category').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#evenTerdekat').owlCarousel({
            loop: false,
            margin: 15,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#blog').owlCarousel({
            loop: false,
            margin: 15,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
@endsection
