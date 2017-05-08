@extends('layouts.app')

@section('content')
    @include('dashboard.partials.search_account_form')


    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <a href="{{ url('/home') }}"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <!-- search for a chama-->
                <div class="col-md-12">
                    {{--<form class="form-horizontal" method="get" action="{{ url('accounts/allAccounts/get') }}">--}}
                        {{--{!! csrf_field() !!}--}}
                        {{--<div class="form-group  {{ $errors->has('q') ? ' has-error' : '' }}">--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label for="search">Search for a chama</label>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-7">--}}
                                {{--<input type="text" class="form-control" id="search" name="q" placeholder="search for a team" @if($query == "") value="" @else value="{{$query}}" @endif>--}}
                                {{--@if ($errors->has('q'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('q') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="col-md-1">--}}
                                {{--<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> search</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                <!--end of search-->
            </div>

            <!--display all teams panel-->
            <div class="row">
                <!--heading-->

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading panel-top">
                            <h5><strong>Select a chama</strong></h5>
                        </div>
                        <div class="panel-body panel-left-border">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#chama-name" aria-controls="chama-name" role="tab" data-toggle="tab"><strong><u>Chama Name</u></strong></a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active pane-content" id="chama-name">
                                        @if($accounts->count())
                                            @foreach($accounts as $account)

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><a href="{{ url('accounts/'. $account->id) }}">{{$account->account_name}}</a></p>
                                                    </div>

                                                </div><!--end of teams data-->
                                            @endforeach{{--end of for each--}}

                                            {{--pagination--}}
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-3 ">
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
            </div> <!--end of heading-->
            {{--<!--more teams headers-->--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4">--}}
                    {{--<h5><strong><u>Chama Name</u></strong></h5>--}}
                {{--</div>--}}
            {{--</div>--}}

            <!--end of header row-->
            <!--teams data loop-->
            {{--@if($accounts->count())--}}
                            {{--@foreach($accounts as $account)--}}

                        {{--<div class="row">--}}
                            {{--<div class="col-md-4">--}}
                                {{--<p><a href="{{ url('accounts/'. $account->id) }}">{{$account->account_name}}</a></p>--}}
                            {{--</div>--}}

                        {{--</div><!--end of teams data-->--}}
                            {{--@endforeach--}}{{--end of for each--}}

                        {{--pagination--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-offset-3 col-md-3 ">--}}
                            {{--{!! $accounts->render() !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@else--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-5">--}}
                                    {{--<div class="alert alert-info alert-dismissible" role="alert">--}}
                                        {{--<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>--}}
                                        {{--<p><strong>No accounts found marching your search !!</strong></p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
        </div>


            </div>
@endsection
