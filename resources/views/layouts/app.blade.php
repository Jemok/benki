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
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{asset('css/multiple_input_css/multiple_input.css')}}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/selectize.bootstrap3.css') }}" type="text/css" rel="stylesheet">



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

    {{--<nav class="navbar navbar-fixed-top nav-guest" style="margin-bottom: 50px;">--}}
    {{--<div class="container">--}}


    {{--<div class="navbar-header">--}}

    {{--<a class="navbar-brand" href="#">--}}
    {{--<span class="holdsCurrentAccount">--}}
    {{--<span class="navbar-text nav-amount">--}}
    {{--<span style="color: #000000;">Current Balance Kshs:</span>--}}
    {{--@if(\Auth::user()->current_account()->exists())--}}
    {{--<span class="amount">{{\Auth::user()->current_account()->first()->account_amount}}</span>--}}
    {{--@else--}}
    {{--0--}}
    {{--@endif--}}
    {{--</span>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--<!-- Collapsed Hamburger -->--}}
    {{--<button type="button" class="navbar-toggle collapsed mobile-menu" data-toggle="collapse" data-target="#navbar-collapse">--}}
    {{--<span class="sr-only toggle">Toggle Navigation</span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--</button>--}}

    {{--@if(\Auth::guest())--}}
    {{--<!-- Branding Image -->--}}
    {{--<a class="navbar-brand link" href="{{ url('/') }}">--}}
    {{--<span class="menu">HBnk</span>--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--</div>--}}


    {{--<div class="collapse navbar-collapse" id="navbar-collapse">--}}

    {{--@if(\Auth::check())--}}
    {{--<!-- Left Side Of Navbar -->--}}

    {{--<ul class="nav navbar-nav">--}}
    {{--<li><a href="{{ url('/home') }}" class="link"><span class="menu">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</span></a></li>--}}
    {{--<li><a href="{{ route('getSavingsAccount')}}" class="link"><span class="menu">Savings rates</span></a></li>--}}
    {{--<li><a href="{{ route('getFixedAccount') }}" class="link"><span class="menu">Fixed deposits</span></a></li>--}}
    {{--</ul>--}}
    {{--<!-- <ul class="nav navbar-nav">--}}
    {{--<li><a href="{{ route('getSavingsAccount')}}">Savings</a></li>--}}
    {{--<li><a href="{{ route('getFixedAccount') }}">Fixed deposits</a></li>--}}
    {{--</ul>-->--}}

    {{--@endif--}}

    {{--<!-- Right Side Of Navbar -->--}}

    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<!-- Authentication Links -->--}}
    {{--@if(Auth::guest())--}}
    {{--@if(Request::path() == 'password/reset')--}}
    {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
    {{--@endif--}}
    {{--<li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Register</a></li>--}}
    {{--@else--}}
    <!-- Sidebar -->
    <div class="navbar navbar-fixed-top" style="background-color: #33ffcc; padding-left: 2%;  padding-top: 10px;">
        <div style="background-color: #33ffcc;" >
            <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas" style="background-color: #33ffcc;">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
        </div>
        <span class="holdsCurrentAccount" style="margin-left: 15%;">
            <span class="navbar-text nav-amount">
               <span class="text">Current Balance Kshs:</span>
                <span class="amount">@if(\Auth::user()->current_account()->exists())
                        {{\Auth::user()->current_account()->first()->account_amount}}
                    @else
                        0
                    @endif
                </span>
            </span>
        </span>
    </div>


    <nav class="navbar navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            {{--<li class="sidebar-brand">--}}
            {{--<a href="#">--}}
            {{--Bootstrap 3--}}
            {{--</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-fw fa-home"></i> <span class="menu">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</span></a>
            </li>
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-fw fa-home"></i> <span class="menu">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</span></a>

                {{--<a href="#"><i class="fa fa-fw fa-folder"></i> Page one</a>--}}
            </li>
            <li>
                <a href="{{ route('getSavingsAccount')}}" class="link"> <span class="menu"><i class="fa fa-fw fa-file-o"></i>Savings rates</span></a>
                {{--<a href="#"><i class="fa fa-fw fa-file-o"></i> Second page</a>--}}
            </li>
            <li>
                <a href="{{ route('getFixedAccount') }}" class="link"><span class="menu"><i class="fa fa-sticky-note"></i> Fixed deposits</span></a>
                {{--<a href="#"><i class="fa fa-fw fa-cog"></i> Third page</a>--}}
            </li>
            {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Dropdown <span class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu" role="menu">--}}
            {{--<li class="dropdown-header">Dropdown heading</li>--}}
            {{--<li><a href="#">Action</a></li>--}}
            {{--<li><a href="#">Another action</a></li>--}}
            {{--<li><a href="#">Something else here</a></li>--}}
            {{--<li><a href="#">Separated link</a></li>--}}
            {{--<li><a href="#">One more separated link</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <li>

                <a >
                    <i class="fa fa-user"></i> <span class="menu">{{ Auth::user()->name }}</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/logout') }}"><span class="menu"><i class="fa fa-btn fa-sign-out"></i>Logout</span></a>
                {{--<a href="#"><i class="fa fa-fw fa-dropbox"></i> Page 5</a>--}}
            </li>
            {{--<li>--}}
            {{--<a href="#"><i class="fa fa-fw fa-twitter"></i> Last page</a>--}}
            {{--</li>--}}
        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->
    {{--<nav class="navbar navbar-fixed-top nav-guest" style="margin-bottom: 50px;">--}}
    {{--<div class="container">--}}


    {{--<div class="navbar-header">--}}

    {{--<a class="navbar-brand" href="#">--}}
    {{--<span class="holdsCurrentAccount">--}}
    {{--<span class="navbar-text nav-amount">--}}
    {{--Current Balance Kshs:--}}
    {{--@if(\Auth::user()->current_account()->exists())--}}
    {{--{{\Auth::user()->current_account()->first()->account_amount}}--}}
    {{--@else--}}
    {{--0--}}
    {{--@endif--}}
    {{--</span>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--<!-- Collapsed Hamburger -->--}}
    {{--<button type="button" class="navbar-toggle collapsed mobile-menu" data-toggle="collapse" data-target="#navbar-collapse">--}}
    {{--<span class="sr-only toggle">Toggle Navigation</span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--<span class="icon-bar humbeger"></span>--}}
    {{--</button>--}}

    {{--@if(\Auth::guest())--}}
    {{--<!-- Branding Image -->--}}
    {{--<a class="navbar-brand link" href="{{ url('/') }}">--}}
    {{--HBnk--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--</div>--}}


    {{--<div class="collapse navbar-collapse" id="navbar-collapse">--}}

    {{--@if(\Auth::check())--}}
    {{--<!-- Left Side Of Navbar -->--}}

    {{--<ul class="nav navbar-nav">--}}
    {{--<li><a href="{{ url('/home') }}" class="link">{{Request::path() == 'home' ? 'HBnk' : 'Home'}}</a></li>--}}
    {{--<li><a href="{{ route('getSavingsAccount')}}" class="link">Savings rates</a></li>--}}
    {{--<li><a href="{{ route('getFixedAccount') }}" class="link">Fixed deposits</a></li>--}}
    {{--</ul>--}}
    {{--<!-- <ul class="nav navbar-nav">--}}
    {{--<li><a href="{{ route('getSavingsAccount')}}">Savings</a></li>--}}
    {{--<li><a href="{{ route('getFixedAccount') }}">Fixed deposits</a></li>--}}
    {{--</ul>-->--}}

    {{--@endif--}}

    {{--<!-- Right Side Of Navbar -->--}}

    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<!-- Authentication Links -->--}}
    {{--@if(Auth::guest())--}}
    {{--@if(Request::path() == 'password/reset')--}}
    {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
    {{--@endif--}}
    {{--<li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Register</a></li>--}}
    {{--@else--}}

    {{--<li class="navbar-text nav-amount">--}}
    {{--Current Balance Kshs:--}}
    {{--@if(\Auth::user()->current_account()->exists())--}}
    {{--{{\Auth::user()->current_account()->first()->account_amount}}--}}
    {{--@else--}}
    {{--0--}}
    {{--@endif--}}
    {{--</li>--}}

    {{--<span class="holdsCurrentAccount">--}}
    {{--<span class="navbar-text nav-amount">--}}
    {{--Current Balance Kshs:--}}
    {{--@if(\Auth::user()->current_account()->exists())--}}
    {{--{{\Auth::user()->current_account()->first()->account_amount}}--}}
    {{--@else--}}
    {{--0--}}
    {{--@endif--}}
    {{--</span>--}}
    {{--</span>--}}


    {{--<li class="dropdown">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
    {{--<i class="fa fa-user" aria-hidden="true"></i> <span class="menu">{{ Auth::user()->name }}</span><span class="caret"></span>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu" role="menu">--}}
    {{--<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>--}}
    {{--</ul>--}}

    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</nav>--}}

    {{--<li class="dropdown">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
    {{--<i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu" role="menu">--}}
    {{--<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>--}}
    {{--</ul>--}}

    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</nav>--}}

@endif

<div class="show-alert col-md-offset-2 hidden" style="margin-top: 60px;">
</div>
<div class="container" id="page-content-wrapper" style="padding-top: 50px;">
    @if(Auth::check())
        @include('dashboard.partials.search_account_form')
    @endif


    <!--<div class="container">-->
        <div class="row">
            <div class="show-alert col-md-offset-2">
            </div>
        </div>

        @yield('content')
    <!--</div>-->




    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{--<script src="{{ asset('js/jquery.mmenu.min.js') }}"></script>--}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{--<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/nav.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.growl.js') }}" type="text/javascript"></script>
        <script src="{{asset('js/selectize.min.js')}}"></script>



        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            }
        });
    </script>

    <script>
            $('#transfer_to').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });
//        $('.tag_list').select2({
//            tags: true,
//            placeholder: 'Select users',
//            maximumSelectionLength: 10
//        });


        // Submit the search form
        function submitSearch() {

            document.getElementById('searchForm').submit();

        }

        //Submits the create account form
        function createAccount() {

            document.getElementById('createAccountForm').submit();

        }
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

                // notify the user
                $.growl.notice({ title: 'Notification', message: data.html});
            }

            // Display new updated amount data in the user interface
            function displayUpdatedAccountAmount( data ) {

                $('.displayAccountBalance').detach();

                $('.displayAccountBalanceDiv').append(data.html)

            }
        </script>
    @endif
</div>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
