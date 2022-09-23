$(document).ready(ocultar_btns_post_ingreso);

  function ocultar_btns_post_ingreso(){
  document.getElementById("post_ingreso").style.display = "none";
  
}
  function mostrar_btn_post_ingreso(){
  document.getElementById("post_ingreso").style.display = "flex";
}
  function ocultar_btn_de_ingreso(){
  document.getElementById("select_prod").style.display = "none";
  document.getElementById("btn_ingreso").style.display = "none";
  document.getElementById("btn_ingreso").style.display = "none";
}
//////////////////////////////
var tablas_compras_ingreso_bodegas;
function init(){
  listarArosBodegaCentral();
  get_numero_ingreso();
  get_correlativo_traslado();
  stockBdCentral();

}
 function ingresar_compras_bodega() {
  $('#modal_ingreso_bodega').modal('show');
  var numero_compra = $("#numero_compra_bod").val();
  tablas_compras_ingreso_bodegas=$('#data_productos_ingresos_bodega').dataTable(

  {

    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/bodegas.php?op=listar_productos_ingreso_bodegas',
          type : "post",
          data:{numero_compra:numero_compra},
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 20,//Por cada 10 registros hace una paginación
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
  $('#data_productos_ingresos_bodega').focus();
}

///////////////INGRESAR PRODUCTOS A BODEGA
var detalles = [];
function agregaIngreso(id_producto,numero_compra){
  $.ajax({
  url:"ajax/bodegas.php?op=buscar_producto_por_compra",
  method:"POST",
  data:{id_producto:id_producto,numero_compra:numero_compra},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);   
    var obj = {
      id_producto: data.id_producto,
      cant_ingreso: data.cant_ingreso,
      precio_venta: data.precio_venta,
      cantidad : 1,
      ubicacion  : '',
      numero_compra   : data.numero_compra,
      descripcion  : data.descripcion,
    };//Fin objeto
    detalles.push(obj);
    listarDetallesIngresos();
    //carga_cats();
    console.log(detalles);
    }//fin success
  });//fin de ajax
  $('#modal_ingreso_bodega').modal("hide");
  
}

function listarDetallesIngresos(){

    $('#listar_productos_de_ingreso').html('');
    var filas = "";

    for(var i=0; i<detalles.length; i++){

    //var subtotal = detalles[i].subtotal = detalles[i].cantidad * detalles[i].precio_compra;

        var filas = filas + "<tr id='fila"+i+"'><td style='text-align:center'>"+(i+1)+
        "</td>"+"<td style='text-align:center;'>"+detalles[i].numero_compra+"</td>"+"<td style='text-align:center;'>"+detalles[i].cant_ingreso+
        "</td>"+"<td style='text-align:center;'><span>"+detalles[i].descripcion+"</span></td>"+"<td>"+"<select class='form-control' id='categoria_ubicacion' onClick='setUbicacion(event, this, "+(i)+");'></select>"+"</td>"+"<td>"+"<input type='text'class='form-control cant"+detalles[i].id_producto+"' onClick='setCant(event, this, "+(i)+");' onKeyUp='setCant(event, this, "+(i)+")' value='"+detalles[i].cantidad+"' pattern='^[0-9]+' id='cant"+(i)+"'>"+"</td>"+"<td style='text-align:center'><i class='nav-icon fas fa-trash-alt fa-2x' onClick='eliminarItem("+i+");' style='color:red'></i></td>"+"</tr>";

    //subtotal = subtotal + importe;

  }//cierre for

  $('#listar_productos_de_ingreso').html(filas);

}
 
function setUbicacion(event, obj, idx){
    event.preventDefault();
    detalles[idx].ubicacion = String(obj.value);
    //recalcular(idx);
}

function setCant(event, obj, idx){
    event.preventDefault();
    detalles[idx].cantidad = String(obj.value);
    setCantidadAjax(event, obj, idx);
}

function setCantidadAjax(event, obj, idx){
  event.preventDefault();
  var cant_act=detalles[idx].cantidad = parseInt(obj.value);  
  var cant_disponible = detalles[idx].cant_ingreso;
  if (cant_act>cant_disponible) {
    setTimeout ("Swal.fire('La cantidad es mayor a cantidad disponible','','error')", 100)
    var parametro ='cant'+idx;
    document.getElementById(parametro).style.border='solid 1px red';
    document.getElementById(parametro).value=0;
  }else if(cant_act<=cant_disponible){
    document.getElementById(parametro).style.border='solid 2px #7FFFD4';
  }
}

function eliminarItem(index) {
  $("#fila" + index).remove();
  drop_item(index);
}

