<div style="padding-top: 5%;">
<form class="form-horizontal" method="post" action="{{ route('depositCurrent') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Amount*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="amount" value="{{ old('amount') }}"  required="">

            @if($errors->has('amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('amount') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Deposit
            </button>
        </div>
    </div>
</form>
</div>