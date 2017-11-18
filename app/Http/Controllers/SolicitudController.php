<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Persona;
use App\Tipo_Estudio;
use App\Solicitud;
use App\Estudio;
use App\Programa;

class SolicitudController extends Controller
{
    /**
    * Inicializar permisos
    */
    public function __construct(){
      $this->middleware('jefe')->only(['index']);
      $this->middleware('estudiante')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $get)
    {
      return view('solicitud.index');
    }

    /**
     * Listar las solicitudes en un JSON
     *
     * @return \Illuminate\Http\Response
     */
    public function listar_solicitudes(Request $get){
      // Cargar modelo.
      $solicitud = new Solicitud;
      // Obtener id del usuario
      $user_id = Auth::user()->id;
      // Obtener solicitudes
      $solicitudes = $solicitud->listar_solicitudes($get,$user_id);
      // Ordenar datos
      $datos = [
        "draw" => $get->draw,
        "recordsTotal" => count($solicitudes['solicitudes']),
        "recordsFiltered" => $solicitudes['total'],
        "data" => $solicitudes['solicitudes']/*,
        "get" => $_GET,*/
      ];
      return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $persona = '';
      // Obtener id del usuario
      $user_id = Auth::user()->id;
      $persona_id = Auth::user()->persona_id;
      $persona = Persona::find($persona_id);
      $tipo_estudios = Tipo_Estudio::all()->toArray();
      $programas = Programa::all()->toArray();
      // Validar si el estudiante ya tiene solicitudes
      $solicitudes = DB::TABLE('solicitudes as s')
            ->JOIN('estudios as e', 's.id', '=', 'e.solicitud_id')
            ->SELECT('*')
            ->where('s.usuario_id',Auth::user()->id)
            ->get();
      if($solicitudes->count() > 0){
        return view('solicitud.create_full');
      }else{
        // Datos para la vista.
        $datos = [
          'persona' => $persona,
          'tipo_estudios' => $tipo_estudios,
          'programas' => $programas
        ];

        // Obtener informacion de la persona
        return view('solicitud.create',$datos);
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $nombres_fila = [];
      $msg = [];
      $estado = true;
      // Obtener las filas.
      foreach($_POST as $posicion => $fila){
        if(is_array($fila)){
          if(!(strpos($posicion, 'fila') === false)){
            $nombres_fila[] = $posicion;
          }
        }
      }
      $stado = true;
      // Validar los tipos de archivos.
      foreach ($nombres_fila as $posicion => $fila) {
        // Validar campo llenos
        if(
            empty($request->$fila['tipo_estudio']) OR
            empty($request->programa) OR
            empty($request->$fila['institucion']) OR
            empty($request->$fila['nombre_estudio']) OR
            empty($request->$fila['soporte_nombre'])
          ){
            $stado = false;
          }
      }
      if(!$stado){
        $estado = false;
        $msg[] = 'Algunos campos están vacíos.';
      }
      // Crear solicitud
      if($estado){
        // crear cabecera.
        $id_solicitud = Solicitud::create([
          'usuario_id' => Auth::user()->id,
          'programa_id' => $request->programa,
          'estado' => 0
        ])->id;
        // Validar los tipos de archivos.
        foreach ($nombres_fila as $posicion => $fila) {
          // Guardar el archivo.
          $nombre_archivo = $request->file($fila)['soporte']->store('public');
          $lista = explode("/",$nombre_archivo);
          $nombre_archivo = $lista[count($lista) - 1];
          // Crear estudios en la base de datos.
          $id_estudio = Estudio::create([
            'tipo_estudio_id' => $request->$fila['tipo_estudio'],
            'solicitud_id' => $id_solicitud,
            'nombre_institucion' => $request->$fila['institucion'],
            'nombre_carrera' => $request->$fila['nombre_estudio'],
            'nombre_archivo' => $nombre_archivo
          ])->id;
        }
        $msg[] = 'La solicitud se generó correctamente.';
      }
      // Datos para retornarle al usuario.
      $data = [
        'msg' => $msg,
        'estado' => $estado
      ];

      // Obtener
      return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show'.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('solicitud.edit');
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
}
