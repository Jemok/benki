@extends('layouts.app')
@section('content')

    {{--<div class="row">--}}
    {{--<div class="col-md-3">--}}
    {{--<a href="{{ url('/home') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@include('partials.back')--}}

    @include('flash.flash_message')
    @include('flash.flash_message_error')

    {{--<a href="/{{ \Illuminate\Support\Facades\Request::path()}}">Refresh</a>--}}
            @if($class_model->checkIfMember(\Auth::user()->id) == true)

                <?php
                     $amount = \App\Account_amount::where('account_id', $account_id)
                                                    ->where('amount', '<=', \Auth::user()->current_account()->first()->account_amount)
                                                    ->avg('amount')
                ?>

                <div>
                    Tips

                    <p>
                        You can save up to Kshs {{ number_format($amount, 0) }} now.
                    </p>

                </div>

                <div class="panel">
                    <div class="panel-heading panel-top">
                        <span class="panel-heading panel-top displayAccountBalanceDiv">
                            <span class="col-md-offset-1 displayAccountBalance">
                                <strong>
                                    Balance:
                                    <span class="amount">{{$account->amount->amount}}
                                    </span>
                                </strong>
                            </span>
                        </span>

                        {{--<div class="panel-heading panel-top"><strong>Transactions</strong>--}}
                        {{--<span class="panel-heading panel-top displayAccountBalanceDiv"><span class="col-md-offset-2 displayAccountBalance">Balance: {{$account->amount->amount}}</span></span>--}}

                        {{--<span class="col-md-offset-2">Account Balance: {{$account->amount->amount}}</span>--}}
                        {{--<span class="col-md-offset-5"><a href="{{ route('accountUsers', [$account_id]) }}">&nbsp;&nbsp;Members</a> </span>--}}
                    </div>
                    <div class="panel-body panel-left-border">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"  class=" pane-heading"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab"><strong><u>Deposit</u></strong></a></li>
                            <li role="presentation" class="pane-heading"><a href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab"><strong><u>Withdraw</u></strong></a></li>
                            <li role="presentation" class="pane-heading"><a href="#withdrawRequests" aria-controls="withdrawRequests" role="tab" data-toggle="tab"><strong><u>Requests <span class="badge" style="background-color: red;">{{ $withdraw_requests->count()  }}</span> </u></strong> <span>{{$info}}</span> </a></li>
                        </ul>

                        {{--<!-- Tab panes -->--}}
                        <div class="tab-content">

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
                            <div role="tabpanel" class="tab-pane pane-content" id="withdrawRequests">
                                @if($withdraw_requests->count())
                                    <table class="table">
                                        <thead class="table_head">
                                        <tr>
                                            <td><strong>Requester</strong></td>
                                            <td><strong>Amount</strong></td>
                                        </tr>
                                        </thead>

                                        @foreach($withdraw_requests as $withdraw_request)
                                            <tbody>
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


                                                            {{--<form method="post" class="withdrawForm" id="{{ $account_id }}">--}}

                                                                <form method="post" action="{{ route('withdrawFromAccount', [$account_id]) }}">

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

                                            </tbody>
                                        @endforeach
                                    </table>
                                @else
                                    <h5>
                                        No withdraw requests
                                    </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($account->user_id == \Auth::user()->id)
                    <div class="panel">
                        <div class="panel-heading panel-top">
                            <h5>
                                    <span class="col-md-offset-3">
                                        <a href="{{ route('accountUsers', [$account_id]) }}">&nbsp;&nbsp;<span class="text" style="color: #FFFFFF;">Members</span>
                                            <i class="fa fa-btn fa-group"></i>
                                        </a>
                                    </span>
                            </h5>
                        </div>
                        <div class="panel-body panel-left-border">

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation"  class="active pane-heading">
                                        <a href="#addMembers" aria-controls="addMembers" role="tab" data-toggle="tab">
                                            <strong>
                                                <u>Add</u>
                                                @if($users != null )
                                                    <span class="badge" style="background-color: red;">
                                                                {{ $users->count() }}
                                                            </span>
                                                @endif

                                            </strong>
                                        </a>
                                    </li>
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
                                                    <td>{{$user->name}} - {{ $user->phone_number }}</td>
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

            @else
                <div class="panel">
                    <div class="panel-heading panel-top">Processing request</div>

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
@endsection
