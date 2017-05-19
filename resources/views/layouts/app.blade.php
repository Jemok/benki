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
    {{--<link href="{{ asset('css/nav.css') }}" rel="stylesheet"/>--}}
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

@if(Request::path() == 'register' || Request::path() == 'login' || Request::path() == 'password/reset')

    <body id="app-layout" style="background-color: #a8614e;">
    </body>

    @else

<body id="app-layout">
@endif
@if(!\Auth::guest())
    <nav class="navbar navbar-default" style="background-color: #a8614e;">

        <p class="navbar-brand">
            <span class="holdsCurrentAccount">
            <span class="navbar-text nav-amount">
            <span style="color: #000000;">
               Balance:
            </span>
                @if(\Auth::user()->current_account()->exists())
                    <span class="amount" style="color: white;">{{\Auth::user()->current_account()->first()->account_amount}}</span>
                @else
                    0
                @endif
            </span>
            </span>
            <?php
            if(\App\Account::where('user_id', \Auth::user()->id)->exists()){
                $user_account_ids[] = \App\Account::where('user_id', \Auth::user()->id)
                        ->pluck('id');
            }else{
                $user_account_ids = [];
            }

            if(\App\AccountRequest::whereIn('account_id', $user_account_ids)
                    ->where('confirmation_status', 0)->exists()){
                $user_account_requests = \App\AccountRequest::whereIn('account_id', $user_account_ids)
                        ->where('confirmation_status', 0)
                        ->count();
            }else{
                $user_account_requests = 0;
            }
            ?>
            <a href="{{ route('getAccountPage') }}" class="navbar-link">
                {{--@if($user_account_requests > 0)--}}

                    <span class="badge" style="background-color: red;">
               <i class="fa fa-user"></i> {{ $user_account_requests  }}
            </span>
                {{--@endif--}}
            </a>
            <?php
            if(\App\Account_user::whereIn('user_id', [\Auth::user()->id])->exists()){
                $user_account_ids[] = \App\Account_user::whereIn('user_id', [\Auth::user()->id])
                        ->pluck('account_id');
            }else{
                $user_account_ids = [];
            }

            if(\App\Withdrawal_request::whereIn('account_id', $user_account_ids)
                    ->where('withdraw_status', 0)->exists()){
                $user_withdrawal_requests = \App\Withdrawal_request::whereIn('account_id', $user_account_ids)
                        ->where('withdraw_status', 0)
                        ->count();
            }else{
                $user_withdrawal_requests = 0;
            }
            ?>
            <a href="{{ route('getAccountPage') }}" class="navbar-link">
                {{--@if($user_withdrawal_requests > 0)--}}

                    <span class="badge" style="background-color: red;">
               <i class="fa fa-money"></i> {{ $user_withdrawal_requests  }}
            </span>
                {{--@endif--}}
            </a>
        </p>


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

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="{{ url('/') }}" style="color: black; font-weight: bold;" class="text-center">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('getWithdrawPage') }}" style="color: black; font-weight: bold;" class="text-center">
                                Withdraw
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('depositAndTransfer')  }}" style="color: black; font-weight: bold;" class="text-center">
                                Transfers
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('getFixedAccount') }}" style="color: black; font-weight: bold;" class="text-center">
                                Fixed account
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('getSavingsAccount')}}" style="color: black; font-weight: bold;" class="text-center">
                                Savings account
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('getAccountPage') }}" style="color: black; font-weight: bold;" class="text-center">
                                Chama accounts
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('payWithPayPal') }}" style="color: black; font-weight: bold;" class="text-center">
                                Pay with Paypal
                            </a>
                        </li>

                        <li>
                            <a  style="color: black; font-weight: bold;" href="{{ url('/logout') }}" class="text-center">Logout</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
@endif

<div class="show-alert col-md-offset-2 hidden" style="margin-top: 60px;">
</div>
<div class="container" id="page-content-wrapper" style="padding-top: 50px;">
    {{--@if(Auth::check())--}}
        {{--@include('dashboard.partials.search_account_form')--}}
    {{--@endif--}}


    <!--<div class="container">-->
        <div class="row">
            <div class="show-alert col-md-offset-2">
            </div>
        </div>

        @yield('content')

        @if(!Auth::guest())

            <h5 id="copyright" class="text-center">Logged in as  {{ Auth::user()->name }} </h5>

        @endif
</div>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

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

