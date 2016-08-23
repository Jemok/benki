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
                <div class="panel-heading panel-top"><strong>Savings Rates</strong></div>

                <div class="panel-body panel-left-border">

                    @if($saving != null)

                    <h5>

                       <strong>Your savings rate :</strong><span class="amount">{{$saving->percentage}} %</span> <br>

                       @if($saving->duration == 1)

                           <span class="text">on</span> <span class="amount">Daily basis </span><br>

                       @endif

                       @if($saving->duration == 7)

                         <span class="text">on</span> <span class="amount">Weekly basis </span><br>

                       @endif

                       @if($saving->duration == 30)

                        <span class="text">on</span> <span class="amount">Monthly basis</span><br>

                       @endif

                       <span class="text">until</span> <span class="amount">{{$saving->withdraw_date}}</span>

                    </h5>

                    <h5>
                        <strong>Savings Account has Kshs: <span class="amount">{{$saving->transaction_amount}}</span></strong>
                    </h5>

                        @include('account.partials.savings_account_update_form')

                    @endif

                    @if($saving == null)
                        @include('account.partials.savings_account_form')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection