@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash.flash_message')
        <div class="col-md-10 col-md-offset-1">
            <div class="panel">
                <div class="panel-heading panel-top">Chama Accounts</div>

                <div class="panel-body">
                   @include('account.partials.create_account_form')
                   @include('dashboard.partials.accounts_requests')
                </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel">
                <div class="panel-heading panel-top">Transfer money other users </div>

                <div class="panel-body">
                    {{--@include('account.partials.deposit_current_form')--}}
                    @include('account.partials.transfer')
                </div>
            </div>
        </div>
</div>
@endsection
