@extends('admin.layouts.master')

@section('title')
    Xem chi tiết
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Chi tiết tin : {{ $post->title }}</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">

                    <table>
                        <tr>
                            <th>ID</th>
                            <td>{{ $post->id }}</td>
                        </tr>
                        <tr>
                            <th>Tác giả</th>
                            <td>{{ $post->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục</th>
                            <td>{{ $post->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Tiêu đề</th>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <th>Ảnh</th>
                            <td>
                                <img src="{{ Storage::url($post->image) }}" alt="..." style="width: 100px;">
                            </td>
                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td>{{ $post->content }}</td>
                        </tr>
                        <tr>
                            <th>Số lượt xem</th>
                            <td>{{ $post->views }}</td>
                        </tr>
                        <tr>
                            <th>Thời gian thêm</th>
                            <td>{{ $post->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Thời gian sửa</th>
                            <td>{{ $post->updated_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-warning mt-3">
                        <a href="{{ route('posts.index') }}">Trở về</a>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
