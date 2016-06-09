@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <!-- search for a team-->
                <div class="col-md-12">
                    <form class="form-horizontal" method="get" action="{{ url('accounts/allAccounts/get') }}">
                        {!! csrf_field() !!}
                        <div class="form-group  {{ $errors->has('q') ? ' has-error' : '' }}">
                            <div class="col-md-3">
                                <label for="search">Search for a chama</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="search" name="q" placeholder="search for a team" @if($query == "") value="" @else value="{{$query}}" @endif>
                                @if ($errors->has('q'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('q') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end of search-->
            </div>
            <!--display all teams panel-->
            <div class="row"><!--heading-->
                <div class="col-md-12">
                   <h4><strong>All available chamas!!</strong></h4>
                </div>
            </div> <!--end of heading-->
            <!--more teams headers-->
            <div class="row">
                <div class="col-md-4">
                    <h5><strong>Chama Name</strong></h5>
                </div>
            </div>

            <!--end of header row-->
            <!--teams data loop-->
            @if($accounts->count())
                            @foreach($accounts as $account)

                        <div class="row">
                            <div class="col-md-2">
                                <p><a href="{{ url('accounts/'. $account->id) }}">{{$account->account_name}}</a></p>
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
                                <div class="col-md-5">
                                    <div class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                        <p><strong>No accounts found marching your search !!</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>


            </div>
        </div>
    </div>
</div>


@endsection
