<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liga;
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

    public function combinar()
    {
        $array = ['1vs2','1vs2','1vs2'];
        print_r(array(
           $array,
           array_unique($array)
        ));
        /*$input = array('1', '2', '3', '4');

        $resultado = $this->permutar($input);
        for ($f = 0; $f < count($resultado); $f++) {
            echo $resultado[$f];
            echo "<br>";
        }*/


    }

    /*******************************************************/
    private function permutar($input)
    {
        $miarray = array();
        $cadena = "";
        //copio el array
        $temporal = $input;
        //borro el primer numero del array
        array_shift($input);
        //ahora la cuenta esta en que solo quedan 3
        for ($u = 0; $u < count($temporal); $u++) {
            for ($i = 0; $i < count($input); $i++) {
                array_push($input, $input[0]);
                array_shift($input);
                for ($e = 0; $e < count($input); $e++) {
                    $cadena .= $input[$e];
                }
                array_push($miarray, $temporal[$u] . $cadena);
                array_push($miarray, $temporal[$u] . strrev($cadena));
                $cadena = "";
            }
            array_shift($input);
            array_push($input, $temporal[$u]);
        }
        return $miarray;
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
