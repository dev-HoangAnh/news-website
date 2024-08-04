@extends('admin.layouts.master')

@section('title')
    Danh sách bản tin
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách bản tin</h1>
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

                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Thêm mới</a>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tác giả</th>
                                    <th>Danh mục</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Số lượt xem</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($post->image) }}" alt="..." style="width: 100px;">
                                        </td>
                                        <td>{{ $post->content }}</td>
                                        <td>{{ $post->views }}</td>
                                        <td>

                                            <a href="{{ route('posts.show', $post) }}" class="btn btn-info mt-3">Xem</a>

                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning mt-3">Sửa</a>

                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"
                                                    class="btn btn-danger mt-3">Xóa</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Bắt buộc có cái này để làm phân trang --}}
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