function drop_item(position_element){
  detalles.splice(position_element, 1);
  //recalcular(position_element);
  calcularTotales();

}
 function registrarIngresoBodega(){

  var fecha_ingreso = $("#fecha_ingreso").val();
  var usuario = $("#usuario").val();
  var sucursal_i = $("#sucursal_i").html();
  var numero_compra_i = $("#numero_compra_i").html();
  var categoria_ubicacion = $("#categoria_ubicacion").val();
  var numero_ingreso = $("#id_ingreso_c").html();

  var contador = 0;
  count_fields_empty=[];
  for(var i=0;i<detalles.length;i++){
    var cantidad = detalles[i].cantidad;
    var ubicacion = detalles[i].ubicacion;
    var cant_items = parseInt(cantidad);    
      //alert(currentNumber);
    if(cantidad == ''){
      count_fields_empty.push(cantidad);
    }
    contador = contador+cant_items;
  }
///////////////////////////////////////


//////////////VALIDAR QUE SE ENVIEN PRODUCTOS A LA BD
var test_array = detalles.length;
  if (test_array<1) {
  Swal.fire('Debe Agregar Productos al Ingreso!','','error')
  return false;
}
//////////////VALIDAR QUE CAMPOS UBCACION Y CANTIDAD NOT EMPTY
var cuenta_vacios = count_fields_empty.length;
if (cuenta_vacios>0) {
  Swal.fire('Debe seleccionar la cantidad en cada item!','','error')
  return false;
}

if(categoria_ubicacion != ""){
    console.log('Message Oscar');
    $.ajax({
    url:"ajax/bodegas.php?op=registrar_ingreso_a_bodega",
    method:"POST",
    data:{'arrayIngresoBodega':JSON.stringify(detalles),'fecha_ingreso':fecha_ingreso,'usuario':usuario,'sucursal_i':sucursal_i,'numero_compra_i':numero_compra_i,'categoria_ubicacion':categoria_ubicacion,'numero_ingreso':numero_ingreso},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      console.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){  
    }

  });
    setTimeout ("Swal.fire('El ingreso a Bodega ha sido Exitoso','','success')", 100)
    //setTimeout ("explode();", 2000);
    mostrar_btn_post_ingreso();
    ocultar_btn_de_ingreso();
  }else{
    setTimeout ("Swal.fire('Seleccione el destino de Ingreso','','error')", 100)
  }

}

