@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash.flash_message_with_error')
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Account Amount</div>

                <div class="panel-body">
                    <h1 style="padding-top: 5%;">Account Balance Kshs : {{number_format($account_amount)}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
