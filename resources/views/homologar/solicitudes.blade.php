<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Mi homologacion')

@section('cssLib')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Ver mi homologación</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Solicitud homologada</h2>
            </div>
            <div class="body">
              <div class="row">
                <div class="col-md-12">
                  <blockquote>
                      <p>La solicitud fue realizada por el estudiante {{ $estudiante->nombres . ' ' .$estudiante->apellidos }} el día {{ $adendas[0]->created_at }}.</p>
                      <footer>Homologado por el director de programa <cite title="Source Title">{{ $jefe->nombres . ' ' . $jefe->apellidos }}</cite></footer>
                  </blockquote>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" id="tb_adendas">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Descripcion</th>
                          <th>Homologada</th>
                          <th>Homologado por</th>
                          <th>Soporte</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($adendas as $i => $adenda)
                            <tr>
                              <td>{{ encrypt($adenda->id) }}</td>
                              <td>{{ $adenda->codigo }}</td>
                              <td>{{ $adenda->nombre }}</td>
                              <td>{{ $adenda->descripcion }}</td>
                              <td>{{ $adenda->editado }}</td>
                              <td>{{ $adenda->nombres.' '.$adenda->apellidos }}</td>
                              <td>
                                <a href="{{ url('homologar/descargar') . '/' . encrypt($adenda->id) . '/1' }}" target="_blank" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">search</i>
                                </a>
                                <a href="{{ url('homologar/descargar') . '/' . encrypt($adenda->id) . '/1/1' }}" target="_blank" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">file_download</i>
                                </a>
                              </td>
                            </tr>
                          @endforeach

                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
@endsection

@section('jsLib')
<!-- Autosize Plugin Js -->
<script src="{{ asset('plugins/autosize/autosize.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/file/file.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/responsive/dataTables.responsive.min.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_index_homologacion.js') }}"></script>
@endsection
