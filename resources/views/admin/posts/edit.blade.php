@extends('admin.layouts.master')

@section('title')
    Cập nhật bài viết
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Cập nhật bài viết</h1>
                        </div>
                    </div>
                </div>

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="white_card_body">

                    <form action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục loại tin</label>

                            <select class="form-select" id="category_id" name="category_id">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $post->title }}">

                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Ảnh</label>
                            <input type="file" name="image" id="image" class="form-control">

                            <img src="{{ Storage::url($post->image) }}" alt="..." style="width: 100px;">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <input type="text" class="form-control" id="content" name="content"
                                value="{{ $post->content }}">

                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Số lượt xem : {{ $post->views }}</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>

                    </form>

                    <button type="submit" class="btn btn-warning mt-3">
                        <a href="{{ route('posts.index') }}">Trở về</a>
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection
