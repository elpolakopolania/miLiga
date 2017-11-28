$(document).ready(function(){
    $(".selectpiker").selectpicker();
    $('#fechaNac').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
    inicializar_form();
});

function inicializar_form(){
    $('#frm_perfil').validate({
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

  function enviar_formulario(){
    // Enviar formulario.
    var formData = new FormData($("#frm_perfil")[0]);
    $.ajax({
      url: $("#frm_perfil").attr('action'),
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function( xhr ) {
        console.log('Antes de enviar');
        // Inactivar formulario
        /*form_activo(false);
        // Mostrar ventana modal.
        $("#modal_msg").modal('show');
        modal_cargando(true);*/
      }
    }).done(function(res){
        console.log('Respuesta');
      // Llenar mensajes
      /*dibujar_msg(res,'msg_modal');
      // Mostra datos
      modal_cargando(false);
      // Activar formulario.
      form_activo(true);*/
    }).fail(function() {
        console.log('Error.');
      // Llenar mensajes
      /*res = {
        estado : false,
        msg : ['Error al guardar los datos.'],
      };
      dibujar_msg(res,'msg_modal');
      // Mostra datos
      modal_cargando(false);
      // Activar formulario.
      form_activo(true);*/
    });
  
  }

/*$(document).ready(function(){
    var div_delete = '<a type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete_item"><i class="material-icons">delete</i></a>';
    var ultimo = 1;
    // inicializar file
    inicializar_file();
    // Inicializar select.
    $(".selectpiker").selectpicker();
    // Inicializar boton de agregar.
    $(".add_item").click(function(){
      // Resetear validación.
      $('#form_solicitud').validate().destroy();
      // Destruir selectpiker
      $('select').selectpicker('destroy');
      // Crear fila
      crear_fila(div_delete, ultimo);
      ultimo++;
      // Inicializar selectpiker
      $(".selectpiker").selectpicker();
      inicializar_form();
      // Reseterar botones
      resetear_botones();
    });
    // Inicializar validación del formulario.
    inicializar_form();
  
  });

  function inicializar_form(){
    $('#form_solicitud').validate({
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
  
  
  function enviar_formulario(){
    // Enviar formulario.
    var formData = new FormData($("#form_solicitud")[0]);
    $.ajax({
      url: $("#form_solicitud").attr('action'),
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function( xhr ) {
        // Inactivar formulario
        form_activo(false);
        // Mostrar ventana modal.
        $("#modal_msg").modal('show');
        modal_cargando(true);
      }
    }).done(function(res){
      // Llenar mensajes
      dibujar_msg(res,'msg_modal');
      // Mostra datos
      modal_cargando(false);
      // Activar formulario.
      form_activo(true);
    }).fail(function() {
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
  

  function form_activo(bool){
    if(bool){
      // Activar
      $("#form_solicitud .onOff").attr('readonly',false);
      $('#form_solicitud .selectpiker').prop('disabled',false);
      $('#form_solicitud .selectpiker').selectpicker('refresh');
    }else{
      // Desactivar
      $("#form_solicitud .onOff").attr('readonly',true);
      $('#form_solicitud .selectpiker').prop('disabled',true);
      $('#form_solicitud .selectpiker').selectpicker('refresh');
    }
  }

  function dibujar_msg(datos, id){
    estilo = 'danger';
    nombre = 'error';
    msg = '<ul>';
    alerta = '';
    if(datos.estado){
      estilo='success';
      nombre = 'Correcto';
      // Inicializar ventana modal para redirect a listado de solicitudes.
      $('#modal_msg').on('hidden.bs.modal', function (e) {
        window.location.replace(ruta_list_hom);
      });
    }
    // Crer mensajes
    $.each(datos.msg,function(i,v){
      msg += '<li>' + v + '</li>';
    });
    msg += '</ul>';
    alerta += '<div class="alert alert-'+ estilo +'"><strong>'+ nombre +'!</strong>'+ msg +'</div>';
    $("#"+id).html(alerta);
  }

  function modal_cargando(bool){
    if(bool){
      // Cargando
      $("#cargando_modal").show();
      $("#msg_modal").hide();
      $("#msg_modal").html('');
      $("#modal_msg .modal-footer").hide();
  
  
    }else{
      // Mostrar mensaje
      $("#cargando_modal").hide();
      $("#msg_modal").show();
      $("#modal_msg .modal-footer").show();
    }
  }
  
  function resetear_botones(){
    // Quitar evento a los input file
    $(':file').unbind('fileselect');
    // Quitar evento a los botones.
    $(".delete_item").unbind('click');
    // Inicializar boton de eliminar item
    $(".delete_item").click(function(){
      // Resetear validación.
      $('#form_solicitud').validate().destroy();
      $(this).parent().parent().remove();
      inicializar_form();
    });
    // Inicializar file
    inicializar_file();
  }
  
  function crear_fila(div_delete, ultimo){
    // Obtener campos
    lista = $($(".item_estudios")[0]).clone();
    $("#form_footer").before(lista);
    // Limpiar los campos.
    limpiar = $(".item_estudios")[$(".item_estudios").length - 1];
    $(limpiar).find('.div_delete').html(div_delete);
    $(limpiar).find('input, select').each(function(i,v){
      nombre = $(v).attr('name');
      if(nombre != undefined){
        $(v).attr('name',nombre.replace('1', ultimo + 1));
      }
      $(v).val('').change();
    });
  }*/
  