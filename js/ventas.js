function init() {
  reporte_ventas_gral();
  get_correlativo_venta();
  get_correlativo_orden();
    //get_correlativo_venta();btn_print_recibos
  document.getElementById("print_orden_descplanilla").style.display = "none";
  document.getElementById("print_pagare").style.display = "none";
  document.getElementById("print_manual_oid").style.display = "none";
  document.getElementById("iprima_oid").style.display = "none";
  document.getElementById("print_factura").style.display = "none";
  document.getElementById("credito_fiscal_print").style.display = "none";
  document.getElementById("tipo_tarjeta").style.display = "none";
  document.getElementById("numero_tarjeta").style.display = "none";
  document.getElementById("vencimiento_tarjet").style.display = "none";
}

$(document).ready(ocultar_btn_post_venta);
  function ocultar_btn_post_venta(){
  get_correlativo_venta();
  document.getElementById("post_venta").style.display = "none";
}

function mostrar_btn_post_venta(){
  document.getElementById("post_venta").style.display = "flex";
}

//VALDAR TIPO DE PAGO
$(document).ready(function(){
  $("#tipo_venta").change(function () {         
    $("#tipo_venta option:selected").each(function () {
      id_tipo = $(this).val();
      $.post('ajax/ventas.php?op=tipo_pago', { id_tipo: id_tipo }, function(data){
        $("#tipo_pago").html(data);
      });            
    });
  })
});
//VALIDAR CUOTA
$(document).ready(function(){
  $("#tipo_pago").change(function () {
          
    $("#tipo_pago option:selected").each(function () {
      m_cuotas = $(this).val();
      $.post('ajax/ventas.php?op=monto_cuotas', { m_cuotas: m_cuotas }, function(data){
        $("#plazo").html(data);
      });            
    });
  })
});


function get_correlativo_venta(){
  let sucursal_correlativo = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  $.ajax({
    url:"ajax/ventas.php?op=get_numero_venta",
    method:"POST",
    data:{sucursal_correlativo:sucursal_correlativo,sucursal_usuario:sucursal_usuario},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);        
      $("#n_venta").val(data.correlativo);             
      }
    })
}

var detalles = [];
function agregarDetalleVenta(id_producto,id_ingreso){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_aros_venta",
  method:"POST",
  data:{id_producto:id_producto,id_ingreso:id_ingreso},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);

    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : id_ingreso,
      stock    : data.stock,
      descripcion    : data.desc_producto,
      categoria_ub  : data.categoria_ub,
      num_compra : data.num_compra,
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      categoria_prod : data.categoria_producto
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
   $('#listar_aros_ventas').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax
}

var detalles = [];
function agregarServicioVenta(id_producto){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_servicios_venta",
  method:"POST",
  data:{id_producto:id_producto},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);

    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      descripcion    : data.servicio,
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      categoria_prod : "Servicio",
      cantidad : 1,
      codProd  : id_producto,
      categoria_ub  : "",
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      //categoria_prod : data.categoria_producto
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
   $('#listar_servicios_ventas').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax
}

