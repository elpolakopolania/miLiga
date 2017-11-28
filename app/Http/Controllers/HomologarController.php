<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Persona;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Tipo_Estudio;
use App\Solicitud;
use App\Estudio;
use App\Asignatura;
use App\Adenda;
use App\Homologacion;
use App\Programa;
use App\Http\Requests\HomologacionRequest;
use PDF;

class HomologarController extends Controller
{
    /**
    * Inicializar permisos
    */
    public function __construct(){
      $this->middleware('jefe')->only(['crear', 'index']);
      $this->middleware('estudiante')->only(['solicitudes']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('homologar.index');
    }

    public function solicitudes()
    {
      $persona = '';
      $titulo ='';
      $estado = 0;
      $persona_usuario = new Persona;
      // Obtener datos del estudiante
      $user_id = Auth::user()->id;
      $persona_id = Auth::user()->persona_id;
      $estudiante = Persona::find($persona_id);
      $tipo_estudios = Tipo_Estudio::all()->toArray();
      // Validar si el estudienta ya tiene solicitudes
      $adendas = DB::TABLE('solicitudes as s')
            ->JOIN('adendas AS ad', 's.id', '=', 'ad.solicitud_id')
            ->JOIN('users AS j_user', 'ad.usuario_id', '=', 'j_user.id')
            ->JOIN('personas AS j_persona', 'j_user.persona_id', '=', 'j_persona.id')
            ->where([
              ['ad.estado', '<>', 0],
              ['s.usuario_id','=',$persona_id]
            ])
            ->SELECT(
                's.usuario_id AS estudiante_id', 's.programa_id', 's.estado AS estado_solicitud',
                'ad.id', 'ad.codigo', 'ad.solicitud_id', 'ad.usuario_id AS jefe_id', 'ad.nombre',
                'ad.descripcion', 'ad.archivo', 'ad.estado AS estado_adenda', 'j_persona.nombres', 'j_persona.apellidos',
                DB::raw('DATE(s.created_at) AS created_at'), DB::raw('DATE(s.updated_at) as updated_at'),
                DB::raw('DATE(ad.created_at) AS fecha'), DB::raw('DATE(ad.updated_at) AS editado')
              )
            ->orderBy('ad.id', 'desc')
            ->get();
      // Obtener el jefe de programa_id
      if($adendas->count() > 0){  
        $jefe_id = $adendas->toArray()[0]->jefe_id;
        $jefe = Persona::find($jefe_id);
        // Mostrar listado
        $datos = [
          'estudiante' => $estudiante,
          'jefe' => $jefe,
          'tipo_estudios' => $tipo_estudios,
          'adendas' => $adendas->toArray()
        ];
        // Obtener informacion de la persona
        return view('homologar.solicitudes', $datos);
      }else{
        // Mostrar link
        return view('homologar.solicitudes_empty');
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Muestra la información de la homologación
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id){
      // Desencriptar el ID.
      $id_solicitud = decrypt($id);
      // Obtener información de la solicitud.
      $solicitud = Solicitud::find($id_solicitud);
      $id_usuario = $solicitud->usuario_id;
      // Obtener la información del usuario
      $usuario = User::where(['id'=> $id_usuario])->first();
      $personaMD = new Persona;
      $persona = $personaMD->persona($usuario->persona_id);
      // Obtener estudios.
      $estudio = new Estudio;
      $estudios = $estudio->estudio_all($id_solicitud);
      // Obtener adendas
      $adendasMD = Adenda::where('solicitud_id',$id_solicitud);
      $adendas = [];
      foreach ($adendasMD->get()->toArray() as $key => $adenda) {
        $adendas[] = [
          'id' => encrypt($adenda['id']),
          'codigo'=>$adenda['codigo'],
          'solicitud_id'=>$adenda['solicitud_id'],
          'usuario_id'=>$adenda['usuario_id'],
          'nombre'=>$adenda['nombre'],
          'descripcion'=>$adenda['descripcion'],
          'estado'=>$adenda['estado']
        ];
      }

      // Variables para la vista.
      $datos = [
        'id' => $id,
        'persona' => $persona,
        'usuario' => $usuario,
        'estudios' => $estudios,
        'solicitud' => $solicitud,
        'adendas' => $adendas
      ];
      return view('homologar.create',$datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomologacionRequest $request)
    {
      // Variables.
      $msg = [];
      $estado = true;
      $adenda = decrypt($request->adenda);
      $asig_progra_id = decrypt($request->asig_progra_id);
      // Validar si existe algun error.
      if(method_exists($request, 'errors')){
        $estado = false;
        $msg[] = 'Error!';
      }else{
        // Validar si existe el registro.
        $homologacion = Homologacion::where([
          'adendas_id' => $adenda,
          'asig_progra_id' => $asig_progra_id
        ]);
        if($homologacion->count() > 0){
          Homologacion::where([
            'adendas_id' => $adenda,
            'asig_progra_id' => $asig_progra_id
          ])->update(['nota'=>$request->nota]);
          $msg[] = 'Se actualizó la nota!';
        }else{
          Homologacion::create([
            'adendas_id' => $adenda,
            'asig_progra_id' => $asig_progra_id,
            'nota' => $request->nota
          ]);
          $msg[] = 'Se creó la nota!';
        }

      }

      // Retornar datos al usuario.
      $datos = [
        'msg' => $msg,
        'estado' => $estado
      ];

      // Retornar datos.
      return $datos;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
    * Descargar formato de homologación.
    */
    public function descargar($adenda_id, $firmado = 0, $tipo = 0){
      // Validar si es documento firmado o es borrador
      $adenda_id= decrypt($adenda_id);
      if($firmado == 0){
        return $this->obtener_doc_borrador($adenda_id, $tipo);
      }else{
        return $this->obtener_doc_firmado($adenda_id, $tipo);
      }

    }

    /**
    * Obtener borrador del documento de homologación.
    */
    private function obtener_doc_borrador($adenda_id, $tipo = 0){
      // Cargar Modelo persona y usuario
      $persona = new Persona;
      $usuario = new User;
      // Cargar pdf
      $pdf  = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      // Obtener adenda
      $adenda = Adenda::find($adenda_id);
      // Obtener solicitud.
      $solicitud = Solicitud::find($adenda->solicitud_id);
      // Obtener los estudios
      $estudios = Estudio::where(['solicitud_id' => $adenda->solicitud_id])->get();
      // Obtener director de programa.
      $u_director = $usuario::find($adenda->usuario_id);
      $director = $persona->persona($u_director->persona_id);
      // Obtener información del estudiante.
      $u_estudiante = $usuario::find($solicitud->usuario_id);
      $estudiante = $persona->persona($u_estudiante->persona_id);
      // Obtener el programa
      $programa = Programa::find($solicitud->programa_id);
      // Nombre del archivo
      $nombre_archivo = $adenda->codigo . '_' . $estudiante->nombres . '_' . $persona->apellidos . '.pdf';
      // Dias y meses.
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      // Obtener asignaturas homologadas
      $asignaturas = DB::table('adendas as ad')
      ->join('homologaciones AS h', 'h.adendas_id','=','ad.id')
      ->join('asig_progra AS ap', 'ap.id','=','h.asig_progra_id')
      ->join('asignaturas AS a', 'ap.asignatura_id','=','a.id')
      ->join('programas AS p', 'p.id','=','ap.programa_id')
      ->where('ad.id', $adenda_id)
      ->select('p.nombre as programa','a.nombre', 'a.semestre', 'a.creditos', 'h.nota', 'a.cog_asignatura')
      ->orderBy('semestre', 'asc')->get();
      // Obtener las sumas de las asignaturas.
      $total_creditos = DB::table('adendas as ad')
      ->join('homologaciones AS h', 'h.adendas_id','=','ad.id')
      ->join('asig_progra AS ap', 'ap.id','=','h.asig_progra_id')
      ->join('asignaturas AS a', 'ap.asignatura_id','=','a.id')
      ->join('programas AS p', 'p.id','=','ap.programa_id')
      ->select(DB::raw('sum(a.creditos) as total_creditos'))->first()->total_creditos;
      // Variables para la vista.
      $datos = [
        'id' => $adenda_id,
        'adenda' => $adenda,
        'solicitud' => $solicitud,
        'estudios' => $estudios,
        'programa' => $programa,
        'u_director' => $u_director,
        'director' => $director,
        'u_estudiante' => $u_estudiante,
        'estudiante' => $estudiante,
        'asignaturas' => $asignaturas,
        'creditos' => $total_creditos,
        'dias' => $dias,
        'meses' => $meses,
        'nombre_archivo' => $nombre_archivo,
        'pdf' => $pdf
      ];
      // Obtener plantillas.
      $header = view('pdf_plantillas.homologacion.header',$datos);
      $body = view('pdf_plantillas.homologacion.body',$datos);
      $footer = view('pdf_plantillas.homologacion.footer',$datos);
      // Dibujar cabecera
      $pdf::setHeaderCallback(function($pdf_) use ($pdf, $header){
        $pdf::SetY(10);
        $pdf::SetFont('helvetica', '', 10);
        $pdf::writeHTML($header, true, false, true, false, '');
        $pdf::SetY(50);
      }); 
      // Dibujar footer
      $pdf::setFooterCallback(function($pdf_) use ($pdf, $footer){
        $pdf::SetY(-20);
        $pdf::SetFont('helvetica', 'I', 8);
        $pdf::writeHTML($footer, true, false, true, false, '');
      });

      // Título
      $pdf::SetTitle($nombre_archivo);
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor('Software de Homologación FET.');
      $pdf::SetSubject('Homologación FET');
      $pdf::SetFooterMargin(50);
      $pdf::SetMargins(30, 50, 30);
      $pdf::AddPage();

      // Dibujar body 
      $pdf::writeHTML($body, true, false, true, false, '');
      $pdf::Output($nombre_archivo);
      /*
      // Obtener html de la plantilla
      $plantilla = view('pdf_plantillas.homologacion',$datos);
      // Crear nuevo PDF.
      $pdf = \App::make('dompdf.wrapper');
      // Cargar html
      $pdf = $pdf->loadHTML($plantilla);
      // Mostrar o descargar
      if($tipo == 0){
        return $pdf->stream($nombre_archivo);
      }else{
        return $pdf->download($nombre_archivo);
      }*/
    }

    /**
    * Obtener obtener documento firmado
    */
    private function obtener_doc_firmado($adenda_id, $tipo = 0){
      // Obtener adenda
      $adenda = Adenda::find($adenda_id);
      $persona_adenda = DB::table('adendas as ad')
      ->join('solicitudes as s', 'ad.solicitud_id', '=' , 's.id')
      ->join('users as u', 'u.id', '=' , 's.usuario_id')
      ->join('personas as p', 'p.id', '=' , 'u.persona_id')
      ->select('ad.codigo', 'p.nombres', 'p.apellidos')
      ->where('ad.id',$adenda_id)->get();
      $persona_adenda = $persona_adenda->first();
      // Validar que el documento esté cargado
      $nombre_archivo = 'ok.pdf';
      if($adenda->archivo != ''){
        $nombre_archivo = $persona_adenda->codigo.'_'.$persona_adenda->nombres.'_'.$persona_adenda->apellidos.'.pdf';
        $ruta = storage_path('app\adendas_firmadas\\'.$adenda->archivo);
        $headers = array(
          'Content-Type: application/pdf',
          'Content-Disposition:attachment; filename="'.$nombre_archivo.'"',
          'Content-Transfer-Encoding:binary',
          "Cache-Control: no-cache, must-revalidate",
          'Content-Length:'.filesize($ruta)
        );
        // Mostrar o descargar
        if($tipo == 0){
          return response()->file($ruta, $headers);
        }else{
          return response()->download($ruta,$nombre_archivo, $headers);
        }
      }else{
        return 'No se ha cargado un documento firmado';
      }
    }

    /**
    * Muestra las asignaturas para la homologación.
    */
    public function listar_asignaturas(Request $get){
      $programa_id = decrypt($get->programa);
      $adenda_id = decrypt($get->adenda);
      // Obtener Asignaturas.
      $asignatura = new Asignatura;
      // Validar el código de la adenta que no sea 0
      if($adenda_id != 0){
        $asignaturas = $asignatura->asignatura_all($get,$programa_id,$adenda_id);
      }else{
        $asignaturas = ['asignaturas'=>[],'total'=>0];
      }
      // Ordenar datos
      $datos = [
        "draw" => $get->draw,
        "recordsTotal" => count($asignaturas['asignaturas']),
        "recordsFiltered" => $asignaturas['total'],
        "data" => $asignaturas['asignaturas']/*,
        "get" => $_GET*/
      ];
      return $datos;
    }
}
