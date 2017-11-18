<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Mensaje para los campos obligatorios.
        $required = 'Este campo es obligatorio.';
        $email = 'Por favor, escribe una dirección de correo válida.';
        // Validar campos. (datos,reglas,mensaje);
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ],[
            'name.required' => $required,
            'lastname.required' => $required,
            'email.required' => $required,
            'email.email'=> $email
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      // Insertar persona.
      $id_persona = Persona::create([
        'nombres' => $data['name'],
        'apellidos' => $data['lastname'],
        'tipoIdent_id'=> 0,
        'numIdent'=> 0,
        'telefono'=> '',
        'direccion'=> '',
        'fechaNac'=> '1900/01/01',
        'genero'=> ''
      ])->id;

      // Insertar usuario
      return User::create([
          'persona_id' => $id_persona,
          'tipo_usuario_id' => 4,
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
      ]);
    }
}
