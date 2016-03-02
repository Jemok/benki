<div style="padding-top: 5%;">
    <form class="form-horizontal" method="post" action="{{ route('transferToUser') }}">
        {{ csrf_field() }}

        <div  class="form-group {{ $errors->has('transfer_to') ? ' has-error' : '' }}">

            <label class="col-md-4 control-label">Transfer to:</label>


            <div class="col-md-6">

                <select class="form-control tag_list" name="transfer_to" multiple>

                    <option disabled>Select User</option>

                    @if($users->count())
                        @foreach($users as $user)

                        <option value="{{$user->id}}">{{$user->email}}</option>

                        @endforeach
                    @endif

                </select>
                @if ($errors->has('transfer_to'))
                         <span class="help-block">
                             <strong>{{ $errors->first('transfer_to') }}</strong>
                         </span>
                @endif
            </div>
          </div>

          <div class="form-group {{ $errors->has('transfer_amount') ? 'has-error' : ''}}">
                <label class="col-md-4 control-label">Amount*</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="transfer_amount" value="{{ old('transfer_amount') }}"  required="">

                    @if($errors->has('transfer_amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('transfer_amount') }}</strong>
                </span>
                    @endif
                </div>
           </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    @if(\Auth::user()->current_account()->first()->account_amount <= 0)
                    <button type="submit" class="btn btn-primary" disabled>
                        <i class="fa fa-btn fa-sign-in"></i>Your account is low Kshs {{\Auth::user()->current_account()->first()->account_amount}} , you cant transfer
                    </button>
                    @else
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Transfer
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>