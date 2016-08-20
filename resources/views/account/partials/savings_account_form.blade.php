 <form class="form-horizontal" method="post" action="{{ route('saveSavings') }}">
        {{ csrf_field() }}

        <!--
        <div class="form-group {{$errors->has('amount') ? 'has-error': ''}}">

            <label class="control-label col-md-4">Amount to deduct</label>
            <div class="col-md-6">
                <input type="text" name="amount" class="form-control" value="{{ old('amount')}}" required>

                @if( $errors->has('amount') )</div>

                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        -->
        <div class="form-group {{ $errors->has('percentage') ? 'has-error' : ''}}">
            <label class="col-md-4 control-label">Percentage</label>

            <div class="col-md-6">
                <input type="number" min="0" max="100" step=""  class="form-control" name="percentage" value="{{ old('percentage') }}"  required="">

                @if($errors->has('percentage'))
                <span class="help-block">
                    <strong>{{ $errors->first('percentage') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('duration') ? ' has-error' : '' }}">

            <label class="control-label col-md-4">Duration to deduct</label>

            <div class="col-md-6">
                <select class="form-control" name="duration">

                    <option value="1" selected disabled>Select Period</option>

                    <option value="1">Daily</option>
                    <option value="7">Weekly</option>
                    <option value="30">Monthly</option>

                </select>
                @if ($errors->has('duration'))
                    <span class="help-block">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('withdraw_date') ? ' has-error' : '' }}">

            <label class="control-label col-md-4">Until</label>

            <div class="col-md-6">

                <input type="date" class="form-control" min="{{$today}}" name="withdraw_date"  required="">

                @if($errors->has('withdraw_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('withdraw_date') }}</strong>
                    </span>
                @endif

            </div>
        </div>


            <div class="form-group">
                <div class="col-md-3 col-sm-offset-1 ">
                    <button type="submit" class="btn btn-danger btn-sm" @if(\Auth::user()->current_account->account_amount == 0) disabled @endif>
                    @if(\Auth::user()->current_account->account_amount != 0)
                        <i class="fa fa-btn fa-sign-in"></i>Save
                    @else
                        <i class="fa fa-btn fa-sign-in"></i>No money in your current account
                    @endif
                    </button>
                </div>
            </div>
    </form>
