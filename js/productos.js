var tabla_aros;
var tabla_aros_creados;
var tabla_acc_compras;
var tabla_accesorios_creados;
var tabla_lentes_tratamientos;
var tabla_traslados;

function init(){
  //listar_aros();
  listar_aros_creados();
  //listar_acc_compras();
  listar_accesorios_creados();
  listar_lentes_tratamientos();
  listar_servicios_venta();
  //listar_prod_traslados();
}
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 5000
    });

//////////////////////LISTADO DE AROS CREAODOS///////////////

/////////LISTAR AROS
function listar_aros_creados(){
  tabla_aros_creados=$('#data_lista_aros_creados').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: ['copyHtml5', {
           extend: 'excelHtml5',
           text: 'Descargar Excel',
           filename: function() {
               var date_edition = 'Productos creados '+moment().format("DD-MM-YYYY HH[h]mm")
               var selected_machine_name = $("#output_select_machine select option:selected").text()
               return date_edition + ' - ' + selected_machine_name
           },
           sheetName: 'Output logiciel complet',
           title : null
       }],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_aros_creados',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

/////////////////FIN LISTADO AROS CREADOS

function boot_b(){
    Swal.fire({icon:'error',title:'Oops...',text:'Something went wrong!',footer:'<a href>Why do I have this issue?</a>'})
}

function exitoso(){
 Toast.fire({
    type: 'success',
    title: 'Producto registrado exitosamente'
  })
}
///////////////GUARDAR ARO
var aros_creados = [];
function guardarAro(){
	let marca_aro =$("#marca_aros").val();
  let marca_aros = marca_aro.toString();
	let modelo_aro = $("#modelo_aro").val();
	let color_aro = $("#color_aro").val();
	let medidas_aro = $("#medidas_aro").val();
	let diseno_aro = $("#diseno_aro").val();
	let materiales_aro = $("#materiales_aro").val();
	let cat_venta_aros = $("#cat_venta_aros").val();
	let categoria_producto = $("#categoria_producto").val();

    //validamos, si los campos(paciente) estan vacios entonces no se envia el formulario
if(marca_aros != "" && modelo_aro != "" && color_aro != "" && medidas_aro != "" && diseno_aro != "" && materiales_aro != ""){
    $.ajax({
    url:"ajax/productos.php?op=guardar_aros",
    method:"POST",
    data:{marca_aros:marca_aros,modelo_aro:modelo_aro,color_aro:color_aro,medidas_aro:medidas_aro,diseno_aro:diseno_aro,materiales_aro:materiales_aro,cat_venta_aros:cat_venta_aros,categoria_producto:categoria_producto},
    cache: false,
    dataType:"json",
    success:function(data){
      
      
      if(data.result=="yes") {
        Swal.fire('Se creado un nuevo aro!','','success')
        let obj = {
          marca_aros:marca_aros,
          modelo_aro:modelo_aro,
          color_aro:color_aro,
          medidas_aro:medidas_aro,
          diseno_aro:diseno_aro,
          materiales_aro:materiales_aro,
          id_producto: data.last_id
        }
        aros_creados.push(obj);
        ubicarArosInvidividual();
        clear_inputs_inv();
        $('#marca_aros').val(null).trigger('change');
        listarArosIngresoMultiple()
      }else if(data.result=='not'){
          Swal.fire('Producto ya Existe!','','error')
          return false;
      }

    }
});
}else{
    //bootbox.alert("Algun campo obligatorio no fue llenado correctamente");
Swal.fire('Hay Campos que no han sido completados o Seleccionados!','','error'
)
    return false;
}
} //cierre del condicional de validacion de los campos de producto

////////////GUARDAR ACCESORIOS/////////////////////////
function guardar_accesorios(){
  var tipo_accesorio =$("#tipo_accesorio").val();
  var marca_accesorio =$("#marca_accesorio").val();
  var desc_accesorio =$("#des_accesorio").val();
  var categoria =$("#categoria").val();
  var codigo =$("#cod_acc").val();

  //validamos, si los campos(paciente) estan vacios entonces no se envia el formulario


    $.ajax({
    url:"ajax/productos.php?op=guardar_accesorios",
    method:"POST",
    data:{tipo_accesorio:tipo_accesorio,marca_accesorio:marca_accesorio,desc_accesorio:desc_accesorio,categoria:categoria,codigo:codigo},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){         

      console.log(data);
      if(data=='editado'){
        Swal.fire('Producto editado exitosamente!','','succces')
        return false;
      }else if (data=="ok") {
        Swal.fire('Se creado un nuevo Accesorio!','','success')
        
      }

    }

});
Swal.fire('Se creado un nuevo Accesorio!','','success')
$("#accesorios_save").modal('hide');


} 



  function explode(){
    location.reload();
  }

  ////LISTAR ACCESORIOS CREADOS /////
  function listar_accesorios_creados()
{
  tabla_accesorios_creados=$('#data_lista_accesorios_creados').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
buttons: ['copyHtml5', {
           extend: 'excelHtml5',
           text: 'Descargar Excel',
           filename: function() {
               var date_edition = 'Productos creados '+moment().format("DD-MM-YYYY HH[h]mm")
               var selected_machine_name = $("#output_select_machine select option:selected").text()
               return date_edition + ' - ' + selected_machine_name
           },
           sheetName: 'Output logiciel complet',
           title : null
       }],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_accesorios_creados',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

/////////LISTAR AROS
function listar_aros()
{
  tabla_aros=$('#data_aros').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_aros',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

/////////LISTAR ACCESORIOS EN COMPRAS
function listar_acc_compras()
{
  tabla_acc_compras=$('#data_acc_compras').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_acc_compras',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}



////////////////LISTAR AROS EN VENTAS
$(document).on("click","#btn_aros_venta", function(){

  let sucursal= $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  tabla_aros_venta = $('#lista_aros_ventas_data').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],

    "ajax":{
      url:"ajax/productos.php?op=buscar_aros_venta",
      type : "post",
        //dataType : "json",
    data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},           
    error: function(e){
          console.log(e.responseText);
    },            
  },

        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,//Por cada 10 registros hace una paginación
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
        });
});
//////////////LISTAR ACCESORIOS EN VENTA

////////////////LISTAR AROS EN VENTAS
$(document).on("click","#btn_accesorios_venta", function(){
  let sucursal= $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  tabla_aros_venta = $('#lista_accesorios_ventas_data').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],

    "ajax":{
      url:"ajax/productos.php?op=buscar_accesorios_venta",
      type : "post",
        //dataType : "json",
    data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},           
    error: function(e){
          console.log(e.responseText);
    },            
  },

        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,//Por cada 10 registros hace una paginación
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
        });
});


////////////////////LISTAR LENTES EN VENTA
function listar_lentes_venta(){
  tabla_lentes_venta=$('#lista_lentes_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_lentes_venta',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}



//////GUARDAR LENTE 
function guardarLentes(){
  var describe =$("#describe").val();
  var costo=$("#costo_lente").val();
  var precio =$("#precio").val();
  var cat_prod =$("#cat_prod").val();
  
    //validamos, si los campos(lente) estan vacios entonces no se envia el formulario
if( describe != "" && costo != "" && precio != "" && cat_prod != "" ){
    $.ajax({
    url:"ajax/productos.php?op=registrar_lentes",
    method:"POST",
    data:{describe:describe,costo:costo,precio:precio,cat_prod:cat_prod},
    cache: false,
    //dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){
        setTimeout ("Swal.fire('Se ha registrado un nuevo lente','','success')", 100)
        setTimeout ("explode();", 2000);
    }
});
}else{
    //bootbox.alert("Algun campo obligatorio no fue llenado correctamente");
Swal.fire('Hay Campos que no han sido completados o Seleccionados!','','error')
    return false;
}
} //cierre del condicional de validacion de los campos del paciente
  function explode(){
    location.reload();
  }

