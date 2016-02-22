@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if($account->user_id == \Auth::user()->id)

                <div class="panel panel-default">
                    <div class="panel-heading">Admin Panel</div>

                    <div class="panel-body">

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"  class="active"><a href="#addMembers" aria-controls="addMembers" role="tab" data-toggle="tab">Add Members</a></li>
                                <li role="presentation"><a href="#removeMembers" aria-controls="removeMembers" role="tab" data-toggle="tab">Remove Members</a></li>
                            </ul>

                            <div role="tabpanel" class="tab-pane active" id="addMembers">


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

        <div class="panel panel-default">
                <div class="panel-heading">Actions <span class="col-md-offset-2">Account Balance: {{$account->amount->amount}}</span> <span class="col-md-offset-5"><a href="{{ route('accountUsers', [$account_id]) }}">Members</a> </span></div>

                <div class="panel-body">

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"  class="active"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab">Deposit</a></li>
                            <li role="presentation"><a href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab">Withdraw</a></li>
                            <li role="presentation"><a href="#withdrawRequests" aria-controls="withdrawRequests" role="tab" data-toggle="tab">Withdraw Requests</a></li>
                        </ul>

                        <div role="tabpanel" class="tab-pane active" id="deposit">


                            @include('account.partials.deposit_form')

                        </div>

                        <div role="tabpanel" class="tab-pane" id="withdraw">


                            @include('account.partials.withdraw_form')

                        </div>

                        <div role="tabpanel" class="tab-pane" id="withdrawRequests">

                        </div>


                    </div>
        </div>
    </div>
</div>
@endsection
