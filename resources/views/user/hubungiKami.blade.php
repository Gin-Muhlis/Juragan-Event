@extends('user.layouts.main')

@section('style')
    <style>
        .btn-danger {
            background-image: var(--primary-color);
        }

        .btn-danger:hover {
            filter: brightness(95%);
        }

        .btn-send-contact {
            background-image: var(--primary-color);
            padding: 4px;
            width: 100px;
            height: 40px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
            border: none;
        }

        .btn-send-contact .loader {
            width: 22px;
            height: 22px;
            border: 3px solid transparent;
            border-radius: 50%;
            border-top-color: #fff;
            animation: loader 1s infinite
        }

        @keyframes loader {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }

        .error-popup {
            padding: 25px;
            background: #DC3545;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            color: #fff;
            font-size: 1em;
            position: fixed;
            right: 20px;
            bottom: 20px;
        }

        .success-popup {
            padding: 25px;
            background: #198754;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            color: #fff;
            font-size: 1em;
            position: fixed;
            right: 20px;
            bottom: 20px;
        }
    </style>
@endsection


@section('container')
    <div class="imgBg w-100 position-relative d-flex align-items-center flex-direction-column"
        style="overflow: hidden; height: 45vh; background: #000000; color: #ffffff;">
        <img lazy="loading" src="{{ \Storage::url($data->banner_website) }}" alt="..." class="d-block w-100"
            style="object-fit: cover; min-height: 100%; filter: opacity(50%);">
        <div class="container position-absolute ms-5">
            <h1>Hubungi Kami</h1>
            <p class="w-75">{!! $data->contact_description !!}</p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <iframe src="https://maps.google.com/maps?q={{ $data->coordinate }}&hl=es;z=14&amp;output=embed"
                    style="width: 100%; height: 225px;"></iframe>
                <div class="mt-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-geo-alt-fill"></i>
                        <a href="https://www.google.com/maps?q={{ $data->coordinate }}" target="_blank"
                            class="text-decoration-none text-dark">{{ substr($data->address, 0, 50) }}</a>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-envelope-fill"></i>
                        <span>{{ $data->email }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-telephone-fill"></i>
                        <span>{{ $data->phone_number }}</span>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <form action="{{ route('contact.send') }}" method="POST" class="form-contact">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-sm">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="3" name="message" required></textarea>
                    </div>
                    <div class="mb-3">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="mb-3 w-100 d-flex justify-content-end">
                        <button type="button" class="btn-send-contact">
                            <span class="loader d-none"></span>
                            <span class="text-btn text-white">Kirim</span>
                        </button>
                    </div>
                </form>
                <div class="row row-alert mt-3">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-message p-3" role="alert">
                                <p class="mb-0" style="font-size: 1em">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-message p-3" role="alert">
                            <p class="mb-0" style="font-size: 1em">{{ session('success') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row-alert-captcha">

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let btn = $(".btn-send-contact")
            $(btn).on("click", () => {
                let captcha = $("#g-recaptcha-response").val()

                if (!captcha) {
                    let markupErrorCaptcha = `<div class="error-popup" style="z-index: 999;">
                                                Harap centang Captcha jika anda bukan robot!
                                            </div>`
                    $(".row-alert-captcha").html(markupErrorCaptcha)
                    setTimeout(() => {
                        $('.error-popup').fadeOut();
                    }, 3000);

                    return false
                }
                sendContactForm(captcha);
            })
        })

        function sendContactForm(captchaValue) {
            $(".loader").removeClass("d-none")
            $(".text-btn").addClass("d-none")

            let name = $("#name").val()
            let email = $("#email").val()
            let message = $("#message").val();
            let captcha = captchaValue

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: "/contactSend",
                type: "POST",
                data: {
                    "name": name,
                    "email": email,
                    "message": message,
                    "g-recaptcha-response": captcha
                },
                success: function(data) {
                    $(".loader").addClass("d-none")
                    $(".text-btn").removeClass("d-none")

                    $("#name").val(null)
                    $("#email").val(null)
                    $("#message").val(null);
                    $("#g-recaptcha-response").val(null)
                    grecaptcha.reset();

                    let markupSuccess = `<div class="success-popup">
                                        ${data.message}
                                    </div>`
                    $(".row-alert-captcha").html(markupSuccess)
                    setTimeout(() => {
                        $('.success-popup').fadeOut();
                    }, 3000);
                    return true
                },
                error: function(xhr) {
                    $(".loader").addClass("d-none")
                    $(".text-btn").removeClass("d-none")

                    let err = JSON.parse(xhr.responseText)

                    if (err.errors.name) {
                        let markupError = `<div class="error-popup" style="z-index: 999;">
                                            ${err.errors.name[0]}
                                        </div>`
                        $(".row-alert-captcha").html(markupError)
                        setTimeout(() => {
                            $('.error-popup').fadeOut();
                        }, 3000);
                        return true
                    }

                    if (err.errors.email) {
                        let markupError = `<div class="error-popup" style="z-index: 999;">
                                            ${err.errors.email[0]}
                                        </div>`
                        $(".row-alert-captcha").html(markupError)
                        setTimeout(() => {
                            $('.error-popup').fadeOut();
                        }, 3000);
                        return true
                    }

                    if (err.errors.message) {
                        let markupError = `<div class="error-popup" style="z-index: 999;">
                                            ${err.errors.email[0]}
                                        </div>`
                        $(".row-alert-captcha").html(markupError)
                        setTimeout(() => {
                            $('.error-popup').fadeOut();
                        }, 3000);
                        return true
                    }


                }
            })
        }
    </script>
    <script>
        const alert = Array.from(document.querySelectorAll(".alert-message"))
        const rowAlert = document.querySelector('.row-alert')


        if (alert.length > 0) {
            for (let i = 1; i <= alert.length; i++) {
                setTimeout(() => {
                    let childAlert = document.querySelector(".alert-message")
                    rowAlert.removeChild(childAlert)
                }, 10000);
            }
        }
    </script>
@endsection
