<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! SEO::generate() !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

        .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Button Masuk */
        .btn-danger {
            background-image: var(--primary-color);
        }

        .btn-danger:hover {
            filter: brightness(95%);
        }

        /* Button Google & Facebook  */
        .btn-outline-danger {
            color: var(--text-color);
        }

        .btn-outline-danger:hover {
            // override for the checkbox/radio buttons
            color: var(--#{$prefix}btn-color);
            background-image: var(--primary-color);
            border-color: var(--#{$prefix}btn-border-color);
        }
    </style>


</head>

<body>

    <div class="container-fluid px-lg-4 px-3 text-center pt-4"
        style="height: 20em; background-image: var(--primary-color);">
        <div class="position-absolute" style="left: 40px; top: 20px">
            <a href="/" class="text-white"><i class="bi bi-arrow-left-circle fs-2"></i></a>
        </div>
        <h2 class="text-light fw-semibold">JURAGAN <span>EVENT</span></h2>
        <div class="row px-0 bg-light rounded shadow m-3 overflow-hidden">
            <div class="col-6 d-md-block d-none px-0">
                <img lazy="loading" src="{{ \Storage::url($data->banner_website) }}" alt="image" class="img-fluid"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="col p-md-4 p-3">
                <div class="container w-md-75 text-start px-md-4 p-2">
                    <h3>Daftar akun</h3>
                    <form method="POST" action="{{ route('register') }}" class="my-4" id="form-daftar">
                        @csrf
                        <div class="mb-3">
                            {{-- <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="Nama Lengkap"> --}}
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" placeholder="Nama Lengkap"
                                autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {{-- <input type="email" class="form-control" id="formGroupExampleInput" placeholder="Email"> --}}
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {{-- <input type="email" class="form-control" id="formGroupExampleInput" placeholder="Email"> --}}
                            <input id="phone_number" type="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') }}" required autocomplete="phone_number"
                                placeholder="No Telepon">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- <input type="password" class="form-control" id="formGroupExampleInput2"
                                placeholder="Password"> --}}
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Kata sandi">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- <input type="password" class="form-control" id="formGroupExampleInput2"
                                placeholder="Konfirmasi Password"> --}}
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Konfirmasi kata sandi">
                        </div>
                        <div class="row mt-3">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="alert-daftar-captcha d-none">
                            <p class="text-danger fw-bold my-1" style="font-size: .9em">Captcha required!</p>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="button" class="btn btn-danger daftar-btn">Daftar</button>
                        </div>
                    </form>
                    <p class="text-center">Suda punya akun? <a href="{{ route('user.login') }}"
                            class="text-danger">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            let btn = $(".daftar-btn")
            $(btn).on("click", () => {
                let captcha = $("#g-recaptcha-response").val()

                if (!captcha) {
                    let alertCaptcha = $(".alert-daftar-captcha")
                    alertCaptcha.removeClass("d-none")

                    setTimeout(() => {
                        alertCaptcha.addClass("d-none")
                    }, 2500)

                    return false
                }
                $("#form-daftar").submit();
            })
        })
    </script>
</body>

</html>
