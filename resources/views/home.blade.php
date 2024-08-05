@extends('client.layouts.master')

@section('banner')
    @include('client.components.banner', [
        'pageName' => 'Bựa ni có gi?',
        'categories' => $categories,
    ])
@endsection

@section('content')
    <section class="section pb-0">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Tin xem nhiều</h2>
                    <article class="card">
                        @foreach ($mostViewedPosts as $post)
                            <div class="post-slider slider-sm">
                                <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="{{ route('posts.show.client', $post->id) }}">{{ $post->title }}</a></h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('posts.show.client', $post->id) }}" class="card-meta-author">
                                            <img src="/client/images/kate-stone.jpg" alt="...">
                                            <span>{{ $post->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            <li class="list-inline-item">
                                                <a href="{{ route('categories.show.client', $post->category->id) }}">
                                                    {{ $post->category->name }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <a href="{{ route('posts.show.client', $post->id) }}" class="btn btn-outline-primary">Xem
                                    thêm</a>
                            </div>
                        @endforeach
                    </article>
                </div>

                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Tin mới</h2>
                    @foreach ($latestPosts as $post)
                        <article class="card mb-4">

                            <div class="card-body d-flex">
                                <img class="card-img-sm" src="{{ Storage::url($post->image) }}">
                                <div class="ml-3">
                                    <h4>
                                        <a href="{{ route('posts.show.client', $post->id) }}"
                                            class="post-title">{{ $post->title }}</a>
                                    </h4>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar">{{ $post->created_at->format('d-m-Y H:i:s') }}</i>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-timer">{{ $post->updated_at->format('d-m-Y H:i:s') }}</i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>

                @include('client.components.sidebar', $categories)

                <div class="col-12">
                    <div class="border-bottom border-default"></div>
                </div>

            </div>
        </div>
    </section>

    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Tất cả bản tin</h2>

                    @foreach ($posts as $post)
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3">
                                    <a class="post-title" href="{{ route('posts.show.client', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('posts.show.client', $post->id) }}" class="card-meta-author">
                                            <img src="/client/images/john-doe.jpg" alt="John Doe">
                                            <span>{{ $post->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer">{{ $post->created_at->format('d-m-Y H:i:s') }}</i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar">{{ $post->updated_at->format('d-m-Y H:i:s') }}</i>
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            <li class="list-inline-item"><a
                                                    href="{{ route('categories.show.client', $post->category->id) }}">{{ $post->category->name }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <a href="{{ route('posts.show.client', $post->id) }}" class="btn btn-outline-primary">Xem
                                    thêm</a>
                            </div>
                        </article>
                    @endforeach

                    {{-- Bắt buộc có cái này để làm phân trang --}}
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
