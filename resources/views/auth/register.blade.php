@extends('plantilla.appLogin')
@section('clasebody','signup-page')
@section('clasecontent','signup-box')
@section('content')
    <div class="card">
        <div class="body">
            <form id="sign_up" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="msg">Registrar persona</div>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nombres"  autofocus required>
                    </div>
                    @if ($errors->has('name'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Apellidos"  autofocus required>
                    </div>
                    @if ($errors->has('lastname'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('lastname') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="correo" required>
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
                        <input type="password" class="form-control" name="password" id="password" minlength="6" placeholder="Contaseña" required>
                    </div>
                    @if ($errors->has('password'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" minlength="6" placeholder="Comfirmar contraseña" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                    <label for="terms">He leído  y estoy de acuerdo con los <a href="javascript:void(0);">términos de uso</a>.</label>
                </div>

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Regístrate</button>

                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">Ya estas registrado?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
  <script src="{{ asset('js/pages/examples/sign-up.js') }}"></script>
@endsection
