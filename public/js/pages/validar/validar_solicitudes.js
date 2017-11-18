$.extend( $.fn.dataTable.defaults, {
    responsive: false
});
$(function () {
    var tb_solicitudes = $('#tb_solicitudes').DataTable({
        "processing": true,
        "serverSide": true,
        "createdRow": function (row, data, index) {
          $('td', row).eq(5).html('<a href="' + ruta_homologar + '/' + data[0] + '" target="_blank" class="btn btn-success btn-circle waves-effect waves-circle waves-float btn_editar"><i class="material-icons">edit</i></a>');
        },
        "ajax": {
            "url":ruta_tabla,
            "type": "GET"
        },
        "order": [[ 5, "desc" ]],
        searchDelay: 1000,
        dom: 'lfrtip',
        language:{
          url: base_url + 'js/Spanish.json'
        },
        columnDefs: [
            { responsivePriority: 1,targets: 0},
            { responsivePriority: 2, targets: -1 },
            {
              "targets": [0],
              "visible": false,
              "searchable": false
            },
            {
              "targets": [-1],
              "searchable": false,
              "width": "10px"
            }
        ],
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');

                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            }
        },
    });

    // inicializar el boton de editar
    $('#tb_solicitudes tbody').on('click', '.btn_editar', function () {
       console.log('Hola mundo!');
   });
});
