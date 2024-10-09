@extends('user.layouts.main')

@section('container')
    <div class="container">
        <img lazy="loading" src="{{ \Storage::url($post->image) }}" alt="..." class="img-fluit mt-4 rounded-5"
            style="width: 100%; height: 18rem; object-fit: cover;">
        <div class="m-4">
            <div class="content ms-5 ps-3">
                <h3>{{ $post->title }}</h3>
                <p class="card-text"><small
                        class="text-muted">{{ substr($post->created_at, 8, 2) . ' ' . $bulan[substr($post->created_at, 5, 2)] }}
                        - Penulis {{ $post->user->name }}</small></p>
                <div>
                    {!! $post->content !!}
                </div>
                <div class="profile pt-4 d-flex" style="border-top: 1px solid #00000044; cursor: pointer;">
                    <img lazy="loading"
                        src="{{ $post->user->image_profile ? \Storage::url($post->user->image_profile) : \Storage::url('public/default.jpg') }}"
                        alt="" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                    <div class="desc ms-3 pt-2">
                        <h5 style="line-height: 10px;">{{ $post->user->name }}</h5>
                        <p class="card-text"><small class="text-muted">Sang Creator JURAGAN</small></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Artikel Lainnya --}}
        <div class="container mt-5">
            <h4 class="mb-4 border-danger" style="border-left: 3px solid;">&nbsp;Artikel Lainnya</h4>
            <div class="owl-carousel owl-theme blog" id="blog">
                @foreach ($anotherPosts as $post)
                    <div class="card">

                        <div class="row g-0">
                            <div class="col-md-5">
                                <a href="{{ route('blog.detail', $post->slug) }}">
                                    <img lazy="loading" src="{{ \Storage::url($post->image) }}"
                                        class="img-fluid rounded-start" alt="..."
                                        style="height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-md-7 h-100">
                                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px">
                                    <?php
                                    $words = str_word_count($post->title, 1);
                                    ?>
                                    <h5 class="card-title">
                                        {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}
                                    </h5>
                                    <p class="card-text">{{ substr(strip_tags($post->content), 0, 50) }}...</p>
                                    <div class="footer d-flex justify-content-between">
                                        <p class="card-text"><small
                                                class="text-muted">{{ substr($post->created_at, 9, 2) }}
                                                {{ $bulan[substr($post->created_at, 5, 2)] }}
                                                {{ substr($post->created_at, 0, 4) }}</small></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
        $('#blog').owlCarousel({
            loop: false,
            margin: 25,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });
    </script>
@endsection
