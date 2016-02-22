@extends('layouts.app')


@section('content')

<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div class="panel panel-default">
                <div class="panel-heading">Account Details</div>

                <div class="panel-body">
                    @include('account.partials.fixed_account_form')
                </div>

            </div>


        </div>
@endsection