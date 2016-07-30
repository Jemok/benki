@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Current Accounts Deposits Records</div>

                        <h1>Current Account: {{ $current_amount }}</h1>

                    <div class="panel-body">
                        <div class="row col-md-12">
                            @if($currents_count > 0)
                                <div>
                                    Current Accounts Deposits Records
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>
                                            Amount
                                        </td>
                                        <td>
                                            Time
                                        </td>
                                    </tr>

                                    </thead>
                                    @foreach($currents as $current)
                                        <tr>
                                            <td>
                                                {{$current->amount}}
                                            </td>
                                            <td>
                                                {{$current->created_at->diffForHumans()}}
                                            </td>
                                        </tr>
                                        <!--end of teams data-->
                                    @endforeach{{--end of for each--}}
                                </table>

                                {{--pagination--}}
                                <div class="row">
                                    <div class="col-md-offset-3 col">
                                        {!! $currents->render() !!}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                            <p><strong>No currents deposits transactions !!</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
@endsection