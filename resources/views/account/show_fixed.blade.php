@extends('layouts.app')


@section('content')



    {{--<div class="row">--}}
        {{--<div class="col-md-3">--}}
            {{--<a href="{{ url('/home') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@include('partials.back')--}}

    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div class="panel">
                <div class="panel-heading panel-top"><strong>Fixed savings</strong></div>
                <div class="panel-body panel-left-border">
                    @if($fixed != null)
                    <span class="text">You have Kshs:</span>
                        <span class="amount">{{$fixed->transaction_amount}} </span>
                        <span class="text">in your fixed account.</span><br>
                        <span class="text">Withdraw date is on </span>
                        <span class="amount">{{$fixed->withdraw_date}}.</span>
                    @endif

                    @include('account.partials.fixed_account_form')
                </div>
            </div>


        </div>
    </div>

@endsection