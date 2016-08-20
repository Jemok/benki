 <form class="form-horizontal" method="post" action="{{ route('transferToUser') }}">
        {{ csrf_field() }}

        <div  class="form-group {{ $errors->has('transfer_to') ? ' has-error' : '' }}">


            <div class="col-md-12">

                <select class="form-control tag_list" name="transfer_to[]" multiple>

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

            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Amount" name="transfer_amount" value="{{ old('transfer_amount') }}"  required="">

                @if($errors->has('transfer_amount'))
                    <span class="help-block">
                    <strong>{{ $errors->first('transfer_amount') }}</strong>
                </span>
                @endif
            </div>
        </div>
            <div class="form-group">
                <div class="col-md-12">
                    @if(\Auth::user()->current_account()->first()->account_amount <= 0)
                    <button type="submit" class="btn btn-danger col-md-offset-2 col-md-4" disabled>
                        <i class="fa fa-btn fa-sign-in"></i>Current account is low Kshs {{\Auth::user()->current_account()->first()->account_amount}}
                    </button>
                    @else
                    <button type="submit" class="btn btn-primary btn-sm col-md-offset-2 col-md-4">
                        <i class="fa fa-btn fa-sign-in"></i>Transfer
                    </button>
                    @endif
                </div>
            </div>

    </form>
