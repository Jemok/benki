<div style="padding-top: 5%;">
    <form class="form-horizontal" method="post" action="{{ route('updateSavings', [$saving->id]) }}">
        {{ csrf_field() }}

        <!--
        <div class="form-group {{$errors->has('amount') ? 'has-error': ''}}">

            <label class="control-label col-md-4">Amount to deduct</label>
            <div class="col-md-6">
                <input type="text" name="amount" class="form-control" value="{{$saving->transaction_amount}}" required>

                @if( $errors->has('amount') )

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
                <input type="number" min="0" max="100" step=""  class="form-control" name="percentage" value="{{$saving->percentage}}"  required="">

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

                    <option value="1" @if ($saving->duration == 1)  selected="selected" @endif>Daily</option>
                    <option value="7"  @if ($saving->duration == 7)  selected="selected" @endif>Weekly</option>
                    <option value="30"  @if ($saving->duration == 30)  selected="selected" @endif>Monthly</option>

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

                <input type="date" class="form-control" min="{{$today}}" name="withdraw_date" value="{{$saving->withdraw_date}}" required="">

                @if($errors->has('withdraw_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('withdraw_date') }}</strong>
                    </span>
                @endif

            </div>
        </div>


        <div class="form-group">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" disabled>
                        <i class="fa fa-btn fa-sign-in"></i>Yo have Kshs {{$saving->transaction_amount }} in your savings account
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>