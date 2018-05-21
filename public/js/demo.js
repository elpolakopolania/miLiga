$(function () {
    obtener_ligas();
    skinChanger();
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll(true);
    setSettingListHeightAndScroll(true);
    $(window).resize(function () {
        setSkinListHeightAndScroll(false);
        setSettingListHeightAndScroll(false);
    });
});

//Skin changer
function skinChanger() {
    $('.right-sidebar .demo-choose-skin').on('click', 'li', function () {
        var $body = $('body');
        var $this = $(this);
        if($(".link_liga.active").length == 1 && $this.hasClass( "active" )){
            console.log('No se puede desativar');
        }else{
            $this.toggleClass('active');
            if($this.hasClass("todos")){
                if($this.hasClass( "active" )){
                    $(".link_liga").addClass('active');
                }else{
                    $(".link_liga").removeClass('active');
                    $($(".link_liga")[0]).addClass('active');
                }
            }
        }
    });
    $('.right-sidebar .demo-choose-skin').on('click', 'li.actualizar', function () {
        update_liga();
    });
}

function update_liga(){
    // Ontener ids
    var ids = [];
    $.each($(".link_liga.active"),function(i,v){
        ids.push($(v).data('valor'));
    });
    window.location.replace(ruta_url_ + '/mis_ligas?' + $.param({ids:ids}));
}

function obtener_ligas(){   
    $.get(ruta_url_ + '/mis_ligas',function(e) {
        dibujar_ligas(e);
    }).fail(function() {
        alert('Error listando ligas!');
    });
}

function dibujar_ligas(ligas){
    colores = [
        'red','PINK','PURPLE','deep-purple','INDIGO','BLUE','light-blue', 
        'CYAN','TEAL','GREEN','light-green','LIME','YELLOW','AMBER',
        'ORANGE','deep-orange'
    ];
    $(".demo-choose-skin").html('');
    $(".demo-choose-skin").append(`
        <li class="todos">
            <div class="white"></div>
            <span>Todos</span>
        </li>
        <li role="separator" class="divider"></li>
        <li class="actualizar">
            <div class="white"></div>
            <span>Actualizar</span>
        </li>
        <li role="separator" class="divider"></li>
    `);
    $.each(ligas,function(i,v){
        $(".demo-choose-skin").append(`
            <li class="link_liga ` + v.estado + `" data-valor="` + v.id + `">
                <div class="` + colores[i%colores.length].toLowerCase() + `"></div>
                <span>` + v.nombre + `</span>
            </li>
        `);
    });
}

//Skin tab content set height and show scroll
function setSkinListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    if (!isFirstTime){
      $el.slimScroll({ destroy: true }).height('auto');
      $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Google Analiytics ======================================================================================
addLoadEvent(loadTracking);
var trackingId = 'UA-30038099-6';

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            oldonload();
            func();
        }
    }
}

function loadTracking() {
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', trackingId, 'auto');
    ga('send', 'pageview');
}
//========================================================================================================

/**
 * Marcar opciones del menú.
 * @param {*} opciones 
 */
function marcar_opciones(opciones, mostrar){

    // Mostrar UL
    $.each(mostrar,function(i,v){
        if(v.onOff){
            $(v.id).show();
        }else{
            $(v.id).hide();
        }
    });

    // Seleccionar opocion del menú.
    $.each(opciones,function(i,v){
        $(v.id).toggleClass(v.class);
    });

}


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
 * 
 * Obtener parámetros del formulario.
 */
function get_param(formdata){
    parametros = {};

    $.each(formdata,function(i,v){
        parametros[v.name] = v.value;
    });

    return parametros;
}

