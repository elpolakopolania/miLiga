<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Inicio')

@section('cssLib')
<!-- Librerías de estilos -->
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Bienvenido</h2>
    @include('plantilla.msg.error')
</div>
@endsection

<!-- Librerias JS -->
@section('jsLib')
@endsection

@section('jsPag')
<!-- Librerias JS para el contenido -->
@endsection
