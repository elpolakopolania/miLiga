<?php
  // Obtener personas.
  $persona = Session::get('persona')[0];
?>
<!-- Barra lateral izquierda -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $persona['nombres'] . ' ' . $persona['apellidos'] }}
            </div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ url('perfil/yo/edit') }}"><i class="material-icons">person</i>Perfil</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          <i class="material-icons">input</i>Salir
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">Navegación principal</li>
            <li class='active'>
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Inicio</span>
                </a>
            </li>
            @if (Auth::user()->tipo_usuario_id == 3)
              <li>
                  <a href="javascript:void(0);" class="menu-toggle">
                      <i class="material-icons">assignment</i>
                      <span>Homologación</span>
                  </a>
                  <ul class="ml-menu">
                      <li>
                          <!-- Jefe de programa -->
                          <a href="{{ url('solicitud') }}">Listado de solicitudes</a>
                      </li>
                  </ul>
              </li>
            @endif
            @if (Auth::user()->tipo_usuario_id == 4)
              <li>
                  <a href="javascript:void(0);" class="menu-toggle">
                      <i class="material-icons">assignment</i>
                      <span>Homologación</span>
                  </a>
                  <ul class="ml-menu">
                      <li>
                        <!-- Estudiante -->
                        <a href="{{ url('solicitud/create') }}">Solicitar homologación</a>
                        <a href="{{ url('homologar/solicitudes') }}">Ver mi homologación</a>
                      </li>
                  </ul>
              </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2017 <a href="javascript:void(0);">Desarrollado por semillero Ingenius</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Barra lateral izquierda -->
