<form class="form-horizontal" id="createAccountForm" method="post" action="{{ route('createAccount') }}">
    {{ csrf_field() }}

    <div class="form-group ">
        <div class="col-md-6">
        <div class="input-group changethisone {{ $errors->has('account_name') ? 'has-error' : ''}}">
            <input type="text" class="form-control" name="account_name" placeholder="Name" value="{{ old('account_name') }}"/>

            <span class="input-group-addon" onclick="createAccount()">

                <i class="fa fa-plus-square" aria-hidden="true">&nbsp;<strong>Create</strong></i>

            </span>
        </div>
            @if($errors->has('account_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('account_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

<!-- @if($accounts_type->count())-->





<!-- @endif -->
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