<form class="navbar-form navbar-left" method="get" action="{{ url('accounts/allAccounts/get') }}">
    {!! csrf_field() !!}
    <div class="form-group  {{ $errors->has('q') ? ' has-error' : '' }}">
        <div class="col-md-7">
            <input type="text" class="form-control" id="search" name="q" placeholder="Search for a chama " @if($query == "") value="" @else value="{{$query}}" @endif>
            @if ($errors->has('q'))
                <span class="help-block">
                                        <strong>{{ $errors->first('q') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> search</button>
        </div>
    </div>
</form>
