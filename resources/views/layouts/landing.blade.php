<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HBnk</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />--}}
    {{--<link href="{{ asset('css/style.css') }}" rel="stylesheet" />--}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/landing_page.css') }}" rel="stylesheet">

    {{--<style>--}}
        {{--body {--}}
            {{--font-family: 'Arial';--}}
            {{--color: #000000;--}}
        {{--}--}}

        {{--.fa-btn {--}}
            {{--margin-right: 6px;--}}
        {{--}--}}
    {{--</style>--}}
</head>

<body class="landing-page" style="margin-top: 14%;">

@yield('content')

</body>

