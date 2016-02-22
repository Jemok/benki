@extends('layouts.app')

@section('content')

<div class="container">
    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">


                    @if($users->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>User</td>
                                    <td>Email</td>
                                </tr>
                            </thead>
                            @foreach($users as $user)

                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach

                         </table>


                    @else

                        <p>No users were found for this account</p>

                    @endif


                </div>
            </div>
        </div>
@endsection