////////REPORTE DE ULTIMO INGESOS A BODEGA
function reporte_ingreso_bodega(){
  var numero_compra = $("#n_compra").val();

  tabla_compras_admin_report=$('#reporte_compra_admin').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [{
          extend: 'excelHtml5',
          download: 'open',
          text: 'Descargar Excel',
          filename: function() {
              var date_edition = 'Compras Pendientes Ingresar '+moment().format("DD-MM-YYYY HH[h]mm")
              var selected_machine_name = $("#output_select_machine select option:selected").text()
              return date_edition + ' - ' + selected_machine_name
           },
           sheetName: 'Compras',
           title : null
       },
            {
              extend: 'pdfHtml5',
              download: 'open',
              text: 'Imprimir',
              orientation: 'portrait',
              pageSize: 'letter',
              customize : function(doc) {doc.pageMargins = [10, 10, 10,10 ]; },
              filename: function() {
              var fecha = 'Compra '+moment().format("DD-MM-YYYY HH[h]mm")
              var selected_machine_name = $("#output_select_machine select option:selected").text()
              return fecha + ' - ' + selected_machine_name
              
            },
            title : 'Compras'
        }   
       ],
    "ajax":
        {
          url: 'ajax/compras.php?op=reporte_compra_administrador',
          type : "post",
          data:{numero_compra:numero_compra},   
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

/////REPORTE INGRESOS A BODEGA
function reporte_ingresos_bodega()
{
  var numero_ingreso = $("#id_ingreso_c").html();
  //alert(numero_compra);
  //return false;
  tabla_reporte_ingresos_bodega=$('#reporte_ingresos_bodega').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/bodegas.php?op=reporte_ingresos_bodega',
          type : "post",
          data:{numero_ingreso:numero_ingreso},   
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
/////////////////////GET NUMERO DE INGRESO
function get_numero_ingreso(){
    $.ajax({
      url:"ajax/bodegas.php?op=get_numero_ingreso",
      method:"POST",
      cache:false,
      dataType:"json",
      success:function(data)
      {
        $("#id_ingreso_c").html(data.n_ingreso);
      }
    })
}

//////////////carga Select
    function carga_cats(){
     $.ajax({
      url:"ajax/categoria.php?op=get_categorias",
      method:"POST",
      //data:{numero_venta:numero_venta},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        console.log(data);
        for(var i in data)
            { 
              document.getElementById("categoria_ubicacion").innerHTML += "<option value='"+data[i]+"'>"+data[i]+"</option>"; 

            }
      }
    });
}

//////////////GET CATEGORIAS EN STOCK
$(document).ready(function(){
  var sucursal = $("#sucursal_user").val();
  $("#tipo_categoria").change(function () {         
    $("#tipo_categoria option:selected").each(function () {
      categoria = $(this).val();
      $.post('ajax/bodegas.php?op=select_categorias', {categoria:categoria,sucursal:sucursal}, function(data){
        $("#ubicacion_bodega").html(data);
      });            
    });
  })
});

//////////////////
$(document).on('click', '#tipo_categoria', function(){ 
    
    var sucursal = $("#sucursal_user").val();
    var categoria = $(this).val();
    console.log(categoria);
    console.log(sucursal);
    $.ajax({
      url:"ajax/categoria.php?op=get_categorias_sucursal",
      method:"POST",
      data:{sucursal:sucursal,categoria:categoria},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        console.log(data);
        $("#categoria_ubicaciones").empty();
        for(var i in data){

              document.getElementById("categoria_ubicaciones").innerHTML += "<option value='"+data[i]+"'>"+data[i]+"</option>"; 

            }
      }
    });

  });
//////////////////////////GET INVENTARIO GENERAL
$(document).on("click","#categoria_ubicaciones", function(){
  var ubicacion = $(this).val();
  tabla_existencias= $('#data_inventario_genaral').DataTable({
      
  "aProcessing": true,//Activamos el procesamiento del datatables
         "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],

           "ajax":{
            url:"ajax/bodegas.php?op=get_inventario_general",
            type : "post",
        //dataType : "json",
        data:{ubicacion:ubicacion},           
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

          //"scrollX": true



        });



      });

///////////////////////////TRASLADOS
var detalles_traslado = [];
function realizar_traslado(id_producto,categoria_ub){

  $.ajax({
  url:"ajax/bodegas.php?op=get_productos_traslados",
  method:"POST",
  data:{id_producto:id_producto,categoria_ub:categoria_ub},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);   
    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      descripcion   : data.desc_producto,
      origen    : data.categoria_ub,
      destino  : "",
      num_compra : data.num_compra,
      id_ingreso : data.id_ingreso,
      precio_venta:data.precio_venta
    };//Fin objeto
    detalles_traslado.push(obj);
    $('#modalTraslados').modal("hide");
    listarDetallesTraslado();
    console.log(detalles_traslado);
    }//fin success
  });//fin de ajax

}
/////////////////////////LISTAR DETALLES DE TRASLADO
/////////fin aggergar acc a compra
function listarDetallesTraslado(){

    $('#listar_det_traslados').html('');

    var filas = "";
    for(var i=0; i<detalles_traslado.length; i++){
        var filas = filas + "<tr id='fila_t"+i+"'><td>"+(i+1)+
        "</td><td style='text-align:center;'>"+detalles_traslado[i].descripcion+
        "<td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' onClick='setCantidad_traslado(event, this, "+(i)+");' onKeyUp='setCantidad_traslado(event, this, "+(i)+");' value='"+detalles_traslado[i].cantidad+"'><td style='text-align:center'><input style='text-align:right' type='text' class='cantidad form-control'  value='"+detalles_traslado[i].origen+"' readonly ></td><td style='text-align:center'><input style='text-align:right' type='text' class='cantidad form-control'  value='"+detalles_traslado[i].destino+"' onClick='buscar_categorias("+(i)+")' id='item_traslado"+(i)+"'></td><td style='text-align:center'><i class='nav-icon fas fa-trash-alt fa-2x' onClick='eliminarItemTraslado("+i+");' style='color:red'></i></td></tr>";
    


    //subtotal = subtotal + importe;

  }//cierre for
  $('#listar_det_traslados').html(filas);
}

