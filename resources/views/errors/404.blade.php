@extends('plantilla.appError')
@section('titulo','404')
@section('clasebody','four-zero-four')
@section('clasecontent','four-zero-four-container')
@section('content')
  <div class="error-code">404</div>
  <div class="error-message">Esta página no existe</div>
  <div class="button-place">
      <a href="{{ route('home') }}" class="btn btn-default btn-lg waves-effect">Ir a la página de inicio</a>
  </div>
@endsection
