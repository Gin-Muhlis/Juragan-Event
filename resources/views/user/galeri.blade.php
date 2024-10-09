@extends('user.layouts.main')

@section('style')
    <style>
        .btn-outline-danger:hover {
            // override for the checkbox/radio buttons
            color: var(--#{$prefix}btn-color);
            background-image: var(--primary-color);
            border-color: var(--#{$prefix}btn-border-color);
        }

        .custom-loader {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #766DF4;
            animation: s7 .5s infinite alternate;
        }

        .bullet1 {
            animation-delay: .2s
        }

        .bullet2 {
            animation-delay: .4s
        }

        .bullet3 {
            animation-delay: .6s
        }

        .bullet4 {
            animation-delay: .8s
        }

        @keyframes s7 {
            100% {
                transform: translateY(8px)
            }
        }
    </style>
@endsection

@section('container')
    <div class="imgBg w-100 position-relative d-flex align-items-center flex-direction-column text-center justify-content-center"
        style="overflow: hidden; height: 65vh; background: #000000; color: #ffffff;">
        <img lazy="loading" src="{{ asset('user/image/banner_juragan_event.jpg') }}" alt="..." class="d-block w-100"
            style="object-fit: cover; min-height: 100%; filter: opacity(50%);">
        <div class="container w-75 position-absolute ms-md-5">
            <h2 class="p-3 border border-white d-inline-block">Galery Juragan Event</h2>
        </div>
    </div>
    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2 px-md-5 mx-lg-5 justify-content-center field-galery">

            @foreach ($galeries as $item)
                <div class="col p-2">
                    <div class="card">
                        <div class="img" style="height: 300px;">
                            <a href="#">
                                <img lazy="loading" src="{{ \Storage::url($item->image) }}" alt="..."
                                    class="card-img-top" style="height: 100%; object-fit: cover;">
                            </a>
                        </div>
                        <div class="card-body p-3" style="height: 120px">
                            @php
                                $words = explode(' ', $item->description);
                            @endphp
                            <h6 class="fw-bolder" style="color: var(--text-color);">{{ $item->caption }}</h6
                                class="fw-bolder">
                            <p class="text-dark" style="font-size: .8rem">
                                {{ implode(' ', array_slice($words, 0, 20)) }}{{ count($words) > 20 ? '...' : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-none align-items-center justify-content-center gap-1 mt-4 row-animate">
            <div class="custom-loader bullet1"></div>
            <div class="custom-loader bullet2"></div>
            <div class="custom-loader bullet3"></div>
            <div class="custom-loader bullet4"></div>
        </div>
        <button class="btn btn-outline-danger mt-4 mx-auto d-block more-image">Selengkapnya...</button>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let limit = 12
            $(".more-image").on("click", function() {
                $('.row-animate').removeClass('d-none')
                $('.row-animate').addClass('d-flex')
                $.ajax({
                    url: "/moreImage",
                    type: "GET",
                    data: {
                        limit: limit,
                    },
                    success: function(data) {
                        console.log(data)
                        let html = ""
                        data.forEach(item => {
                            html += ` <div class="col p-2">
                                    <div class="card">
                                        <div class="img" style="height: 300px;">
                                                <img lazy="loading" src="${item['image']}" alt="..." class="card-img-top"
                                                    style="height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="card-body p-3" style="height: 120px">
                                        
                                            <h6 class="fw-bolder text-danger">${item['caption']}</h6 class="fw-bolder">
                                            <p class="text-dark" style="font-size: .8rem">
                                                ${item['description']}
                                            </p>
                                        </div>
                                    </div>
                            </div>`
                        })
                        $('.row-animate').removeClass('d-flex')
                        $('.row-animate').addClass('d-none')
                        $(".field-galery").html(html)
                        limit += 6
                    }
                })
            })
        })
    </script>
@endsection
