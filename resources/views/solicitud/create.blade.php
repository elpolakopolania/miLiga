<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Solicitar homologación')

@section('cssLib')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Solicitar homologación</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Cargar estudios</h2>
            </div>
            <form id="form_solicitud" method="POST" action="{{ route('solicitud.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="body">
                <div class="row">
                  <div clas="col-md-12">
                    <div class="col-md-12">
                      <b>Programa al que aspira:</b>
                      <select name="programa" class="form-control show-tick selectpiker" required>
                          <option value="">-- Seleccionar --</option>
                          @foreach ($programas as $programa)
                              <option value="{{ $programa['id'] }}">{{ $programa['nombre'] }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <div class="item_estudios row">
                    <div class="col-sm-6 col-md-3">
                      <b>Nivel de estudio</b>
                      <select name="fila1[tipo_estudio]" class="form-control show-tick selectpiker" required>
                          <option value="">-- Seleccionar --</option>
                          @foreach ($tipo_estudios as $tipo_estudio)
                              <option value="{{ $tipo_estudio['id'] }}">{{ $tipo_estudio['nombre'] }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      Nombre del estudio
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">mode_edit</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control nombre_estudio onOff" name='fila1[nombre_estudio]' value="" placeholder="Nombre del estudio" required>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        Institución
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">school</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control institucion onOff" name='fila1[institucion]' value="" placeholder="Institución" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                      Soporte en pdf
                      <div class="input-group">
                          <label class="input-group-addon">
                            <span class="btn btn-circle waves-effect waves-circle waves-float">
                                <i class="material-icons">attach_file</i> <input type="file" name="fila1[soporte]" class="onOff"  accept="application/pdf" style="display: none;" required>
                            </span>
                          </label>
                          <div class="form-line">
                              <input type="text" class="form-control" name="fila1[soporte_nombre]" readonly required>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-1 div_delete"></div>
                </div>
                <div class="row" id="form_footer">
                  <div class="col-md-12 text-right">
                    <a type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float add_item">
                        <i class="material-icons">add</i>
                    </a>
                    <button type="submit" class="btn btn-success waves-effect">
                      <span>Enviar</span>
                        <i class="material-icons">send</i>
                    </button>
                  </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
<!-- ventana modal -->
<div class="modal fade" id="modal_msg" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Solicitud</h4>
            </div>
            <div class="modal-body text-center">
              <div id="msg_modal"></div>
              <div class="preloader pl-size-xl" id="cargando_modal">
                  <div class="spinner-layer pl-teal">
                      <div class="circle-clipper left">
                          <div class="circle"></div>
                      </div>
                      <div class="circle-clipper right">
                          <div class="circle"></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN ventana modal -->
<script type="text/javascript">
  var ruta_list_hom  = '{{ asset('homologar/solicitudes') }}';
</script>
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
<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_crear_solicitud.js') }}"></script>
@endsection
