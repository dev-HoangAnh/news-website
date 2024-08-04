@extends('client.layouts.master')

@section('content')
    <section class="section">
        <div class="py-4"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h1 class="h2 mb-4">Danh mục tin : <mark>{{ $category->name }}</mark></h1>

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
                                        <a href="author-single.html" class="card-meta-author">
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


                </div>

                @include('client.components.sidebar', $categories)

            </div>
        </div>
    </section>
@endsection
