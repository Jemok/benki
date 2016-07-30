@extends('layouts.app_two')

@section('content')
@if($count > 0)
    @foreach($accounts as $account)

        <div class="col-md-offset-1">
            Chamas
        </div>

        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                {{--<a href="{{ url('accounts/'. \App\Account::where('id', $account->account_id)->first()->id) }}">--}}
                <p>{{\App\Account::where('id', $account->account_id)->first()->account_name}}</p>
            </div>

        </div><!--end of teams data-->
    @endforeach{{--end of for each--}}

    {{--pagination--}}
    <div class="row">
        <div class="col-md-offset-3 col">
            {!! $accounts->render() !!}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <p><strong>No chama accounts for this user !!</strong></p>
            </div>
        </div>
    </div>
@endif
@endsection