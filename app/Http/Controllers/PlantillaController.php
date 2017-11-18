<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    public function index(){
      return '';
    }

    public function login(){
      return view('plantilla.login.login');
    }

    public function registrar(){
      return view('plantilla.login.registrar');
    }

    public function password(){
      return view('plantilla.login.password');
    }

    public function home(){
      return view('plantilla.app.home');
    }

}
