<form class="form-horizontal" method="post" action="{{ route('updateRates') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('fixed') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Fixed account rates*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="fixed" value="{{$rates->fixed}}">

            @if($errors->has('fixed'))
                <span class="help-block">
                    <strong>{{ $errors->first('fixed') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('savings') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Savings account rates*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="savings" value="{{$rates->savings}}">

            @if($errors->has('savings'))
                <span class="help-block">
                    <strong>{{ $errors->first('savings') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Update Rates
            </button>
        </div>
    </div>



</form>