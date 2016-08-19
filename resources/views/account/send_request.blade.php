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
                    <button class="btn btn-primary" type="submit">Not a member want to Send a Request??</button>
                    </form>
                    @else

                    <div class="alert alert-info">

                    <h4>The request you sent has not yet been confirmed!</h4>

                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
