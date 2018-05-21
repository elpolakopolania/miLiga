<!-- Barra superior -->
<?php 
    $persona = Session::get('persona')[0];
?>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="">Mi liga - @yield('titulo')</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--Lista de ligas -->
                <li class="pull-right" title="Ligas">
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true">
                        <i class="material-icons">apps</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- #END# Barra superior -->
