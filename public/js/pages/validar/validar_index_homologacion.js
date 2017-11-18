$(document).ready(function(){
  // Inicializar tabla
  var tb_adendas = $('#tb_adendas').DataTable({
      dom: "<'row'<'col-sm-6'l><'col-sm-2 toolbar'><'col-sm-1'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      language:{
        url: base_url + 'js/Spanish.json'
      },
      "columnDefs": [
        {
          'targets': [0],
          'visible':false,
          'searchable':false
        },
        { responsivePriority: 1,targets: [2,-1]}
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
              },
              type: 'column',
              target: 'tr'
          }
      }
  });
});
