@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash.flash_message')
            @include('flash.flash_message_error')

            <div>
    <span>
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
@endsection
