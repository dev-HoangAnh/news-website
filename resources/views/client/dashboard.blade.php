@extends('client.layouts.master')

@section('content')
<h1>Hi, {{ Auth::user()->name }}</h1>

<form action="{{ route('logout') }}" method="post">
    @csrf

    <button type="submit" class="btn btn-danger">Logout</button>
</form>
@endsection
