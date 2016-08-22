@if(isset($message))
{{ $user_name }} confirmed your request, {{$message}}
@else
    {{ $user_name }} confirmed your request
@endif


