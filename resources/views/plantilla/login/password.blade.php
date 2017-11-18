@extends('plantilla.appLogin')
@section('clasebody','fp-page')
@section('clasecontent','fp-box')
@section('content')
  <div class="card">
      <div class="body">
          <form id="forgot_password" method="POST">
              <div class="msg">
                  Introduzca su dirección de correo electrónico que utilizó para registrarse.
                  Te enviaremos un correo electrónico con tu nombre de usuario y un enlace para restablecer tu contraseña.
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">email</i>
                  </span>
                  <div class="form-line">
                      <input type="email" class="form-control" name="email" placeholder="Correo" required autofocus>
                  </div>
              </div>

              <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESTABLECER</button>

              <div class="row m-t-20 m-b--5 align-center">
                  <a href="{{ route('login') }}">ingresa!</a>
              </div>
          </form>
      </div>
  </div>
@endsection
@section('js')
<script src="{{ asset('js/pages/examples/forgot-password.js') }}"></script>
@endsection
