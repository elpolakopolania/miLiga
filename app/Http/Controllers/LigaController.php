<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LigaRequest;
use App\Liga;
use Auth;
use Illuminate\Support\Facades\DB;

class LigaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liga.index');
    }

    /**
     * Listar ligas
     *
     * @return \Illuminate\Http\Response
     */
    public function listar_ligas(Request $get)
    {
        // Cargar modelo.
        $liga = new Liga;
        // Obtener id del usuario
        $user_id = Auth::user()->id;
        // Obtener solicitudes
        $ligas = $liga->listar_ligas($get,$user_id);
        // Ordenar datos
        $datos = [
            "draw" => $get->draw,
            "recordsTotal" => $ligas['total'],
            "recordsFiltered" => $ligas['total'],
            "data" => $ligas['ligas']/*,
            "get" => $_GET,*/
          ];
        return $datos;
    }

    /**
     * Formulario para crear una nueva liga
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Crea una nueva liga
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LigaRequest $request)
    {
        // Variables.
        $msg = ['La liga se guardó correctamente.'];
        $estado = true;

        // Guardar liga
        $liga = new Liga();

        $liga->nombre = $request->input_nombre;
        $liga->usuario_id = Auth::id();
        $liga->img = '';
        $liga->descripcion = $request->input_descripcion;
        $liga->fecha_ini = $request->input_fecha_ini;
        $liga->fecha_fin = $request->input_fecha_fin;
        $liga->telefono = $request->input_telefono;
        $liga->direccion = $request->input_direccion;
        $liga->categoria = $request->input_categoria;
        $liga->valor_inscrip = $request->input_incripcion;
        $liga->valor_ama = $request->input_amarilla;
        $liga->valor_roja = $request->input_roja;
        $liga->campeon_id = null;
        $liga->subcampeon_id = null;
        $liga->reglas = $request->input_reglas;

        $liga->save();

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
     * Muestra una liga en específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Mustra una liga para editarla
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Actualiza una liga
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LigaRequest $request, $id)
    {
        // Variables.
        $msg = [];
        $estado = false;

        //  Editar liga
        $liga = new Liga(); 
        try {
            $liga = $liga->find(decrypt($id));
            if(count($liga) > 0){

                $liga->nombre = $request->input_nombre;
                $liga->descripcion = $request->input_descripcion;
                $liga->fecha_ini = $request->input_fecha_ini;
                $liga->fecha_fin = $request->input_fecha_fin;
                $liga->telefono = $request->input_telefono;
                $liga->direccion = $request->input_direccion;
                $liga->categoria = $request->input_categoria;
                $liga->valor_inscrip = $request->input_incripcion;
                $liga->valor_ama = $request->input_amarilla;
                $liga->valor_roja = $request->input_roja;
                $liga->reglas = $request->input_reglas;
                
                $liga->save();

                $msg[] = 'La liga se editó correctamente.';
                $estado = true;
            }else{
                $estado = false;
                $msg[] = 'La liga no existe.';
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
     * Elimina una liga en específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retorna las ligas del usuario.
     */
    public function mis_ligas(Request $request){
        if($request->input('ids')){
            $redirect_ = $request->input('redirect');
            $redirect = (!empty($redirect_)) ? $request->input('redirect'): '';
            $liga = new Liga();
            $ligas = $liga::select('id', 'nombre', DB::raw("'active' as estado "))
            ->whereIn('id',$request->input('ids'))
            ->where('estado',1)
            ->where('usuario_id', Auth::user()->id)->get();
            // Actualizar session
            $liga_insert = $request->session()->get('ligas');
            foreach ($liga_insert as $i => $liga) {
                $liga_insert[$i]['estado'] = '';
                foreach ($ligas->toArray() as $indice => $liga_consulta) {
                    if($liga_consulta['id'] == $liga['id']){
                        $liga_insert[$i]['estado'] = 'active';
                    }
                }
            }
            $request->session()->put('ligas', $liga_insert);

            return redirect($redirect);
        }else{
            return response()->json($request->session()->get('ligas'));
        }

    }

}
