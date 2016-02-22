@if(Session::has('flash_message_error'))

<div class="alert-message alert alert-warning {{Session::has('flash_message_important') ? 'alert-important' : '' }}">

    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    @endif

    {!! session('flash_message_error') !!}

</div>
@endif