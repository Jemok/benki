@extends('layouts.app')
@section('content')


    @include('flash.flash_message_with_error')
    @include('flash.flash_message')


    @include('dashboard.partials.search_account_form')

    <div style="margin-top: 30px;">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{ route('getFixedAccount') }}" class="btn btn-default center-block" style="background-color: #a8614e; color: white;">
                    Fixed account
                </a>
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-body">
                <a href="{{ route('getSavingsAccount')}}" class="btn btn-default center-block" style="background-color: #a8614e; color: white;">
                    Savings account
                </a>
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-body">
                <a href="{{ route('getFixedAmountSavingsAccount')}}" class="btn btn-default center-block" style="background-color: #a8614e; color: white;">
                    Fixed amount savings
                </a>
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-body">
                <a href="{{ route('getAccountPage') }}" class="btn btn-default center-block" style="background-color: #a8614e; color: white;">
                    Chama accounts
                </a>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}

        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--@include('flash.flash_message')--}}
            {{--@include('flash.flash_message_error')--}}

            {{--<div>--}}
                {{--<span>--}}
                    {{--<a href="{{ route('getSavingsAccount')}}" class="link"> <span class="menu"><i class="fa fa-fw fa-file-o"></i>Savings Account</span></a>--}}
                {{--</span>--}}
                {{--<span>--}}
                    {{--<a href="{{ route('getFixedAccount') }}" class="link"><span class="menu"><i class="fa fa-sticky-note"></i> Fixed Account</span></a>--}}
                {{--</span>--}}
            {{--</div>--}}

            {{--<div class="panel">--}}
                {{--<div class="panel-heading panel-top"><strong>Chama Accounts</strong></div>--}}

                {{--<div class="panel-body panel-left-border">--}}
                   {{--@include('account.partials.create_account_form')--}}
                   {{--@include('dashboard.partials.accounts_requests')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel">--}}
                {{--<div class="panel-heading panel-top"><strong>Transfer money other members </strong></div>--}}

                {{--<div class="panel-body panel-left-border">--}}
                    {{--@include('account.partials.deposit_current_form')--}}
                    {{--@include('account.partials.transfer')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
