<tr>
    <td><a href="{{ route('getConfirmation', [$request_id]) }}"> {{$requester_name}}</a></td>
    <td>{{$request_amount}}</td>

    <td>

        <form method="post" action="{{route('setConfirmAjax', [$account_id, $request_id])}}">

                {{ csrf_field() }}

                <button type="submit" class="btn btn-info" onclick="submitConfirmationForm({{$request_id}})">Confirm</button>
        </form>
    </td>
</tr>