////// GUARDAR NUEVO ANTIREFLEJANTE
function guardarAntireflejante(){
  var describe =$("#describe_dos").val();
  var costo =$("#costo_anti").val();
  var precio =$("#precio_anti").val();
  var cat_prod =$("#cat_prod_dos").val();
  
    //validamos, si los campos(lente) estan vacios entonces no se envia el formulario
if( describe != "" && costo_anti != "" && precio_anti != "" && cat_prod != "" ){
    $.ajax({
    url:"ajax/productos.php?op=registrar_antireflejantes",
    method:"POST",
    data:{describe:describe,costo:costo,precio:precio,cat_prod:cat_prod},
    cache: false,
    //dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){
        setTimeout ("Swal.fire('Se ha registrado un nuevo antireflejante','','success')", 100)
        setTimeout ("explode();", 2000);
    }
});
}else{
    //bootbox.alert("Algun campo obligatorio no fue llenado correctamente");
Swal.fire('Hay Campos que no han sido completados o Seleccionados!','','error')
    return false;
}
} //cierre del condicional de validacion de los campos del paciente
  function explode(){
    location.reload();
  }

////// GUARDAR NUEVO PHOTOSENSIBLE
function guardarPhotosensible(){
  var describe =$("#describe_tres").val();
  var costo_photo =$("#costo_photo").val();
  var precio_photo =$("#precio_photo").val();
  var cat_prod =$("#cat_prod_tres").val();
  
    //validamos, si los campos(lente) estan vacios entonces no se envia el formulario
if( describe != "" && precio != "" && cat_prod != "" ){
    $.ajax({
    url:"ajax/productos.php?op=registrar_photosensibles",
    method:"POST",
    data:{describe:describe,costo_photo:costo_photo,precio_photo:precio_photo,cat_prod:cat_prod},
    cache: false,
    //dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){
        setTimeout ("Swal.fire('Se ha registrado un nuevo photosensible','','success')", 100)
        setTimeout ("explode();", 2000);
    }
});
}else{
    //bootbox.alert("Algun campo obligatorio no fue llenado correctamente");
Swal.fire('Hay Campos que no han sido completados o Seleccionados!','','error')
    return false;
}
} //cierre del condicional de validacion de los campos del paciente
  function explode(){
    location.reload();
  }


  ////////////////////LISTAR ANTIREFLEJANTES EN VENTA
function listar_ar_venta(){
  tabla_ar_venta=$('#lista_ar_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_ar_venta',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}
///////////LISTAR PHOTOSENSIBLES EN VENTA
function listar_photo_venta(){
  tabla_photo_venta=$('#lista_photo_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_photo_venta',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

//////LISTAR LENTES + TRATAMIENTOS
function listar_lentes_tratamientos()
{
  tabla_lentes_tratamientos=$('#data_lente_tratamientos').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=lista_lentes_tratamientos',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

///FUNCION EDITAR ARO
function editar_aro(){
  var marca_aros =$("#marca_aros_edit").val();
  var modelo_aro =$("#modelo_aro_edit").val();
  var color_aro =$("#color_aro_edit").val();
  var medidas_aro =$("#medidas_aro_edit").val();
  var diseno_aro =$("#diseno_aro_edit").val();
  var materiales_aro =$("#materiales_aro_edit").val();
  var cat_venta_aros =$("#cat_venta_aros_edit").val();
  var categoria_producto =$("#categoria_producto_edit").val();
  var id_producto =$("#id_producto_edit").val();

    //validamos, si los campos(paciente) estan vacios entonces no se envia el formulario
if(marca_aros != "" && modelo_aro != "" && color_aro != "" && medidas_aro != "" && diseno_aro != "" && materiales_aro != ""){
    $.ajax({
    url:"ajax/productos.php?op=editar_aros",
    method:"POST",
    data:{marca_aros:marca_aros,modelo_aro:modelo_aro,color_aro:color_aro,medidas_aro:medidas_aro,diseno_aro:diseno_aro,materiales_aro:materiales_aro,cat_venta_aros:cat_venta_aros,categoria_producto:categoria_producto,id_producto:id_producto},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){

    }
});
}
Swal.fire('El producto ha sido editado exitosamente!','','success')
setTimeout ("explode();", 2000);
} //cierre del condicional de validacion de los campos de editar producto


function show_datos_aro(id_producto){
  $.ajax({
    url:"ajax/productos.php?op=show_datos_aro",
    method:"POST",
    data:{id_producto:id_producto},
    cache:false,
    dataType:"json",
    success:function(data){
      console.log(data);
      $("#id_producto_edit").val(data.id_producto);
      $("#marca_aros_edit").val(data.marca_aros);
      $("#modelo_aro_edit").val(data.modelo_aro);
      $("#color_aro_edit").val(data.color_aro);
      $("#medidas_aro_edit").val(data.medidas_aro);
      $("#diseno_aro_edit").val(data.diseno_aro);
      $("#materiales_aro_edit").val(data.materiales_aro);
      $("#cat_venta_aros_edit").val(data.cat_venta_aros);
      $("#categoria_producto").val(data.categoria_producto);

    }
  });
}

function editar_accesorio(){
  var tipo_accesorio =$("#tipo_accesorio_edit").val();
  var marca_accesorio =$("#marca_accesorio_edit").val();
  var desc_accesorio =$("#des_accesorio_edit").val();
  var categoria =$("#categoria_edit").val();
  var codigo =$("#cod_acc_edit").val();
  var id_producto =$("#id_producto_edit").val();

  //validamos los campos de editar accesorio

if(tipo_accesorio !="" && marca_accesorio!="" && desc_accesorio !=""){

    $.ajax({
    url:"ajax/productos.php?op=editar_accesorios",
    method:"POST",
    data:{tipo_accesorio:tipo_accesorio,marca_accesorio:marca_accesorio,desc_accesorio:desc_accesorio,categoria:categoria,codigo:codigo,id_producto:id_producto},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){         

    }
});
}
Swal.fire('El accesorio ha sido editado exitosamente!','','success')
setTimeout ("explode();", 2000);
} //cierre editar accesorio


///VER INFORMACION DE ACCESORIO A EDITAR
function show_datos_acc(id_producto){
  $.ajax({
    url:"ajax/productos.php?op=show_datos_acc",
    method:"POST",
    data:{id_producto:id_producto},
    cache:false,
    dataType:"json",
    success:function(data){
      console.log(data);
      $("#id_producto_edit").val(data.id_producto);
      $("#tipo_accesorio_edit").val(data.tipo_accesorio);
      $("#marca_accesorio_edit").val(data.marca_accesorio);
      $("#des_accesorio_edit").val(data.desc_accesorio);
      $("#categoria_edit").val(data.categoria);
      $("#cod_accesorio_edit").val(data.codigo);
    }
  });
}

///FUNCION ELIMINAR ACCESORIO
function eliminar_accesorio(id_producto){

  bootbox.confirm("¿Está seguro de eliminar accesorio?", function(result){
    if(result){

  $.ajax({
    url:"ajax/productos.php?op=eliminar_accesorio",
    method:"POST",
    data:{id_producto:id_producto},
    dataType:"json",
    success:function(data)
    {
      console.log(data);
      if(data=="ok"){
        setTimeout ("Swal.fire('Accesorio Eliminado Existosamente','','success')",);
        setTimeout ("explode();", 2000);
      }        //alert(data);
      $("#data_lista_accesorios_creados").DataTable().ajax.reload();
    }
  });

}
});//bootbox

}

$(document).on("click","#items_traslados", function(){
$("#modalTraslados").modal("show");
    var sucursal = $('#sucursal').val();

    tabla_pacientes_traslados=$('#data_items_traslados').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      columnDefs: [
          {"targets": [0],
          "visible": false,
          "searchable": false
          },
        ],
      buttons: [
            'excelHtml5',
            'pdf'
            ],
    "ajax":{
      url: 'ajax/productos.php?op=listar_productos_traslado',
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal},         
      error: function(e){
      console.log(e.responseText);  
        }
    },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      //"order": [[ 0, "desc" ]],//Ordenar (columna,orden)
      
      "language": {
 
          "sProcessing":     "Procesando...",
       
          "sLengthMenu":     "Mostrar _MENU_ registros",
       
          "sZeroRecords":    "No se encontraron resultados",
       
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
       
          "sInfo":           "Mostrando un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando un total de 0 registros",
       
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
       
          }

         }//cerrando language
         
  }).DataTable();
});

