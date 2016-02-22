<form class="form-horizontal" method="post" action="{{ route('validateForAccount', [$account_id]) }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Your Email*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}">

            @if($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Submit
            </button>
        </div>
    </div>
</form>