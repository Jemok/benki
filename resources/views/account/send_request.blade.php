@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel ">
                <div class="panel-heading panel-top"><strong>Send request.. Be a chama member</strong></div>

                <div class="panel-body panel-left-border">
                    @if($request == "")
                    <form method="post" action="{{ url('accounts/'. $account_id . '/send/request') }}">
                    {!! csrf_field() !!}
                    <button class="btn btn-send-request" type="submit">Send Request</button>
                    </form>
                    @else

                    <div class="alert alert-info">

                    <span class="text">The request you sent has not yet been confirmed!</span>

                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
