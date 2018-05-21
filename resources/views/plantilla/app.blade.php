<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('titulo') | Mi Liga </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico?ass') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Librerías de estilo app -->
    @yield('cssLib')
    <!--/end Librerías de estilo app -->

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />

    <!-- Estilo de la página -->
    @yield('cssPag')
    <!--/end Estilo de la página -->
    <script type="text/javascript">
      var base_url = '{{ asset('') }}';
      var ruta_url_ = '{{ url('') }}';
      //console.log(base_url, ruta_url_);
      var selecionar_lista = [];
    </script>
</head>

<body class="theme-light-blue">
    <!-- Cargando -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Por favor espere...</p>
        </div>
    </div>
    <!-- #END# Cargando -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    @include('plantilla.menu.top')
    <section>
      @include('plantilla.menu.left')
      @include('plantilla.menu.right')
    </section>
    <!-- Contenido de la APP -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @yield('contenido')
            </div>
        </div>
    </section>
    <!-- #END# Contenido de la APP -->

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>
    <!-- Librerías de la página -->
    @yield('jsLib')
    <!--/end Librerías de la página -->
    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <!-- Script de la página -->
    @yield('jsPag')
    <!--/ Fin script de la página-->
    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>
</body>

</html>
