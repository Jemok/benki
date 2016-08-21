@if(Session::has('flash_message_auth_email'))

    <div class="alert-message alert alert-info alert-dismissible {{Session::has('flash_message_important') ? 'alert-important' : '' }}">

        @if(Session::has('flash_message_important'))

             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {!! session('flash_message_auth_email') !!}

    </div>
@endif