@extends('layouts.app_two')

@section('content')
<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel">
                <div class="panel-heading panel-top">Main Admin</div>

                <div class="panel-body">

                    @include('user.partials.rates_form')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection