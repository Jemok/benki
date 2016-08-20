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
                <div class="panel-heading panel-top"><strong>Savings Rates</strong></div>

                <div class="panel-body panel-left-border">

                    @if($saving != null)

                    <h5>

                       Your savings rate :<strong>{{$saving->percentage}} %</strong> <br>

                       @if($saving->duration == 1)

                           on <strong>Daily basis </strong><br>

                       @endif

                       @if($saving->duration == 7)

                         on <strong>Weekly basis </strong><br>

                       @endif

                       @if($saving->duration == 30)

                        on <strong>Monthly basis </strong><br>

                       @endif

                       until <strong>{{$saving->withdraw_date}}</strong>

                    </h5>

                    <h5>
                        <strong>Savings Account has Kshs: {{$saving->transaction_amount}}</strong>
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