@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Main Admin Two</div>

                    <div class="panel-body">

                        @include('user.partials.search_users')

                        <div class="row col-md-12 table-responsive">
                            @if($users->count())

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>
                                                Name
                                            </td>
                                            <td>
                                                Email
                                            </td>
                                            <td>
                                                Number
                                            </td>
                                            <td>
                                                Accounts
                                            </td>
                                            <td>
                                                Savings
                                            </td>
                                            <td>
                                                Fixed
                                            </td>
                                            <td>
                                                Received
                                            </td>
                                            <td>
                                                Sent
                                            </td>
                                            <td>
                                                Chama Withdrawals
                                            </td>
                                            <td>
                                                Chama Deposits
                                            </td>
                                            <td>
                                                Current Deposits
                                            </td>
                                            <td>
                                                Add Money
                                            </td>
                                        </tr>
                                    </thead>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_number}}</td>
                                                <td><a href="{{ route('userAccounts', [$user->id]) }}">Accounts</a></td>
                                                <td><a href="{{ route('userSavings', [$user->id]) }}">Savings</a></td>
                                                <td><a href="{{ route('fixedRecords', [$user->id]) }}">Fixed</a></td>
                                                <td><a href="{{ route('receivedTransfers', [$user->id]) }}">Received</a></td>
                                                <td><a href="{{ route('sentTransfers', [$user->id]) }}">Sent</a></td>
                                                <td><a href="{{ route('chamaWithdrawals', [$user->id]) }}">Withdrawals</a> </td>
                                                <td><a href="{{ route('chamaDeposits', [$user->id]) }}">Deposits</a> </td>
                                                <td><a href="{{ route('currentDeposits', [$user->id]) }}">Deposits</a></td>
                                                <td><a href="{{ route('getDepositForUser', [$user->id]) }}">Add Money</a> </td>
                                            </tr>
                                        @endforeach
                                </table>
                            @else
                                <h1>No users found</h1>
                            @endif
                        </div>


                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading panel-top">Freezed accounts</div>

                    <div class="panel-body">

                        <div class="row col-md-12 table-responsive">
                            @if($users_freezed->count())

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>
                                            Name
                                        </td>
                                        <td>
                                            Email
                                        </td>
                                        <td>
                                            Amount
                                        </td>
                                        <td>
                                            Approve
                                        </td>
                                    </tr>
                                    </thead>
                                    @foreach($users_freezed as $freeze)
                                        <tr>
                                            <td>{{$freeze->user->name}}</td>
                                            <td>{{$freeze->user->email}}</td>
                                            <td>
                                                {{$freeze->account_amount}}
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('approveFreezed', [$freeze->id]) }}">
                                                    {{csrf_field()}}
                                                    <button class="btn btn-info" type="submit">
                                                        Approve
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <h1>No freezed users</h1>
                            @endif
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection