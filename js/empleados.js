function init(){
	cargar_data_year();
}

function cargar_data_year(){
  
  $('#year_comision').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 1;
  for (var i = 0; i < 15; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
    else
      $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
  }

})
}

function get_categoria_empleado(){
	let id_emp = $("#emp_comision").val();
  let id_empleado = id_emp.toString();
  if(id_empleado =="" || id_empleado==null){
    Swal.fire('Debe seleccionar un empleado!','','warning');
    return false;
  }
	$.ajax({
    url:"ajax/empleados.php?op=categoria_user",
    method:"POST",
    data:{id_empleado:id_empleado},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
      console.log(data);
    	if (data == 1){
         get_comision_cat_uno();
      }else if(data == 3){
         get_comision_cat_tres(id_empleado);
      }else if(data == 2){
         get_comision_cat_dos(id_empleado);
      }

    }

    });//////FIN AJAX	
}

function get_comision_cat_uno(){
  let sucursal = $("#sucursal").val();
  let year = $("#year_comision").val();
  let mes = $("#month_comision").val();
  if(mes == "0"){
    Swal.fire('Debe seleccionar un mes!','','warning');
    return false;
  }
    $.ajax({
    url:"ajax/empleados.php?op=get_comision_cat_uno",
    method:"POST",
    data:{sucursal:sucursal,year:year,mes:mes},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
      let total_ventas = data.total_ventas;
      let comision = data.comision;
      $("#ventas_uno").val("$"+total_ventas);
      $("#com_uno").val("$"+comision);

    }

    });//////FIN AJAX 

  data_comisiones_cat_uno(sucursal,year,mes);  
}
////////////////////////CATEGORIA DOS ///////////
function get_comision_cat_dos(id_empleado){

  let sucursal = $("#sucursal").val();
  let year = $("#year_comision").val();
  let mes = $("#month_comision").val();
  if(mes == "0"){
    Swal.fire('Debe seleccionar un mes!','','warning');
    return false;
  }
    $.ajax({
    url:"ajax/empleados.php?op=get_comision_cat_dos",
    method:"POST",
    data:{sucursal:sucursal,year:year,mes:mes,id_empleado:id_empleado},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
      let total_ventas = data.total_ventas;
      let comision = data.comision;
      $("#ventas_uno").val("$"+total_ventas);
      $("#com_uno").val("$"+comision);

    }

    });//////FIN AJAX 

  data_comisiones_cat_dos(sucursal,year,mes,id_empleado);  
}


function get_comision_cat_tres(id_empleado){

  let sucursal = $("#sucursal").val();
  let year = $("#year_comision").val();
  let mes = $("#month_comision").val();
  if(mes == "0"){
    Swal.fire('Debe seleccionar un mes!','','warning');
    return false;
  }
    $.ajax({
    url:"ajax/empleados.php?op=get_comision_cat_tres",
    method:"POST",
    data:{sucursal:sucursal,year:year,mes:mes,id_empleado:id_empleado},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
      console.log("E"+data)
      let total_ventas = data.total_ventas;
      let comision = data.comision;
      $("#ventas_uno").val("$"+total_ventas);
      $("#com_uno").val("$"+comision);

    }

    });//////FIN AJAX 

  data_comisiones_cat_tres(sucursal,year,mes,id_empleado);  
}

function data_comisiones_cat_uno(sucursal,year,mes){
  tabla_comisiones = $('#data_comisiones').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatablescom_uno
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [   

    'excelHtml5'
    ],

    "ajax":{
      url:"ajax/empleados.php?op=data_comisiones_cat_uno",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,year:year,mes:mes},         
      error: function(e){
        console.log(e.responseText);
      },           
    },
        drawCallback: function () {
        let total_ventas = $('#data_comisiones').DataTable().column(5).data().sum();
        $('#tot_ventas_mes').html('$'+total_ventas.toFixed(2));
      },

    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
        "iDisplayLength": 30,//Por cada 30 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

          "language": {

            "sProcessing":     "Procesando...",

            "sLengthMenu":     "Mostrar _MENU_ registros",

            "sZeroRecords":    "No se encontraron resultados",

            "sEmptyTable":     "Ningún dato disponible en esta tabla",

            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",

            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",

            "sInfoPostFix":    "",

            "sSearch":         "Buscar:",

            "sUrl":            "",

            "sInfoThousands":  ",",

            "sLoadingRecords": "Cargando...",

            "oPaginate": {

              "sFirst":    "Primero",

              "sLast":     "Último",

              "sNext":     "Siguiente",

              "sPrevious": "Anterior"

            },

            "oAria": {

              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",

              "sSortDescending": ": Activar para ordenar la columna de manera descendente"

            }

         }, //cerrando language

          //"scrollX": true

        });
}
////////////////////////////   DATA COMISIONES CAT 2  ////////////////
function data_comisiones_cat_dos(sucursal,year,mes,id_empleado){
  tabla_comisiones = $('#data_comisiones').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [   

    'excelHtml5'
    ],

    "ajax":{
      url:"ajax/empleados.php?op=data_comisiones_cat_dos",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,year:year,mes:mes,id_empleado:id_empleado},         
      error: function(e){
        console.log(e.responseText);
      },           
    },
        drawCallback: function () {
        let total_ventas = $('#data_comisiones').DataTable().column(5).data().sum();
        $('#tot_ventas_mes').html('$'+total_ventas.toFixed(2));
      },

    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
        "iDisplayLength": 30,//Por cada 30 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

          "language": {

            "sProcessing":     "Procesando...",

            "sLengthMenu":     "Mostrar _MENU_ registros",

            "sZeroRecords":    "No se encontraron resultados",

            "sEmptyTable":     "Ningún dato disponible en esta tabla",

            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",

            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",

            "sInfoPostFix":    "",

            "sSearch":         "Buscar:",

            "sUrl":            "",

            "sInfoThousands":  ",",

            "sLoadingRecords": "Cargando...",

            "oPaginate": {

              "sFirst":    "Primero",

              "sLast":     "Último",

              "sNext":     "Siguiente",

              "sPrevious": "Anterior"

            },

            "oAria": {

              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",

              "sSortDescending": ": Activar para ordenar la columna de manera descendente"

            }

         }, //cerrando language

          //"scrollX": true

        });
}

//////////////////   CAT 3
function data_comisiones_cat_tres(sucursal,year,mes,id_empleado){
  tabla_comisiones = $('#data_comisiones').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [   

    'excelHtml5'
    ],

    "ajax":{
      url:"ajax/empleados.php?op=data_comisiones_cat_tres",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,year:year,mes:mes,id_empleado:id_empleado},         
      error: function(e){
        console.log(e.responseText);
      },           
    },
        drawCallback: function () {
        let total_ventas = $('#data_comisiones').DataTable().column(5).data().sum();
        $('#tot_ventas_mes').html('$'+total_ventas.toFixed(2));
      },

    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
        "iDisplayLength": 30,//Por cada 30 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

          "language": {

            "sProcessing":     "Procesando...",

            "sLengthMenu":     "Mostrar _MENU_ registros",

            "sZeroRecords":    "No se encontraron resultados",

            "sEmptyTable":     "Ningún dato disponible en esta tabla",

            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",

            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",

            "sInfoPostFix":    "",

            "sSearch":         "Buscar:",

            "sUrl":            "",

            "sInfoThousands":  ",",

            "sLoadingRecords": "Cargando...",

            "oPaginate": {

              "sFirst":    "Primero",

              "sLast":     "Último",

              "sNext":     "Siguiente",

              "sPrevious": "Anterior"

            },

            "oAria": {

              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",

              "sSortDescending": ": Activar para ordenar la columna de manera descendente"

            }

         }, //cerrando language

          //"scrollX": true

        });
}

init();