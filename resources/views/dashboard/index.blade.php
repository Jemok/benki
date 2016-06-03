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

            <span class="col-md-offset-2">Chama Requests</span>



            @if($account_requests->count())
                @foreach($account_requests as $request)
                 <p class="col-md-offset-2">
                 <?php $account_id = $request->account()->first()->id; ?>
                 <a href="{{ url('accounts/'.$account_id)}}"> {{$request->account()->first()->account_name}}</a>
                 </p>
                @endforeach
            @else
            <h5>You have no requests</h5>
            @endif

            <span class="col-md-offset-2"><a href="{{ url('accounts/get/all') }}">View all accounts</a></span>
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
                <div class="panel-heading">Deposit In Your Current Account or Transfer to another user </div>

                <div class="panel-body">
                    @include('account.partials.deposit_current_form')

                    @include('account.partials.transfer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
