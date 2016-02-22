<div style="padding-top: 5%;">
    <form class="form-horizontal" method="post" action="{{ route('depositFixed') }}">
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

        <div class="form-group {{ $errors->has('withdraw_date') ? 'has-error' : ''}}">

            <label class="col-md-4 control-label">Withdraw date*</label>

            <div class="col-md-6">

                <input type="date" class="form-control" name="withdraw_date" value="{{ old('withdraw_date')}}" required="">

                @if($errors->has('withdraw_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('withdraw_date') }}</strong>
                    </span>
                @endif

            </div>

        </div>

        <div class="form-group">

        @if($fixed != null)
            @if($fixed->withdraw_date > $today)

            <div class="col-md-6 col-md-offset-1">
                <button type="submit" class="btn btn-primary" disabled>
                    <i class="fa fa-btn fa-sign-in"></i>You cannot deposit until date {{$fixed->withdraw_date}}, you have Kshs {{$fixed->transaction_amount}} in your fixed account
                </button>
            </div>
            @else

            <div class="col-md-6 col-md-offset-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Deposit
                </button>
            </div>

            @endif
        @else
        <div class="form-group">
            <div class="col-md-6 col-md-offset-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Deposit
                </button>
            </div>
        </div>
        @endif

        </div>
    </form>
</div>