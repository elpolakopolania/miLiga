<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participante;
use App\Persona;
use App\Liga;
use App\Grupo;
use App\TipoDocumento;
use Auth;
use App\Http\Requests\DelegadoRequest;
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
        //Obtener números de documetos
        $documentos_model = new TipoDocumento();
        $documentos = $documentos_model->where('estado',1)->get();
        $datos['ligas'] = $ligas->toArray();
        $datos['documentos'] = $documentos;
        return view('delegado.index', $datos);
    }

    /**
     * Listar delegados
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $get)
    {
        // Cargar modelo.
        $participante = new Participante();
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
    public function store(DelegadoRequest $delegadoRequest)
    {
        // Variables.
        $msg = [];
        $estado = false;

        // Guardar persona y participante.
        $persona = new Persona();
        $participante = new Participante();

        $persona->nombres = $delegadoRequest->input_nombre;
        $persona->apellidos = $delegadoRequest->input_apellido;
        $persona->tipoIdent_id = $delegadoRequest->select_tipoDoc;
        $persona->numIdent = $delegadoRequest->input_doc;
        $persona->email = $delegadoRequest->input_correo;
        $persona->telefono = $delegadoRequest->input_telefono;
        $persona->direccion = $delegadoRequest->input_direccion;
        $persona->fechaNac = $delegadoRequest->input_fecha_nac;
        $persona->genero = $delegadoRequest->select_genero;
        $persona->save();

        if($persona->id > 0){
            // Editar relación con el aquipo.
            $participante->persona_id = $persona->id;
            $participante->liga_id = $delegadoRequest->select_liga;
            $participante->equipo_id = $delegadoRequest->select_equipo;
            $participante->tipo_usuario_id = 4;
            $participante->save();
            $msg[] = 'EL delegado se creó correctamente.';
            $estado = true;
        }else{
            $msg[] = 'EL delegado no se pudo crear.';
            $estado = false;
        }

        // Retornar datos al usuario.
        $datos = [
            'msg' => $msg,
            'estado' => false/*,
            $delegadoRequest->all()*/
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
    public function update(DelegadoRequest $delegadoRequest, $id)
    {
        // Variables.
        $msg = [];
        $estado = false;

        // Editar persona y participante.
        $persona = Persona::find(decrypt($delegadoRequest->delegado_id));
        $participante = Participante::find(decrypt($id));
        if(count($persona) > 0 AND count($participante) > 0){
            $persona->nombres = $delegadoRequest->input_nombre;
            $persona->apellidos = $delegadoRequest->input_apellido;
            $persona->tipoIdent_id = $delegadoRequest->select_tipoDoc;
            $persona->numIdent = $delegadoRequest->input_doc;
            $persona->email = $delegadoRequest->input_correo;
            $persona->telefono = $delegadoRequest->input_telefono;
            $persona->direccion = $delegadoRequest->input_direccion;
            $persona->fechaNac = $delegadoRequest->input_fecha_nac;
            $persona->genero = $delegadoRequest->select_genero;
            $persona->save();
            // Editar relación con el aquipo.
            $participante->persona_id = decrypt($delegadoRequest->delegado_id);
            $participante->liga_id = $delegadoRequest->select_liga;
            $participante->equipo_id = $delegadoRequest->select_equipo;
            $participante->save();

            $msg[] = 'EL delegado se actualizó correctamente.';
            $estado = true;
        }else{
            $msg[] = 'EL delegado no se pudo actualizar.';
            $estado = false;
        }

        // Retornar datos al usuario.
        $datos = [
            'msg' => $msg,
            'estado' => $estado/*,
            $delegadoRequest->all(),
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
