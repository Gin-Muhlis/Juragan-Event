<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! SEO::generate() !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Bootsrapt --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="icon" href="{{ asset('user/image/icon.png') }}">

    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --primary-color: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);
            --text-color: rgba(252, 37, 103, 1);
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
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
    <div class="container-fluid bg-danger position-absolute"
        style="height: 20em; background-image: var(--primary-color);">
        <div class="position-absolute" style="left: 30px; top: 25px">
            <a href="/" class="text-white"><i class="bi bi-arrow-left-circle fs-2"></i></a>
        </div>
        <h2 class="text-light fw-semibold my-4 text-center">JURAGAN <span>EVENT</span></h2>
        <div class="row px-0 bg-light rounded shadow m-3 overflow-hidden">
            <div class="col p-md-4 p-3 d-flex flex-column justify-content-center">
                @php
                    $imageProfile = '';
                    if (is_null($user->image)) {
                        $imageProfile = \Storage::url('public/default.jpg');
                    } elseif (\Str::contains($user->image, 'https://graph.facebook.com/') || \Str::contains($user->image, 'https://lh3.googleusercontent.com/')) {
                        $imageProfile = $user->image;
                    } else {
                        $imageProfile = \Storage::url($user->image);
                    }
                @endphp
                <img lazy="loading" src="{{ $imageProfile }}" alt="profile"
                    style="width: 90px; height: 90px; border-radius: 50%; border: 1px solid #DC3545; object-fit: cover;"
                    class="d-blog m-auto mb-3">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" readonly value="{{ $user->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" readonly value="{{ $user->email }}" disabled>
                    </div>
                    @if (is_null($user->google_id) && is_null($user->facebook_id))
                        <div class="mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text" class="form-control" readonly value="{{ $user->phone_number }}"
                                disabled>
                        </div>
                    @endif
                </div>
                @if (is_null($user->google_id && is_null($user->facebook_id)) && $user->id === Auth::user()->id)
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editModal"
                            class="btn btn-danger">Edit</button>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#passwordModal"
                            class="btn btn-outline-danger">Perbarui
                            Password</button>
                    </div>
                @endif


                <div class="row mt-3 row-alert">


                </div>
            </div>
            <div class="col-6 d-lg-block d-none px-0">
                <img lazy="loading" src="{{ asset('user/image/banner_juragan_event.jpg') }}" alt="image"
                    class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
    @if ($errors->any())
        @component('components.user.error', ['message' => $errors->first()])
        @endcomponent
    @endif

    @if (session()->has('success'))
        @component('components.user.success', ['message' => session('success')])
        @endcomponent
    @endif

    <!-- Edit Modal -->
    @php $editing = isset($user) @endphp
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group col-sm-12 mb-3">
                            <label for="name">Nama</label>
                            <input class="form-control" type="text" name="name" id="name" label="Name"
                                value="{{ old('name', $editing ? $user->name : '') }}" maxlength="255"
                                placeholder="Name" required></input>
                        </div>

                        <div class="form-group col-sm-12 mb-3">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" label="Email"
                                value="{{ old('email', $editing ? $user->email : '') }}" maxlength="255"
                                placeholder="Email" required></input>
                        </div>

                        <div class="form-group col-sm-12 mb-3">
                            <label for="phone_number">No. telepon</label>
                            <input class="form-control" type="number" name="phone_number" id="phone_number"
                                label="Phone Number"
                                value="{{ old('phone_number', $editing ? $user->phone_number : '') }}"
                                placeholder="Phone Number" required></input>
                        </div>

                        <div class="form-group col-sm-12 mb-3">
                            @php
                                $imageProfile = '';
                                if (is_null($user->image)) {
                                    $imageProfile = \Storage::url('public/default.jpg');
                                } elseif (\Str::contains($user->image, 'https://graph.facebook.com/') || \Str::contains($user->image, 'https://lh3.googleusercontent.com/')) {
                                    $imageProfile = $user->image;
                                } else {
                                    $imageProfile = \Storage::url($user->image);
                                }
                            @endphp
                            <div x-data="imageViewer('{{ $editing && $imageProfile ? $imageProfile : '' }}')">
                                <label name="image" label="Image"></label><br />

                                <!-- Show the image -->
                                <template x-if="imageUrl">
                                    <img lazy="loading" :src="imageUrl"
                                        class="object-cover rounded border border-gray-200"
                                        style="width: 100px; height: 100px;" />
                                </template>

                                <!-- Show the gray box when image is not available -->
                                <template x-if="!imageUrl">
                                    <div class="border rounded border-gray-200 bg-gray-100"
                                        style="width: 100px; height: 100px;"></div>
                                </template>

                                <div class="mt-2">
                                    <input class="form-control" type="file" name="image" id="image"
                                        @change="fileChosen" />
                                </div>

                                @error('image')
                                    @include('components.inputs.partials.error')
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger float-right">
                            <i class="icon ion-md-save"></i>
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Password Modal -->
    <div class="modal fade" id="passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordModalLabel">Ganti Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.password.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="recipient-name" class="col-form-label">Password Lama</label>
                            <input type="password" class="form-control" name="old_password">
                        </div>
                        <div class="mb-1">
                            <label for="recipient-name" class="col-form-label">Password Baru</label>
                            <input type="password" class="form-control" name="new_password">
                        </div>
                        <div class="mb-1">
                            <label for="recipient-name" class="col-form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="new_password_confirmation">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Perbarui</button>
                    </div>
                </form>
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
        /* Simple Alpine Image Viewer */
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageViewer', (src = '') => {
                return {
                    imageUrl: src,

                    refreshUrl() {
                        this.imageUrl = this.$el.getAttribute("image-url")
                    },

                    fileChosen(event) {
                        this.fileToDataUrl(event, src => this.imageUrl = src)
                    },

                    fileToDataUrl(event, callback) {
                        if (!event.target.files.length) return

                        let file = event.target.files[0],
                            reader = new FileReader()

                        reader.readAsDataURL(file)
                        reader.onload = e => callback(e.target.result)
                    },
                }
            })
        })
    </script>

    <script>
        const alert = Array.from(document.querySelectorAll(".alert-message"))
        const rowAlert = document.querySelector('.row-alert')

        if (alert.length > 0) {
            for (let i = 1; i <= alert.length; i++) {
                setTimeout(() => {
                    let childAlert = document.querySelector(".alert-message")
                    rowAlert.removeChild(childAlert)
                }, 5000);
            }
        }
    </script>

</body>

</html>
