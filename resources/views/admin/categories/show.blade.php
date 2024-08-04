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
                            <h1 class="m-0">Chi tiết danh mục : {{ $category->name }}</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">

                    <table>
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên danh mục</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Thời gian thêm</th>
                            <td>{{ $category->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Thời gian sửa</th>
                            <td>{{ $category->updated_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-warning mt-3">
                        <a href="{{ route('categories.index') }}">Trở về</a>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
