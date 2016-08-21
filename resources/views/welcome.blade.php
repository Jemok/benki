@extends('layouts.landing')
@section('content')


<h1 class="header-content">
    Welcome to
    <br> HBnk
</h1>
    <p class="paragraph-content">
        HBnk a mobile banking app for chamas
        <br>and individuals
    </p>
    <div class="buttons col-md-12">
        <a class="btn  btn-block sign-up" name="register" href="{{ url('/register') }}">Sign up</a>
        <a class="btn btn-block login" name="login" href="{{ url('/login') }}">Log in</a>
    </div>
@endsection
