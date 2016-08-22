
<form class="form-inline" method="post" action="{{ route('addMember', [$account_id]) }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

        <select class="form-control" name="email">

            @if($users != null)
            @foreach($users as $user)
            <option value="{{$user->email}}">{{ $user->name }} {{ $user->email }}</option>
            @endforeach
            @else
            <option>No requests around</option>
            @endif

        </select>

        @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
        @endif
    </div>

    @if(!$users == null)
    <button type="submit" class="btn btn-add-member"><i class="fa fa-btn fa-angle-double-left"></i>&nbsp;Add member</button>
    @endif
</form>