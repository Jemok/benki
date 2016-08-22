<form class="form-horizontal accountDepositForm " id="{{$account_id}}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label amountDepositLabel">Amount*</label>

        <div class="col-md-6">
            <input type="text" class="form-control accountDepositAmount" name="amount" value="{{ old('amount') }}"  required="">

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
                <i class="fa fa-btn fa-sign-in"></i>Deposit
            </button>
        </div>
    </div>
</form>


{{--commented out--}}
{{--<form class="form-horizontal" method="post" action="{{ route('depositAmount', [$account_id]) }}">--}}
