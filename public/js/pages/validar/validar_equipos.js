var tb_grupos;
var columnas = [
    'id',
    'equipo',
    'grupo',
    'liga',
    'creada',
    'equipo_id',
    'liga_id',
    'grupo_id',
    'opciones'
];
var cancelar = 'cancelar';
var ok = 'ok';
var limpiar = 'limpiar';
$(document).ready(function(){
    // Inicializar menú
    ini_menu();
    // Inicializar boton de editar.
    ini_btn_editar();
    // Inicializar Formulario
    inicializar_form();
    // inicializar tabla.
    ini_tb();
    // Inicializar tab
    ini_tab();
    // Ini cambio liga
    ini_change_liga();
});

/**
 * Inicializar el boton editar liga
 */
function ini_btn_editar(){
    $('#tb_grupos tbody').on('click', '.btn_editar', function () {
        var data = $('#tb_grupos').DataTable().row($(this).parents('tr')).data();
        // Llenar campos.
        $("#crear_editar").val(1);
        $("#input_id").val(data[columnas.indexOf('id')]);
        $("#grupo_id").val(data[columnas.indexOf('grupo_id')]);
        $("#equipo_id").val(data[columnas.indexOf('equipo_id')]);
        $("#liga_id").val(data[columnas.indexOf('liga_id')]);
        $('#select_liga').selectpicker('val', data[columnas.indexOf('liga_id')]);
        $('#select_grupo').selectpicker('val', data[columnas.indexOf('select_grupo')]);
        $("#input_nombre").val(data[columnas.indexOf('equipo')]);
        $("#input_clasifican").val(data[columnas.indexOf('clasifican')]);
        $('.selectpiker').selectpicker('refresh');
        // Mostrar tab
        $('#myTabs a[href="#grupo_panel"]').tab('show');   
	});
}

/**
 * Inicializar tabla liga
 */
function ini_tb(){
    tb_grupos = $('#tb_grupos').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url":ruta_tabla,
            "type": "GET"
        },
        "createdRow": function (row, data, index) {
            $('td', row).eq(-1).html(`
            <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float btn_editar">
                <i class="material-icons">edit</i>
            </button>
            `);
        },
        "order": [[ 4, "desc" ]],
        searchDelay: 1000,
        dom: 'lfrtip',
        language:{
            url: base_url + 'js/Spanish.json'
        },
        columnDefs: [
            {
                "targets": [columnas.indexOf('opciones')],
                "searchable": false,
                "orderable": false,
                "width": "10px"
            },
            {
                "targets": [
                    columnas.indexOf('id'),
                    columnas.indexOf('liga_id'),
                    columnas.indexOf('grupo_id'),
                    columnas.indexOf('equipo_id')
                ],
                "searchable": false,
                "orderable": false,
                "visible": false
            }
        ]
    });
}

/**
 * Inicializar opciones del menú
 */
function ini_menu(){
    active = 'active';
    toggled = 'toggled';
    selecionar_lista = [
        {id: '#list_home', class: active},
        {id: '#list_equipos', class: active}
    ];
    mostrar = [];
    marcar_opciones(selecionar_lista, mostrar);
}

/**
 * Inicializar formulario
 */
function inicializar_form(){
    $('#form_equipo').validate({
        submitHandler: function(form) {
        try {
            enviar_formulario();   
        } catch (error) {
            console.log('Error enviando el formulario!',error);
        }
    },
    highlight: function (input) {
        $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
        $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
        $(element).parents('.input-group').append(error);
    }});
    // Ini select
    $(".selectpiker").selectpicker();
}

/**
 * Evniar formulario
 */
function enviar_formulario(){
    // Enviar formulario.
    var colorName='bg-red';
    var placementFrom='bottom';
    var placementAlign='right';
    var animateEnter='animated fadeInRight';
    var animateExit='animated fadeOutRight';
    parametros = get_param($("#form_equipo").serializeArray());
    parametros['select_liga']= $('#select_liga').selectpicker('val');
    var editar = '';
    var id = '/' + $("#equipo_id").val();
    var ruta = ruta_url;
    var metodo = 'POST';
    if($("#crear_editar").val() == 1){
        ruta += id;
        metodo = 'PUT';
    }
    $.ajax({
        url: ruta,
        method: metodo,
        data: parametros,
        dataType: "json",
        beforeSend: function( xhr ) {
            $("#btn_guardar").button('loading');
            $("#btn_limpiar").button('loading');
        }
    }).done(function(res){
        // Validar el estado de la notificaion.
        if(res.estado){
            colorName='bg-teal';
            $("#form_equipo")[0].reset();
        }else{
            colorName='bg-red';
        }
        msg = res.msg[0];
        showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
    }).fail(function(res) {
        try {
            respuesta = JSON.parse(res.responseText);
            $.each(respuesta,function(indice, value){
                $.each( value,function(i,v){
                    showNotification(colorName, v, placementFrom, placementAlign, animateEnter, animateExit);
                });
            });
        }
        catch(err) {
            showNotification(colorName, 'Error en el servidor.', placementFrom, placementAlign, animateEnter, animateExit);
        }
    }).complete(function(res){
        $("#btn_guardar").button('reset');
        $("#btn_limpiar").button('reset');
    });
}

function ini_tab(){
    $('#tab_grupos').on('shown.bs.tab', function (e) {
        $('#tb_grupos').DataTable().draw('page');
    });

    $('#tab_crear').on('hidden.bs.tab', function (e) {
        $("#form_equipo")[0].reset();
        $('#select_liga').selectpicker('refresh');
    });
}

function ini_change_liga(){
    // Enviar formulario.
    var colorName='bg-red';
    var placementFrom='bottom';
    var placementAlign='right';
    var animateEnter='animated fadeInRight';
    var animateExit='animated fadeOutRight';
    $( "#select_liga" ).change(function(e) {
        // Actualizar el select
        $.get(ruta_select_grupo + '/' + $(this).val(),function(data){
            try {
                dibujar_select(data);
            }
            catch(err) {
                showNotification(colorName, 'Error mostrando grupos.', placementFrom, placementAlign, animateEnter, animateExit);
            }
        }).fail(function() {
            try {
                respuesta = JSON.parse(res.responseText);
                $.each(respuesta,function(indice, value){
                    $.each( value,function(i,v){
                        showNotification(colorName, v, placementFrom, placementAlign, animateEnter, animateExit);
                    });
                });
            }
            catch(err) {
                showNotification(colorName, 'Error en el servidor.', placementFrom, placementAlign, animateEnter, animateExit);
            }
        });
    });
}

function dibujar_select(data){
    $("#select_grupo").empty();
    $.each(data,function(i,v){
        $("#select_grupo").append('<option value="' + v.id + '">' + v.nombre  + '</option>');
    });
    $('.selectpiker').selectpicker('refresh');
}

/*active = 'active';
    toggled = 'toggled';
    selecionar_lista = [
        {id: '#list_home', class: active},
        {id: '#resultado_li', class: active},
        {id: '#resultado_a', class: toggled},
        {id: '#posiciones_li', class:  active},
        {id: '#posiciones_a', class: toggled}
    ];
    mostrar = [
            {id: '#resultado_m', onOff: true}
    ];*/