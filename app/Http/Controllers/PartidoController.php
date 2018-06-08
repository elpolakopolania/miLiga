<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liga;
use App\LigaGrupo;
use App\Grupo;
use App\Equipo;
use App\Fecha;
use App\Jornada;
use Auth;

class PartidoController extends Controller
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
        $datos = [
            'ligas' => $ligas
        ];
        return view('partido.index', $datos);
    }

    /**
     * Permite listar las rondas según la liga
     */
    public function listar_rondas($liga_id)
    {
        $rondas = [];
        $msg = [];
        $estado = true;

        $msg[] = 'Listar rondas';
        if (decrypt($liga_id) == 1) {
            $rondas[] = 1;
        }
        return [
            'estado' => $estado,
            'msg' => $msg,
            'rondas' => $rondas
        ];
    }

    /**
     * Combina los equipos de una liga.
     * @return array
     */
    public function combinar($liga_id, $idaVuelta = 0)
    {
        $idaVuelta = (intval($idaVuelta) === 0) ? false : true;
        $rondas = calcular_rondas(5, $idaVuelta);
        return $rondas;
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
        //
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
}