function guardarServicio(){
  var tipo_servicio =$("#tipo_servicio").val();
  var des_servicio =$("#des_servicio").val();
  var precio_servicio =$("#precio_servicio").val();
  var cat_servicio =$("#cat_servicio").val();
  
    //validamos, si los campos(lente) estan vacios entonces no se envia el formulario
if( tipo_servicio != "" && des_servicio != "" && precio_servicio != "" && cat_servicio != "" ){
    $.ajax({
    url:"ajax/productos.php?op=registrar_servicio",
    method:"POST",
    data:{tipo_servicio:tipo_servicio,des_servicio:des_servicio,precio_servicio:precio_servicio,cat_servicio:cat_servicio},
    cache: false,
    //dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){
        setTimeout ("Swal.fire('Se ha registrado un nuevo servicio','','success')", 100)
        setTimeout ("explode();", 2000);
    }
});
}else{
    //bootbox.alert("Algun campo obligatorio no fue llenado correctamente");
Swal.fire('Hay Campos que no han sido completados o Seleccionados!','','error')
    return false;
}
} //cierre del condicional de validacion de los campos del paciente
  function explode(){
    location.reload();
  }

//modal listar servicios en venta;
function listar_servicios_venta(){
  tabla_servicios_venta=$('#lista_servicios_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/productos.php?op=listar_servicios_venta',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

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

         }//cerrando language

  }).DataTable();
}

function ubicarArosInvidividual(){
  $("#ingreso-ind-temp").html("");
  var filas = '';

  for(var i=0; i < aros_creados.length; i++){
    filas = filas + "<tr id='fila"+i+"'>"+
    
    "<td>"+aros_creados[i].marca_aros+"</td>"+
    "<td>"+aros_creados[i].modelo_aro+"</td>"+
    "<td>"+aros_creados[i].color_aro+"</td>"+
    "<td>"+aros_creados[i].materiales_aro+"</td>"+
    "<td>"+aros_creados[i].diseno_aro+"</td>"+    
    "<td><button type='button' class='btn btn-edit btn-md edita_aro bg-light' style='text-align:center' onClick='arosUbicarIndividual("+i+","+aros_creados[i].id_producto+","+'"'+aros_creados[i].modelo_aro+'"'+","+'"'+aros_creados[i].color_aro+'"'+","+'"'+aros_creados[i].marca_aros+'"'+","+'"'+aros_creados[i].materiales_aro+'"'+");' data-toggle='modal' data-target='#ubicacion-ind' data-backdrop='static' data-keyboard='false'><i class='fas fa-box' aria-hidden='true' style='color:#006600'></i></button>'</td>"+
    "</tr>";
  }
  
  $('#ingreso-ind-temp').html(filas);
}
function dtTemplateCobros(table,route,...Args){

  tabla = $('#'+table).DataTable({      
  "aProcessing": true,//Activamos el procesamiento del datatables
  "aServerSide": true,//Paginación y filtrado realizados por el servidor
  dom: 'Bfrtip',//Definimos los elementos del control de tabla
  buttons: [     
    'excelHtml5',
  ],

  "ajax":{
    url:"ajax/productos.php?op="+ route,
    type : "POST",
    data: {Args:Args},
    dataType : "json",
     
    error: function(e){
    console.log(e.responseText);
  },      
  /*success: function(result) {
    console.log(result.aaData)
  },*/ 
},

  "bDestroy": true,
  "responsive": true,
  "bInfo":true,
  "iDisplayLength": 2000,//Por cada 10 registros hace una paginación
    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
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
    }}, //cerrando language
});

 
}



init();
