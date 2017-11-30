<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Homologar')

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
    <h2>Homologar</h2>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                Formulario de homologación
            </h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">settings</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a id="btn_ver_pdf">Ver borrador</a></li>
                        <li><a id="btn_desc_pdf">Descargar borrador</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a id="btn_ver_firma">Ver documento fimado</a></li>
                        <li><a id="btn_desc_firma">Descargar documento firmado</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a id="btn_cargar_firma">Cargar documento firmado</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a id="btn_homologar">Homologar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#estudiante_tb" data-toggle="tab">
                        <i class="material-icons">school</i> Estudiante
                    </a>
                </li>
                <li role="presentation">
                    <a href="#estudios_tab" data-toggle="tab">
                        <i class="material-icons">person</i> Estudios
                    </a>
                </li>
                <li role="presentation">
                    <a href="#homologar_tab" data-toggle="tab">
                        <i class="material-icons">list</i> Homologar
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="estudiante_tb">
                  <div class="row">
                    <div class="col-sm-6 col-md-3">
                      <b>Nombres</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->nombres }}" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Apellidos</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->apellidos }}" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Tipo documento</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">perm_identity</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->nombre_tipodoc }}" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Número de documento</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">payment</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->numIdent }}" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Teléfono</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">phone</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->telefono }}" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Dirección</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">location_on</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="Call 4 # 2 -36" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-line">
                        <b>Fecha de nacimiento</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" value="{{ $persona->fechaNac }}" readonly>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <b>Género</b>
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control" value="{{ $persona->genero }}" readonly>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="estudios_tab">
                  @foreach ($estudios->get()->toArray() as $estudio)
                    <div class="item_estudios">
                    <div class="row clearfix">
                      <div class="col-sm-6 col-md-3">
                        Nivel de estudio
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">school</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control institucion" value="{{$estudio->nombre}}" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-4">
                          Institución
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">school</i>
                              </span>
                              <div class="form-line">
                                  <input type="text" class="form-control institucion" value="{{$estudio->nombre_institucion}}" readonly>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-4">
                        Nombre del estudio
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">mode_edit</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control nombre_estudio" value="{{$estudio->nombre_carrera}}" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-1">
                        <div class="input-group">
                          <a type="button" href="{{ url('../storage/app/public/'.$estudio->nombre_archivo) }}" target="__blank" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                              <i class="material-icons">search</i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div role="tabpanel" class="tab-pane fade" id="homologar_tab">
                  <div class="row">
                    <div class="col-sm-10" id="div_adenda"></div>
                    <div class="col-sm-2">
                      <a type="button" id="btn_crear_adenda" class="btn btn-success waves-effect btn-sm">
                        <i class="material-icons">add</i><span>Crear</span>
                      </a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tb_notas">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th>Codigo</th>
                            <th>Asignatura</th>
                            <th>Semestre</th>
                            <th>Créditos</th>
                            <th>Nota</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_adendas" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Crear adenda</h4>
            </div>
            <form id="form_adenda" method="POST" action="{{ route('adenda.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name='solicitud' value="{{ $id }}" required>
              <div class="modal-body" id="body_form">
                <div class="row">
                  <div class="col-md-12">
                    <div id="msg_modal"></div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      Nombre
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="material-icons">short_text</i>
                          </span>
                          <div class="form-line">
                              <input type="text" class="form-control onOff" name='nombre' value="" required>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                        Descripcion
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">textsms</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control onOff" name='descripcion' value="" required>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-body text-center" id="cargando_modal">
                <div class="preloader pl-size-xl">
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
                <button type="submit" class="btn btn-success waves-effect">GUARDAR</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
              </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="md_cargar_firma" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Cargar firma</h4>
            </div>
            <form id="form_firma" method="POST" action="{{ url('adenda/cargar_firma') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="modal-body" id="body_form_firma">
                <div class="row">
                  <div class="col-md-12">
                    <div id="msg_modal_firma"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    Soporte en pdf
                    <div class="input-group">
                      <div class="form-line">
                          <input type="text" class="form-control" name="nombre_archivo" readonly required>
                      </div>
                      <label class="input-group-addon">
                        <span class="btn btn-circle waves-effect waves-circle waves-float">
                            <i class="material-icons">attach_file</i> <input type="file" name="archivo" class="onOff"  accept="application/pdf" style="display: none;" required>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-body text-center" id="cargando_modal_firma">
                <div class="preloader pl-size-xl">
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
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
              </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  var ruta_base = '{{ url('') }}';
  var ruta_notas = '{{ url('homologar') }}';
  var ruta_homologar = '{{ url('adenda/homologar') }}';
  var ruta_descargar_pdf = '{{ url('homologar/descargar') }}';
  var ruta_descargar_pdf_firmado = '{{ url('homologar/descargar') }}';
  var ruta_asignatura = '{{ url('homologar/listar_asignaturas') }}';
  var cod_programa = '{{ encrypt($solicitud->programa_id) }}';
  var cod_adenda = '{{ encrypt(0) }}';
  var adendas = {!! json_encode($adendas) !!};
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
  <script src="{{ asset('js/pages/validar/validar_crear_homologacion.js') }}"></script>
@endsection
