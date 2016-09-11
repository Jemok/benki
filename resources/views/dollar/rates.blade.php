@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">View Previous Dollar Rates </div>
                    <div class="panel-body">
                        <div class="row col-md-12">
                            @if($rates->count())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>
                                                Rate
                                            </td>
                                            <td>
                                                Date
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rates as $rate)
                                            <tr>
                                                <td>
                                                    {{ $rate->rate }}
                                                </td>
                                                <td>
                                                    {{ $rate->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $rates->links() }}
                            @else
                                <h4>No Dollar rates have been set </h4>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection