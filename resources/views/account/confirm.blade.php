@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Confirmed Users</div>

                <div class="panel-body">
                    @if($confirmations->count())

                        @foreach($confirmations as $confirmation)

                            <p>{{ $userClass->userName($confirmation->user_id)}} ({{$confirmation->created_at->diffForHumans()}})</p>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
