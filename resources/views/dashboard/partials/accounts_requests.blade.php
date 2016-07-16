<div class="row">
    <div class="col-md-6">

        <span class="col-md-offset-3">My Accounts</span>

        @if($user_accounts->count())
            @foreach($user_accounts as $user_account)
                <ul>
                    <li class="list-unstyled col-md-offset-2"><a href="{{ route('getAccount', [$user_account->account_id]) }}">{{$account_class->accountName($user_account)}}</a></li>
                </ul>
            @endforeach
        @else
            <h5>You have no accounts</h5>
        @endif
    </div>

    <div class="col-md-6">
        <span class="col-md-offset-2">Chama Requests</span>
        {{--<span class="col-md-offset-2">OR</span>--}}
        {{--<span class="col-md-offset-2"><a href="{{ url('accounts/get/all') }}">View all accounts</a></span>--}}
    @if($account_requests->count())
            @foreach($account_requests as $request)
                <ul>
                    <?php $account_id = $request->account()->first()->id; ?>
                        <li class="list-unstyled col-md-offset-2"><a href="{{ url('accounts/'.$account_id)}}"> {{$request->account()->first()->account_name}}</a></li>
                </ul>
            @endforeach
        @else
            <h5 class="list-unstyled col-md-offset-2 text-success">Sorry,, but you have no requests at this moment</h5>
        @endif
    </div>
 </div>