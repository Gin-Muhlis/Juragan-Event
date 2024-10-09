<style>
    .dropdown-toggle::after {
        display: none;
    }

    .keluar:hover {
        color: #dc3545;
    }

    .btn-go-profile {
        cursor: pointer;
    }
</style>
{{-- background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% ); --}}
<nav class="navbar navbar-expand-lg navbar-dark py-3 sticky-top shadow" style=" background-image: var(--primary-color);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><img lazy="loading" style="width: 200px;"
                src="{{ \Storage::url($dataWebsite->logo_website) }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link fs-6 {{ $tittle === 'Event' ? 'active' : '' }}" href="/event">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 {{ $tittle === 'Tentang' ? 'active' : '' }}" href="/tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 {{ $tittle === 'Galeri' ? 'active' : '' }}" href="/galeri">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 {{ $tittle === 'Blog' ? 'active' : '' }}" href="/blog">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 {{ $tittle === 'Hubungi Kami' ? 'active' : '' }}"
                        href="/hubungiKami">Hubungi
                        Kami</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link fs-6 {{ $tittle === 'Hubungi Kami' ? 'active' : '' }}"
                        href="/auth/account">Profile</a>
                </li>
            </ul>
            <form class="d-flex width-search-navbar mb-3 mb-lg-0 position-relative" role="search" method="GET"
                action="{{ route('events.filter') }}">
                <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control text-light input-search"
                        placeholder="Cari event disini..."
                        style="border-radius: 5px 0 0 5px; background: none; font-size: .8em" name="keyword"
                        value="{{ old('keyword') }}">
                    <button class="btn btn-light pe-3" type="submit" id="button-addon2"
                        style="border-radius: 0 5px 5px 0; font-size: .8em">Cari</button>
                </div>

                <div class="row row-cols-1 bg-white rounded p-2 d-none field-event-search"
                    style="position: absolute; left: 10px; top: 0; width: 100%;  transform-origin: top; transform: translateY(50px); max-height: 50vh; overflow-y: scroll;">
                    <div class="row row-cols-1 field-events" style="max-height: 50vh; z-index: 999999;">

                    </div>
                </div>
            </form>


            @auth
                @php
                    $imageProfile = '';
                    if (is_null(auth()->user()->image)) {
                        $imageProfile = \Storage::url('public/default.jpg');
                    } elseif (\Str::contains(auth()->user()->image, 'https://graph.facebook.com') || \Str::contains(auth()->user()->image, 'https://lh3.googleusercontent.com')) {
                        $imageProfile = auth()->user()->image;
                    } else {
                        $imageProfile = \Storage::url(auth()->user()->image);
                    }
                    
                @endphp
                <div class="dropdown d-lg-block d-none">
                    <a class="btn btn-secondary dropdown-toggle p-0 ms-lg-3 rounded-circle border border-2" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="width: 40px; height: 40px; background-color: transparent; overflow: hidden;">

                        <img lazy="loading" src="{{ $imageProfile }}" alt="profile"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg-end px-3">
                        <div class="d-flex align-items-center dropdown-item px-0 rounded-3">

                            <img lazy="loading" src="{{ $imageProfile }}" alt="profile"
                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 1px solid #DE4251;"
                                class="me-2">

                            <div class="d-flex flex-column justify-content-center">

                                <p class="mb-0" style="font-size: .9em;">{{ auth()->user()->name }}</p>
                                <a href="{{ route('profile.index') }}"
                                    class="mb-0 text-decoration-none text-danger btn-go-profile"
                                    style="font-size: .8em;">Lihat detail</a>
                            </div>

                            <a href="{{ route('profile.index') }}"
                                class="mb-0 text-decoration-none text-danger btn-go-profile" style="font-size: .8em;"><i
                                    class="bi bi-chevron-right px-3"></i></a>
                        </div>
                        <a href="{{ route('transaction.index') }}"
                            class="keluar d-flex justify-content-start align-items-center dropdown-item px-0 rounded-3 mt-1">
                            <i class="bi bi-wallet px-2" style="font-size: .9em"></i>
                            <p class="mb-0" style="font-size: .9em">Transaksi saya</p>
                        </a>
                        <a href="{{ route('logout') }}"
                            class="keluar d-flex justify-content-start align-items-center dropdown-item px-0 rounded-3 mt-1"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left px-2" style="font-size: .9em"></i>
                            <p class="mb-0" style="font-size: .9em">Keluar</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            @else
                <a href="{{ route('user.login') }}"
                    class="btn btn-outline-light ms-lg-3 rounded px-3 text-decoration-none"
                    style="font-size: .8em">Login</a>
                <a href="{{ route('user.register') }}" class="btn btn-light ms-lg-2 rounded px-3 text-decoration-none"
                    style="font-size: .8em">Daftar</a>
            @endauth
        </div>
    </div>

</nav>
