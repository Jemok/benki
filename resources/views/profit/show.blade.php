@extends('layouts.app_two')

@section('content')

    <div class="alert alert-success">

        <p>
            Profit for date: {{ $date }}
        </p>

        <h2>
           Kshs: {{ $profits->sum('payment') }}
        </h2>

    </div>

@endsection