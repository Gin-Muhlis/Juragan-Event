@extends('user.layouts.main')

@section('style')
    <style>
        .carousel-inner {
            width: 400px;
        }

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
    {{-- Artikel Populer --}}
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4 border-danger" style="border-left: 3px solid;">&nbsp;Artikel Populer</h4>

                @foreach ($popularArticles as $post)
                    <div class="col mb-5">
                        <div class="row gap-2">
                            <div class="col-md-7">
                                <a href="{{ route('blog.detail', $post->slug) }}">
                                    <img lazy="loading" src="{{ \Storage::url($post->image) }}" class="w-100 rounded-3"
                                        alt="..."
                                        style="height: 350px; object-fit: cover; box-shadow: 6px 6px 6px rgba(0, 0, 0, .2);">
                                </a>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="d-flex flex-column" style="min-height: 200px">

                                    <h3 class="card-title fw-bold mb-3 lh-base">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="card-text mb-3 lh-lg">{{ substr(strip_tags($post->content), 0, 100) }}...
                                    </p>
                                    <div class="footer d-flex justify-content-between">
                                        <p class="card-text fst-italic"><small
                                                class="text-muted ">{{ substr($post->created_at, 9, 2) }}
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

    {{-- Artikel Lainnya --}}
    <div class="container mt-5">
        <h4 class="mb-4 border-danger" style="border-left: 3px solid;">&nbsp;Artikel Lainnya</h4>
        <div class="row row-cols-1 row-cols-lg-2 another-article">
            @foreach ($allArticles as $article)
                <div class="col">
                    <div class="card mb-3">

                        <div class="row g-0">
                            <div class="col-md-5">
                                <a href="{{ route('blog.detail', $article->slug) }}">
                                    <img lazy="loading" src="{{ \Storage::url($article->image) }}"
                                        class="img-fluid rounded-start" alt="..."
                                        style="height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-md-7 h-100">
                                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px">
                                    <?php
                                    $words = str_word_count($article->title, 1);
                                    ?>
                                    <h5 class="card-title">
                                        {{ implode(' ', array_slice($words, 0, 3)) }}{{ count($words) > 3 ? '...' : '' }}
                                    </h5>
                                    <p class="card-text">{{ substr(strip_tags($article->content), 0, 70) }}...</p>
                                    <div class="footer d-flex justify-content-between">
                                        <p class="card-text"><small
                                                class="text-muted">{{ substr($article->created_at, 8, 2) }}
                                                {{ $bulan[substr($article->created_at, 5, 2)] }}
                                                {{ substr($article->created_at, 0, 4) }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="d-none align-items-center justify-content-center gap-1  row-animate">
            <div class="custom-loader bullet1"></div>
            <div class="custom-loader bullet2"></div>
            <div class="custom-loader bullet3"></div>
            <div class="custom-loader bullet4"></div>
        </div>
        <div class="row justify-content-center add-article m-4">
            <button class="btn btn-outline-danger w-50">Selengkapnya...</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let page = 4
            $('.add-article').on('click', function() {
                $('.row-animate').removeClass('d-none')
                $('.row-animate').addClass('d-flex')
                $.ajax({
                    url: '/addArticle',
                    type: 'GET',
                    data: {
                        currentPage: page
                    },
                    success: function(data) {
                        let markup = ""
                        data.articles.forEach(article => {
                            markup += `<div class="col">
                            <div class="card mb-3">
                                <div class="row g-0 h-100">
                                    <div class="col-md-5 h-100">
                                        <a href="blog/detailBlog/${article.slug}">
                                            <img lazy="loading" src="${article.path}" class="img-fluid rounded-start" alt="..." style="height: 200px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="col-md-7 h-100">
                                        <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px">
                                            <h5 class="card-title" style="line-height: 30px">${article.title}</h5>
                                            <p class="card-text">${article.description.substr(0, 40)}...</p>
                                            <div class="footer d-flex justify-content-between">
                                                <p class="card-text"><small class="text-muted">${article.created_at}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                        })
                        $('.row-animate').removeClass('d-flex')
                        $('.row-animate').addClass('d-none')
                        $('.another-article').html(markup)


                        page += 2
                    }
                })
            })
        })
    </script>
@endsection
