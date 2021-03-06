@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Savings Transactions Records</div>

                    <div class="panel-body">
                        <div class="row col-md-12">

                                    <div>
                                        Savings Transactions Records
                                    </div>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>
                                                Amount
                                            </td>
                                            {{--<td>--}}
                                                {{--Percentage(%)--}}
                                            {{--</td>--}}
                                            <td>
                                                Creation
                                            </td>
                                            <td>
                                                Last Updated
                                            </td>
                                        </tr>

                                        </thead>
                                        @if($records_count > 0)
                                            @foreach($saving_records as $records)
                                        <tr>
                                            <td>
                                                {{$records->amount}}
                                            </td>
                                            {{--<td>--}}
                                                {{--{{$records->transactions->percentage}}--}}
                                            {{--</td>--}}
                                            <td>
                                                {{$records->created_at}}
                                            </td>
                                            <td>
                                                {{ $records->updated_at  }}
                                            </td>
                                        </tr>
                                            @endforeach{{--end of for each--}}
                                    </table>

                                {{--pagination--}}
                                <div class="row">
                                    <div class="col-md-offset-3 col">
                                        {!! $saving_records->render() !!}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                            <p><strong>No savings records transactions !!</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
@endsection