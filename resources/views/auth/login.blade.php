@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('/') }}" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>
    <div class="row" style="background-color: #FFFFFF; margin-top: 100px;">
        <div class="col-md-8 col-md-offset-2" style="background-color: #FFFFFF;">
            <div class="panel" style="background-color: #FFFFFF;">
                {{--<div class="panel-heading panel-top">Login</div>--}}
                <div class="panel-body panel-left-border">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">E-Mail Address</label>--}}

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="email@example.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{--<label class="col-md-4 control-label">Password</label>--}}

                            <div class="col-md-6">
                                <input type="password" placeholder="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-login center-block">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                                <a class="btn btn-link" style="color: black;" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
