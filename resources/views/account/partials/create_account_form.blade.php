<form class="form-horizontal col-md-12" method="post" action="{{ route('createAccount') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('account_name') ? 'has-error' : ''}}">
        <div class="col-md-6 col-md-offset-1">
            <input type="text" class="form-control" name="account_name" placeholder="Account Name" value="{{ old('account_name') }}">

            @if($errors->has('account_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('account_name') }}</strong>
                </span>
            @endif
        </div>
    <!-- @if($accounts_type->count())-->

        <div class="form-group">
            <div class="col-md-4 ">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Create Account
                </button>
            </div>
        </div>

    <!-- @endif -->

    </div>
    <!--
    <div class="form-group {{ $errors->has('account_description') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Description*</label>

        <div class="col-md-6">
            <textarea type="text" class="form-control" name="account_description">

            </textarea>

            @if($errors->has('account_description'))
                <span class="help-block">
                    <strong>{{ $errors->first('account_description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('account_type') ? 'has-error': ''}}">
        <label class="col-md-4 control-label">Account Type*</label>

        <div class="col-md-6">
            <select class="form-control" name="account_type">

                <option selected disabled>Select An Account</option>

                @if($accounts_type->count())
                    @foreach($accounts_type as $account_type)
                        <option value="{{$account_type->id}}">{{$account_type->account_type_name}}</option>
                    @endforeach
                @else
                        <option>No Accounts Created</option>
                @endif
            </select>
            @if($errors->has('account_type'))
                <span class="help-block">
                    <strong>{{ $errors->first('account_type') }}</strong>
                </span>
            @endif
        </div>
    </div>

    -->

</form>