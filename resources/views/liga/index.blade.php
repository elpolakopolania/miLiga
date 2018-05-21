<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Ligas')

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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                Administrar ligas
            </h2>
        </div>
        <div class="body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#ligas_panel" id="tab_ligas" data-toggle="tab">
                        <i class="material-icons">apps</i> Ligas
                    </a>
                </li>
                <li role="presentation">
                    <a href="#liga_panel" id="tab_crear" data-toggle="tab">
                        <i class="material-icons">edit</i> Editar
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="ligas_panel">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tb_ligas">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha Inicial</th>
                            <th>Fecha Fin</th>
                            <th>Telefono</th>
                            <th>direccion</th>
                            <th>Categoria</th>
                            <th>Inscripción $</th>
                            <th>Amarilla $</th>
                            <th>Rojas $</th>
                            <th>Reglas</th>
                            <th>Creada</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="liga_panel">
                    <form id="form_liga" action="{{ url('liga') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="crear_editar" id="crear_editar">
                        <input type="hidden" name="input_id" id="input_id">
                        <div class="row">
                            <div class="col-sm-12">
                            <b>Nombre</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">assignment</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="input_nombre" id="input_nombre" required>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <b>Descripcion</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" id="input_descripcion" name="input_descripcion" class="form-control no-resize" placeholder="Descripción general de la liga..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                            <b>Inicio de la liga</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" name="input_fecha_ini" id="input_fecha_ini" class="datepicker form-control" placeholder="Escoja la fecha inicio..." required>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                            <b>Fin de la liga</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" name="input_fecha_fin" id="input_fecha_fin" class="datepicker form-control" placeholder="Escoja la fecha final..." required>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-sm-6">
                            <b>Teléfono - Celular</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">contact_phone</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="input_telefono" id="input_telefono">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                            <b>Dirección</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">location_on</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="input_direccion" id="input_direccion">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                            <b>Nombre de la categoría</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">assignment</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="input_categoria" id="input_categoria">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <b>Valor inscripción <i class="font-bold col-green material-icons">card_membership</i></b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="input_incripcion" id="input_incripcion">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <b>Valor amarilla <i class="font-bold col-yellow material-icons">class</i></b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="input_amarilla" id="input_amarilla">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <b>Valor roja <i class="font-bold col-red material-icons">class</i></b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="input_roja" id="input_roja">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <b>Reglas</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" id="input_reglas" name="input_reglas" class="form-control no-resize" placeholder="Reglas del torneo..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-right">
                                <input type="reset" id="btn_limpiar" loading-text="Limpiar" class="btn btn-link m-t-15 waves-effect" value="Limpiar">
                                <input type="submit" id="btn_guardar" data-loading-text="Guardando..." class="btn btn-success m-t-15 waves-effect" value="Guardar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var ruta_base = '{{ url('') }}';
  var ruta_tabla = '{{ url('ligas') }}';
  var ruta_url = '{{ url('liga') }}';
</script>
<!-- #END# Basic Validation -->
@endsection

@section('jsLib')
<!-- Autosize Plugin Js -->
<script src="{{ asset('plugins/autosize/autosize.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<script src="{{ asset('plugins/momentjs/locale/es.js') }}"></script>
<script type="text/javascript">
    moment.locale('es');
    console.log(moment().format('LLL'));
</script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/file/file.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/responsive/dataTables.responsive.min.js') }}"></script>
<!-- Validar formulario -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
<!-- Bootstrap Notify Plugin Js -->
<script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_ligas.js') }}"></script>
@endsection
