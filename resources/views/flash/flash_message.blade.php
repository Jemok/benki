@if(Session::has('flash_message'))

    <div class="alert-message alert alert-dismissible alert-success {{Session::has('flash_message_important') ? 'alert-important' : '' }}" role="alert">

        @if(Session::has('flash_message_important'))

             <button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="close">
                 <span aria-hidden="true">&times;</span></button>

        @endif

        {!! session('flash_message') !!}

    </div>
@endif