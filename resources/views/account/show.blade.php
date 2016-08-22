@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/home') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>

    @include('flash.flash_message')
    {{--<a href="/{{ \Illuminate\Support\Facades\Request::path()}}">Refresh</a>--}}
    <div class="row">
        <div class="col-md-12">

        @if($class_model->checkIfMember(\Auth::user()->id) == true)

            @if($account->user_id == \Auth::user()->id)

                <div class="panel">
                    <div class="panel-heading panel-top">
                        <h5><strong>Members Panel</strong><span class="col-md-offset-3"><a href="{{ route('accountUsers', [$account_id]) }}">&nbsp;&nbsp;<span class="text">Members</span> <i class="fa fa-btn fa-group"></i></a> </span></h5>
                    </div>
                    <div class="panel-body panel-left-border">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"  class="active pane-heading"><a href="#addMembers" aria-controls="addMembers" role="tab" data-toggle="tab"><strong><u>Add</u></strong></a></li>
                                <li role="presentation" class="pane-heading"><a href="#removeMembers" aria-controls="removeMembers" role="tab" data-toggle="tab"><strong><u>Remove</u></strong></a></li>
                            </ul>

                            <div role="tabpanel" class="tab-pane active pane-content"  id="addMembers">

                                      @include('account.partials.create_member_form')

                            </div>

                            <div role="tabpanel" class="tab-pane pane-content" id="removeMembers">


                                    @if($users_in->count())
                                    <!--<ul>-->
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Member</strong></td>
                                                <td><strong>Action</strong></td>
                                            </tr>
                                            </thead>
                                        @foreach($users_in as $user)

                                           <!-- <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Member</strong></td>
                                                        <td><strong>Action</strong></td>
                                                    </tr>
                                                </thead>-->
                                                <tr>
                                                    <td>{{$user->name}} - {{ $user->email }}</td>
                                                    <td>
                                                        <form method="post" action="{{ route('deleteUser', [$account_id, $user->id ]) }}">

                                                            {{csrf_field()}}


                                                            <button class="btn btn-delete btn-sm" type="submit">Delete &nbsp;<i class="fa fa-btn fa-trash-o" aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <!--</table>-->

                                        @endforeach
                                            </table>
                                    <!--</ul>-->

                                    @else

                                    <p>No members were found for this account</p>

                                    @endif


                            </div>

                    </div>
                </div>

                    <div class="panel-footer panel-bottom">
                        <a href="{{ route('deleteAccount', [$account_id])}}" class="btn btn-delete btn-sm"><i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete Account</a>
                    </div>
                </div>

            @endif




        <div class="panel">
                <div class="panel-heading panel-top"><strong>Transactions:&nbsp;&nbsp;</strong>
                    <span class="panel-heading panel-top displayAccountBalanceDiv"><span class="col-md-offset-1 displayAccountBalance"><strong>Balance: <span class="amount">{{$account->amount->amount}}</span></strong></span></span>

                {{--<div class="panel-heading panel-top"><strong>Transactions</strong>--}}
                    {{--<span class="panel-heading panel-top displayAccountBalanceDiv"><span class="col-md-offset-2 displayAccountBalance">Balance: {{$account->amount->amount}}</span></span>--}}

                    {{--<span class="col-md-offset-2">Account Balance: {{$account->amount->amount}}</span>--}}
                    {{--<span class="col-md-offset-5"><a href="{{ route('accountUsers', [$account_id]) }}">&nbsp;&nbsp;Members</a> </span>--}}
                </div>


                <div class="panel-body panel-left-border">

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"  class=" pane-heading"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab"><strong><u>Deposit</u></strong></a></li>
                            <li role="presentation" class="pane-heading"><a href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab"><strong><u>Withdraw</u></strong></a></li>
                            <li role="presentation" class=" active pane-heading"><a href="#withdrawRequests" aria-controls="withdrawRequests" role="tab" data-toggle="tab"><strong><u>Requests</u></strong> <span>{{$info}}</span> </a></li>
                        </ul>

                        <div role="tabpanel" class="tab-pane pane-content" id="deposit">


                            @if(\Auth::user()->current_account()->first()->account_amount <= 0)

                                <div style="margin-top: 5%;" class="alert alert-info alert-dismissible">
                                    You cannot deposit in this chama account since your current balance is very low
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>

                            @else

                                @include('account.partials.deposit_form')

                            @endif
                        </div>

                        <div role="tabpanel" class="tab-pane pane-content" id="withdraw">

                            @if(\Auth::user()->current_account()->first()->account_amount <= 0)

                             <div style="margin-top: 5%;" class="alert alert-info">
                                 You cannot withdraw from this chama account since your current balance is very low
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>

                            @else

                             @include('account.partials.withdraw_form')

                            @endif

                        </div>


                        <div role="tabpanel" class="tab-pane active pane-content" id="withdrawRequests">


                            @if($withdraw_requests->count())
                                <table class="table withdraw_requests_table">
                                    <thead class="table_head">
                                    <tr>
                                        <td><strong>Requester</strong></td>
                                        <td><strong>Requested Amount</strong></td>
                                    </tr>
                                    </thead>

                                   @foreach($withdraw_requests as $withdraw_request)
                                        <tr class="first_request_row">
                                            <td><a href="{{ route('getConfirmation', [$withdraw_request->id]) }}"> {{$withdraw_request->user()->first()->name}}</a></td>
                                            <td>{{$withdraw_request->request_amount}}</td>

                                            <td>

                                                @if($answer_class->check($account_id, \Auth::user()->id, $withdraw_request->id) == null)
                                                    <form method="post" id="{{ $withdraw_request->id }}" data-id="{{ $account_id }}" class="confirm_form">
                                                    {{--<form method="post" action="{{route('setConfirm', [$account_id, $withdraw_request->id])}}">--}}

                                                        {{ csrf_field() }}

                                                        <button type="submit" class="btn btn-info btn-sm" id="button_{{$withdraw_request->id}}">Confirm</button>
                                                    </form>
                                                @else
                                                    @if($users_in_account_count == $request_answers_count && $withdraw_request->withdraw_status == 0)


                                                    <form method="post" class="withdrawForm" id="{{ $account_id }}">

                                                        {{--<form method="post" action="{{ route('withdrawFromAccount', [$account_id]) }}">--}}


                                                        {{ csrf_field() }}


                                                        <button class="btn btn-success btn-sm" type="submit">Withdraw</button>

                                                    </form>

                                                    @elseif($answer_class->check($account_id, \Auth::user()->id, $withdraw_request->id) != null)
                                                        <div class="withdraw_div" id="withdraw_div">
                                                        </div>
                                                        <button class="btn btn-success btn-sm disabled button_confirmed">Confirmed</button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                            @else

                                <h5 class="pane-content"><strong>No withdraw requests here</strong></h5>
                            </table>
                            @endif
                            {{--@else--}}


                                {{--<table class="table withdraw_requests_table">--}}
                                    {{--<thead class="table_head">--}}
                                    {{--<tr>--}}
                                        {{--<td>Requester</td>--}}
                                        {{--<td>Request Amount</td>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tr class="default_request_row">--}}
                                        {{--<td>--}}
                                        {{--<div style="margin-top: 5%;" class="alert alert-info">--}}
                                            {{--No withdraw requests here--}}
                                        {{--</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endif--}}

                        </div>
                    </div>
        </div>
    </div>
    @else
            <div class="panel">
                <div class="panel-heading panel-top">Actions</div>

                <div class="panel-body">

                    @if($confirmation_status == 0)

                     <div class="alert alert-info alert-dismissible" role="alert">
                         Your request is being processed, we will let you know when its confirmed
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>


                    @elseif($confirmation_status == 2)

                    @include('account.partials.send_request_form', [$account_id])

                    @endif
                </div>
            </div>
    @endif
</div>
    </div>
@endsection
