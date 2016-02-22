@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-2">

            <span class="col-md-offset-2">My Accounts</span>

            @if($user_accounts->count())
                @foreach($user_accounts as $user_account)
                       <ul>
                           <li class="list-unstyled"><a href="{{ route('getAccount', [$user_account->account_id]) }}">{{$account_class->accountName($user_account)}}</a></li>
                       </ul>
                @endforeach
            @else
                <h5>You have no accounts</h5>
            @endif
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create Chama Account</div>

                <div class="panel-body">
                   @include('account.partials.create_account_form')
                </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Deposit In Your Current Account</div>

                <div class="panel-body">
                    @include('account.partials.deposit_current_form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
