@extends('layouts.app')

@section('content')

    @include('flash.flash_message_with_error')
    @include('flash.flash_message')


    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel">--}}
                {{--<div class="panel-heading panel-top"><strong>Deposit To Current Account </strong></div>--}}

                {{--<div class="panel-body panel-left-border">--}}
                    {{--@include('account.partials.deposit_current_form')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}



    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading panel-top"><strong>Transfer money other members </strong></div>

                <div class="panel-body panel-left-border">
                    @include('account.partials.transfer')
                </div>
            </div>
        </div>
    </div>


    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel">--}}
                {{--<div class="panel-heading panel-top"><strong>Transfer to multiple members </strong></div>--}}

                {{--<div class="panel-body panel-left-border">--}}
                    {{--@include('account.partials.transfer_multiple')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
