<form class="form-horizontal" method="post" action="{{ route('payment') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Pay With Paypal</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="amount" value="{{ old('amount') }}"  required="">

            @if($errors->has('amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('amount') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-deposit ">
                <i class="fa fa-btn fa-sign-in"></i>Save
            </button>
        </div>
    </div>
</form>
