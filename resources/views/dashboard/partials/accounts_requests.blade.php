<div class="row">
    <div class="col-md-12">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="pane-heading">
                    <a href="#my-account" style="font-size: small;" aria-controls="my-account" role="tab" data-toggle="tab">
                        Accounts
                        <span class="badge" style="background-color: red;">
                            {{ $user_accounts->count() }}
                        </span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#chama-request"  style="font-size: small;" aria-controls="chama-request" role="tab" data-toggle="tab">
                        Requests
                        <span class="badge" style="background-color: red;">
                            {{ $account_requests->count() }}
                        </span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane pane-content" id="my-account" >
                    @if($user_accounts->count())
                        @foreach($user_accounts as $user_account)
                            <table class="table">
                                <thead>
                                <span class="text">
                                       <?php
                                    if(\App\AccountRequest::where('account_id', $user_account->account_id)
                                            ->where('confirmation_status', 0)->exists()){
                                        $user_account_requests = \App\AccountRequest::where('account_id', $user_account->account_id)
                                                ->where('confirmation_status', 0)
                                                ->count();
                                    }else{
                                        $user_account_requests = 0;
                                    }
                                    ?>
                                    <?php
                                    if(\App\Withdrawal_request::where('account_id', $user_account->account_id)
                                            ->where('withdraw_status', 0)->exists()){
                                        $user_withdraw_requests = \App\Withdrawal_request::where('account_id', $user_account->account_id)
                                                ->where('withdraw_status', 0)
                                                ->count();
                                    }else{
                                        $user_withdraw_requests = 0;
                                    }
                                    ?>
                                    <a href="{{ route('getAccount', [$user_account->account_id]) }}">
                                        {{$account_class->accountName($user_account)}}
                                    </a>
                                           @if($user_account_requests > 0)
                                           <span class="badge" style="background-color: red;">
                                                <i class="fa fa-user"></i> {{ $user_account_requests  }}
                                            </span>
                                           @endif

                                           @if($user_withdraw_requests > 0)
                                               <span class="badge" style="background-color: red;">
                                                <i class="fa fa-money"></i> {{ $user_withdraw_requests  }}
                                            </span>
                                           @endif
                                </span>

                                </thead>
                            </table>
                        @endforeach
                    @else
                        <span class="text text-success">You have no chama account and you do not belong in any.</span>
                    @endif
                </div>

                <div role="tabpanel" class="tab-pane pane-content" id="chama-request">
                    @if($account_requests->count())
                        @foreach($account_requests as $request)
                            <p>
                            <?php $account_id = $request->account()->first()->id; ?>
                            <!--<li class="list-unstyled col-md-offset-2">--> <span class="text"><a href="{{ url('accounts/'.$account_id)}}"> {{$request->account()->first()->account_name}}</a></span><!--</li>-->
                            </p>
                        @endforeach
                    @else
                        <span class="list-unstyled col-md-offset-2 text-success text">Sorry,, you have no requests at this moment</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
<!--<div class="col-md-6">

        <span class="col-md-offset-3"><u><strong>My Accounts</strong></u></span>

        @if($user_accounts->count())
    @foreach($user_accounts as $user_account)
        <ul>
            <li class="list-unstyled col-md-offset-2 "><a href="{{ route('getAccount', [$user_account->account_id]) }}">{{$account_class->accountName($user_account)}}</a></li>
                </ul>
            @endforeach
@else
    <h5 class="text-success">You have no accounts...</h5>
@endif
        </div>-->

<!--<div class="col-md-6">
        <span class="col-md-offset-3"><u><strong>Chama Requests</strong></u></span>
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
    <h5 class="list-unstyled col-md-offset-2 text-success">Sorry,, you have no requests at this moment</h5>
@endif
        </div>-->
</div>