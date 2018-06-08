(function ($) {
    // Declaración del plugin.
    $.fn.jornada = function (options) {
        // Inicializar cada elemento.
        this.colores = [
            'bg-cyan',
            'bg-red',
            'bg-pink',
            'bg-light-green',
            'bg-purple',
            'bg-indigo',
            'bg-blue',
            'bg-deep-orange',
            'bg-green',
            'bg-lime',
            'bg-blue-grey',
            'bg-deep-purple',
            'bg-yellow',
            'bg-amber',
            'bg-orange',
            'bg-brown',
            'bg-grey',
            'bg-light-blue',
            'bg-black',
            'bg-teal'
        ];
        var this_ = (this);
        this.urlGet = '';
        this.contenido = '';
        this.template = {};
        this.template.fechas = ``;
        this.template.partido = {
            local: `
                <div class="col-xs-12">
                    <div class="info-box-sm hover-zoom-effect div_local" data-valor="{{id}}">
                        <div class="icon {{color}}">
                            <i class="material-icons">security</i>
                        </div>
                        <div class="content">
                            <div class="text">{{nombre}} <small>({{grupo}})</small></div>
                            <div class="number">{{goles}}</div>
                        </div>
                    </div>
                </div>
            `,
            visitante: `
                <div class="col-xs-12">
                    <div class="info-box-sm hover-zoom-effect div_visitante" data-valor="{{id}}">
                        <div class="icon {{color}}">
                            <i class="material-icons">security</i>
                        </div>
                        <div class="content">
                            <div class="text">{{nombre}} <small>({{grupo}})</small></div>
                            <div class="number">{{goles}}</div>
                        </div>
                    </div>
                </div>
            `,
            info: `
                <div class="col-xs-12 divFecha" data-valor="{{id}}">
                    <p class="font-bold col-grey font-16">{{fecha}}</p>
                    <ul class="icon-grupo">
                        <li>
                            <a href="javascript:void(0);"><i
                                        class="material-icons col-grey font-18">mode_edit</i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="material-icons col-grey font-18">delete</i></a>
                        </li>
                    </ul>
                </div>
            `,
        };

        this.template.card = {
            header: `
                <div class="header divJornada" data-valor="{{id}}">
                    <h2>
                        {{nombre}}
                    </h2>
                    <ul class="header-dropdown">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons">add</i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons">delete</i>
                            </a>
                        </li>
                    </ul>
                </div>
            `,
            body: `
                <div class="body">
                    <div class="row">
                        {{fechas}}
                    </div>
                </div>
            `,
            fecha: `
                <div class="col-xs-12 col-sm-6 col-md-3">
                    {{local}}
                    {{visitante}}
                    {{info}}
                </div>
            `
        };
        this.template.content = `
            <div class="card">{{header}}{{body}}</div>
         `;
        this.equipo = {
            id: '1',
            color: '',
            nombre: 'Equipo ',
            grupo: 'Grupo ',
            goles: 1
        };
        this.fecha = {
            id: '1',
            fecha: '2019-01-01',
            local: this.equipo,
            visitante: this.equipo
        };
        this.fechas = [
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha,
            this.fecha
        ];
        this.jornada = {
            id: '1',
            nombre: 'Jornada ',
            fechas: this.fechas
        }
        this.jornadas = [
            this.jornada,
            this.jornada,
            this.jornada
        ];

        // Obtener color aleatorio.
        this.randonColor = function(){
            var randon = Math.floor(Math.random()*10);
            return this.colores[randon];
        }
        // Dibuja la plantilla
        this.dibujarContenido = function (jornada){
            var header=this_.template.card.header,
                body=this_.template.card.body,
                content=this_.template.content,
                fechas='';
            // Crear jornada.
            header = header.replace('{{nombre}}',jornada.nombre + Math.floor((Math.random() * 10) + 1));
            header = header.replace('{{id}}',Math.floor((Math.random() * 10) + 1));
            // Crear fechas
            $.each(jornada.fechas,function(i,fecha_){
                var fecha=this_.template.card.fecha,
                    local=this_.template.partido.local,
                    visitante=this_.template.partido.visitante,
                    info=this_.template.partido.info;
                // Local
                local = local.replace('{{id}}', fecha_.local.id + Math.floor((Math.random() * 10) + 1));
                local = local.replace('{{color}}', this_.randonColor());
                local = local.replace('{{nombre}}', fecha_.local.nombre + Math.floor((Math.random() * 10) + 1));
                local = local.replace('{{grupo}}', fecha_.local.grupo + Math.floor((Math.random() * 10) + 1));
                local = local.replace('{{goles}}', fecha_.local.goles + Math.floor((Math.random() * 10)));
                // Visitante
                visitante = visitante.replace('{{id}}', fecha_.visitante.id + Math.floor((Math.random() * 10) + 1));
                visitante = visitante.replace('{{color}}', this_.randonColor());
                visitante = visitante.replace('{{nombre}}', fecha_.visitante.nombre + Math.floor((Math.random() * 10) + 1));
                visitante = visitante.replace('{{grupo}}', fecha_.visitante.grupo + Math.floor((Math.random() * 10) + 1));
                visitante = visitante.replace('{{goles}}', fecha_.visitante.goles + + Math.floor((Math.random() * 10)));
                //Fecha
                info = info.replace('{{id}}', fecha_.id + Math.floor((Math.random() * 10) + 1));
                info = info.replace('{{fecha}}', fecha_.fecha);
                // Partido
                fecha = fecha.replace('{{local}}', local);
                fecha = fecha.replace('{{visitante}}', visitante);
                fecha = fecha.replace('{{info}}', info);
                // Insertar fechas
                fechas += fecha;
            });

            //console.log(this_.template.card.header);
            body = body.replace('{{fechas}}',fechas);
            content = content.replace('{{body}}',body);
            content = content.replace('{{header}}',header);
            this_.contenido += content;
        };

        // Inicializar elementos.
        this.init = function (){
            // Otener datos
            // Dibujar datos en la plantilla.
            this.jornadas.forEach(this.dibujarContenido);
        };

        this.init();
        // Obtener opciones para el plugin.
        options = $.extend({}, $.fn.jornada.defaultOptions, options);
        this.each(function () {
            var element = $(this);
            element.html(this_.contenido);
        });
        return this;

        this.getContenido = function(){
            return this_.contenido;
        }

        this.destruir = function (){
            this.each(function () {
                var element = $(this);
                element.html('');
            });
        }

    }

    // Parametros del plugin.
    $.fn.jornada.defaultOptions = {
        element_class: 'texto-azul'
    }
})(jQuery);