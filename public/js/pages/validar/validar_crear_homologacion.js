$(document).ready(function(){
  // Inicializar el boton de descargar
  $("#btn_desc_pdf").click(function(){
    // Abrir en otra pestaña.
    window.open(ruta_descargar_pdf + '/' + $("#select_adenda").selectpicker('val') + '/0/1', '_blank');
  });
  // Inicializar el boton de ver
  $("#btn_ver_pdf").click(function(){
    // Abrir en otra pestaña.
    window.open(ruta_descargar_pdf + '/' + $("#select_adenda").selectpicker('val')+ '/0', '_blank');
  });

  // Inicializar el boton de ver
  $("#btn_ver_firma").click(function(){
    // Abri documento firmado.
    window.open(ruta_descargar_pdf + '/' + $("#select_adenda").selectpicker('val') + '/1', '_blank');
  });

  // Cargar documento firmado.
  $("#btn_desc_firma").click(function(){
    // Abri documento firmado.
    window.open(ruta_descargar_pdf + '/' + $("#select_adenda").selectpicker('val') + '/1/1', '_blank');
  });

  inicializar_file();
  // Btn cargar firma.
  $("#btn_cargar_firma").click(function(){
    // Abrir el documento firmado.
    modal_cargando_firma(false);
    $("#md_cargar_firma").modal('show');
    limpiar_md_firma();
  });

  // Inicializar el input firma.
  $("[name=archivo]").change(function(){
    // Cada vez que cambier de archivo
    if($(this).val() != ''){
      modal_cargando_firma(false);
      enviar_firma();
    }
  });

  // Inicializar el boton de homologar.
  $("#btn_homologar").click(function(){
    datos = {
      '_token': $('meta[name="csrf-token"]').attr('content'),
      'adenda': $("#select_adenda").selectpicker('val')
    };
    // Consultar datos.
    $.post(ruta_homologar, datos, function(res) {
      // Validar el estado de la notificaion.
      if(res.estado){
        colorName='bg-teal';
      }else{
        colorName='bg-red';
      }
      // Inicializar variables para las notificaciones.
      placementFrom='bottom';
      placementAlign='left';
      animateEnter='animated fadeInLeft';
      animateExit='animated fadeOutLeft';
      msg = res.msg[0];
      showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
    }, "json").fail(function(res) {
      colorName='bg-red';
      placementFrom='bottom';
      placementAlign='left';
      animateEnter='animated fadeInLeft';
      animateExit='animated fadeOutLeft';
      msg = 'Error al homologar la adenda.';
      showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
    });
  });
  // Inicializar notificaciones.
  $('.jsdemo-notification-button button').on('click', function () {
      var placementFrom = $(this).data('placement-from');
      var placementAlign = $(this).data('placement-align');
      var animateEnter = $(this).data('animate-enter');
      var animateExit = $(this).data('animate-exit');
      var colorName = $(this).data('color-name');
      showNotification(colorName, null, placementFrom, placementAlign, animateEnter, animateExit);
  });
  // Crear select.
  if(adendas.length == 0 ){
    adendas = [
      {'id': cod_adenda, nombre:'No existe adendas', codigo:'No existe adendas'}
    ];
  }
  crear_adendas(adendas);
  // Inicializar el boton para crear la adenda.
  $("#btn_crear_adenda").click(function(){
    modal_cargando(false);
    $("#md_adendas").modal('show');
    limpiar_md_adenda();
  });
  // Inicializar la venta de adendas
  $("#md_adendas").on('shown.bs.modal',function(){
    inicializar_form();
  }).on('hidden.bs.modal',function(){
    $('#form_adenda').validate().destroy();
  });
  // Inicializar tabla
  var tb_solicitudes = $('#tb_notas').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [[ 5, "desc" ]],
    "ajax": {
        "url": ruta_asignatura,
        "data": function ( d ) {
            d.programa = cod_programa;
            d.adenda = $("#select_adenda").selectpicker('val');
        }
      },
      dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      language:{
        url: base_url + 'js/Spanish.json'
      },
      "columnDefs": [
        {
            "targets": -1,
            "render": function ( data, type, row, meta ) {
              return '<input class="form-control input-sm input_nota" style="width:60px" type="number" step="any" min="0" max="5" value="' + data + '" >';
            }
        },
        {
          "targets": [0],
          "visible": false,
          "searchable": false
        }
      ]
  }).on('init.dt',function(){
    $('#tb_notas').width('98%');
  });
  // Inicializar el input para actualizar las notas.
  $('#tb_notas tbody').on( 'change', '.input_nota', function () {
    if($(this).val() != ''){
      // Enviar nota. adenda_id, asig_progra_id, nota
      actualizar_nota(this);
    }
  });

});

