<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Grupos')

@section('cssLib')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>
    <!-- Wait Me Css -->
    <link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet"/>
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
    <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
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
                    Administrar Grupos
                </h2>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#grupos_panel" id="tab_grupos" data-toggle="tab">
                            <i class="material-icons">apps</i> Grupos
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#grupo_panel" id="tab_crear" data-toggle="tab">
                            <i class="material-icons">edit</i> Editar
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="grupos_panel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="tb_grupos"
                                           style="width: 99.9%;">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Liga</th>
                                            <th>Grupo</th>
                                            <th>Clasifican</th>
                                            <th>Creada</th>
                                            <th>liga_id</th>
                                            <th>grupo_id</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="grupo_panel">
                        <form id="form_grupo" action="{{ url('liga') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="crear_editar" id="crear_editar">
                            <input type="hidden" name="input_id" id="input_id">
                            <input type="hidden" name="grupo_id" id="grupo_id">
                            <div class="row">
                                <div class="col-sm-12">
                                    <b>Liga</b>
                                    <select id="select_liga" name="select_liga"
                                            class="form-control show-tick selectpiker">
                                        @foreach ($ligas as $liga)
                                            <option value="{{ $liga['id'] }}">{{ $liga['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <b>Nombre</b>
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">assignment</i>
                                    </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="input_nombre"
                                                   id="input_nombre" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Número de equipos que clasifican</b>
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">assignment</i>
                                    </span>
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="input_clasifican"
                                                   id="input_clasifican" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 text-right">
                                    <input type="reset" id="btn_limpiar" loading-text="Limpiar"
                                           class="btn btn-link m-t-15 waves-effect" value="Limpiar">
                                    <input type="submit" id="btn_guardar" data-loading-text="Guardando..."
                                           class="btn btn-success m-t-15 waves-effect" value="Guardar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var ruta_redirect = 'grupo';
        var ruta_base = '{{ url('') }}';
        var ruta_tabla = '{{ url('grupos') }}';
        var ruta_url = '{{ url('grupo') }}';
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
    <!-- Select -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
    <script src="{{ asset('js/pages/validar/validar_grupos.js') }}"></script>
@endsection
