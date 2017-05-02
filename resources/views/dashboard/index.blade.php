@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('flash.flash_message')
            @include('flash.flash_message_error')

            <div>
                <span>
                    <a href="{{ route('getSavingsAccount')}}" class="link"> <span class="menu"><i class="fa fa-fw fa-file-o"></i>Savings Account</span></a>
                </span>
                <span>
                    <a href="{{ route('getFixedAccount') }}" class="link"><span class="menu"><i class="fa fa-sticky-note"></i> Fixed Account</span></a>
                </span>
            </div>

            <div class="panel">
                <div class="panel-heading panel-top"><strong>Chama Accounts</strong></div>

                <div class="panel-body panel-left-border">
                   @include('account.partials.create_account_form')
                   @include('dashboard.partials.accounts_requests')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading panel-top"><strong>Transfer money other members </strong></div>

                <div class="panel-body panel-left-border">
                    {{--@include('account.partials.deposit_current_form')--}}
                    @include('account.partials.transfer')
                </div>
            </div>
        </div>
    </div>

@endsection
