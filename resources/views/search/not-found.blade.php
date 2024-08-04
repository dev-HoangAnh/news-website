@extends('client.layouts.master')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4">
                    <h1 class="h2 mb-4">Tìm kiếm kết quả cho
                        <mark>
                            {{ $query }}
                        </mark>
                    </h1>
                </div>
                <div class="col-lg-10 text-center">
                    <img class="mb-5" src="/client/images/no-search-found.svg" alt="">
                    <h3>Không tìm thấy</h3>
                </div>
            </div>
        </div>
    </section>
@endsection