///////////AGEREGAR ACCESORIOS A LA VENTA
var detalles = [];
function agregarAccVenta(id_producto,id_ingreso){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_accesorios_venta",
  method:"POST",
  data:{id_producto:id_producto,id_ingreso:id_ingreso},
  cache: false,
  dataType:"json",
  success:function(data){
   // console.log(data);

 existe_lentes_aros=[];
  for(var i=0;i<detalles.length;i++){
    
    var aro_lente = detalles[i].categoria_prod;
    
    if (aro_lente=="ARO" || aro_lente=="LENTES"){
      existe_lentes_aros.push(aro_lente);
    }
  }
  var long_items = existe_lentes_aros.length;
  if (long_items>0) {
    precio_v=0;
  }else{
    precio_v=data.precio_venta;
  }


    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : id_ingreso,
      stock    : data.stock,
      descripcion    : data.desc_producto,
      categoria : data.categoria,
      categoria_ub  : data.categoria_ub,
      num_compra : data.num_compra,
      precio_venta  : precio_v,
      subtotal : 0,
      descuento : 0,
      categoria_prod : ""
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
   $('#listar_accesorios_ventas').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajaxsaveV
}

function agregar_detalles_lente_venta(id_producto){
  var consulta = $("#id_consulta").val();
  if(consulta !=""){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_lentes_venta",
  method:"POST",
  data:{id_producto:id_producto},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);
     
    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : "",
      stock    : 0,
      descripcion    : data.desc_producto,
      categoria_ub  : "",
      num_compra : "",
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      categoria_prod : data.categoria_producto
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
    $('#listar_lentes_ventas').modal("hide");
    $('#listar_ar_ventas').modal("hide");
    $('#listar_photo_ventas').modal("hide");
    //console.log(detalles);
    }//fin success
  });//fin de ajax
  
}else{
  Swal.fire('Error!. El paciente no posee consulta!','','error')

}
}

/////////////LISTAR DETALLE DE ITEM SELECCIONADOS
function listarDetallesVentas(){

    $('#listar_det_ventas').html('');

    var filas = "";
    //var subtotal = 0;
    var total = 0;

    for(var i=0; i<detalles.length; i++){

      var subtotal = detalles[i].subtotal = detalles[i].cantidad * detalles[i].precio_venta;
      var filas = filas + "<tr id='fila"+i+"'><td>"+(i+1)+
      "</td><td style='text-align:center;'>"+detalles[i].descripcion+
      "</td><td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'>"+
      "<td style='text-align:center'>"+"<span>$</span>"+detalles[i].precio_venta+"</td>"+
      "<td style='text-align:center'><input style='text-align:right' type='number' class='descuento form-control' id='descuento"+(i)+"' onClick='setDescuento(event, this, "+(i)+");' onKeyUp='validaCantidadDist(event, this, "+(i)+");' value='"+detalles[i].descuento+"'>"+
      "</td><td style='text-align:center;'><span>$</span><span style='text-align:right' name='subtotal[]' id=subtotal"+i+" >"+detalles[i].subtotal.toFixed(2)+"</span><td style='text-align:center'><i class='nav-icon fas fa-times-circle fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>";

    //subtotal = subtotal + importe;

  }//cierre for
  $('#listar_det_ventas').html(filas);
  calcularTotales();
}

function setCantidad(event, obj, idx){
    event.preventDefault();
    detalles[idx].cantidad = parseInt(obj.value);
    recalcular(idx);
}

function recalcular(idx){

    console.log(detalles[idx].cantidad);
    console.log((detalles[idx].cantidad * detalles[idx].precio_venta));
    var subtotal =detalles[idx].subtotal = detalles[idx].cantidad * detalles[idx].precio_venta;
    console.log(subtotal.toFixed(2));
    subtotal = detalles[idx].subtotal = (detalles[idx].subtotal - detalles[idx].descuento);
    subtotalFinal = subtotal.toFixed(2);
    $('#subtotal'+idx).html(subtotalFinal);
  calcularTotales();
  }

function setDescuento(event, obj, idx){
    event.preventDefault();
    var desc = document.getElementById("descuento"+idx).value;
    var desc_n = parseInt(desc);
     if(desc_n>200){
      Swal.fire('Error!, Ha excedido el limite de descuento autorizado','','error')
      document.getElementById("descuento"+idx).value="";
      document.getElementById("descuento"+idx).style.border='solid 1px red';
     }else if(desc_n<=200){
    detalles[idx].descuento = parseFloat(obj.value);
    document.getElementById("descuento"+idx).style.border='solid 1px green';
    recalcular(idx);
  }
}

function calcularTotales() {
  var total_final=0;
  for(var i=0;i<detalles.length;i++){
    total_final=total_final+detalles[i].subtotal;
  }
  $('#total_venta').html(total_final.toFixed(2));
  console.log(total_final);
}

