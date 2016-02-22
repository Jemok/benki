@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('flash_message_error'))
        @include('flash.flash_message_error')
    @else
        @include('flash.flash_message_auth_email')
    @endif
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Provide Your Email</div>

            <div class="panel-body">
                @include('account.partials.auth_email_form')
            </div>
        </div>
    </div>
</div>
@endsection
