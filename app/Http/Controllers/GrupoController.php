<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GrupoRequest;
use App\Grupo;
use App\Liga;
use App\LigaGrupo;
use Auth;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Liga
        $liga = new Liga;
        // Obtener id del usuario
        $user_id = Auth::user()->id;
        // Obtener las ligas del usuario
        $ligas = $liga->select('id', 'nombre')->where('usuario_id', $user_id)->where('estado',1)->get(); 
        $datos['ligas'] = $ligas->toArray();
        return view('grupo.index',$datos);
    }

    /**
     * Listar grupos
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $get)
    {
        // Cargar modelo.
        $grupo = new Grupo;
        // Obtener id del usuario
        $user_id = Auth::user()->id;
        // Obtener las ligas del usuario

        // Obtener solicitudes
        $grupos = $grupo->listar($get,$user_id);
        // Ordenar datos
        $datos = [
            "draw" => $get->draw,
            "recordsTotal" => $grupos['total'],
            "recordsFiltered" => $grupos['total'],
            "data" => $grupos['ligas']/*,
            "get" => $_GET,*/
          ];
        return $datos;
    }

     /**
     * Listar grupos de la liga
     *
     * @return \Illuminate\Http\Response
     */
    public function grupos_liga($id_liga)
    {
        $grupos = [];
        $grupo = new Grupo();
        $grupos = $grupo->grupos_liga($id_liga);
        return $grupos;
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
    public function store(GrupoRequest $request)
    {
        // Variables.
        $msg = [];
        $estado = false;

        try {
            //  Editar
           $grupo = new Grupo(); 
           $ligaGrupo = new LigaGrupo(); 
           if(count($grupo) > 0  && count($ligaGrupo) > 0){
               // Editar grupo
               $grupo->nombre = $request->input_nombre;
               $grupo->clasifican = $request->input_clasifican;
               $grupo->save();
               // Editar relación
               $ligaGrupo->liga_id = $request->select_liga;
               $ligaGrupo->grupo_id = $grupo->id;
               $ligaGrupo->save();

               $estado = true;
               $msg[] = 'El grupo se guardó.';
           }else{
               $estado = false;
               $msg[] = 'No se encontraron registros.';
           }
        } catch (Exception $e) {
            $estado = false;
            $msg[] = 'Error actualizando los datos.';
        }
        

        // Retornar datos al usuario.
        $datos = [
            'msg' => $msg,
            'estado' => $estado,
            $request->all()
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
    public function update(GrupoRequest $request, $id)
    {
         // Variables.
         $msg = [];
         $estado = false;
 
         try {
             //  Editar
            $grupo = new Grupo(); 
            $grupo = $grupo->find($request->grupo_id);
            $ligaGrupo = new LigaGrupo(); 
            $ligaGrupo = $ligaGrupo->find(decrypt($request->input_id));
            if(count($grupo) > 0  && count($ligaGrupo) > 0){
                // Editar grupo
                $grupo->nombre = $request->input_nombre;
                $grupo->clasifican = $request->input_clasifican;
                $grupo->save();
                // Editar relación
                $ligaGrupo->liga_id = $request->select_liga;
                $ligaGrupo->grupo_id = $request->grupo_id;
                $ligaGrupo->save();

                $estado = true;
                $msg[] = 'Los registros se actualizaron.';
            }else{
                $estado = false;
                $msg[] = 'No se encontraron registros.';
            }
         } catch (Exception $e) {
             $estado = false;
             $msg[] = 'Error actualizando los datos.';
         }
         
 
         // Retornar datos al usuario.
         $datos = [
             'msg' => $msg,
             'estado' => $estado,
             $request->all()
         ];
 
         // Retornar datos.
         return $datos;
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
