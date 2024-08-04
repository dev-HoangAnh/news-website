@extends('admin.layouts.master')

@section('title')
    Danh sách danh mục
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách danh mục</h1>
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

                    <a class="btn btn-primary" href="{{ route('categories.create') }}">Thêm mới</a>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Thời gian thêm</th>
                                    <th>Thời gian sửa</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $category->updated_at->format('d-m-Y H:i:s') }}</td>
                                        <td>

                                            <a href="{{ route('categories.show', $category) }}"
                                                class="btn btn-info mt-3">Xem</a>

                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="btn btn-warning mt-3">Sửa</a>

                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
