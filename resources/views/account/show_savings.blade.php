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

                    <h4>

                       Your savings summary:{{$saving->percentage}} %

                       @if($saving->duration == 1)

                            Daily

                       @endif

                       @if($saving->duration == 7)

                        Weekly

                       @endif

                       @if($saving->duration == 30)

                        Weekly

                       @endif

                       until {{$saving->withdraw_date}}

                    </h4>

                    <h4>
                        Savings Account has Kshs: {{$saving->transaction_amount}}
                    </h4>

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