<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Solicitudes')

@section('cssLib')
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Listado de solicitudes</h2>
</div>
<!-- Formulario para cargar usuario -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Editar</h2>
            </div>
            <div class="body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover" id="tb_solicitudes">
                      <thead>
                          <tr>
                            <th>id</th>
                            <th>Estudiante</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Programa</th>
                            <th>Fecha</th>
                            <th>Editar</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
<script type="text/javascript">
  var ruta_tabla = '{{ asset('solicitud/listar_solicitudes') }}';
  var ruta_homologar = '{{ url('homologar/crear/') }}';
</script>
@endsection

@section('jsLib')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/responsive/dataTables.responsive.min.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_solicitudes.js') }}"></script>
@endsection
