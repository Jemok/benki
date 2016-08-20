@if(Session::has('flash_message_error'))

<div class="alert-message alert alert-warning alert-dismissible {{Session::has('flash_message_important') ? 'alert-important' : '' }}" role="alert">

    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="close">&times;</button>

    @endif

    {!! session('flash_message_error') !!}

</div>
@endif