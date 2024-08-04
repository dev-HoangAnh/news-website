@extends('admin.layouts.master')

@section('title')
    Sửa danh mục
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Sửa danh mục</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">

                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">
                                <h4>ID : {{ $category->id }}</h4>
                            </label>
                            <br>
                            <label for="name" class="form-label">
                                <h4>Tên danh mục :</h4>
                            </label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name"
                                name="name" value="{{ $category->name }}">
                            @if ($errors->has('name'))
                                <div style="color: red;">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>

                    <button type="submit" class="btn btn-warning mt-3">
                        <a href="{{ route('categories.index') }}">Trở về</a>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
