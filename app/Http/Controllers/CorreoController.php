<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Users;
use Auth;

class CorreoController extends Controller
{
    public function index(){
        $user = '';
        $data = [];
        Mail::send('email', $data, function ($message) use ($user){
            $message->subject('Asunto del correo');
            $message->to('gapolania0796@gmail.com');
        });

        return 'ok';
    }

    public function borrar(){
        dd(Auth::user());
        return User::all();
    }
}