function buscar_categorias(index_cat){
  var indice = index_cat;
  var sucursal =$("#sucursal").val();
  $("#modal_cat_traslados").modal("show");
  $("#indice_categoria").val(indice);
    tabla_prod_traslados=$('#data_cats_traslados').dataTable({
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
      url: 'ajax/categoria.php?op=get_categorias_traslados',
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
}

function agregar_item_traslado(categoria){
  var indice = $("#indice_categoria").val();
  console.log(indice);
  console.log(categoria);
  $("#modal_cat_traslados").modal("hide");
  detalles_traslado[indice].destino = categoria;
  $("#item_traslado"+indice).val(categoria);
}

function eliminarItemTraslado(index) {
  $("#fila_t" + index).remove();
  drop_item_t(index);
}

function drop_item_t(position_element){
  detalles_traslado.splice(position_element, 1);
}

/////////////////////REGISTRAR TRASLADO//////////////

function registrar_traslado(){
  var  sucursal= $("#sucursal").val();
  var  usuario= $('#usuario').val();
  var  fecha= $('#fecha').val();
  var  tipo_traslado= $('#tipo_traslado').val();
  var  num_traslado = $("#num_traslado").html();
  ubicaciones_vacias=[];
  for(var i=0;i<detalles_traslado.length;i++){
      var dest = detalles_traslado[i].destino;
      if(dest == ""){
      ubicaciones_vacias.push(dest);
    }
  }


var cuenta_vacios = ubicaciones_vacias.length;
if (cuenta_vacios>0) {
  Swal.fire('Debe especificar la nueva ubicacion de cada producto!','','error')
  return false;
}
////////VALIDAR QUE LA RUTA DE DESTINO SEA DIFERENTE A ORIGEN
for(var i=0;i<detalles_traslado.length;i++){
      var desti = detalles_traslado[i].destino;
      var origen =detalles_traslado[i].origen;
      if(desti == origen){
      Swal.fire('Existen ubicaciones mal seleccionadas!','','error')
  return false;
    }
  }

var test_array = detalles_traslado.length;
  if (test_array<1) {
  Swal.fire('Debe Agregar Productos al traslado!','','error')
  return false;
}

   $.ajax({
    url:"ajax/bodegas.php?op=registrar_traslado",
    method:"POST",
    data:{'arrayTraslado':JSON.stringify(detalles_traslado),'sucursal':sucursal,'usuario':usuario,'fecha':fecha,'tipo_traslado':tipo_traslado,'num_traslado':num_traslado},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      console.log(x);
      console.log(y);
      console.log(z);
    },

    success:function(data){
    console.log(data);
  }

  });
    $('#listar_det_traslados').html('');
    setTimeout ("Swal.fire('Se ha registrado Exitosamente el traslado','','success')", 100);

}

////////////////GET CORRELATIVO TRASLADO
function get_correlativo_traslado(){
  var sucursal = $("#sucursal").val();
  $.ajax({
    url:"ajax/bodegas.php?op=get_numero_traslado",
    method:"POST",
    data:{sucursal:sucursal},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);        
      $("#num_traslado").html(data.correlativo);             
      }
    })
}

function arosUbicarIndividual(idx,id_producto,modelo,color,marca, materiales){
  document.getElementById("marca-aro-indiv").innerHTML = marca;
  document.getElementById("modelo-aro-indiv").innerHTML = modelo;
  document.getElementById("color-aro-indiv").innerHTML = color;
  document.getElementById("material-aro-indiv").innerHTML = materiales;
  document.getElementById("id-envio-ind").value = id_producto;
  document.getElementById("idx-prod").value = idx;
}

function envioBodegaIndividual(){

  let id_producto = document.getElementById("id-envio-ind").value;
  let cantidad_ingreso = document.getElementById("cantidad_ind").value;
  let precio_venta = document.getElementById("pventa_ind").value;
  let ubicacion = document.getElementById("ubicacion_ind").value;
  let usuario = document.getElementById("usuario").value;
  let sucursal = document.getElementById("sucursal").value;
  let costo_u = document.getElementById("costo_ind_unit").value;
  let idx = document.getElementById("idx-prod").value;
  $.ajax({
    url:"ajax/bodegas.php?op=ingresoIndividualBodega",
    method:"POST",
    data:{id_producto:id_producto,cantidad_ingreso:cantidad_ingreso,precio_venta:precio_venta,ubicacion:ubicacion,usuario:usuario,sucursal:sucursal,costo_u:costo_u},
    cache:false,
      dataType:"json",
      success:function(data){
        console.log(data)
        if(data.mensaje=="insertOk"){
        $("#ubicacion-ind").modal("hide");
        aros_creados.splice(idx, 1);
        ubicarArosInvidividual(); 
        Swal.fire('Ingresado a bodega','','success');
        clear_inputs_inv();
       // $('#marca_aros').val(null).trigger('change');
       $("#modal_ingreso_bodega").modal("hide");
       $("#data_stock_bdcentral").DataTable().ajax.reload(null,false);
      }
        
    }
  })


}

var aros_bodega = [];
function addProductoBd(id_producto,descripcion){
document.getElementById("select-all-bod-chk").checked = false
let obj = {
  id_producto : id_producto,
  descripcion : descripcion,
  cantidad : 1,
  costo: 0,pventa:0
}
aros_bodega.push(obj);
//$("#agregar-aros-ingresar-bdcentral").modal('hide')
listarArosUbicarBodega();
};

