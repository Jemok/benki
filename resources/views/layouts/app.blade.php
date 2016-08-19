<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default nav-guest">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                @if(\Auth::guest())
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    HBnk
                </a>
                @endif
            </div>


            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                @if(\Auth::check())
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="{{ route('getSavingsAccount')}}">Savings</a></li>
                    <li><a href="{{ route('getFixedAccount') }}">Fixed</a></li>
                </ul>
                @include('dashboard.partials.search_account_form')

                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if(Auth::guest())
                        @if(Request::path() == 'password/reset')
                            <li><a href="{{ url('/login') }}">Login</a></li>
                        @endif
                            <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <span class="holdsCurrentAccount">
                        <span class="navbar-text nav-amount">
                            Current Balance Kshs:
                            @if(\Auth::user()->current_account()->exists())
                                {{\Auth::user()->current_account()->first()->account_amount}}
                            @else
                                0
                            @endif
                        </span>
                        </span>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
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

    <div class="show-alert col-md-offset-6">
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/all.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            }
        });
    </script>

    <script>
        $('.tag_list').select2({
            tags: true,
            placeholder: 'Select users',
            maximumSelectionLength: 10
        });
    </script>

    @if(\Auth::check())
    <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
    <script>
        var pusher = new Pusher('{{Config::get('pusher.appKey')}}');
        var channel = pusher.subscribe('for_user_{{\Auth::user()->id}}');

        // Deposit updation channel
        channel.bind('new_deposit', function(data) {
            displayUpdatedAccountAmount(data);
        });

        // Request confirmation channel
        channel.bind('request_confirmation', function (data) {
            alertRequestConfirmation(data);
            switchWithdrawDivs(data);
        });

        channel.bind('withdraw', function (data) {
            displayUpdatedAccountAmount(data);
        });

        channel.bind('new_request', function (data) {

            displayNewRequest(data);

        });

        function displayNewRequest(data) {

            $('.table_head').after(data.html);


        }


        function switchWithdrawDivs(data) {

            $('.button_confirmed').detach();

            if(data.html2 != 'undefined'){

                $('.withdraw_div').append(data.html2)
            }
        }

        function alertRequestConfirmation(data) {
            $('.show-alert').append(data.html);
        }

        // Display new updated amount data in the user interface
        function displayUpdatedAccountAmount( data ) {

            $('.displayAccountBalance').detach();

            $('.displayAccountBalanceDiv').append(data.html)

        }
    </script>
    @endif


    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
