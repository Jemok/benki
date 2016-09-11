@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="#" class="navigation"> <i class="fa fa-btn fa-angle-double-left"></i>Back</a>
        </div>
    </div>

    @include('flash.flash_message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel">
                <div class="panel-heading panel-top">
                    <h5><strong>Chama members</strong></h5>
                </div>
                <div class="panel-body panel-left-border">

                    @if($users->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Email</strong></td>
                                    <td><strong>Contribution (Kshs)</strong></td>
                                </tr>
                            </thead>
                            @foreach($users as $user)

                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ \App\AccountContribution::where('user_id', $user->id)->sum('amount')  }}</td>
                            </tr>
                            @endforeach

                         </table>


                    @else

                        <p>No members were found for this account</p>

                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