function listarArosUbicarBodega(){
  $("#ingreso-grupal-temp").html("");
  var filas = '';  
  let length_array = parseInt(aros_bodega.length)-1;
  for(let i=length_array;i>=0;i--){
    filas = filas +    
    "<tr style='text-align:center' id='item_t"+i+"'>"+
    "<td style='width:5%'>"+(i+1)+"</td>"+
    "<td style='width:10%'>"+"<input type='checkbox' class='form-check-input ubicar-bodega' value="+i +"  id="+"prodchk"+i+" onClick='agregarItemBodega(this.id)'>"+ "Sel."+"</td>"+
    "<td style='width:45%'>"+aros_bodega[i].descripcion+"</td>"+
    "<td style='width:8%'><input type='number' class='form-control next-input' id="+"costo-item"+i+" data-idproducto="+aros_bodega[i].id_producto+" value="+aros_bodega[i].costo+" onchange='setCostodProd("+(i)+");'></td>"+
    "<td style='width:8%'><input type='number' class='form-control next-input' id="+"pventa-item"+i+" data-idproducto="+aros_bodega[i].id_producto+" value="+aros_bodega[i].pventa+" onchange='setpVentaProd("+(i)+");'></td>"+
    "<td style='width:8%'><input type='number' class='form-control next-input' id="+"cant-item"+i+" data-idproducto="+aros_bodega[i].id_producto+" value="+aros_bodega[i].cantidad+" onchange='setCantidadProd("+(i)+");'></td>"+
    "<td style='width:8%'>"+"<button type='button'  class='btn btn-sm bg-light' onClick='eliminarItemProd("+i+")'><i class='fa fa-times-circle' aria-hidden='true' style='color:red'></i></button>"+"</td>"+
    "</tr>";
    
  }
  //check_selected();
  $("#ingreso-grupal-temp").html(filas);
  maxIndex = aros_bodega.length - 1;
  let id_item = 'costo-item'+maxIndex;
  $('#'+id_item).focus();
  $('#'+id_item).select();   

}

function eliminarItemProd(idx){
  aros_bodega.splice(idx, 1);
  listarArosUbicarBodega()
}


function setCantidadProd(idx){
  let cantidad = document.getElementById("cant-item"+idx).value;
  aros_bodega[idx].cantidad = cantidad;
  //listarArosUbicarBodega();
}

function setCostodProd(idx){
  let costo = document.getElementById("costo-item"+idx).value;
  aros_bodega[idx].costo = costo;
  //listarArosUbicarBodega();
}

function setpVentaProd(idx){
  let pventa = document.getElementById("pventa-item"+idx).value;
  aros_bodega[idx].pventa = pventa;
  //listarArosUbicarBodega();
}

function agregarItemBodega(idx){
  let valItem = document.getElementById(idx).value;
  let cantidad = document.getElementById("cant-item"+valItem).value;
  console.log(cantidad);
}

function selectOrdenesEnviar(idy){
  let items_prod = document.getElementsByClassName('ubicar-bodega');
  let checkbox = document.getElementById(idy);
  let check_state = checkbox.checked;
  if(check_state){

    for (var i = 0; i < items_prod.length; i++) {
    let id = items_prod[i].id;
    document.getElementById(id).checked = true

  }

  }else{
    for (var i = 0; i < items_prod.length; i++) {
      let id = items_prod[i].id;
      document.getElementById(id).checked = false
  
    }
  }
}

function clear_inputs_inv(){
  let element = document.getElementsByClassName("clear_i");
    for(i=0;i<element.length;i++){
      let id_element = element[i].id;
      document.getElementById(id_element).value = "";
   }
}

var aros_bodega = [];
function listarArosIngresoMultiple(){
  aros_bodega = [];
  document.getElementById("ingreso-grupal-temp").innerHTML="";
  $("#aros-list").select2({
    maximumSelectionLength: 1
});

  $.ajax({
		url:"ajax/bodegas.php?op=listar_aros_bodega",
      	method:"POST",
      	cache:false,
      	dataType:"json",
      	success:function(data){
          $("#aros-list").select2({
            data: data
          })
        }
	}); 
}
var itemsSelectGrupal = []
function agregarStockGrupal(){
  itemsSelectGrupal = [];
  let items_prod = document.getElementsByClassName('ubicar-bodega');
  for (var i = 0; i < items_prod.length; i++) {
    let id = items_prod[i].id;
    let checkbox = document.getElementById(id);
    let check_state = checkbox.checked;
    if(check_state){
      let idy = document.getElementById(checkbox.id).value;
      let productos = {
        idProd : aros_bodega[idy].id_producto,
        descripcion : aros_bodega[idy].descripcion,
        cantidad: aros_bodega[idy].cantidad,
        costo: aros_bodega[idy].costo,
        pventa: aros_bodega[idy].pventa,
        indice: idy
      }
      itemsSelectGrupal.push(productos)
    }

  }
  //console.log(itemsSelectGrupal)
  calculaValidaSeleccionados()

}

