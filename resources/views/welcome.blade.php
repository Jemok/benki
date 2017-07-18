@extends('layouts.landing')
@section('content')
    {{--<h1 class="header-content">--}}
    {{--Welcome to--}}
    {{--<br> HBnk--}}
    {{--</h1>--}}
    <div style="margin-left: 15%;">
        <img src="{{ asset('images/logo.jpg') }}" height="230" width="230" alt="">
    </div>
    <div style="margin-left: 35%;">
        <p class="paragraph-content">
            Virtual Bank
        </p>
    </div>

    <div class="buttons col-md-12">
        <a class="btn  btn-block sign-up" name="register" href="{{ url('/register') }}">Sign up</a>
        <a class="btn btn-block login" name="login" href="{{ url('/login') }}">Log in</a>
    </div>
@endsection
