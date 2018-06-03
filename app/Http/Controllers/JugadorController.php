<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participante;
use App\Jugador;
use App\Persona;
use App\Liga;
use App\Grupo;
use App\TipoDocumento;
use Auth;
use App\Http\Requests\JugadorRequest;
use Illuminate\Support\Facades\DB;

class JugadorController extends Controller
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
        //Obtener números de documetos
        $documentos_model = new TipoDocumento();
        $documentos = $documentos_model->where('estado',1)->get();
        $datos['ligas'] = $ligas->toArray();
        $datos['documentos'] = $documentos;
        return view('jugador.index', $datos);
    }

    /**
     * Listar jugadores
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $get)
    {
        // Cargar modelo.
        $participante = new Jugador();
        // Obtener id del usuario
        $user_id = Auth::user()->id;
        // Obtener participantes.
        $participantes = $participante->listar_del($get, $user_id);
        // Ordenar datos
        $datos = [
            "draw" => $get->draw,
            "recordsTotal" => count($participantes['datos']),
            "recordsFiltered" => $participantes['total'],
            "data" => $participantes['datos'],
            "get" => $_GET,
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
    public function store(JugadorRequest $jugadorRequest)
    {
        // Variables.
        $msg = [];
        $estado = false;

        // Guardar persona y participante.
        $persona = new Persona();
        $participante = new Jugador();

        $persona->nombres = $jugadorRequest->input_nombre;
        $persona->apellidos = $jugadorRequest->input_apellido;
        $persona->tipoIdent_id = $jugadorRequest->select_tipoDoc;
        $persona->numIdent = $jugadorRequest->input_doc;
        $persona->email = $jugadorRequest->input_correo;
        $persona->telefono = $jugadorRequest->input_telefono;
        $persona->direccion = $jugadorRequest->input_direccion;
        $persona->fechaNac = $jugadorRequest->input_fecha_nac;
        $persona->genero = $jugadorRequest->select_genero;
        $persona->save();

        if($persona->id > 0){
            // Editar relación con el aquipo.
            $participante->persona_id = $persona->id;
            $participante->liga_id = $jugadorRequest->select_liga;
            $participante->equipo_id = $jugadorRequest->select_equipo;
            $participante->num_camiseta = $jugadorRequest->input_num_camiseta;
            $participante->tipo_usuario_id = 3;
            $participante->save();
            $msg[] = 'EL jugador se creó correctamente.';
            $estado = true;
        }else{
            $msg[] = 'EL jugador no se pudo crear.';
            $estado = false;
        }

        // Retornar datos al usuario.
        $datos = [
            'msg' => $msg,
            'estado' => false/*,
            $jugadorRequest->all()*/
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
        echo $id;
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
    public function update(JugadorRequest $jugadorRequest, $id)
    {
        // Variables.
        $msg = [];
        $estado = false;

        // Editar persona y participante.
        $persona = Persona::find(decrypt($jugadorRequest->delegado_id));
        $participante = Jugador::find(decrypt($id));
        if(count($persona) > 0 AND count($participante) > 0){
            $persona->nombres = $jugadorRequest->input_nombre;
            $persona->apellidos = $jugadorRequest->input_apellido;
            $persona->tipoIdent_id = $jugadorRequest->select_tipoDoc;
            $persona->numIdent = $jugadorRequest->input_doc;
            $persona->email = $jugadorRequest->input_correo;
            $persona->telefono = $jugadorRequest->input_telefono;
            $persona->direccion = $jugadorRequest->input_direccion;
            $persona->fechaNac = $jugadorRequest->input_fecha_nac;
            $persona->genero = $jugadorRequest->select_genero;
            $persona->save();
            // Editar relación con el aquipo.
            $participante->persona_id = decrypt($jugadorRequest->delegado_id);
            $participante->liga_id = $jugadorRequest->select_liga;
            $participante->equipo_id = $jugadorRequest->select_equipo;
            $participante->num_camiseta = $jugadorRequest->input_num_camiseta;
            $participante->tipo_usuario_id = 3;
            $participante->save();

            $msg[] = 'EL jugador se actualizó correctamente.';
            $estado = true;
        }else{
            $msg[] = 'EL jugador no se pudo actualizar.';
            $estado = false;
        }

        // Retornar datos al usuario.
        $datos = [
            'msg' => $msg,
            'estado' => $estado/*,
            $jugadorRequest->all(),
            'id' => $id*/
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
    public function destroy($id)
    {
        //
    }

    /**
     * Obtener el participante por medio de número de documento.
     */
    public function showNumdoc($numDoc)
    {
        $datos = [];
        $delegadoModel = new  Jugador();
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
