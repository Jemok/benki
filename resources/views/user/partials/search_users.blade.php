<form class="col-md-10 form-horizontal" method="get" action="{{ route('searchUsers') }}">
    {!! csrf_field() !!}
    <div class="form-group  {{ $errors->has('q') ? ' has-error' : '' }}">
        <div class="col-md-10">
            <input type="text" class="form-control" id="search" name="q" placeholder="Search for a user using phone number email or name" @if(isset($query))@if($query == "") value="" @else value="{{$query}}" @endif @endif>
            @if ($errors->has('q'))
                <span class="help-block">
                    <strong>{{ $errors->first('q') }}</strong>
                </span>
            @endif
        </div>
        <div class="">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> search</button>
        </div>
    </div>
</form>