<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdendaRequest;
use App\Adenda;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AdendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdendaRequest $request)
    {
      // Variables.
      $msg = [];
      $estado = true;
      $adendas = [];
      // Validar si existe algun error.
      if(method_exists($request, 'errors')){
        $msg = array_values($request->errors());
        $estado = false;
      }else{
        // Valdar si tiene adendas pendientes.
        $adenda = Adenda::where('solicitud_id',decrypt($request->solicitud))->where('estado',0)->get();
        if($adenda->count() > 0){
          $msg[]= 'Usted ya tiene una adenda sin homologar. Por favor homologuela para crear una nueva.';
          $estado = false;
        }else{
          // Crear adenda
          $id_adenda = Adenda::create([
            'codigo' => '',
            'solicitud_id' => decrypt($request->solicitud),
            'usuario_id' => Auth::user()->id,
            'nombre' => $request->nombre,
            'archivo' => '',
            'descripcion' => $request->descripcion,
            'estado' => 0
          ])->id;
          // Actualizar el código de la adenda.
          Adenda::where('id',$id_adenda)->update(['codigo' => 'HFET' . $id_adenda]);
          $msg[] = 'La adenda se creó correctamente con el código ' . 'HFET' . $id_adenda . '.';
        }

      }

      // Obtener adendas
      $adendasMD = Adenda::where('solicitud_id',decrypt($request->solicitud));
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
      // Retornar datos al usuario.
      $datos = [
        'msg' => $msg,
        'estado' => $estado,
        'adendas' => $adendas
      ];

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
     * Homologar adenda
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function homologar(Request $request){
      $estado = true;
      $msg = [];
      $adenda = Adenda::where('id',decrypt($request->adenda))->first();
      if($adenda->estado != 0){
        $estado = false;
        $msg[]= 'La adenda ya se encuentra homologada.';
      }else{
        if($adenda->archivo != ''){
          Adenda::where('id',decrypt($request->adenda))->update(['estado' => 1]);
          $adenda = Adenda::where('id',decrypt($request->adenda))->first();
          $msg = ['La adenda ' . $adenda->codigo . ' se homologó correctamente.'];
        }else{
          $estado = false;
          $msg[]= 'Debe cargar el archivo firmado.';
        }
      }
      // Organizar datos.
      $datos = [
        'estado' => $estado,
        'msg' => $msg
      ];
      return $datos;
    }

    /**
    * Carga el documento firmado por el direcotr de programa.
    */
    public function cargar_firma(Request $request){
      $estado = true;
      $msg = [];
      $path = '';
      $adenda_id = decrypt($request->adenda);
      // Validar si el usuario cargó un archivo.
      if($request->hasFile('archivo') && $request->file('archivo')->isValid()){
        if($request->archivo->extension() == 'pdf'){
          // Validar si ya tiene algún archivo cargado
          $adenda = Adenda::find($adenda_id);
          if($adenda->archivo != ''){
            // Eliminar archivo.
            Storage::delete('adendas_firmadas/'.$adenda->archivo);
          }
          $path = $request->archivo->store('adendas_firmadas');
          $lista = explode("/",$path);
          $nombre_archivo = $lista[count($lista) - 1];
          // Actualizar el archivo firmado de la adenda.
          Adenda::where('id',$adenda_id)->update(['archivo' => $nombre_archivo]);
          $msg[] = 'El archivo se cargó correctamente.';
        }else{
          $msg[] = 'Se debe cargar un archivo con formato pdf.';
          $estado = false;
        }
      }else{
          $msg[] = 'No se cargó archivo.';
          $estado = false;
      }
      // Datos
      $datos = [
        'estado' => $estado,
        'msg' => $msg
      ];

      return $datos;
    }


}
