<form class="form-horizontal" method="post" action="{{ route('addCharge') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('transaction_type') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Transaction Type</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="transaction_type" value="{{ old('transaction_type') }}"  required="">

            @if($errors->has('transaction_type'))
                <span class="help-block">
                    <strong>{{ $errors->first('transaction_type') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('transaction_category') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Transaction Category</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="transaction_category" value="{{ old('transaction_category') }}"  required="">

            @if($errors->has('transaction_category'))
                <span class="help-block">
                    <strong>{{ $errors->first('transaction_category') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('transaction_name') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Transaction Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="transaction_name" value="{{ old('transaction_name') }}"  required="">

            @if($errors->has('transaction_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('transaction_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('charge') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Transaction Charge</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="charge" value="{{ old('charge') }}"  required="">

            @if($errors->has('charge'))
                <span class="help-block">
                    <strong>{{ $errors->first('charge') }}</strong>
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
