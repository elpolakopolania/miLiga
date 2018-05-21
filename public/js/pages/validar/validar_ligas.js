var tb_ligas;
var columnas = [
    'id',
    'nombre',
    'descripcion',
    'fecha_ini',
    'fecha_fin',
    'telefono',
    'direccion',
    'categoria',
    'inscripcion',
    'amarilla',
    'roja',
    'reglas',
    'creada',
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
    // Inicializa los DATEPIKER.
    ini_fechas();
    // inicializar tabla.
    ini_tb();
    // Inicializar tab
    ini_tab();
});

/**
 * Inicializar el boton editar liga
 */
function ini_btn_editar(){
    $('#tb_ligas tbody').on('click', '.btn_editar', function () {
        var data = $('#tb_ligas').DataTable().row($(this).parents('tr')).data();
        // Llenar campos.
        $("#crear_editar").val(1);
        $("#input_id").val(data[columnas.indexOf('id')]);
        $("#input_nombre").val(data[columnas.indexOf('nombre')]);
        $("#input_descripcion").val(data[columnas.indexOf('descripcion')]);
        $("#input_fecha_ini").val(data[columnas.indexOf('fecha_ini')]);
        $("#input_fecha_fin").val(data[columnas.indexOf('fecha_fin')]);
        $("#input_telefono").val(data[columnas.indexOf('telefono')]);
        $("#input_direccion").val(data[columnas.indexOf('direccion')]);
        $("#input_categoria").val(data[columnas.indexOf('categoria')]);
        $("#input_incripcion").val(data[columnas.indexOf('inscripcion')]);
        $("#input_amarilla").val(data[columnas.indexOf('amarilla')]);
        $("#input_roja").val(data[columnas.indexOf('roja')]);
        $("#input_reglas").val(data[columnas.indexOf('reglas')]);

        // Mostrar tab
        $('#myTabs a[href="#liga_panel"]').tab('show');   
	});
}

/**
 * Inicializar fechas
 */
function ini_fechas(){
    // Inicializar fechas
    $('#input_fecha_fin').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false,
        lang : 'es',
        cancelText:cancelar,
        okText: ok,
        clearText: limpiar
    }).on('change', function(e, date){
        $('#input_fecha_ini').bootstrapMaterialDatePicker('setMaxDate', date);

    });

    $('#input_fecha_ini').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false,
        lang : 'es',
        cancelText:cancelar,
        okText: ok,
        clearText: limpiar
    }).on('change', function(e, date){
        $('#input_fecha_fin').bootstrapMaterialDatePicker('setMinDate', date);
    });
}

/**
 * Inicializar tabla liga
 */
function ini_tb(){
    tb_ligas = $('#tb_ligas').DataTable({
        "processing": true,
        "serverSide": true,
        "createdRow": function (row, data, index) {
            $('td', row).eq(-1).html(`
            <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float btn_editar">
                <i class="material-icons">edit</i>
            </button>
            `);
        },
        "ajax": {
            "url":ruta_tabla,
            "type": "GET"
        },
        "order": [[ columnas.indexOf('creada'), "desc" ]],
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
                "targets": [columnas.indexOf('fecha_ini'),columnas.indexOf('fecha_fin'),columnas.indexOf('creada')],
                "width": "80px"
            },
            {
                "targets": [columnas.indexOf('categoria'),columnas.indexOf('nombre')],
                "width": "80px"
            },
            {
                "targets": [
                    columnas.indexOf('id'),
                    columnas.indexOf('descripcion'),
                    columnas.indexOf('telefono'),
                    columnas.indexOf('direccion'),
                    columnas.indexOf('categoria'),
                    columnas.indexOf('inscripcion'),
                    columnas.indexOf('amarilla'),
                    columnas.indexOf('roja'),
                    columnas.indexOf('reglas'),
                    columnas.indexOf('roja')
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
        {id: '#list_ligas', class: active}
    ];
    mostrar = [];
    marcar_opciones(selecionar_lista, mostrar);
}

/**
 * Inicializar formulario
 */
function inicializar_form(){
    $('#form_liga').validate({
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
    parametros = get_param($("#form_liga").serializeArray());
    var editar = '';
    var id = '/' + $("#input_id").val();
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
            $("#form_liga")[0].reset();
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
        obtener_ligas();
    });
}

function ini_tab(){
    $('#tab_ligas').on('shown.bs.tab', function (e) {
        $('#tb_ligas').DataTable().draw('page');
    });

    $('#tab_crear').on('hidden.bs.tab', function (e) {
        $("#form_liga")[0].reset();
    });
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