function eliminarFila(index) {
  $("#fila" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  detalles.splice(position_element, 1);
  //recalcular(position_element);
  calcularTotales();

}

$(document).on("click","#select_paciente_venta", function(){
  var consulta = $("#consulta_ex").val();
  var tipo_venta = $("#tipo_venta").val();
  
  if(tipo_venta != "Credito Fiscal"){
    if(consulta==''){
    setTimeout ("Swal.fire('Hay campos sin seleccionar','','error')", 100);
    document.getElementById("consulta_ex").style.border='solid 1px red';
  }else if(consulta=='Si'){
    $("#modal_pacientes_consulta").modal("show");
    listar_pacientes_consultas_ventas();
  }else if(consulta=='No'){
    $("#pacientes_sin_consulta").modal("show");
    listar_pacientes_sin_consultas_ventas();
  }

}else{

  show_pacientes_empresas();
}

});

//////////////////LISTAR PACIENTES CON CONSULTAS EN VENTAS

function listar_pacientes_consultas_ventas(){

  let sucursal = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  tabla_paciente_venta= $('#data_pacientes_consulta').DataTable({      
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
      url:"ajax/pacientes.php?op=listar_pacientes_consulta",
      type : "POST",
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

          //"scrollX": true

        });
}

//////////////////LISTAR PACIENTES SIN CONSULTAS EN VENTAS

function listar_pacientes_sin_consultas_ventas(){
  var sucursal = $("#sucursal").val();
  tabla_paciente_no_consulta= $('#data_pacientes_sin_consulta').DataTable({      
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
      url:"ajax/pacientes.php?op=listar_pacientes_sin_consulta",
      type : "POST",
      //dataType : "json",
      data:{sucursal:sucursal},           
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
}

///////////////////SHOW CONTRIBUYENTES 
function show_pacientes_empresas(){
  $("#contribuyente_credito_fiscal").modal("show");
    tabla_contribuyentes= $('#data_contribuyentes_fisc').DataTable({      
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
      url:"ajax/empresas.php?op=listar_contribuyentes",
      type : "get",
      dataType : "json",
      //data:{sucursal:sucursal},           
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

}

var data_oid = [];

function saveVenta(){
  var tipo_pago = $("#tipo_pago").val();
  var tipo_venta = $("#tipo_venta").val();
  let plazo = $("#plazo").val();
   var id_user=$("#usuario").val();
  let id_usuario = id_user.toString();
  if (id_usuario == 0 || id_usuario == "") {
      Swal.fire('Debe seleccionar vendedor','','error');
      return false;
  }

  if (tipo_venta=="Contado") {
    registrarVenta();
    //$('#recibo_inicial').modal('show');
    //setTimeout ("mostrar_recibo_inicial();", 2000);
  }else if(tipo_venta=="Credito" && tipo_pago=="Descuento en Planilla"){
    get_correlativo_orden();
    buscar_existe_oid();
    //$("#oid").modal("show");    
    //let id_paciente = $("#id_paciente").val();
    
  }else if(tipo_venta=="Credito" && tipo_pago=="Cargo Automatico"){
   get_correlativo_orden();
   document.getElementById("tipo_tarjeta").style.display = "block";
   document.getElementById("numero_tarjeta").style.display = "block";
   document.getElementById("vencimiento_tarjet").style.display = "block";
   data_cargo_form();
  }
}



function buscar_existe_oid(){
  //$("#advertencia_creditos").modal("show");
  let id_paciente = $("#id_paciente").val();
  let paciente = $("#titular_cuenta").val();
  let evaluado = $("#evaluado").val();
  let tipo_pago = $("#tipo_pago").val();
  $.ajax({
  url:"ajax/creditos.php?op=buscar_existe_oid",
  method:"POST",
  data:{id_paciente:id_paciente,tipo_pago:tipo_pago},
  cache:false,
  dataType:"json",
  success:function(data){ 
  console.log(data);
//==========VALIDACION SI EXISTE CREDITO===========//
    var n_orden_add = data.numero_orden;
    var emp_tit = data.empresas;
    $("#n_orden_add").val(data.numero_orden);
    var tipo_pago = $("#tipo_pago").val();
    var tipo_venta = $("#tipo_venta").val();
    let plazo = $("#plazo").val();
    let pac_evaluado = $("#evaluado").val();
    console.log(pac_evaluado);
    get_plazo_orden(n_orden_add,id_paciente);

    if (data != "No") { //==========SI CONSULTA RETORNA QUE EXISTE ORDEN========//
      console.log("existe credito");
      $("#advertencia_creditos").modal("show");
      $("#tit_add_tit").html(paciente);
      $("#eval_add_tit").html(evaluado);
      

      $.ajax({//================SE HACE LA CONSULTA SI EXISTE CREDITO
      url:"ajax/creditos.php?op=get_saldos_oid",
      method:"POST",
      data:{id_paciente:id_paciente},
      cache:false,
      dataType:"json",
      success:function(data){      
      var monto_total = $("#total_venta").html();      
      $("#empresa_add_tit").html(emp_tit);      
      let saldos_act = data.saldos;
      if(saldos_act>0) {      
      let n_saldo = parseFloat(monto_total)+parseFloat(saldos_act);
      let new_sal = parseInt(n_saldo.toFixed(2));
        $("#nuevo_saldo_add").html("$"+n_saldo.toFixed(2))
        $("#saldo_act_add").html("$"+data.saldos);
      }else{
        $("#nuevo_saldo_add").html("$00.00");
        $("#saldo_act_add").html("$00.00");
      }        
    }
  })
  }else{
    $("#oid").modal("show");
    var n_orden_add = data;
    $("#n_orden_add").val(data);
    var tipo_pago = $("#tipo_pago").val();
    var tipo_venta = $("#tipo_venta").val();
    let plazo = $("#plazo").val();  
    console.log("FFFFFFFF000000")
    document.getElementById("print_manual_oid").style.display = "block";
    let id_paciente = $("#id_paciente").val();
    $.ajax({
    url:"ajax/ventas.php?op=show_datos_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    console.log(data);   
      $("#paciente_empresarial").val(data.nombres);
      $("#edad_pac").val(data.edad);
      $("#tel_pac").val(data.telefono);
      $("#dui_pac").val(data.dui);
      $("#plazo_credito").val(plazo);
      $("#benef_empresarial").val(pac_evaluado);
    }
    })
      }
    }
}) 
    
}


function data_cargo_form(){

    $("#oid").modal("show");
    let id_paciente = $("#id_paciente").val();    
    let tipo_pago = $("#tipo_pago").val();
    let tipo_venta = $("#tipo_venta").val();
    let plazo = $("#plazo").val();
    let evaluado = $("#evaluado").val();  
    console.log("FFFFFFFF000000")
    document.getElementById("print_manual_oid").style.display = "block";
    $.ajax({
    url:"ajax/ventas.php?op=show_datos_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    console.log(data);   
      $("#paciente_empresarial").val(data.nombres);
      $("#edad_pac").val(data.edad);
      $("#tel_pac").val(data.telefono);
      $("#dui_pac").val(data.dui);
      $("#plazo_credito").val(plazo);
      $("#benef_empresarial").val(evaluado);      
    }
    })
}


function get_plazo_orden(n_orden_add,id_paciente){    
  ///////////GET PLAZO ACTUAL DE ORDEN CREDITO //////
  $.ajax({
      url:"ajax/creditos.php?op=get_det_orden",
      method:"POST",
      data:{n_orden_add:n_orden_add,id_paciente:id_paciente},
      cache:false,
      dataType:"json",
      success:function(data){ 
      console.log(data);
      let plazo_orden = $("#plazo_acts").val();
      document.getElementById("plazo_acts").placeholder = "Plazo Actual: "+data.plazo+" Meses";
      $("#plazo_acts_1").val(data.plazo);      
  }
  });

}

function newOrden(){
    $("#advertencia_creditos").modal("hide");
    $("#oid").modal("show");
    console.log("FFFFFFFF000000")
    document.getElementById("print_manual_oid").style.display = "block";
    let id_paciente = $("#id_paciente").val();
    $.ajax({
    url:"ajax/ventas.php?op=show_datos_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    console.log(data);   
      $("#paciente_empresarial").val(data.nombres);
      $("#edad_pac").val(data.edad);
      $("#tel_pac").val(data.telefono);
      $("#dui_pac").val(data.dui);
      $("#plazo_credito").val(plazo);
    }
    })
}

//AGREGAR BENEFICIARIO EN DESCUENTO EN L¿
function add_beneficiario_oid(){

  let n_orden_add = $("#n_orden_add").val();
  var fecha_venta = $("#fecha").val();  
  var numero_venta = $("#n_venta").val();
  var paciente = $("#titular_cuenta").val();  
  var monto_total = $("#total_venta").html();
  var tipo_pago = $("#tipo_pago").val();
  var tipo_venta = $("#tipo_venta").val();  
  var id_paciente = $("#id_paciente").val();
  var sucursal = $("#sucursal").val();
  var evaluado = $("#evaluado").val();
  var optometra = $("#optometra").val();
  var plazo = $("#plazo").val();
  var id_ref = $("#id_refererido").val();
  var nuevo_saldo_add = $("#nuevo_saldo_add").html();
  var id_user= $("#usuario").val();
  let id_usuario = id_user.toString();
  var vendedor = id_user.toString();;

  let plazo_orden = $("#plazo_acts").val();

  console.log(plazo_orden);


  if (plazo_orden != "") {
    var new_plazo = plazo_orden;
  }else{
    var new_plazo = $("#plazo_acts_1").val();
  }

  var test_array = detalles.length;
      if (test_array<1) {
      Swal.fire('Debe Agregar Productos a la Venta!','','error')
      return false;
}


$('#listar_det_ventas').html('');
    $.ajax({
    url:"ajax/ventas.php?op=agregar_benefiaciario_oid",
    method:"POST",
    data:{'arrayVenta':JSON.stringify(detalles),'fecha_venta':fecha_venta,'numero_venta':numero_venta,'paciente':paciente,'vendedor':vendedor,'monto_total':monto_total,
    'tipo_pago':tipo_pago,'tipo_venta':tipo_venta,'id_usuario':id_usuario,
    'id_paciente':id_paciente,'sucursal':sucursal,'evaluado':evaluado,'optometra':optometra,'plazo':plazo,"id_ref":id_ref,'n_orden_add':n_orden_add,'nuevo_saldo_add':nuevo_saldo_add,new_plazo:new_plazo},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
    if(data == "ok"){
      Swal.fire('Un nuevo beneficiario se agregado a la orden...Esperar aprobación!','','info');
      $("#advertencia_creditos").modal("hide");
      //ocultar_btn_post_venta();
    }
    }

});//////FIN AJAX
}
/////////////////REGISTRAR PRIMERA OID
data_oid = [];
function guardar_oid(){
    
    let prima_oid = $("#prima_oid").val();
    let observaciones_oid = $("#observaciones_oid").val();
    if (prima_oid == '0') {
      Swal.fire('Debe especificar SI/NO existe prima inicial!','','warning');
      return false;
    }else if(prima_oid == 'Si'){
      Swal.fire('Debe realizar un abono inicial obligatoriamente!','','warning');
     // document.getElementById("iprima_oid").style.display = "inline";
    }else if(prima_oid == 'Si' && observaciones_oid==""){
      Swal.fire('El campo observaciones debe contener una descripcion!','','warning');
      return false;
    }

    let sucursal_usuario = $("#sucursal_usuario").val();
    let id_paciente = $("#id_paciente").val();
    let fecha_inicio = $("#fecha_inicio").val();
    let plazo_credito = $("#plazo_credito").val();
    let empresa = $("#empresa").val();
    let funcion_laboral = $("#funcion_laboral").val();
    let edad_pac = $("#edad_pac").val();
    let dui_pac = $("#dui_pac").val();
    let nit_pac = $("#nit_pac").val();
    let tel_pac = $("#tel_pac").val();
    let tel_of_pac = $("#tel_of_pac").val();
    let corre_pac = $("#corre_pac").val();
    let direccion_pac = $("#direccion_pac").val();
    let ref_1 = $("#ref_1").val();
    let tel_ref1 = $("#tel_ref1").val();
    let ref_2 = $("#ref_2").val();
    let tel_ref2 = $("#tel_ref2").val();
    let codigo = $("#correlativo_orden").html();
    let numero_venta = $("#n_venta").val();
    let sucursal = $("#sucursal").val();
    let tipo_venta = $("#tipo_venta").val();
    let tipo_pago = $("#tipo_pago").val();
    let tipo_tarjeta_c = $("#tipo_tarjeta_c").val();
    let numero_tarjeta_c = $("#numero_tarjeta_c").val();
    let vencimiento_tarjeta_c = $("#vencimiento_tarjeta_c").val();

    if((tipo_pago == "Cargo Automatico") && (tipo_tarjeta_c == "" || numero_tarjeta_c == "" || vencimiento_tarjeta_c == "")){
        setTimeout ("Swal.fire('Campos de tarjeta vacia','','error')", 100);
        return false;
    }

    if (tipo_pago=="Descuento en Planilla" && (empresa == "" || funcion_laboral =="")) {
       setTimeout ("Swal.fire('Existen campos obligatorios vacios','','error')", 100);
       return false;
    }


    if(fecha_inicio !="" && edad_pac !="" && dui_pac !="" && tel_pac !="" && tel_of_pac !="" && direccion_pac !="" && ref_1 !="" && tel_ref1 !="" && ref_2 !="" && tel_ref2 !=""){
      var obj = {
        id_paciente:id_paciente,
        fecha_inicio:fecha_inicio,
        plazo_credito:plazo_credito,
        empresa:empresa,
        funcion_laboral:funcion_laboral,
        edad_pac:edad_pac,
        dui_pac:dui_pac,
        nit_pac:nit_pac,
        tel_pac:tel_pac,
        tel_of_pac:tel_of_pac,
        corre_pac:corre_pac,
        direccion_pac:direccion_pac,
        ref_1:ref_1,
        tel_ref1:tel_ref1,
        ref_2:ref_2,
        tel_ref2:tel_ref2,
        codigo: codigo,
        observaciones_oid :observaciones_oid,
        sucursal_usuario:sucursal_usuario,
        tipo_pago:tipo_pago,
        tipo_tarjeta_c:tipo_tarjeta_c,
        numero_tarjeta_c:numero_tarjeta_c,
        vencimiento_tarjeta_c:vencimiento_tarjeta_c
    }

    data_oid.push(obj);
    //console.log(data_oid);
    document.getElementById("btn_reg_orden").style.display = "none";
    document.getElementById("print_pagare").href='imprimir_pagare_pdf.php?n_orden='+codigo+'&'+'n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal_usuario;
    if(tipo_pago=="Descuento en Planilla"){
          document.getElementById("print_orden_descplanilla").href='print_oid_v.php?n_orden='+codigo+'&'+'n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal_usuario;
          document.getElementById("iprima_oid").style.display = "inline";
    
    }else if(tipo_pago=="Cargo Automatico"){
         document.getElementById("print_orden_descplanilla").href='print_cauto.php?n_orden='+codigo+'&'+'n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal_usuario;
         document.getElementById("iprima_oid").style.display = "inline";
    }

    setTimeout("show_btn_print_oid();",1500);

    registrarVenta();
    //get_correlativo_orden();
  }else{
    Swal.fire('Hay campos obligatorios vacios','','error');
    return false;
  }

  ///////////VALDAR SI EXISTE ABONO INICIAL
}
///////////FINALIZA GUARDAR OID ///////////////


$(document).on('keyup', '#tel_ref2', function(){
  get_correlativo_orden();
});


function show_btn_print_oid(){
  document.getElementById("print_orden_descplanilla").style.display = "block";
  document.getElementById("print_pagare").style.display = "block";
  document.getElementById("print_manual_oid").style.display = "block";
}


function get_correlativo_orden(){
  let sucursal = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  let tipo_pago = $("#tipo_pago").val();
    $.ajax({
    url:"ajax/ventas.php?op=get_correlativo_orden",
    method:"POST",
    data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario,tipo_pago:tipo_pago},
    cache:false,
    dataType:"json",
    success:function(data){ 
    console.log(data);   
      $("#correlativo_orden").html(data);

    }
  })
}
/**************************************************************************
***************************  INICIO REGISTRAR VENTAS  *********************
**************************************************************************/

