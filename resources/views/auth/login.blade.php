@extends('plantilla.appLogin')
@section('clasebody','login-page')
@section('clasecontent','login-box')
@section('content')
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
                <div class="msg">Debe estar registrado para iniciar sesión</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Usuario" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                    </div>
                    @if ($errors->has('password'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                        <!--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me-->
                        <label for="remember">Recuérdame</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">Ingresar</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="{{ route('register') }}">Registarse ahora!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{ route('password.request') }}">Olvidó su contraseña ?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('js/pages/examples/sign-in.js') }}"></script>
@endsection
