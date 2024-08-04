@extends('admin.layouts.master')

@section('title')
    Cập nhật người dùng
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Cập nhật người dùng</h1>
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

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Kiểu người dùng</label>
                            <select class="form-select" id="role" name="role">

                                @if ($user->role == 'client')
                                    <option value="client" selected>Client</option>
                                    <option value="admin">Admin</option>
                                @else
                                    <option value="client">Client</option>
                                    <option value="admin" selected>Admin</option>
                                @endif

                            </select>

                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>

                    </form>

                    <button type="submit" class="btn btn-warning mt-3">
                        <a href="{{ route('users.index') }}">Trở về</a>
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection
