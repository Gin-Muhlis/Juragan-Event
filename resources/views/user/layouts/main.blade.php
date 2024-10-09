<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Owl Carousel Min .css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

    {{-- Owl Carousel Theme Min .css --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- icon --}}
    <link rel="icon" href="{{ asset('user/image/icon.png') }}">

    <style>
        :root {
            --primary-color: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);
            --text-color: rgba(252, 37, 103, 1);
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .width-search-navbar {
            width: 100%;
        }

        .input-search::placeholder {
            color: #ffffff80
        }

        @media (min-width: 992px) {
            .width-search-navbar {
                width: 25%;
            }
        }

        @media (min-width: 1220px) {
            .width-search-navbar {
                width: 35%;
            }
        }
    </style>
    @yield('style')

</head>

<body>
    {{-- @component('components.user.navbar-component', ['tittle' => $tittle, 'data' => $dataWebsite])
    @endcomponent --}}
    @include('user.partials.navbar')
    @yield('carousel')

    @yield('container')

    @include('user.partials.footer')

    @yield('script')


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            let valueSearch = ""
            // DOM input search
            $(".input-search").focus(function() {
                $(this).closest("form").css({
                    "box-shadow": "0 0 0 100vmax rgba(0,0,0,.5)",
                })
            })
            $(".input-search").blur(function() {
                $(this).closest("form").css({
                    "box-shadow": "0 0 0 0 rgba(0,0,0)",

                })
                setTimeout(() => {
                    $(".field-event-search").addClass("d-none")

                }, 300);
            })
            $(".input-search").on("input", function() {

                // manipulasi field event search
                if ($(this).val().length > 0) {
                    $(".field-event-search").removeClass("d-none")
                } else {
                    $(".field-event-search").addClass("d-none")
                }

                // ajax untuk search
                valueSearch = $(this).val()
                $.ajax({
                    url: '/eventSearch',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        valueSearch: valueSearch
                    },
                    success: function(data) {
                        console.log(data)
                        let markup = ""
                        data.forEach(item => {
                            markup += ` <div class="col mb-3">
                            <div class="row">
                                <div class="col-4" style="padding: 0">
                                    <a href="/event/detail/${item['identifier']}" class="cursor-pointer">
                                        <img src="${item['banner']}" class="rounded" alt="banner"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </div>
                                <div class="col-8 d-flex flex-column gap-1">
                                    <span class="fw-bold" style="font-size: .85em">${item['title']}</span>
                                    <span class="font-weight-lighter" style="font-size: .7em">${item['organizer']}
                                    </span>
                                </div>
                            </div>
                        </div>`

                            $(".field-events").html(markup)
                        })
                    },
                    error: function(data) {
                        $(".field-events").html(
                            `<p style="font-size: .8em">Event tidak ditemukan!</p>`)
                    }
                })
            })


        })
    </script>

</body>

</html>
