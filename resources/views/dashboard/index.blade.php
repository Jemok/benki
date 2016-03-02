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

            <span class="col-md-offset-2">Search an account</span>

            <!--
            <span class="col-md-offset-2">All Accounts</span>

            @if($all_accounts->count())
            @foreach($all_accounts as $account)
            <ul>
                <li class="list-unstyled">

                    <a href="{{ route('getAccount', [$account->id]) }}">{{$account->account_name}}</a>


                    @if($request_class->checkUserRequest(\Auth::user()->id, $account->id) == 0)

                     R-Pending

                    @endif

                    @if($request_class->checkUserRequest(\Auth::user()->id, $account->id) == 1)

                    R-Confirmed

                    @endif

                    @if($request_class->checkUserRequest(\Auth::user()->id, $account->id) == 2)
                    @endif
                </li>
            </ul>
            @endforeach
            @else
            <h5>no accounts</h5>
            @endif
            -->
            <div>
                <form class="form-horizontal" method="post" action="{{ route('searchAccount') }}">

                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('search_account') ? ' has-error' : '' }}">

                        <select class="form-control tag_list" name="search_account" multiple>

                           @if($all_accounts->count())
                            @foreach($all_accounts as $account)
                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                            @endforeach
                           @endif

                        </select>

                        @if ($errors->has('search_account'))
                         <span class="help-block">
                             <strong>{{ $errors->first('search_account') }}</strong>
                         </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i>Search
                            </button>
                        </div>
                    </div>


                </form>
            </div>

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
