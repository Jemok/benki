<form class="form-horizontal" method="post" action="{{ route('getProfitDate') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('profit_date') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Profit Date (e.g 2016-09-11) (YYYY-MM-DD)</label>

        <div class="col-md-6">
            <input type="date" class="form-control" name="profit_date" value="{{ old('profit_date') }}"  required="">

            @if($errors->has('profit_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('profit_date') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-deposit ">
                <i class="fa fa-btn fa-sign-in"></i>Query
            </button>
        </div>
    </div>
</form>
