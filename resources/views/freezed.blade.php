@extends('layouts.landing')
@section('content')
<style type="text/css">

    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">

                <h2>
                    Account Freezed</h2>
                <div class="error-details">
                    Sorry, please contact HBnk for more information
                </div>
                <div class="error-actions">
                    <a  style="color: black; font-weight: bold;" href="{{ url('/logout') }}" class="text-center">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection