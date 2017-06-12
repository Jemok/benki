@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Fixed Amount Savings Transactions</div>

                    <div class="panel-body">
                        <div class="row col-md-12">
                        @if($savings_fixed_count > 0)
                            @foreach($user_fixed_savings as $savings)

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
                                                Saved Amount
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
                                            <td>
                                                Duration Records
                                            </td>
                                        </tr>

                                    </thead>
                                    <tr>
                                        <td>
                                            {{$savings->transaction_amount}}
                                        </td>
                                        <td>
                                            {{$savings->deduct_amount}}
                                        </td>
                                        <td>
                                            @if($savings->duration == 1)
                                                Daily
                                            @endif

                                            @if($savings->duration == 2)
                                                Weekly
                                            @endif

                                            @if($savings->duration == 3)
                                                Monthly
                                            @endif
                                        </td>
                                        <td>
                                            {{$savings->withdraw_date}}
                                        </td>
                                        <td>
                                            {{$savings->created_at}}
                                        </td>
                                        <td>
                                            {{ $savings->updated_at  }}
                                        </td>
                                        <td>
                                            <a href="{{ route('savingRecords', [$savings->id]) }}">Records</a>
                                        </td>
                                    </tr>
                                </table>

                                <!--end of teams data-->
                            @endforeach{{--end of for each--}}

                            {{--pagination--}}
                            <div class="row">
                                <div class="col-md-offset-3 col">
                                    {!! $user_fixed_savings->render() !!}
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-5 col-md-offset-2">
                                    <div class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                        <p><strong>No savings transactions !!</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endif
    </div>
    </div>
@endsection