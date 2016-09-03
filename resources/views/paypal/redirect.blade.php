@extends('layouts.app')

@section('content')

    <h4>Copy and paste this link in your browser</h4>

  <textarea rows="50" cols="25">
    {{ $redirect_url }}
  </textarea>

@endsection