<form class="form-horizontal" method="post" action="{{ route('updateRates') }}">
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('category_one') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Category One (KES 1 - 10,000)*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="category_one" value="{{$rates->category_one}}">

            @if($errors->has('category_one'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_one') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('category_two') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Category Two (KES 10,001 - 20,000)*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="category_two" value="{{$rates->category_two}}">

            @if($errors->has('category_two'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_two') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('category_three') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Category Three (KES 20,001 - 50,000)*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="category_three" value="{{$rates->category_three}}">

            @if($errors->has('category_three'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_three') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group {{ $errors->has('category_four') ? 'has-error' : ''}}">
        <label class="col-md-4 control-label">Category Three (above KES 50,000)*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="category_four" value="{{$rates->category_four}}">

            @if($errors->has('category_four'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_four') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-sign-in"></i>Update Rates
            </button>
        </div>
    </div>

</form>