/**
* Mostrar notificaciones.
*/
function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = ''; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}

/**
* Permite actualizar la nota.
*/
function actualizar_nota(input){
  // Obtener datos de la columna
  fila = $(input).parent().parent();
  datos = $('#tb_notas').DataTable().row(fila).data();
  // Enviar formulario.
  datos = {
    '_token': $('meta[name="csrf-token"]').attr('content'),
    'adenda': $("#select_adenda").selectpicker('val'),
    'asig_progra_id':datos[0],
    'nota': $(input).val()
  };
  // Consultar datos.
  $.post(ruta_notas, datos, function(res) {
    // Validar el estado de la notificaion.
    if(res.estado){
      colorName='bg-teal';
    }else{
      colorName='bg-red';
    }
    // Inicializar variables para las notificaciones.
    placementFrom='bottom';
    placementAlign='left';
    animateEnter='animated fadeInLeft';
    animateExit='animated fadeOutLeft';
    msg = res.msg[0];
    showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
  }, "json").fail(function(res) {
    respuesta = JSON.parse(res.responseText);
    colorName='bg-red';
    placementFrom='bottom';
    placementAlign='left';
    animateEnter='animated fadeInLeft';
    animateExit='animated fadeOutLeft';
    msg = respuesta.nota[0];
    showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
  });

}

/**
* Crear la alerta con el mensaje.
*/
function alerta(){

}
// Permite crear select
function crear_select(option, id){
  var select = '<select class="form-control" id="'+ id +'">';
  var selected = '';
  $.each(option,function(i,v){
    if(v.id == 3){
      selected = 'selected';
    }
    select += '<option data-subtext="'+ v.nombre +'" value="'+ v.id +'" ' + selected + '>'+ v.codigo +'</option>';
  });
  select += '</select>';
  return select;
}

// Buscar por medio de la tabla
function buscar_datos(){
  // Validar que los datos no estén vacíos.
  if($("#select_adenda").selectpicker('val') != ''){
    // Enviar
    $('#tb_notas').DataTable().draw('page');
  }
}


