<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participante;
use App\Persona;
use App\Liga;
use App\Grupo;
use Auth;
use Illuminate\Support\Facades\DB;

class DelegadoController extends Controller
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
        $ligas = $liga->select('id', 'nombre')->where('usuario_id', $user_id)->where('estado', 1)->get();
        // Grupos
        $grupo = new Grupo;
        $datos['ligas'] = $ligas->toArray();
        $datos['grupos'] = $grupo->grupos($user_id, $datos['ligas'][0]['id']);
        return view('delegado.index', $datos);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Consultar el delegado por medio del número de documento.
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Obtener el delegado por medio de número de documento.
     */
    public function showNumdoc($numDoc)
    {
        $datos = [];
        $delegadoModel = new  Participante();
        $delegado = $delegadoModel->delgado_doc($numDoc, Auth::user()->id);
        if (!empty($delegado)) {
            $datos = [
                'id' => encrypt($delegado->id),
                'numIdent' => $delegado->numIdent,
                'nombre' => $delegado->nombre
            ];
        }
        return $datos;
    }
}
