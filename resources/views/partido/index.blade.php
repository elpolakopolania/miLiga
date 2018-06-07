<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Partidos')

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
    <!--WaitMe Css-->
    <link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet"/>
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
                    Partidos
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-xs-12">
                        <b>Equipo</b>
                        <select id="select_equipo" name="select_equipo"
                                class="form-control show-tick selectpiker" data-live-search="true">
                            @foreach ($ligas as $liga)
                                <option value="{{ $liga->id }}">{{ $liga->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jornadas -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divJornadas" ></div>

    <!-- Modal Jornada -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="smallModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros
                    vestibulum ut. Ut accumsan
                    vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus
                    ullamcorper.
                    Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
                    nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
                    Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect">Guardar</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var ruta_redirect = 'equipo';
        var ruta_base = '{{ url('') }}';
        var ruta_tabla = '{{ url('equipos') }}';
        var ruta_url = '{{ url('equipo') }}';
        var ruta_select_grupo = '{{ url('grupos_liga') }}';
        var ruta_get_delegado = '{{ url('delegadoNumDoc') }}';
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
        //moment.locale('es');
        //console.log(moment().format('LLL'));
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
    <!-- Wait Me Plugin Js -->
    <script src="{{ asset('plugins/waitme/waitMe.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
    <script src="{{ asset('plugins/bootstrap-jornada/js/jornada.js') }}"></script>
    <script src="{{ asset('js/pages/validar/validar_partidos.js') }}"></script>

@endsection
