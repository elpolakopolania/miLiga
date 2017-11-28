<?php

namespace App\Http\Controllers;

use App\User;
use App\Persona;
use App\TipoDocumento;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == 'yo'){
            // Obtener información de la persona.
            $persona = new Persona();
            $persona_id = Auth::user()->persona_id;
            $persona_info = $persona->persona($persona_id);
            $tipos_docs = TipoDocumento::all()->toArray();
            
            //Persona::persona(Auth::);
            $datos = [
                "persona" => $persona_info,
                "tipo_docs" => $tipos_docs,
                "generos" => [
                    ["id"=>'M', 'nombre'=>'Masculino'], 
                    ["id"=>'F', 'nombre'=>'Femenino']
                ]
            ];
            return view('perfil.edit',$datos);
        }else{
            return redirect()->route('home');
        }
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
      // Mensaje para los campos obligatorios.
      $required = 'Este campo es obligatorio.';
      $email = 'Por favor, escribe una dirección de correo válida.';
      // Validar campos. (datos,reglas,mensaje);
      $this->validate($request,[
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
      ],[
          'name.required' => $required,
          'lastname.required' => $required,
          'email.required' => $required,
          'email.email'=> $email
      ]);
        return "Perfil actualizado.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
