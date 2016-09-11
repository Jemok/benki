@extends('layouts.app_two')

@section('content')

    <div class="alert alert-success">

        Transfers

        <p>
            Profit for date: {{ $date }}
        </p>

        <h2>
           Kshs: {{ $profits_transfers->sum('payment') }}
        </h2>

    </div>

    <div class="alert alert-success">

        Chama Withdrawals

        <p>
            Profit for date: {{ $date }}
        </p>

        <h2>
            Kshs: {{ $profits_chama_withdrawals->sum('payment') }}
        </h2>

    </div>

    <div class="alert alert-success">

        Total Profit

        <p>
            Total Profit for date: {{ $date }}
        </p>

        <h2>
            Kshs: {{ $profits->sum('payment') }}
        </h2>

    </div>

@endsection