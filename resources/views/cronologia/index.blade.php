<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Cronología')

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
    <!--Timeline Css-->
    <link href="{{ asset('plugins/timeline/css/timeline.css') }}" rel="stylesheet"/>
@endsection

@section('cssPag')
    <!-- Estilo de el contenido -->
@endsection

@section('contenido')
    <!-- Contenido de la página -->
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">security</i>
                        </div>
                        <div class="content">
                            <div class="text">Deportivo tapitas</div>
                            <div class="number">2</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">security</i>
                        </div>
                        <div class="content">
                            <div class="text">Atletico tapitas</div>
                            <div class="number">4</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge" title="Fin del partido">
                                <i class="material-icons">class</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Fin</h4>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge bg-red" title="Tarjeta roja">
                                <i class="material-icons">class</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Daniel Giraldo</h4>
                                    <p>
                                        <small class="text-muted">
                                            <i class="glyphicon glyphicon-time"></i>
                                            90 + 1
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge bg-green">
                                <i class="material-icons">check</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Andrés Eduardo Pérez</h4>
                                    <p>
                                        <small class="text-muted">
                                            <i class="glyphicon glyphicon-time"></i>
                                            89 (2-0)
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge" title="Entretiempo">
                                <i class="material-icons">class</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Entretiempo</h4>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge bg-blue" title="Sustitución">
                                <i class="material-icons">compare_arrows</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h6 class="timeline-title">
                                        <i class="glyphicon glyphicon-arrow-up col-green"></i>
                                        Fabían Sambueza
                                    </h6>
                                    <h6 class="timeline-title">
                                        <i class="glyphicon glyphicon-arrow-down col-red"></i>
                                        Didier Delgado
                                    </h6>
                                    <p>
                                        <small class="text-muted"><i class="glyphicon glyphicon-time"></i>40</small>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge" title="Inicio del partido">
                                <i class="material-icons">class</i>
                            </div>
                            <div class="timeline-panel animated fadeIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Inicio</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ruta_redirect = 'cronologia';
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
    <!-- Wait Me Plugin Js -->
    <script src="{{ asset('plugins/waitme/waitMe.js') }}"></script>
    <!-- Timeline -->
    <script src="{{ asset('plugins/timeline/js/timeline.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
    <script src="{{ asset('js/pages/validar/validar_cronologia.js') }}"></script>
@endsection