function calculaValidaSeleccionados(){
  let tam_array =itemsSelectGrupal.length;
  let total_cantidad= 0;
  let total_costo= 0;
  let total_pventa= 0;
  if(tam_array>0){
    for (var j = 0; j < itemsSelectGrupal.length; j++) {
      let cantidad = itemsSelectGrupal[j].cantidad;
      let costo = itemsSelectGrupal[j].costo;
      let pventa = itemsSelectGrupal[j].pventa;
      if(cantidad!=0 && costo!=0 && pventa!=0 && cantidad!="" && costo!=""&& pventa!=""){
        total_cantidad = parseFloat(total_cantidad) + parseFloat(cantidad);
        total_costo = parseFloat(total_costo) + parseFloat(costo);
        total_pventa = parseFloat(total_pventa) + parseFloat(pventa);
      }else{
        Swal.fire('Existe un campo vacio','','warning'); return false
      }
    }
    
    $("#ingresos-bodega-grupal").modal();
    $("#tot-prod-grup").html(total_cantidad);
    $("#costos-grup").html("$"+total_costo.toFixed(2));
    $("#pventa-grup").html("$"+total_pventa.toFixed(2));
  }else{
    Swal.fire('Debe seleccionar productos','','error')
  }
}

function ingresosGrupal(){

  let usuario = $("#usuario").val();
  let sucursal = $("#sucursal").val();
  let ubicacion = $("#ubicacion_ind_grup").val();
  let totales_compra = $("#pventa-grup").html();

  $.ajax({
    url:"ajax/bodegas.php?op=ingreso_grupal",
    method:"POST",
    data:{'arrayProdGrupal':JSON.stringify(itemsSelectGrupal),'usuario':usuario,'sucursal':sucursal,'ubicacion':ubicacion,'totales_compra':totales_compra},
    cache: false,
    dataType:"json",
    success:function(data){ 
      if(data.mensaje=='insertOk'){
        Swal.fire('Se ha ingresado a Bodega','','success');
        $("#modal_ingreso_bodega").modal("hide");
        $("#data_stock_bdcentral").DataTable().ajax.reload(null,false);
      }
    }

  });

}
////////////////// AGRUPADOS /////////////

function agregarStockAgrupado(){
  itemsSelectGrupal = [];
  let items_prod = document.getElementsByClassName('ubicar-bodega');
  for (var i = 0; i < items_prod.length; i++) {
    let id = items_prod[i].id;
    let checkbox = document.getElementById(id);
    let check_state = checkbox.checked;
    if(check_state){
      let idy = document.getElementById(checkbox.id).value;
      let productos = {
        idProd : aros_bodega[idy].id_producto,
        descripcion : aros_bodega[idy].descripcion,
        cantidad: aros_bodega[idy].cantidad,
        costo: aros_bodega[idy].costo,
        pventa: aros_bodega[idy].pventa,
        indice: idy
      }
      itemsSelectGrupal.push(productos)
    }

  }
  //console.log(itemsSelectGrupal)
  calculaValidaSelectAgrupados()

}

function calculaValidaSelectAgrupados(){
  let tam_array =itemsSelectGrupal.length;
  let total_cantidad= 0;
  if(tam_array>0){
    for (var j = 0; j < itemsSelectGrupal.length; j++) {
      let cantidad = itemsSelectGrupal[j].cantidad;     
      if(cantidad!=0){
        total_cantidad = parseFloat(total_cantidad) + parseFloat(cantidad);      
      }else{
        Swal.fire('Especificar la cantidad de cada item','','warning'); return false
      }
    }
    
    $("#ingreso-agrupado").modal();
    $("#total-aros-agrupados").html(total_cantidad);
    /*$("#costos-grup").html("$"+total_costo.toFixed(2));
    $("#pventa-grup").html("$"+total_pventa.toFixed(2));*/
  }else{
    Swal.fire('Debe seleccionar productos','','error')
  }
}


