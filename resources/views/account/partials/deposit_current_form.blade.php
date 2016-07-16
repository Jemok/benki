
<form class="form-horizontal col-md-12" method="post" action="{{ route('depositCurrent') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <div class="col-md-6 col-md-offset-1">
            <input type="text" class="form-control" placeholder="Amount" name="amount" value="{{ old('amount') }}"  required="">

            @if($errors->has('amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('amount') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Deposit
                </button>
            </div>
        </div>
    </div>
</form>

<h3 class="col-md-offset-4">OR</h3>