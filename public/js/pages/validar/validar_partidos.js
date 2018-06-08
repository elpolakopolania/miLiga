var tb_grupos;
var columnas = [
    'participante_id', 'liga', 'equipo','nombres', 'apellidos', 'tipo_doc',
    'documento', 'camiseta', 'telefono', 'correo', 'direccion',
    'fecha_nac', 'genero', 'creada', 'tipoDoc_id', 'liga_id',
    'equipo_id', 'delegado_id',
    'opciones'
];
var cancelar = 'cancelar';
var ok = 'ok';
var limpiar = 'limpiar';

var colorName = 'bg-red';
var placementFrom = 'bottom';
var placementAlign = 'right';
var animateEnter = 'animated fadeInRight';
var animateExit = 'animated fadeOutRight';
var jornadas;
$(document).ready(function () {
    // Inicializar menú
    ini_menu();
    // Ini cambio liga
    ini_change_liga();
    // Inicializar jornada
    ini_div_jornada();
    // Inicializar el boton para carlcular jorndas.
    ini_cal_jornadas();
});

function ini_cal_jornadas(){
    $("#btn_calcular").click(function(){
        liga_id = '/' + $('#select_liga').selectpicker('val');
        idaVuelta = ($("#checkIdaVuelta").prop('checked')) ? '/1' : '/0';
        $.get(ruta_calcular_jornadas + liga_id + idaVuelta,function(datos){
            try {
                // Mostrar mensaje de calculado y obtener los datos calculados.
            }
            catch (err) {
                showNotification(colorName, 'Error mostrando equipos.', placementFrom, placementAlign, animateEnter, animateExit);
                mostrar_opciones(false);
            }
        },'json').fail(function () {
            try {
                respuesta = JSON.parse(res.responseText);
                $.each(respuesta, function (indice, value) {
                    $.each(value, function (i, v) {
                        showNotification(colorName, v, placementFrom, placementAlign, animateEnter, animateExit);
                    });
                });
            }
            catch (err) {
                showNotification(colorName, 'Error en el servidor.', placementFrom, placementAlign, animateEnter, animateExit);
                mostrar_opciones(false);
            }
        });;
    });
}
function ini_div_jornada(){
    ini_div_jornada_destroy();
    jornadas = $('.divJornadas').jornada({
        'nombre':'jornada',
        'url':'okok',
        'nombre':'ok',
        'element_class':'rojo'
    });
}

function ini_div_jornada_destroy(){
    $('.divJornadas').html('');
}

/**
 * Inicializar opciones del menú
 */
function ini_menu() {

    active = 'active';
    toggled = 'toggled';
    selecionar_lista = [
        {id: '#list_home', class: active},
        {id: '#list_fechas', class: active},
        {id: '#fechas_a', class: toggled},
        {id: '#partidos_li', class: active},
        {id: '#partidos_a', class: toggled}
    ];
    mostrar = [
        {id: '#fechas_m', onOff: true}
    ];

    marcar_opciones(selecionar_lista, mostrar);
}

function ini_change_liga() {
    mostrar_opciones(false);
    $('#select_liga').selectpicker();
    // Enviar formulario.
    var colorName = 'bg-red';
    var placementFrom = 'bottom';
    var placementAlign = 'right';
    var animateEnter = 'animated fadeInRight';
    var animateExit = 'animated fadeOutRight';

    $("#select_liga").change(function (e) {
        liga_id = '/' + $('#select_liga').selectpicker('val');
        idaVuelta = ($("#checkIdaVuelta").prop('checked')) ? '/1' : '/0';
        //$.get(ruta_get_rondas + liga_id + idaVuelta, function (data) {

        // Actualizar el select
        $.get(ruta_get_rondas + liga_id, function (data) {
            try {
                if(data.rondas.length > 0){
                    mostrar_opciones(false);
                    ini_div_jornada();
                }else{
                    mostrar_opciones(true);
                    ini_div_jornada_destroy();
                }
            }
            catch (err) {
                showNotification(colorName, 'Error mostrando equipos.', placementFrom, placementAlign, animateEnter, animateExit);
                mostrar_opciones(false);
            }
        }).fail(function () {
            try {
                respuesta = JSON.parse(res.responseText);
                $.each(respuesta, function (indice, value) {
                    $.each(value, function (i, v) {
                        showNotification(colorName, v, placementFrom, placementAlign, animateEnter, animateExit);
                    });
                });
            }
            catch (err) {
                showNotification(colorName, 'Error en el servidor.', placementFrom, placementAlign, animateEnter, animateExit);
                mostrar_opciones(false);
            }
        });
    });
}

function mostrar_opciones(bool){
    // Mostrar
    if(bool){
        $(".onOffOp").show();
    }else{
        $(".onOffOp").hide();
    }
}
