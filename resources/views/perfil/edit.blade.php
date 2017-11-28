<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Mi perfil')

@section('cssLib')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<!-- Input mascaras -->
<link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Mi perfil</h2>
</div>
<!-- Formulario para cargar usuario -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Editar</h2>
            </div>
            <div class="body">
                <form id="frm_perfil" method="POST" action="{{ route('perfil.update', Auth::user()->id) }}">
                <input name="_method" type="hidden" value="PUT">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                      <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $persona->nombres }}" placeholder="Nombres"    required>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $persona->apellidos }}" placeholder="Apellidos"    required>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <select class="form-control show-tick selectpiker" id="tipoIdent" name="tipoIdent" value="{{ $persona->tipoIdent_id }}" required>
                          <option value="">-- Tipo de documento --</option>
                            @foreach($tipo_docs as $doc)
                            <option value="{{ $doc['id'] }}">{{ $doc['codigo'] }} - {{ $doc['nombre'] }}</option>
                            @endforeach  
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">payment</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" name="numIdent" id="numIdent" value="{{ old('numIdent') }}" placeholder="Número de identificación"    required>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">phone</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Teléfono"    required>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">location_on</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}" placeholder="Dirección residencia"    required>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-line">
                        <b>Fecha de nacimiento</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input name="fechaNac" id="fechaNac" type="text" class="form-control fecha" placeholder="Ex: 31/12/1900" required>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <b>Género</b>
                      <select class="form-control show-tick selectpiker" name="genero" id="genero" required>
                          <option value="">-- Seleccionar --</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero['id'] }}">{{ $genero['nombre'] }}</option>
                            @endforeach  
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 text-right">
                      <button class="btn btn-primary waves-effect" type="submit">Guardar</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
@endsection

<!-- Librerias JS -->
@section('jsLib')
<!-- Autosize Plugin Js -->
<script src="{{ asset('plugins/autosize/autosize.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script src="{{ asset('js/pages/forms/basic-form-elements.js') }}"></script>

<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_editar_perfil.js') }}"></script>
@endsection
