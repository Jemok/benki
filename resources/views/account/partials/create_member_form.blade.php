<div style="padding-top: 5%;">
<form class="form-inline" method="post" action="{{ route('addMember', [$account_id]) }}">

    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

        <select class="form-control" name="email">

            @if($users->count())
            @foreach($users as $user)
            <option value="{{$user->email}}">{{ $user->name }} {{ $user->email }}</option>
            @endforeach
            @else
            <option>No user around</option>
            @endif

        </select>
        @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
        @endif
    </div>
    @if(!$users->count() == 0)
    <button type="submit" class="btn btn-default">Add</button>
    @endif
</form>
</div>