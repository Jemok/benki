<form method="post" id="withdrawFormAjax"  action="{{ route('withdrawFromAccountAjax', [$account_id]) }}" >

    <input type="hidden" name="_token" value="{{ $csrf_value }}">
    {{--<form method="post" action="{{ route('withdrawFromAccount', [$account_id]) }}">--}}


    <button class="btn btn-success" type="submit" onclick="submitWithdrawForm()">Withdraw</button>

</form>
