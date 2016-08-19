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

                                                            <button class="btn btn-danger btn-sm" type="submit">Delete &nbsp;<i class="fa fa-btn fa-trash-o" aria-hidden="true"></i></button>
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

            @endif
                    <div class="panel-footer panel-bottom">
                        <a href="{{ route('deleteAccount', [$account_id])}}" class="btn btn-danger btn-sm"><i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete Account</a>
                    </div>



        </div>

        <div class="panel">
                <div class="panel-heading panel-top"><strong>Transactions:&nbsp;&nbsp;</strong>
                    <span class="col-md-offset-2">Account Balance: {{$account->amount->amount}}</span>
                    <span class="col-md-offset-5"><a href="{{ route('accountUsers', [$account_id]) }}">&nbsp;&nbsp;Members</a> </span>
                </div>

                <div class="panel-body panel-left-border">

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"  class="active pane-heading"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab"><strong><u>Deposit</u></strong></a></li>
                            <li role="presentation" class="pane-heading"><a href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab"><strong><u>Withdraw</u></strong></a></li>
                            <li role="presentation" class="pane-heading"><a href="#withdrawRequests" aria-controls="withdrawRequests" role="tab" data-toggle="tab"><strong><u>Withdraw Requests</u></strong> <span>{{$info}}</span> </a></li>
                        </ul>

                        <div role="tabpanel" class="tab-pane active pane-content" id="deposit">

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

                                    <p>No withdraw requests received</p>

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
