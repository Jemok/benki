<form class="form-horizontal" method="post" action="{{ route('setDollarRate') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('dollar_rate') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Dolar Rate</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="dollar_rate" value="{{ old('dollar_rate') }}"  required="">

            @if($errors->has('dollar_rate'))
                <span class="help-block">
                    <strong>{{ $errors->first('dollar_rate') }}</strong>
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
