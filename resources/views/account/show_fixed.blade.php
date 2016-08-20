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
                    <h5>You have <strong> Kshs: {{$fixed->transaction_amount}} </strong>in your fixed account,<br> withdraw
                    date is on <strong>{{$fixed->withdraw_date}}</strong></h5>
                    @endif

                    @include('account.partials.fixed_account_form')
                </div>

            </div>


        </div>
    </div>

@endsection