function IngresarAgrupados(){

  let usuario = $("#usuario").val();
  let sucursal = $("#sucursal").val();
  let ubicacion = $("#ubicacion_ind_grup").val();
  let costo_u = $("#costo_ind_agrupados").val();
  let pventa = $("#pventa_agrupados").val();

  $.ajax({
    url:"ajax/bodegas.php?op=ingreso_agrupado",
    method:"POST",
    data:{'arrayProdGrupal':JSON.stringify(itemsSelectGrupal),'usuario':usuario,'sucursal':sucursal,'ubicacion':ubicacion,'costo_u':costo_u,'pventa':pventa},
    cache: false,
    dataType:"json",
    success:function(data){ 
      console.log(data)
      if(data.mensaje=='insertOk'){
        Swal.fire('Se ha ingresado a Bodega','','success');
        $("#costo_ind_agrupados").val("");
        $("#pventa_agrupados").val("");
        $("#ingreso-agrupado").modal("hide");
        for (var i = 0; i < itemsSelectGrupal.length; i++) {
          let idx = itemsSelectGrupal[i].idProd;
          let index = aros_bodega.map(producto => producto.id_producto).indexOf(idx)
          aros_bodega.splice(index, 1);
      
        }
        listarArosUbicarBodega();
        $("#data_stock_bdcentral").DataTable().ajax.reload(null,false);
      }
    }

  });

}


function stockBdCentral(){

  tabla_reporte_ingresos_bodega=$('#data_stock_bdcentral').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":{
        url: 'ajax/bodegas.php?op=get_inventario_bdcentral',
        type : "post",
        error: function(e){
        console.log(e.responseText);
        }
        },
        drawCallback: function () {
          var sumatoria_stock = $('#data_stock_bdcentral').DataTable().column(8).data().sum();
          $('#total-stock').html(sumatoria_stock+" aros");  
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 500,//Por cada 10 registros hace una paginación
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
          

         }//cerrando language

  }).DataTable();
}

function listarArosBodegaCentral(){

  tabla_reporte_ingresos_bodega=$('#aros-agregar-bdcentral').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":{
        url: 'ajax/bodegas.php?op=listar_aros_bodega',
        type : "post",
        error: function(e){
        console.log(e.responseText);
        }
    },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 25,//Por cada 10 registros hace una paginación
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


function modalDistribuir(id_producto,numero_compra,stock,pventa,descripcion){
  $("#modal-distribuir").modal("show");
  document.getElementById("stock-bd-cental-distr").value = stock;
  document.getElementById("num-compra-dist").value = numero_compra;
  document.getElementById("id-prod-distr").value = id_producto;
  document.getElementById("pventa-dist").value = pventa;
  document.getElementById("titulo-dist").innerHTML = descripcion;
  
}

function distribuirSucursal(){
  let stock = parseInt(document.getElementById("stock-bd-cental-distr").value);
  let id_producto = document.getElementById('id-prod-distr').value;
  let cantidad = document.getElementById('cant-distr').value;
  let numero_compra = document.getElementById('num-compra-dist').value;
  let usuario = $("#usuario").val();
  let sucursal = $("#ubicacion_distrib").val();  
  let precio_venta =document.getElementById("pventa-dist").value;
  if(cantidad > stock){   
    Swal.fire('La cantidad excede el stock','','error');
    return false;
  }
  if(cantidad != "" && sucursal != "0"){
    $.ajax({
      url:"ajax/bodegas.php?op=distribuir_aros_sucursal",
      method:"POST",
      data : {id_producto:id_producto,cantidad:cantidad,numero_compra:numero_compra,usuario:usuario,sucursal:sucursal,precio_venta:precio_venta},
      cache:false,
      dataType:"json",
      success:function(info){
       if(info.mensaje=="registroOk"){
          Swal.fire('Ingreso a bodega exitoso','','success');
          $("#modal-distribuir").modal("hide");
          $("#ubicacion_distrib").val("0")
          $("#cant-distr").val("");
          $("#data_stock_bdcentral").DataTable().ajax.reload(null,false);
       }
  
      }
    }); 
  }else{
    Swal.fire('Sucursal o cantidad estan vacios','','error');
  }

}

var arosEnviarSucursal =[];
function agregarItemBodegaDist(id){
 let tag = document.getElementById(id);
 
 let check_state = tag.checked;
   if(check_state){
    let modelo =  tag.dataset.modelo;
    let idprod = tag.dataset.idprod;
    let marca = tag.dataset.marca; 
    let medidas = tag.dataset.medidas;
    let color = tag.dataset.color;
    let stock = parseInt(tag.dataset.stock);
    let numero_compra = tag.dataset.compra;
    let precio_venta = tag.dataset.pventa; 
   
    let arosObj = {modelo,idprod,marca,medidas,color,id,numero_compra,stock,desc: `Mod .:${modelo} Color: ${color}`,cantidad:stock,precio_venta}
    arosEnviarSucursal.push(arosObj);
    console.log(arosEnviarSucursal) 
  }else{
    const o = arosEnviarSucursal.find(elemento=>{
      return elemento.id === id      
    })
    
    if(o != undefined){
      const indice  = arosEnviarSucursal.findIndex(element=>{
        return element.id === id
      })
      arosEnviarSucursal.splice(indice, 1);
    }
  }

 document.getElementById("aros-sel-suc").innerHTML = arosEnviarSucursal.length + " modelos seleccionados";

}

