@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Savings Transactions</div>

                    <div class="panel-body">
                        <div class="row col-md-12">
                            @if($records_count > 0)
                                @foreach($user_fixed as $fixed)

                                    <div>
                                        Savings Transactions
                                    </div>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>
                                                Amount
                                            </td>
                                            <td>
                                                Percentage(%)
                                            </td>
                                            <td>
                                                Duration
                                            </td>
                                            <td>
                                                Withdraw Date
                                            </td>
                                            <td>
                                                Creation
                                            </td>
                                            <td>
                                                Last Updated
                                            </td>
                                        </tr>

                                        </thead>
                                        <tr>
                                            <td>
                                                {{$fixed->transaction_amount}}
                                            </td>
                                            <td>
                                                {{$fixed->percentage}}
                                            </td>
                                            <td>
                                                @if($fixed->duration == 1)
                                                    Daily
                                                @endif

                                                @if($fixed->duration == 2)
                                                    Weekly
                                                @endif

                                                @if($fixed->duration == 3)
                                                    Monthly
                                                @endif
                                            </td>
                                            <td>
                                                {{$fixed->withdraw_date}}
                                            </td>
                                            <td>
                                                {{$fixed->created_at}}
                                            </td>
                                            <td>
                                                {{ $fixed->updated_at  }}
                                            </td>
                                        </tr>
                                    </table>

                                    <!--end of teams data-->
                                @endforeach{{--end of for each--}}

                                {{--pagination--}}
                                <div class="row">
                                    <div class="col-md-offset-3 col">
                                        {!! $user_fixed->render() !!}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                            <p><strong>No fixed transactions !!</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
@endsection