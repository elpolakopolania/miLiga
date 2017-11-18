@extends('plantilla.appError')
@section('titulo','500')
@section('clasebody','five-zero-zero')
@section('clasecontent','five-zero-zero-container')
@section('content')
  <div class="error-code">500</div>
  <div class="error-message">Error interno en el servidor</div>
  <div class="button-place">
      <a href="{{ route('home') }}" class="btn btn-default btn-lg waves-effect">Ir a la página de inicio</a>
  </div>
@endsection
