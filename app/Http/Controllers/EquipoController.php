<?php

namespace App\Http\Controllers;

use App\Participante;
use Illuminate\Http\Request;
use App\Http\Requests\EquipoRequest;
use App\Equipo;
use App\Grupo;
use App\Liga;
use App\EquipoGrupo;
use Auth;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
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
        return view('equipo.index', $datos);
    }

    /**
     * Listar equipos de la liga
     *
     * @return \Illuminate\Http\Response
     */
    public function equipo_liga($id_liga)
    {
        $equipo = [];
        $equipo = new Equipo();
        $equipo = $equipo->equipo_liga($id_liga, Auth::user()->id);
        return $equipo;
    }

    /**
     * Listar grupos
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $get)
    {
        // Cargar modelo.
        $equipo = new Equipo;
        // Obtener id del usuario
        $user_id = Auth::user()->id;
        // Obtener las ligas del usuario

        // Obtener solicitudes
        $equipos = $equipo->listar($get, $user_id);
        // Ordenar datos
        $datos = [
            "draw" => $get->draw,
            "recordsTotal" => $equipos['total'],
            "recordsFiltered" => $equipos['total'],
            "data" => $equipos['ligas']/*,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipoRequest $request)
    {
        // Variables.
        $msg = [];
        $estado = false;

        try {
            //  Editar
            $equipo = new Equipo();
            $equipoGrupo = new EquipoGrupo();
            $delegado = new Participante();
            if (count($equipo) > 0) {
                // Editar Equipo
                $equipo->nombre = $request->input_nombre;
                $equipo->escudo = "";
                $equipo->save();
                // Editar relación
                $equipoGrupo->liga_id = $request->select_liga;
                $equipoGrupo->grupo_id = $request->select_grupo;
                $equipoGrupo->equipo_id = $equipo->id;
                $equipoGrupo->posicion = 0;
                $equipoGrupo->save();
                // Relacionar delegado.
                if (isset($request->input_idDelegado)) {
                    $delegado->persona_id = decrypt($request->input_idDelegado);
                    $delegado->liga_id = $request->select_liga;
                    $delegado->tipo_usuario_id = 4;
                    $delegado->equipo_id = $equipo->id;
                    $delegado->save();
                }
                $estado = true;
                $msg[] = 'El grupo se guardó.';
            } else {
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
    public function update(EquipoRequest $request, $id)
    {

        // Variables.
        $msg = [];
        $estado = false;

        try {
            //  Editar
            $equipo = new Equipo();
            $equipo = $equipo->find($id);
            $equipoGrupo = new EquipoGrupo();
            $equipoGrupo = $equipoGrupo->find(decrypt($request->input_id));
            $delegado = (isset($request->input_idDelegado)) ?
                Participante::where('equipo_id', $id)->where('tipo_usuario_id', 4)->first() :
                new Participante();
            if (count($equipo) > 0) {
                // Editar Equipo
                $equipo->nombre = $request->input_nombre;
                $equipo->save();
                // Editar relación
                $equipoGrupo->liga_id = $request->select_liga;
                $equipoGrupo->grupo_id = $request->select_grupo;
                $equipoGrupo->equipo_id = $equipo->id;
                $equipoGrupo->save();
                // Validar delegado
                if (isset($request->input_idDelegado)) {
                    if (isset($delegado->id)) {
                        // Actualizar delegado
                        $delegado->persona_id = decrypt($request->input_idDelegado);
                        $delegado->save();
                    } else {
                        // Crear delegado.
                        if (!isset($delegado->id)) {
                            $delegado = new Participante();
                        }
                        $delegado->persona_id = decrypt($request->input_idDelegado);
                        $delegado->liga_id = $request->select_liga;
                        $delegado->tipo_usuario_id = 4;
                        $delegado->equipo_id = $id;
                        $delegado->save();
                    }
                } else {
                    // Eliminar delegado del equipo.
                    Participante::where('equipo_id', $id)->where('tipo_usuario_id', 4)->delete();
                }
                $estado = true;
                $msg[] = 'El grupo se guardó.';
            } else {
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
            $request->all(),
            'id' => $id
        ];

        // Retornar datos.
        return $datos;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
