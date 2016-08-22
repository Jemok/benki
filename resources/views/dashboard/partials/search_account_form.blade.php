<form class="form-horizontal" id="searchForm" method="get" action="{{ url('accounts/allAccounts/get') }}" style="padding-top: 15px;">

<div class="form-group">
    <div class="col-md-4 col-md-offset-3">
        <div class="input-group changethisone" {{ $errors->has('q') ? ' has-error' : '' }}>

            <input type="text" class="form-control " id="search" name="q" placeholder="Search for a chama " @if(isset($query))@if($query == "") value="" @else value="{{$query}}" @endif @endif/>
            <span class="input-group-addon" onclick="submitSearch()">
                <i class="fa fa-search-plus" aria-hidden="true"></i>
            </span>

            @if ($errors->has('q'))
                <span class="help-block">
                <strong>{{ $errors->first('q') }}</strong>
            </span>
            @endif
        </div>
    </div>

</div>
</form>

{{--<form class="form-horizontal" method="get" action="{{ url('accounts/allAccounts/get') }}">--}}
    {{--{!! csrf_field() !!}--}}

    {{--<div class="form-group  {{ $errors->has('q') ? ' has-error' : '' }}">--}}

        {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control " id="search" name="q" placeholder="Search for a chama " @if(isset($query))@if($query == "") value="" @else value="{{$query}}" @endif @endif>--}}
            {{--@if ($errors->has('q'))--}}
                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('q') }}</strong>--}}
                                    {{--</span>--}}
            {{--@endif--}}
        {{--</div>--}}


        {{--<div class="col-md-1" >--}}
            {{--<button type="submit" class="btn btn-default btn-sm">--}}
                {{--<span class="glyphicon glyphicon-search" aria-hidden="true"></span> search</button>--}}
        {{--</div>--}}

    {{--</div>--}}
{{--</form>--}}
