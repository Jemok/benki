@extends('layouts.app')

@section('content')

    <div class="container">
        @include('flash.flash_message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">
                    <div class="panel-heading panel-top">Charges</div>
                    <div class="panel-body">
                        <div class="row col-md-12">

                            @if($charges->count())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>
                                          Transaction Type
                                        </td>
                                        <td>
                                          Transaction Category
                                        </td>
                                        <td>
                                           Transaction Range
                                        </td>
                                        <td>
                                            Transaction Charges
                                        </td>
                                        <td>
                                            Update
                                        </td>
                                    </tr>

                                </thead>

                                @foreach($charges as $charge)

                                    <tr>
                                        <td>
                                            @if($charge->transaction_type == 1)
                                                User Transfers
                                            @else
                                                Chama Withdrawal
                                            @endif

                                        </td>
                                        <td>
                                            {{ $charge->transaction_category }}
                                        </td>
                                        <td>
                                            {{ $charge->transaction_name }}
                                        </td>
                                        <td>
                                            {{ $charge->charge }}
                                        </td>
                                        <td>
                                            <a href="{{ route('updateTransactionCharge', [$charge->id]) }}">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                                <h4>No charges have been set in the app</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection