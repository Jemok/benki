@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('flash.flash_message')
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
