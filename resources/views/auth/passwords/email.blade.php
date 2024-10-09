 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

     <title>Juragan Event | reset</title>

 </head>

 <body>

     <div class="container my-5">
         <div class="row justify-content-center">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-header">{{ __('Reset Password') }}</div>

                     <div class="card-body">
                         @if (session('status'))
                             <div class="alert alert-success" role="alert">
                                 {{ session('status') }}
                             </div>
                         @endif

                         <form method="POST" action="{{ route('password.email') }}">
                             @csrf

                             <div class="row mb-3">
                                 <label for="email"
                                     class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                 <div class="col-md-6">
                                     <input id="email" type="email"
                                         class="form-control @error('email') is-invalid @enderror" name="email"
                                         value="{{ old('email') }}" required autocomplete="email" autofocus>

                                     @error('email')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                             </div>

                             <div class="row mb-0">
                                 <div class="col-md-6 offset-md-4">
                                     <button type="submit" class="btn btn-danger">
                                         {{ __('Kirim link reset kata sandi') }}
                                     </button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
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
 </body>

 </html>
