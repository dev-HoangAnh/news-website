@extends('client.layouts.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4">
                    <h1 class="h2 mb-4">Tìm kiếm kết quả cho :
                        <mark>{{ $query }}</mark>
                    </h1>
                </div>
                <div class="col-lg-10">

                    @foreach ($posts as $post)
                        <article class="card mb-4">
                            <div class="row card-body">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="post-slider slider-sm">
                                        <img src="{{ Storage::url($post->image) }}" class="card-img" alt="post-thumb"
                                            style="height:200px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="h4 mb-3"><a class="post-title"
                                            href="{{ route('posts.show.client', $post->id) }}">{{ $post->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{ route('posts.show.client', $post->id) }}" class="card-meta-author">
                                                <img src="/client/images/john-doe.jpg" alt="John Doe">
                                                <span>{{ $post->user->name }}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>{{ $post->created_at->format('d-m-Y H:i:s') }}
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-calendar"></i>{{ $post->updated_at->format('d-m-Y H:i:s') }}
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                <li class="list-inline-item"><a
                                                        href="{{ route('categories.show.client', $post->category->id) }}">{{ $post->category->name }}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <a href="{{ route('posts.show.client', $post->id) }}"
                                        class="btn btn-outline-primary">Xem thêm</a>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
