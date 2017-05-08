@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash.flash_message')
            @include('flash.flash_message_error')

            <div>
    <span>
    </span>
            </div>

            <div class="panel">
                <div class="panel-heading panel-top"><strong>Select a Chama</strong></div>
                <div class="panel-body panel-left-border">
                    <div class="row" xmlns="http://www.w3.org/1999/html">
                        <div class="col-md-12">
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active pane-heading"><a href="#my-account" aria-controls="my-account" role="tab" data-toggle="tab"><strong><u>Chama Name</u></strong></a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active pane-content" id="my-account" >
                                        @if($user_accounts->count())
                                            @foreach($user_accounts as $user_account)
                                                <table class="table">
                                                    <thead>
                                                    <span class="text"><a href="{{ route('getAccount', [$user_account->account_id]) }}">{{$account_class->accountName($user_account)}}</a></span>
                                                    </thead>
                                                </table>
                                            @endforeach
                                        @else
                                            <span class="text text-success">You have no chama account and you do not belong in any.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