function registrarVenta(){

  var fecha_venta = $("#fecha").val();  
  var numero_venta = $("#n_venta").val();
  var paciente = $("#titular_cuenta").val();
  var vend = $("#usuario").val();
  var monto_total = $("#total_venta").html();
  var tipo_pago = $("#tipo_pago").val();
  var tipo_venta = $("#tipo_venta").val();
  //var id_usuario = $("#usuario").val();
  var id_paciente = $("#id_paciente").val();
  var sucursal = $("#sucursal").val();
  var evaluado = $("#evaluado").val();
  var optometra = $("#optometra").val();
  var plazo = $("#plazo").val();
  var id_ref = $("#id_refererido").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  let vendedor = vend.toString();
  var id_user=$("#usuario").val();
  let id_usuario = id_user.toString();
  if (id_usuario == 0 || id_usuario == "") {
      Swal.fire('Debe seleccionar vendedor','','error');
      return false;
  }

  if (tipo_venta=="Credito" && tipo_pago == "Descuento en Planilla") {

  }

  if (tipo_venta == "Credito" && plazo =="0") {
    setTimeout ("Swal.fire('Debe seleccionar el plazo','','error')", 100);
    return false;
  }

  var test_array = detalles.length;
  if (test_array<1) {
  Swal.fire('Debe Agregar Productos a la Venta!','','error')
  return false;
}
//VALIDAMOS EL TIPO DE VENTA

/*****SI VENTA ES CONTADO****/

if (paciente !="" && tipo_pago !=""  && tipo_venta !="") {
  $('#listar_det_ventas').html('');
   document.getElementById("btn_de_compra").style.display = "none";

    $.ajax({
    url:"ajax/ventas.php?op=registrar_venta",
    method:"POST",
    data:{'arrayVenta':JSON.stringify(detalles),'arrayOid':JSON.stringify(data_oid),'fecha_venta':fecha_venta,'numero_venta':numero_venta,'paciente':paciente,'vendedor':vendedor,'monto_total':monto_total,'tipo_pago':tipo_pago,'tipo_venta':tipo_venta,'id_usuario':id_usuario,'id_paciente':id_paciente,'sucursal':sucursal,'evaluado':evaluado,'optometra':optometra,'plazo':plazo,"id_ref":id_ref,'sucursal_usuario':sucursal_usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
    //return false;       
    detalles = [];
    if(data == "error"){
      Swal.fire('La venta no se pudo realizar por que el correlativo ya fue registrado... Intentar actualizar el navegador!','','error')
      setTimeout("$('#recibo_inicial').modal('hide');",3000)
      ocultar_btn_post_venta();
    }
    }

    });//////FIN AJAX
    
    if (tipo_venta=="Contado") {       
      setTimeout ("reciboInicial();", 2500);
      mostrar_btn_post_venta();        
    }else if(tipo_venta == "Credito" && tipo_pago == "Descuento en Planilla"){
      Swal.fire('OID Registrada a la espera de Aprobación...','','info');

    }else if(tipo_venta == "Credito" && tipo_pago == "Cargo Automatico"){
      Swal.fire('Cargo Automatico Registrado a la espera de Aprobación...','','info');

    }
}else{
  Swal.fire('Existen campos obligatorios vacios!','','error')
}

}

