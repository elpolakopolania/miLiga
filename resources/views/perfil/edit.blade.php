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
                <form id="perfil" method="PATCH" action="{{ route('perfil.update', Auth::user()->id) }}">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                      <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nombres"  autofocus required>
                            </div>
                            @if ($errors->has('name'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Apellidos"  autofocus required>
                            </div>
                            @if ($errors->has('lastname'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('lastname') }}</label>
                            @endif
                        </div>
                      </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <select class="form-control show-tick">
                          <option value="">-- Tipo de documento --</option>
                          <option value="1">Registro civil</option>
                          <option value="2">Tarjeta de identidad</option>
                          <option value="3">Cédula de ciudadanía</option>
                          <option value="4">Cédula de extranjería</option>
                          <option value="5">Pasaporte</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">payment</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" name="numIdent" id="numIdent" value="{{ old('numIdent') }}" placeholder="Número de identificación"  autofocus required>
                          </div>
                          @if ($errors->has('numIdent'))
                              <label id="name-error" class="error" for="name">{{ $errors->first('numIdent') }}</label>
                          @endif
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
                              <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Teléfono"  autofocus required>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">location_on</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}" placeholder="Dirección residencia"  autofocus required>
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
                                <input type="text" class="form-control date" placeholder="Ex: 01/01/1996">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <b>Género</b>
                      <select class="form-control show-tick">
                          <option value="">-- Seleccionar --</option>
                          <option value="1">Masculino</option>
                          <option value="2">Femnino</option>
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

@endsection
