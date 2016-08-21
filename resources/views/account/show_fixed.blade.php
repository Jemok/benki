@extends('layouts.app')


@section('content')



    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/home') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>

    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div class="panel">
                <div class="panel-heading panel-top"><strong>Fixed savings</strong></div>
                <div class="panel-body panel-left-border">
                    @if($fixed != null)
                    <h4>You have Kshs {{$fixed->transaction_amount}} in your fixed account, withdraw
                    date is on {{$fixed->withdraw_date}}</h4>
                    @endif

                    @include('account.partials.fixed_account_form')
                </div>

            </div>


        </div>
    </div>

@endsection