 <form class="form-horizontal" method="post" action="{{ route('withdrawRequest', [$account_id]) }}">

        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('request_amount') ? 'has-error' : ''}}">
            <label class="col-md-4 control-label">Amount*</label>

            <div class="col-md-12">
                <input type="text" class="form-control" name="request_amount" value="{{ old('request_amount') }}"  required="">

                @if($errors->has('request_amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('request_amount') }}</strong>
                </span>
                @endif
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-btn fa-sign-in"></i>Send Request
                </button>
            </div>
        </div>
    </form>


{{--<form class="form-horizontal withdrawRequestForm" id="{{ $account_id }}">--}}