/**************************************************************************
=============================  FIN REGISTRAR VENTAS =======================
***************************************************************************/

function desc_planilla(){
  
}


function reciboInicial(){
  $('#recibo_inicial').modal('show');
  var numero_venta = $("#n_venta").val();
  var id_paciente = $("#id_paciente").val();
  var evaluado = $("#evaluado").val();
  var titular_cuenta = $("#titular_cuenta").val();
  var monto_total = $("#total_venta").html();


  $("#n_venta_recibo_ini").val(numero_venta);
  $("#id_pac_ini").val(id_paciente);
  $("#servicio_rec_ini").val(evaluado);
  $("#recibi_rec_ini").val(titular_cuenta);
  $("#monto_venta_rec_ini").val(monto_total);


  $.ajax({
  url:"ajax/ventas.php?op=get_datos_lentes_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  {

    console.log(data);  
    $("#lente_rec_ini").val(data.producto);
  }
  })
  ////////////////photo
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_photo_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#photo_rec_ini").val(data.producto);
  }
  })

    ////////////////antireflejante
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_ar_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#ar_rec_ini").val(data.producto);
  }
  })
      ////////////////aros
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_aros_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#marca_aro_ini").val(data.marca);
    $("#modelo_aro_ini").val(data.modelo);
    $("#color_aro_ini").val(data.color);
  }
  })
