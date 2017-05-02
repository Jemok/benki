@extends('layouts.app_two')

@section('content')
    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Main Admin Three <a href="{{ route('getCharges') }}" style="color: whitesmoke;">Get Charges</a> </div>
                    <div class="panel-body">
                        <div class="row col-md-12">

                            @include('charges.add_charge_form')

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Set Dollar Rate <a href="{{ route('viewDollarRates') }}" style="color: whitesmoke;">View Rates</a> </div>
                    <div class="panel-body">
                        <div class="row col-md-12">

                            @include('charges.set_dolar_rate')

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">View Your Profits</div>
                    <div class="panel-body">
                        <div class="row col-md-12">

                            @include('profit.profit_date_form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection