 <form class="form-horizontal" method="post" action="{{ route('transferToManyUsers') }}">
        {{ csrf_field() }}


     <div class="form-group {{ $errors->has('transfer_to') ? ' has-error' : '' }}">
         {{--<label for="transfer_to" class="col-md-2 control-label">To</label>--}}

         <div class="col-md-10">
             <input type="text" id="transfer_multiple" name="transfer_to" placeholder="Numbers" required>

             @if($errors->has('transfer_to'))
                 <span class="help-block">
                     <strong>{{ $errors->first('transfer_to') }}</strong>
                 </span>
             @endif
         </div>
     </div>

        {{--<div  class="form-group {{ $errors->has('transfer_to') ? ' has-error' : '' }}">--}}


            {{--<div class="col-md-12">--}}

                {{--<select class="form-control tag_list" name="transfer_to[]" multiple>--}}

                    {{--@if($users->count())--}}
                        {{--@foreach($users as $user)--}}

                        {{--<option value="{{$user->id}}">{{$user->email}}</option>--}}

                        {{--@endforeach--}}
                    {{--@endif--}}

                {{--</select>--}}
                {{--@if ($errors->has('transfer_to'))--}}
                         {{--<span class="help-block">--}}
                             {{--<strong>{{ $errors->first('transfer_to') }}</strong>--}}
                         {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
          {{--</div>--}}
        <div class="form-group {{ $errors->has('transfer_amount') ? 'has-error' : ''}}">

            <div class="col-md-6">
                <input type="text" id="multiple_amount" class="form-control" min="0" max="{{ Auth::user()->current_account()->first()->account_amount }}" placeholder="Amounts" name="transfer_amount" value="{{ old('transfer_amount') }}"  required="">

                @if($errors->has('transfer_amount'))
                    <span class="help-block">
                    <strong>{{ $errors->first('transfer_amount') }}</strong>
                </span>
                @endif
            </div>
        </div>

         <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">

             <div class="col-md-6">
                 <input type="password" name="password" class="form-control" placeholder="Your password"  required="">

                 @if($errors->has('password'))
                     <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                 @endif
             </div>
         </div>
            <div class="form-group">
                <div class="col-md-12">
                    @if(\Auth::user()->current_account()->first()->account_amount <= 0)
                    <button type="submit" class="btn btn-account col-md-offset-2 col-md-4 center-block" disabled>
                        Low balance: {{\Auth::user()->current_account()->first()->account_amount}}
                    </button>
                    @else
                    <button type="submit" class="btn btn-transfer btn-sm center-block">
                        <i class="fa fa-btn fa-sign-in"></i>Transfer
                    </button>
                    @endif
                </div>
            </div>

    </form>
