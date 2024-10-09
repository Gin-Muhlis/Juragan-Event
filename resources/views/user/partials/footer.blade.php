<footer class="mt-5"
    style=" background-image: radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% );">
    <div class="container text-white pt-5 pb-2">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <img lazy="loading" src="{{ \Storage::url($dataWebsite->logo_website) }}" alt="logo">
            </div>
            <div class="col-md-3">
                <h6 class="mb-3">Tentang Juragan</h6>
                <div style="font-size:
                    .8em;">
                    {{ substr(strip_tags($dataWebsite->long_description), 0, 175) }}
                </div>
            </div>
            <div class="col-md-3">
                <ul style="list-style-type: none">
                    <h6 class="mb-3">Menu Juragan</h6>
                    <li><a href="{{ route('user.login') }}" class="text-decoration-none text-white"
                            style="font-size:
                    .8em">Masuk</a> </li>
                    <li><a href="{{ route('events') }}" class="text-decoration-none text-white"
                            style="font-size:
                    .8em">Lihat Event</a> </li>
                    <li><a href="{{ route('galeri.index') }}" class="text-decoration-none text-white"
                            style="font-size:
                    .8em">Galery</a> </li>
                    <li><a href="{{ route('blog') }}" class="text-decoration-none text-white"
                            style="font-size:
                    .8em">Blog dan Berita</a> </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="mb-3">Ikuti Kami Di :</h6>
                <div class="d-flex">
                    <a href="{{ $dataWebsite->link_instagram }}" class="text-white fs-5"><i
                            class="me-3 bi bi-instagram"></i></a>
                    <a href="{{ $dataWebsite->link_twitter }}" class="text-white fs-5"><i
                            class="mx-3 bi bi-twitter"></i></a>
                    <a href="{{ $dataWebsite->link_fb }}" class="text-white fs-5"><i
                            class="mx-3 bi bi-facebook"></i></a>
                    <a href="{{ $dataWebsite->link_youtube }}" class="text-white fs-5"><i
                            class="mx-3 bi bi-youtube"></i></a>
                </div>
            </div>

        </div>
        <hr class="my-4">
        <div class="row mt-3 justify-content-center">
            <p class="text-center">&copy; {{ $dataWebsite->copyright_text }}</p>
        </div>
    </div>
</footer>