//////////////DATOS PACIENTE
  $.ajax({
  url:"ajax/pacientes.php?op=datos_pacientes_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#telefono_ini").val(data.telefono);
    $("#empresa_ini").val(data.empresas);
  }
  })

  
}///////////FIN FUNCION RECIBO INICIAL
///////////////////LISTADO GENERAL DE VENTAS
function reporte_ventas_gral(){
  var sucursal = $("#sucursal").val();
  var sucursal_usuario = $("#sucursal_usuario").val();
  tabla_ventas_gral=$('#lista_reporte_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ventas.php?op=listar_ventas_gral',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},
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


function detalleVentas(numero_venta,evaluado,id_paciente){
//console.log(numero_venta+id_paciente);
    $.ajax({
      url:"ajax/ventas.php?op=ver_detalle_venta",
      method:"POST",
      data:{numero_venta:numero_venta,id_paciente:id_paciente,evaluado:evaluado},
      cache:false,
      //dataType:"json",
      success:function(data)
      { 
      console.log(data)      
        $("#tabla_detalle_venta").html(data);
   
      }
    })

}


/////////////////AGREGA DATA CONTRIBUYENTES
function contribuyenteData(id_paciente,empresa){  

  $('#contribuyente_credito_fiscal').modal('hide');
  $('#id_paciente').val(id_paciente);
  $('#id_consulta').val("");
  $('#empresa_fisc').val(empresa);
  document.getElementById("paciente_evaluado_c").style.display = "none";  

    $.ajax({
      url:"ajax/pacientes.php?op=buscar_data_pacientes_sin_consulta_ventas",
      method:"POST",
      data:{id_paciente:id_paciente},
      dataType:"json",
      success:function(data){
      console.log(data);//return false;       
        
        $("#titular_cuenta").val(data.nombres);
        $("#evaluado").val("");
        $("#codigo_paciente").val(data.codigo);
        
      }
    })
}
/////////////COMPROBAR EL TIPO DE VENTA
$(document).on('click', '.enviar_venta', function(){
  var n_venta =$("#n_venta").val();
  var id_paciente =$("#id_paciente").val();
  var empresa_fisc = $("#empresa_fisc").val();
  var tipo_venta = $("#tipo_venta").val();
console.log(tipo_venta);
if (tipo_venta=="Credito Fiscal"){
  document.getElementById("credito_fiscal_print").href='imprimir_credito_fiscal_pdf.php?empresa='+empresa_fisc+'&'+'id_paciente='+id_paciente+'&'+'n_venta='+n_venta;
}
 
});


//function

init();