var tb_grupos;
var columnas = [
    'persona_id', 'nombres', 'apellidos', 'tipo_doc', 'documento', 'telefono', 'direccion',
    'fecha_nac', 'genero', 'creada', 'liga_id', 'grupo_id', 'equipo_id', 'delegado_id',
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
$(document).ready(function () {
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
    // Inicializar el boton buscar delegado.
    ini_buscar_delegado();
});

/**
 * Inicializar el boton editar liga
 */
function ini_btn_editar() {
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

        $('#input_idDelegado').val(data[columnas.indexOf('delegado_id')]);
        $('#input_doc').val(data[columnas.indexOf('docDelegado')]);
        $('#nombre_delegado').val(data[columnas.indexOf('delegado')]);

        $("#input_nombre").val(data[columnas.indexOf('equipo')]);
        $('.selectpiker').selectpicker('refresh');
        // Mostrar tab
        $('#myTabs a[href="#grupo_panel"]').tab('show');
    });
}

/**
 * Inicializar tabla liga
 */
function ini_tb() {
    tb_grupos = $('#tb_grupos').DataTable({
        /*"processing": true,
        "serverSide": true,
        "ajax": {
            "url": ruta_tabla,
            "type": "GET"
        },*/
        "createdRow": function (row, data, index) {
            $('td', row).eq(-1).html(`
            <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float btn_editar">
                <i class="material-icons">edit</i>
            </button>
            `);
        },
        "order": [[4, "desc"]],
        searchDelay: 1000,
        dom: 'lfrtip',
        language: {
            url: base_url + 'js/Spanish.json'
        },
        columnDefs: [
            {
                "targets": [columnas.indexOf('opciones')],
                "searchable": false,
                "orderable": false,
                "width": "10px"
            }/*,
            {
                "targets": [
                    columnas.indexOf('id'),
                    columnas.indexOf('liga_id'),
                    columnas.indexOf('grupo_id'),
                    columnas.indexOf('equipo_id'),
                    columnas.indexOf('delegado_id')
                ],
                "searchable": false,
                "orderable": false,
                "visible": false
            }*/
        ]
    });
}

/**
 * Inicializar opciones del menú
 */
function ini_menu() {

    active = 'active';
    toggled = 'toggled';
    selecionar_lista = [
        {id: '#list_home', class: toggled},
        {id: '#list_participantes', class: active},
        {id: '#participantes_a', class: toggled},
        {id: '#delegados_li', class: active},
        {id: '#delegados_a', class: toggled}
    ];
    mostrar = [
        {id: '#participantes_m', onOff: true}
    ];

    marcar_opciones(selecionar_lista, mostrar);
}

/**
 * Inicializar formulario
 */
function inicializar_form() {
    $('#form_equipo').validate({
        submitHandler: function (form) {
            try {
                enviar_formulario();
            } catch (error) {
                console.log('Error enviando el formulario!', error);
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
        }
    });
    // Ini select
    $(".selectpiker").selectpicker();
}

/**
 * Evniar formulario
 */
function enviar_formulario() {
    // Enviar formulario.
    var colorName = 'bg-red';
    var placementFrom = 'bottom';
    var placementAlign = 'right';
    var animateEnter = 'animated fadeInRight';
    var animateExit = 'animated fadeOutRight';
    parametros = get_param($("#form_equipo").serializeArray());
    parametros['select_liga'] = $('#select_liga').selectpicker('val');
    var editar = '';
    var id = '/' + $("#equipo_id").val();
    var ruta = ruta_url;
    var metodo = 'POST';
    if ($("#crear_editar").val() == 1) {
        ruta += id;
        metodo = 'PUT';
    }
    $.ajax({
        url: ruta,
        method: metodo,
        data: parametros,
        dataType: "json",
        beforeSend: function (xhr) {
            $("#btn_guardar").button('loading');
            $("#btn_limpiar").button('loading');
        }
    }).done(function (res) {
        // Validar el estado de la notificaion.
        if (res.estado) {
            colorName = 'bg-teal';
            $("#form_equipo")[0].reset();
        } else {
            colorName = 'bg-red';
        }
        msg = res.msg[0];
        showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
    }).fail(function (res) {
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
        }
    }).complete(function (res) {
        $("#btn_guardar").button('reset');
        $("#btn_limpiar").button('reset');
    });
}

function ini_tab() {
    $('#tab_grupos').on('shown.bs.tab', function (e) {
        $('#tb_grupos').DataTable().draw('page');
    });

    $('#tab_crear').on('hidden.bs.tab', function (e) {
        $("#form_equipo")[0].reset();
        $('#select_liga').selectpicker('refresh');
    });
}

function ini_change_liga() {
    // Enviar formulario.
    var colorName = 'bg-red';
    var placementFrom = 'bottom';
    var placementAlign = 'right';
    var animateEnter = 'animated fadeInRight';
    var animateExit = 'animated fadeOutRight';
    $("#select_liga").change(function (e) {
        // Actualizar el select
        $.get(ruta_select_grupo + '/' + $(this).val(), function (data) {
            try {
                dibujar_select(data);
            }
            catch (err) {
                showNotification(colorName, 'Error mostrando grupos.', placementFrom, placementAlign, animateEnter, animateExit);
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
            }
        });
    });
}

function dibujar_select(data) {
    $("#select_grupo").empty();
    $.each(data, function (i, v) {
        $("#select_grupo").append('<option value="' + v.id + '">' + v.nombre + '</option>');
    });
    $('.selectpiker').selectpicker('refresh');
}

function ini_buscar_delegado() {
    $("#btn_buscar_dele").click(function () {
        //Buscar delegado
        if ($("#input_doc").val() != '') {
            form_cargando(true, '#grupo_panel', this);
            obtener_delegado($("#input_doc").val());
        }
    });
}

function obtener_delegado(documento) {
    $.get(ruta_get_delegado + '/' + documento, function (datos) {
        // Validar el estado de la notificaion.
        if (datos.id != undefined) {
            colorName = 'bg-teal';
            msg = 'Se encontró delegado';
            $("#input_idDelegado").val(datos.id);
            $("#input_doc").val(datos.numIdent);
            $("#nombre_delegado").val(datos.nombre);
        } else {
            colorName = 'bg-red';
            msg = 'No se encontró delegado';
            $("#input_idDelegado").val('');
            $("#input_doc").val('');
            $("#nombre_delegado").val('');
        }
        showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);

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
        }
    }).always(function () {
        form_cargando(false, '#grupo_panel');
    });

}

function form_cargando(bool, aplicar, elemento = '') {
    if (bool) {
        var effect = $(elemento).data('loadingEffect');
        var color = $.AdminBSB.options.colors[$(elemento).data('loadingColor')];
        $(aplicar).waitMe({
            effect: effect,
            text: 'Loading...',
            bg: 'rgba(255,255,255,0.90)',
            color: color
        });
    } else {
        $(aplicar).waitMe('hide');
    }
}