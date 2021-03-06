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
            <?php
            $random_rate = random_int(1, \Auth::user()->current_account()->first()->account_amount);

            $periods = [1, 7, 30];

            $period = $periods[array_rand($periods, 1)];

            $amount = \Auth::user()->current_account()->first()->account_amount + $random_rate;
            ?>
            <div class="alert alert-success">
                Tips
                <p>
                    Save {{$random_rate}}

                    for {{$period}} days

                    to get {{ number_format($amount, 0) }}

                </p>
            </div>
            <div class="panel">
                <div class="panel-heading panel-top"><strong>Savings Rates</strong></div>

                <div class="panel-body panel-left-border">

                    @if($saving != null)

                        <div class="alert alert-success">
                        <h5>

                            <strong>Your savings rate :</strong><span class="amount">{{$saving->deduct_amount}}</span> <br>

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
                        </div>
                        @include('account.partials.fixed_amount_savings_account_update_form')

                    @endif

                    @if($saving == null)
                        @include('account.partials.fixed_amount_savings_account_form')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection