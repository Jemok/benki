@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/home') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>

    @include('flash.flash_message')
    <a href="/{{ \Illuminate\Support\Facades\Request::path()}}">Refresh</a>
    <div class="row">
        <div class="col-md-12">

        @if($class_model->checkIfMember(\Auth::user()->id) == true)

            @if($account->user_id == \Auth::user()->id)

                <div class="panel">
                    <div class="panel-heading panel-top">
                        <h5><strong>Members Panel</strong></h5>
                    </div>
                    <div class="panel-body panel-left-border">
                    <div class="panel-heading panel-top">Admin Panel <a href="{{ route('deleteAccount', [$account_id])}}" class="btn btn-warning btn-sm col-md-offset-8">Delete Account</a></div>

                    <div class="panel-body">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"  class="active pane-heading"><a href="#addMembers" aria-controls="addMembers" role="tab" data-toggle="tab"><strong><u>Add Members</u></strong></a></li>
                                <li role="presentation" class="pane-heading"><a href="#removeMembers" aria-controls="removeMembers" role="tab" data-toggle="tab"><strong><u>Remove Members</u></strong></a></li>
                            </ul>

                            <div role="tabpanel" class="tab-pane active pane-content"  id="addMembers">

                                      @include('account.partials.create_member_form')

                            </div>

                            <div role="tabpanel" class="tab-pane" id="removeMembers">

                                <div style="padding-top: 5%;">
                                    @if($users_in->count())
                                    <ul>
                                        @foreach($users_in as $user)

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>User</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td>{{$user->name}} - {{ $user->email }}</td>
                                                    <td>
                                                        <form method="post" action="{{ route('deleteUser', [$account_id, $user->id ]) }}">

                                                            {{csrf_field()}}

                                                            <button class="btn btn-warning" type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>




                                        @endforeach
                                    </ul>

                                    @else

                                    <p>No users were found for this account</p>

                                    @endif
                                </div>

                            </div>

                    </div>
                </div>

            @endif



        </div>

        <div class="panel">
                <div class="panel-heading panel-top">Actions <span class="col-md-offset-2">Account Balance: {{$account->amount->amount}}</span> <span class="col-md-offset-5"><a href="{{ route('accountUsers', [$account_id]) }}">Members</a> </span></div>

                <div class="panel-body">

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"  class="active"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab">Deposit</a></li>
                            <li role="presentation"><a href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab">Withdraw</a></li>
                            <li role="presentation"><a href="#withdrawRequests" aria-controls="withdrawRequests" role="tab" data-toggle="tab">Withdraw Requests <span>{{$info}}</span> </a></li>
                        </ul>

                        <div role="tabpanel" class="tab-pane active" id="deposit">

                            @if(\Auth::user()->current_account()->first()->account_amount <= 0)

                                <div style="margin-top: 5%;" class="alert alert-info">You cannot deposit in this chama account since your current account is very low</div>

                            @else

                                @include('account.partials.deposit_form')

                            @endif
                        </div>

                        <div role="tabpanel" class="tab-pane" id="withdraw">

                            @if(\Auth::user()->current_account()->first()->account_amount <= 0)

                             <div style="margin-top: 5%;" class="alert alert-info">You cannot withdraw from this chama account since your current account is very low</div>

                            @else

                             @include('account.partials.withdraw_form')

                            @endif

                        </div>

                        <div role="tabpanel" class="tab-pane" id="withdrawRequests">

                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Requester</td>
                                    <td>Request Amount</td>
                                </tr>
                                </thead>

                                @if($withdraw_requests->count())

                                   @foreach($withdraw_requests as $withdraw_request)
                                        <tr>
                                            <td><a href="{{ route('getConfirmation', [$withdraw_request->id]) }}"> {{$withdraw_request->user()->first()->name}}</a></td>
                                            <td>{{$withdraw_request->request_amount}}</td>

                                            <td>

                                                @if($answer_class->check($account_id, \Auth::user()->id, $withdraw_request->id) == null)
                                                    <form method="post" action="{{route('setConfirm', [$account_id, $withdraw_request->id])}}">

                                                        {{ csrf_field() }}

                                                        <button type="submit" class="btn btn-info">Confirm</button>
                                                    </form>
                                                @else
                                                    @if($users_in_account_count == $request_answers_count && $withdraw_request->withdraw_status == 0)

                                                    <form method="post" action="{{ route('withdrawFromAccount', [$account_id]) }}">

                                                        {{ csrf_field() }}

                                                        <button class="btn btn-success" type="submit">Withdraw</button>

                                                    </form>

                                                    @elseif($answer_class->check($account_id, \Auth::user()->id, $withdraw_request->id) != null)
                                                    <button class="btn btn-success disabled">Confirmed</button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                @else

                                    No withdraw requests here

                                @endif
                            </table>

                        </div>
                    </div>
        </div>
    </div>
    @else
            <div class="panel">
                <div class="panel-heading panel-top">Actions</div>

                <div class="panel-body">

                    @if($confirmation_status == 0)

                     <div class="alert alert-info">Your request is being processed, we will let you know when its confirmed</div>

                    @elseif($confirmation_status == 2)

                    @include('account.partials.send_request_form', [$account_id])

                    @endif
                </div>
            </div>
    @endif
</div>
</div>
</div>
@endsection
