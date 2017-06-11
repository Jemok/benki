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
            <label class="col-md-4 control-label">Withdraw date* e.g yyyy-mm-dd</label>

            <div class="col-md-6">
                <input type="date" class="form-control savings_date" min="{{$today}}" name="withdraw_date"  required="">

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

            <div class="col-md-3">
                <button type="submit" class="btn btn-withdrawal-date  col-md-10 center-block" disabled>
                    <i class="fa fa-lock" aria-hidden="true"></i>Locked - Withdraw date: {{$fixed->withdraw_date}}
                </button>
            </div>
            @else

            <div class="col-md-3">
                <button type="submit" class="btn btn-fixed-deposit center-block">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>Lock
                </button>
            </div>

            @endif
        @else
        <!--<div class="form-group">-->
            <div class="col-md-4 col-md-offset-1">

                <button type="submit" class="btn btn-fixed-deposit  btn-sm center-block"  @if(\Auth::user()->current_account->account_amount == 0) disabled @endif>
                    @if(\Auth::user()->current_account->account_amount != 0)
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>Lock
                    @else
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>Low Balance {{\Auth::user()->current_account->account_amount}}
                    @endif
                </button>
            </div>
        <!--</div>-->
        @endif

        </div>
    </form>
