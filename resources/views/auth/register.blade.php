@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>

    <div class="row" style="background-color: #FFFFFF;">
        <div class="col-md-8 col-md-offset-2" style="background-color: #FFFFFF;">
            <div class="panel " style="background-color: #FFFFFF;">
                {{--<div class="panel-heading panel-top">Register</div>--}}
                <div class="panel-body panel-left-border" style="margin-top: 40px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">Name</label>--}}

                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">E-Mail Address</label>--}}

                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">Phone Number</label>--}}

                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Phone number" name="phone_number" value="{{ old('phone_number') }}">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">Password</label>--}}

                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="password" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">Confirm Password</label>--}}

                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-login center-block">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
