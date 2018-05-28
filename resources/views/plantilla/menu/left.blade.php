<?php
// Obtener personas.
$persona = Session::get('persona')[0];
?>
<!-- Barra lateral izquierda -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User"/>
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
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
            <li class="active" id="list_home">
                <a href="{{ url('home') }}">
                    <i class="material-icons">home</i>
                    <span>Inicio</span>
                </a>
            </li>
            <li id="list_ligas">
                <a href="{{ url('liga') }}">
                    <i class="material-icons">apps</i>
                    <span>Ligas</span>
                </a>
            </li>
            <li id="list_grupos">
                <a href="{{ url('grupo') }}">
                    <i class="material-icons">view_carousel</i>
                    <span>Grupos</span>
                </a>
            </li>
            <li id="list_equipos">
                <a href="{{ url('equipo') }}">
                    <i class="material-icons">security</i>
                    <span>Equipos</span>
                </a>
            </li>
            <li id="list_participantes">
                <a href="javascript:void(0);" class="menu-toggle" id="participantes_a">
                    <i class="material-icons">accessibility</i>
                    <span>Participantes</span>
                </a>
                <ul class="ml-menu" id="participantes_m">
                    <li id="jugadores_li">
                        <a href="#" id="jugadores_a" class="waves-effect waves-block">Jugadores</a>
                    </li>
                    <li id="delegados_li">
                        <a href="{{ url('delegado') }}" id="delegados_a" class="waves-effect waves-block">Delegados</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">date_range</i>
                    <span>Fechas</span>
                </a>
            </li>
            <li id="resultado_li">
                <a href="javascript:void(0);" id="resultado_a" class="menu-toggle waves-effect waves-block">
                    <i class="material-icons">assignment</i>
                    <span>Resultados</span>
                </a>
                <ul class="ml-menu" id="resultado_m">
                    <li id="posiciones_li">
                        <a href="#" id="posiciones_a" class="waves-effect waves-block">Tabla de posiciones</a>
                    </li>
                    <li id="goleador_li">
                        <a href="#" id="goleador_a" class=" waves-effect waves-block">Goleador</a>
                    </li>
                    <li id="vencida_li">
                        <a href="#" id="vencida_a" class=" waves-effect waves-block">Valla menos vencida</a>
                    </li>
                    <li id="amarillas_li">
                        <a href="#" id="amarillas_a" class=" waves-effect waves-block">Amarillas</a>
                    </li>
                    <li id="rojas_li">
                        <a href="#" id="rojas_a" class=" waves-effect waves-block">Rojas</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 <a href="javascript:void(0);">Desarrollado por Gustavo Polania</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Barra lateral izquierda -->
