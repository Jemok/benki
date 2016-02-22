@extends('layouts.app')

@section('content')
<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div class="panel panel-default">
                <div class="panel-heading">Account Details</div>

                <div class="panel-body">

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

                    </h4>

                        @include('account.partials.savings_account_update_form')

                    @endif

                    @if($saving == null)
                        @include('account.partials.savings_account_form')
                    @endif
                </div>
            </div>
        </div>
@endsection