<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Homologar solicitud')

@section('cssLib')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Homologar solicitud <small><a href="{{ url('solicitud') }}">Ver todas las solicitudes</a></small></h2>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-cyan">
                <h2>Estudiante</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-6 col-md-3">
                      Nombres
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" id="name" value="Gustavo Adolfo" placeholder="Nombres"  readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      Apellidos
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" id="lastname" value="Polania Ardila" placeholder="Apellidos"  readonly>
                          </div>
                      </div>
                    </div>
                  <div class="col-sm-6 col-md-3">
                    Tipo de documento
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">payment</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="tipo_doc" value="Cédula de Ciudadanía" placeholder="Tipo de documento"  readonly>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Número de documento
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">payment</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="numIdent" value="1.075.297.926" placeholder="Número de identificación"  readonly>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Teléfono
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="telefono" value="3184860672" placeholder="Teléfono"  readonly>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Dirección
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">location_on</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="direccion" value="Call 4 # 2 - 36 " placeholder="Dirección residencia"  readonly>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    <div class="form-line">
                      Fecha de nacimiento
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">date_range</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control date" value="14/07/1996" placeholder="Ex: 01/01/1996" readonly>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Género
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">location_on</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="genero" value="Masculino" placeholder="Género" readonly>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-cyan">
                <h2>Cargar estudios</h2>
            </div>
            <div class="body">
              <div class="item_estudios">
                <div class="row clearfix">
                  <div class="col-sm-6 col-md-3">
                    <b>Nivel de estudio</b>
                    <select class="form-control show-tick">
                        <option value="">-- Seleccionar --</option>
                        <option value="1">Técnico Profesional</option>
                        <option value="2">Tecnológico </option>
                        <option value="3">Profesional</option>
                        <option value="4">Especialización</option>
                        <option value="5">Maestría</option>
                        <option value="6">Doctorado</option>
                    </select>
                  </div>
                  <div class="col-sm-6 col-md-3">
                      Institución
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">school</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control institucion" name='institucion' value="" placeholder="Institución" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Nombre del estudio
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mode_edit</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control nombre_estudio" name='nombre_estudio' value="" placeholder="Nombre del estudio" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    Soporte
                    <div class="input-group">
                        <label class="input-group-addon">
                          <span class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                              <i class="material-icons">attach_file</i> <input type="file" style="display: none;">
                          </span>
                        </label>
                        <div class="form-line">
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <a type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                      <i class="material-icons">add</i>
                  </a>
                  <button type="button" class="btn btn-success waves-effect">
                    <span>Enviar</span>
                      <i class="material-icons">send</i>
                  </button>
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
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_edit_solicitud.js') }}"></script>
@endsection
