@extends('client.layouts.master')

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning">
                        <a href="{{ route('register') }}">Bạn chưa có tài khoản? Đăng kí ngay</a>
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