/**
* Inicializar validación del formulario.
*/
function inicializar_form(){
  $('#form_adenda').validate({
        submitHandler: function(form) {
          enviar_formulario();
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
}
/**
* Envía el formulario al servidor.
*/
function enviar_formulario(){
  // Enviar formulario.
  var formData = new FormData($("#form_adenda")[0]);
  $.ajax({
    url: $("#form_adenda").attr('action'),
    type: "post",
    dataType: "json",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function( xhr ) {
      // Inactivar formulario
      form_activo(false);
      // Ventana modal cargando.
      modal_cargando(true);
    }
  }).done(function(res){
    // Llenar mensajes
    dibujar_msg(res,'msg_modal');
    // Mostra datos
    modal_cargando(false);
    // Activar formulario.
    form_activo(true);
    // Actualizar adendas.
    crear_adendas(res.adendas);
    buscar_datos();
  }).fail(function(e) {
    // Llenar mensajes
    res = {
      estado : false,
      msg : ['Error al guardar los datos.'],
    };
    dibujar_msg(res,'msg_modal');
    // Mostra datos
    modal_cargando(false);
    // Activar formulario.
    form_activo(true);
  });

}
/**
* Enviar firma al servidor
*/
function enviar_firma(){
  // Enviar formulario.
  var formData = new FormData($("#form_firma")[0]);
  formData.append('adenda', $("#select_adenda").selectpicker('val'));
  $.ajax({
    url: $("#form_firma").attr('action'),
    type: "post",
    dataType: "json",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function( xhr ) {
      // Ventana modal cargando.
      modal_cargando_firma(true);
    }
  }).done(function(res){
    // Llenar mensajes
    dibujar_msg_alert(res);
    if(res.estado){
      // Ocultar ventana modal y resetear form
      $("#md_cargar_firma").modal('hide');
      limpiar_md_firma();
    }else{
      modal_cargando_firma(false);
    }
  }).fail(function(e) {
    // Llenar mensajes
    res = {
      estado : false,
      msg : ['Error al guardar los datos.'],
    };
    dibujar_msg_alert(res);
    // Mostra datos
    modal_cargando_firma(false);
  });

}

/**
* Dibujar ventana modal alert.
*/
function dibujar_msg_alert(res){
  // Validar el estado de la notificaion.
  if(res.estado){
    colorName='bg-teal';
  }else{
    colorName='bg-red';
  }
  // Inicializar variables para las notificaciones.
  placementFrom='bottom';
  placementAlign='left';
  animateEnter='animated fadeInLeft';
  animateExit='animated fadeOutLeft';
  msg = res.msg[0];
  showNotification(colorName, msg, placementFrom, placementAlign, animateEnter, animateExit);
}
/**
* Crear adendas
*/
function crear_adendas(adendas){
  // Crear el select para la adenda.
  select = crear_select(adendas,'select_adenda');
  $("#div_adenda").html(select);
  $("#select_adenda").selectpicker().on('changed.bs.select', function (e) {
    buscar_datos();
  });
  $('#select_adenda ').selectpicker('val', $('#select_adenda option:last-child').val());
  $("#select_adenda").change();
  $('#select_adenda').selectpicker('render');
}

/**
* Activa e inactiva el formulario
*/
function form_activo(bool){
  if(bool){
    // Activar
    $("#form_adenda .onOff").attr('readonly',false);
  }else{
    // Desactivar
    $("#form_adenda .onOff").attr('readonly',true);
  }
}

/**
* Estados de la ventana modal
*/
function modal_cargando(bool){
  if(bool){
    // Cargando
    $("#cargando_modal").show();
    $("#body_form").hide();
    $("#msg_modal").html('');
    $("#md_adendas .modal-footer").hide();
  }else{
    // Mostrar mensaje
    $("#cargando_modal").hide();
    $("#body_form").show();
    $("#md_adendas .modal-footer").show();
  }
}

/**
* Estados de la ventana modal firma
*/
function modal_cargando_firma(bool){
  if(bool){
    // Cargando
    $("#cargando_modal_firma").show();
    $("#body_form_firma").hide();
    $("#msg_modal_firma").html('');
    $("#md_cargar_firma .modal-footer").hide();
  }else{
    // Mostrar mensaje
    $("#cargando_modal_firma").hide();
    $("#body_form_firma").show();
    $("#md_cargar_firma .modal-footer").show();
  }
}
/**
* Dibujas los mensaje de la ventana modal.
*/
function dibujar_msg(datos, id){
  estilo = 'danger';
  nombre = 'error';
  msg = '<ul>';
  alerta = '';
  if(datos.estado){
    estilo='success';
    nombre = 'Correcto';
    // Limpiar formulario
    limpiar_md_adenda();
  }
  // Crer mensajes
  $.each(datos.msg,function(i,v){
    msg += '<li>' + v + '</li>';
  });
  msg += '</ul>';
  alerta += '<div class="alert alert-'+ estilo +' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+ nombre +'!</strong>'+ msg +'</div>';
  $("#"+id).html(alerta);
}

/**
* Limpiar ventana modal de la adenda.
*/
function limpiar_md_adenda(){
  $('#md_adendas [name=nombre]').val('');
  $('#md_adendas [name=descripcion]').val('');
}

/**
* Limpiar ventana modal de la firma.
*/
function limpiar_md_firma(){
  $("#form_firma")[0].reset();
}
