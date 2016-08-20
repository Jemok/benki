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
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Arial';
            color: #000000;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
@if(!\Auth::guest())
        <nav class="navbar navbar-fixed-top nav-guest" style="margin-bottom: 50px;">
        <div class="container">


            <div class="navbar-header">

                <a class="navbar-brand" href="#">
                        <p class="navbar-text nav-amount">
                            Current Balance Kshs:
                            @if(\Auth::user()->current_account()->exists())
                                {{\Auth::user()->current_account()->first()->account_amount}}
                            @else
                                0
                            @endif
                        </p>
                </a>
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed mobile-menu" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only toggle">Toggle Navigation</span>
                    <span class="icon-bar humbeger"></span>
                    <span class="icon-bar humbeger"></span>
                    <span class="icon-bar humbeger"></span>
                </button>

            @if(\Auth::guest())
                <!-- Branding Image -->
                    <a class="navbar-brand link" href="{{ url('/') }}">
                        HBnk
                    </a>
                @endif
            </div>


            <div class="collapse navbar-collapse" id="navbar-collapse">

            @if(\Auth::check())
                <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}" class="link">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</a></li>
                        <li><a href="{{ route('getSavingsAccount')}}" class="link">Savings rates</a></li>
                        <li><a href="{{ route('getFixedAccount') }}" class="link">Fixed deposits</a></li>
                    </ul>
                    <!-- <ul class="nav navbar-nav">
                        <li><a href="{{ route('getSavingsAccount')}}">Savings</a></li>
                        <li><a href="{{ route('getFixedAccount') }}">Fixed deposits</a></li>
                    </ul>-->

            @endif

            <!-- Right Side Of Navbar -->

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if(Auth::guest())
                        @if(Request::path() == 'password/reset')
                            <li><a href="{{ url('/login') }}">Login</a></li>
                        @endif
                        <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Register</a></li>
                    @else
                        {{--<li class="navbar-text nav-amount">--}}
                            {{--Current Balance Kshs:--}}
                            {{--@if(\Auth::user()->current_account()->exists())--}}
                                {{--{{\Auth::user()->current_account()->first()->account_amount}}--}}
                            {{--@else--}}
                                {{--0--}}
                            {{--@endif--}}
                        {{--</li>--}}

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>

                        </li>
                    @endif
                </ul>
            </div>
        </div>
        </nav>
@endif
        <div class="container" style="margin-top: 65px;">
            @yield('content')
        </div>



    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{--<script src="{{ asset('js/jquery.mmenu.min.js') }}"></script>--}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

    <script>
        $('.tag_list').select2({
            tags: true,
            placeholder: 'Select users',
            maximumSelectionLength: 10
        });


        // Submit the search form
        function submitSearch() {

            document.getElementById('searchForm').submit();

        }

        //Submits the create account form
        function createAccount() {

            document.getElementById('createAccountForm').submit();

        }
    </script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
