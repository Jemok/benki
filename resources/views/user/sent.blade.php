@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Sent Transactions Records</div>

                    <div class="panel-body">
                        <div class="row col-md-12">
                            @if($sent_count > 0)
                                <div>
                                    Sent Transactions Records
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>
                                            Amount
                                        </td>
                                        <td>
                                            To
                                        </td>
                                        <td>
                                            Date
                                        </td>
                                    </tr>

                                    </thead>
                                @foreach($sent as $send)
                                        <tr>
                                            <td>
                                                {{$send->transfer_amount}}
                                            </td>
                                            <td>
                                                <?php
                                                $class = new \App\User();
                                                ?>

                                                {{  $class->userName($send->receiver_id)  }}
                                            </td>
                                            <td>
                                                {{$send->created_at->diffForHumans()}}
                                            </td>
                                        </tr>
                                    <!--end of teams data-->
                                @endforeach{{--end of for each--}}
                                </table>

                                {{--pagination--}}
                                <div class="row">
                                    <div class="col-md-offset-3 col">
                                        {!! $sent->render() !!}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                            <p><strong>No sent transactions !!</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
@endsection