function seleccionarEnviarSucursal(id){
  arosEnviarSucursal = [];
  let checkbox = document.getElementById(id);
  let chk_estado = checkbox.checked;
  let elements_chk = document.getElementsByClassName("env-sucursales");
  if(chk_estado){
    for (var i = 0; i < elements_chk.length; i++) {
      let id = elements_chk[i].id;
      document.getElementById(id).checked = true;
      let tag = document.getElementById(id);
      let modelo =  tag.dataset.modelo;
      let idprod = tag.dataset.idprod;
      let marca = tag.dataset.marca; 
      let medidas = tag.dataset.medidas;
      let color = tag.dataset.color;
      let stock = parseInt(tag.dataset.stock);
      let numero_compra = tag.dataset.compra;
      let precio_venta = tag.dataset.pventa; 
    
      let arosObj = {modelo,idprod,marca,medidas,color,id,numero_compra,stock,desc: `Mod .:${modelo} Color: ${color}`,cantidad:stock,precio_venta}
      arosEnviarSucursal.push(arosObj);
    }
  }else{
    for (var i = 0; i < elements_chk.length; i++) {
      let id = elements_chk[i].id;
      document.getElementById(id).checked = false;
    }
    arosEnviarSucursal = [];
  }
  document.getElementById("aros-sel-suc").innerHTML = arosEnviarSucursal.length + " modelos seleccionados";
}

function enviarArosSucursalLote(){
  let arrayTam = arosEnviarSucursal.length;
  if(arrayTam<1){Swal.fire('Lista vacia','','error');
  return false;}
  const sumall = arosEnviarSucursal.map(item => item.stock).reduce((prev, curr) => prev + curr, 0);
  document.getElementById("sum-aros-enviar").innerHTML = `${sumall} AROS PARA ENVIAR`
  $("#env-suc-lote").modal()
  $("#data-aros-env-lote").html("");
  var filas = '';  
  for(let i=0;i<arrayTam;i++){
    filas = filas +    
    "<tr style='text-align:center' id='item_t"+i+"'>"+ 
    "<td style='width:60%'>"+arosEnviarSucursal[i].desc+"</td>"+
    "<td style='width:20%'>"+arosEnviarSucursal[i].stock+"</td>"+
    "<td style='width:20%'><input type='text' class='form-control next-input' id=itemdist"+i+" value="+arosEnviarSucursal[i].cantidad+" onkeyup='validaCantidadDist(this.id,event, this, "+(i)+");'></td>"+
    "</tr>";
    
  }
  //check_selected();
  $("#data-aros-env-lote").html(filas);  
  
}

function distribuirProductosLote(){
  let usuario = $("#usuariouser_id").val();
  let sucursal = $("#ubicacion_distrib_lote").val();
  if(sucursal=='0'){ Swal.fire('Seleccionar sucursal','','error'); return false}
  $.ajax({
    url:"ajax/bodegas.php?op=ingreso_productos_lote",
    method:"POST",
    data:{'arrayProdLote':JSON.stringify(arosEnviarSucursal),'usuario':usuario,'sucursal':sucursal},
    cache: false,
    dataType:"json",
    success:function(data){ 
      if(data.mensaje=="registroOk"){
        Swal.fire('Ingreso a bodega exitoso','','success');
        $("#env-suc-lote").modal("hide");
        $("#ubicacion_distrib_lote").val("0")
        arosEnviarSucursal = [];
        $("#data_stock_bdcentral").DataTable().ajax.reload(null,false);
     }
    }

  });
  
}

function validaCantidadDist(id,event, obj, idx){
  event.preventDefault();
  let stock = arosEnviarSucursal[idx].stock;
  let cantidad_act = parseInt(obj.value);
  console.log(id)
  if(cantidad_act > stock){
    Swal.fire('Error!, Ha excedido el stock','','error');
    document.getElementById(id).value= stock;
    arosEnviarSucursal[idx].cantidad = parseInt(stock);
    document.getElementById(id).focus();
    document.getElementById(id).style.border='solid 1px red';
  }else{
    arosEnviarSucursal[idx].cantidad = parseInt(obj.value);
    document.getElementById(id).style.border='solid 1px green';
  }
}

init();
