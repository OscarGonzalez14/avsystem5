function init(){
  listar_requicisiones();
}

$(document).keypress(function(e) {
    if(e.which == 13) {
        agregar_item_requi();
    }
});

var item_req =[];

function agregar_item_requi(){
 
   var descripcion = $("#desc_requi").val();
   var cantidad = $("#cant_requi").val();
  
   if(descripcion !="" && cantidad !=""){

    var item = {
      descripcion : descripcion,
      cantidad : cantidad
    };

    item_req.push(item);
    console.log(item_req);
    
      $("#desc_requi").val("");
      $("#cant_requi").val("");
      $("#precio_requi").val("");

    }else{
      Swal.fire('Error!. Campos vacios!','','error')
    }

    document.getElementById("desc_requi").focus();
    lista_items_requisicion();

}

function lista_items_requisicion(){

  $('#listar_det_items_requisicion').html('');

  for(var i=0; i<item_req.length; i++){
    var filas = filas + "<tr id='fila"+i+"'><td>"+(i+1)+
    "</td><td style='text-align:center;'>"+item_req[i].descripcion+
    "<td style='text-align:center'>"+item_req[i].cantidad+"</td>"+
    "<td style='text-align:center'><i class='nav-icon fas fa-times-circle fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>";

  }

    $('#listar_det_items_requisicion').html(filas);

}


function eliminarFila(index) {
  $("#fila" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  item_req.splice(position_element, 1);
  //recalcular(position_element);
  calcularTotales();

}

function get_correlativo_requisiciones(){
  var sucursal = $("#sucursal").val();
  console.log(sucursal);
  $.ajax({
    url:"ajax/caja.php?op=get_numero_requisicion",
    method:"POST",
    data:{sucursal:sucursal},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);        
      $("#n_requisicion").html(data.correlativo);             
      }
    })
}


function registrar_requisicion(){

  var cuenta_elem = item_req.length;
    var fecha_req = $("#fecha_requi").val();
    var numero_req = $("#n_requisicion").html();
    var sucursal = $("#sucursal").val();
    var usuario = $("#usuario").val();
    //var precio = $("#precio_requi").val();
    //var cantidad = $("#cant_requi").val();

  if(cuenta_elem > 0 && numero_req !=""){

  $.ajax({
    url:"ajax/caja.php?op=registrar_req",
    method:"POST",
    data:{'arrayRequisicion':JSON.stringify(item_req),'fecha_req':fecha_req,'numero_req':numero_req,'sucursal':sucursal,'usuario':usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      if(data=='ok'){
       setTimeout ("Swal.fire('Requicisión creada Existosamente','','success')", 100);
       setTimeout ("explode();", 2000); 
      }else{
        setTimeout ("Swal.fire('Correlativo Duplicado','','error')", 100);
      }


    }

    });//////FIN AJAX
    
   }else{
    Swal.fire('Error!. Requisión vacía o Correlativo incorrecto!','','error')
   }
}

  function explode(){
    location.reload();
  }

function listar_requicisiones(){

  var sucursal = $('#sucursal').val();

  tabla_requi_general=$('#data_requisiciones').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla

      columnDefs: [
          {"targets": [0],
            "visible": false,
            "searchable": false
          },
        ],
        rowReorder: {
        selector: 'td:nth-child(2)'
        },
        responsive: true,
buttons: [
        {
            extend: 'excel',
            text: 'Descargar Excel',
            className: 'btn btn-success',
 
            exportOptions: {
                columns:  ':not(:last-child)'
            }
        }],
    "ajax":
        {
          url: 'ajax/caja.php?op=listar_requisiciones',
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
    "iDisplayLength":25,//Por cada 10 registros hace una paginación
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
       
          "sSearch":         "",
       
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

function listar_requicisiones_pendientes(){

  //var sucursal = $('#sucursal').val();

  tabla_requi_pendientes=$('#data_requisiciones').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla

      columnDefs: [
          {"targets": [0],
            "visible": false,
            "searchable": false
          },
        ],
        rowReorder: {
        selector: 'td:nth-child(2)'
        },
        responsive: true,
buttons: [
        {
            extend: 'excel',
            text: 'Descargar Excel',
            className: 'btn btn-success',
 
            exportOptions: {
                columns:  ':not(:last-child)'
            }
        }],
    "ajax":
        {
          url: 'ajax/caja.php?op=listar_requisiciones_pendientes',
          type : "get",
          dataType : "json",
          //data:{sucursal:sucursal},         
          error: function(e){
            console.log(e.responseText);  
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength":25,//Por cada 10 registros hace una paginación
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
       
          "sSearch":         "",
       
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

var items_requisicion = [];
function show_datos_requi(id_requisicion,n_requisicion){

  $(".n_requisicion").html(n_requisicion);

 let cat_user = $("#cat_user").val();

 if (cat_user=="administrador") {

    $.ajax({
      url:"ajax/caja.php?op=get_data_requisicion_admin",
      method:"POST",
      data:{n_requisicion:n_requisicion},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        console.log(data);
        for(var i in data){ 
          //console.log(data[i].descripcion);
          //console.log(data[i].cantidad);
          //console.log(data[i].precio);
          var obj = {
            id_detalle : data[i].id_detalle_req,
            descripcion : data[i].descripcion,
            cantidad : data[i].cantidad,
            precio : data[i].precio,
            estado : "No"

          };//FIN OBJ
          items_requisicion.push(obj);
        }
        lista_items_requisicion_pendientes();
      }
    })
 }

}

function clear_items_req(){
    console.log("holaa");
  items_requisicion.length = 0;
  item_est_uno.length = 0;
    item_est_dos.length = 0;

}

function lista_items_requisicion_pendientes(){
 
    $('#det_items_requisicion_admin').html('');
    var filas = "";

    for(var i=0; i<items_requisicion.length; i++){
      var filas = filas + "<tr id='fila"+i+"'><td style='width: 5%'>"+"<input class='hemograma' type='checkbox' name='check_box' value='hemograma' id=item"+i+" onClick='item_check(event, this, "+(i)+");'></td>"+
      "<td style='text-align:center;width: 60% !important'>"+items_requisicion[i].descripcion+"</td>"+
      "<td style='text-align:center;width: 20% !important'>"+"<input style='text-align:left' type='number' class='form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidadItem(event, this, "+(i)+");' onKeyUp='setCantidadItem(event, this, "+(i)+");' value='"+items_requisicion[i].cantidad+"'>"+"</td>"+"</tr>";
    }

    $('#det_items_requisicion_admin').html(filas);

}


//////////////////COMPROBAR SI CHECKBOX IS ACTIVATE
function item_check(event, obj, idx){ 
    //event.preventDefault();
    var desc = document.getElementById("item"+idx).value;
    let x = "item"+idx;

 if (document.getElementById(x).checked){
    items_requisicion[idx].estado = "Ok";
 }else{
  items_requisicion[idx].estado = "No";
 }
}
////
function setCantidadItem(event, obj, idx){
    event.preventDefault();
    items_requisicion[idx].cantidad = parseInt(obj.value);
    //recalcular(idx);
}
///////////////////////APROBAR REQUICISION 

function aprobar_requisicion(){

    let usuario = $("#usuario").val();
    let n_requisicion = $(".n_requisicion").html();

  $.ajax({
    url:"ajax/caja.php?op=aprueba_requisicion",
    method:"POST",
    data:{'arrayAprobados':JSON.stringify(items_requisicion),'usuario':usuario,'n_requisicion':n_requisicion},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      if(data=='ok'){
       setTimeout ("Swal.fire('La requisicion ha sido Aprobada','','success')", 100);
       setTimeout ("explode();", 2000); 
      }

    }

    });//////FIN AJAX
    
}

///////////////////////ACEPTAR REQUICISION 

function aceptar_requisicion(){

    let usuario = $("#usuario").val();
    let n_requisicion = $(".n_requisicion").html();

  $.ajax({
    url:"ajax/caja.php?op=acepta_requisicion",
    method:"POST",
    data:{n_requisicion:n_requisicion},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      if(data=='ok'){
       setTimeout ("Swal.fire('La requisicion ha sido Aprobada','','success')", 100);
       setTimeout ("explode();", 2000); 
      }

    }

    });//////FIN AJAX
    
}

function finalizar_requisicion(){

    let usuario = $("#usuario").val();
    let n_requisicion = $(".n_requisicion").html();
    let sucursal = $("#sucursal").val();
    let monto = $("#total_caja").html();

  $.ajax({
    url:"ajax/caja.php?op=finaliza_requisicion",
    method:"POST",
    data:{'arrayFinalizarReq':JSON.stringify(item_est_dos),'usuario':usuario,'n_requisicion':n_requisicion,'sucursal':sucursal,'monto':monto},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      if(data=='ok'){
       setTimeout ("Swal.fire('La requisicion ha sido Ingresada al corte','','success')", 100);
       setTimeout ("explode();", 2000); 
      }else{
        setTimeout ("Swal.fire('Saldo de Caja chica es menor a gasto actual','','error')", 100);
       
      }

    }

    });//////FIN AJAX
    
}

var item_est_uno = [];
var item_est_dos = [];

function actions_requisicions(id_requisicion,n_requisicion,estado){

  console.log(estado);
  if (estado==1) {
  $(".n_requisicion").html(n_requisicion);
  $("#modal_estado_uno").modal("show");
    $.ajax({
      url:"ajax/caja.php?op=data_req_est_uno",
      method:"POST",
      data:{n_requisicion:n_requisicion},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        console.log(data);
        for(var i in data){ 
         var obj = {
            id_detalle : data[i].id_detalle_req,
            descripcion : data[i].descripcion,
            cantidad : data[i].cantidad,
            precio : data[i].precio,
            estado : data[i].estado,
    
          };//FIN OBJ
          item_est_uno.push(obj);
        }
        lista_items_est_uno();
      }
      
    })
    console.log(item_est_uno);
  }else if(estado==2){
    $(".n_requisicion").html(n_requisicion);
    $("#modal_estado_dos").modal("show");
    $.ajax({
      url:"ajax/caja.php?op=data_req_est_uno",
      method:"POST",
      data:{n_requisicion:n_requisicion},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        for(var i in data){ 
         var obj = {
            id_detalle : data[i].id_detalle_req,
            descripcion : data[i].descripcion,
            cantidad : data[i].cantidad,
            precio : 0,
            estado : data[i].estado,
            comprobante : ""

            
          };//FIN OBJ
          item_est_dos.push(obj);
        }
        lista_items_est_dos();
      }
    })
    console.log(item_est_dos);
  }
}


function lista_items_est_uno(){ 
    $('#det_modal_aprobada').html('');
    var filas = "";
    for(var i=0; i<item_est_uno.length; i++){
      var filas = filas +"<tr id='fila"+i+"'><td style='text-align:center;width: 60% !important'>"+item_est_uno[i].descripcion+"</td>"+
        "<td style='text-align:ce nter;width: 60% !important'>"+item_est_uno[i].cantidad+"</td>"+
      "<td style='text-align:center;width: 15%'>"+item_est_uno[i].estado+"</td>"+"</tr>";
    }

    $('#det_modal_aprobada').html(filas);
}

function lista_items_est_dos(){ 
    $('#det_modal_aceptada').html('');
    var filas = "";
    for(var i=0; i<item_est_dos.length; i++){
      if((item_est_dos[i].estado) != "No"){
      var filas = filas +"<tr id='fila"+i+"'><td style='text-align:center;width: 60% !important' colspan='60'>"+item_est_dos[i].descripcion+"</td>"+
        "<td style='text-align:center;width: 10% !important' colspan='10'>"+"<input style='text-align:left' type='text' class='form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidadItem(event, this, "+(i)+");' onKeyUp='setCantidadItem(event, this, "+(i)+");' value='"+item_est_dos[i].cantidad+"' readonly>"+"</td>"+
      "<td style='text-align:center;width: 10% !important' colspan='10'>"+"<input style='text-align:left' type='number' class='form-control' name='cantidad[]' id='cantidad[]' onClick='setPrecioItem(event, this, "+(i)+");' onKeyUp='setPrecioItem(event, this, "+(i)+");' value='"+item_est_dos[i].precio+"'>"+"</td>"+
      "<td style='text-align:center;width: 20% !important' colspan='20'>"+"<input style='text-align:left' type='text' class='form-control' onClick='setTicketItem(event, this, "+(i)+");' onKeyUp='setTicketItem(event, this, "+(i)+");' value='"+item_est_dos[i].comprobante+"' maxlength='4' placeholder='---- ultimos dígitos'>"+"</td>"+"</tr>";
    }
  }
    $('#det_modal_aceptada').html(filas);

}

function setPrecioItem(event, obj, idx){
  event.preventDefault();
    item_est_dos[idx].precio = parseFloat(obj.value);
    calcularTotales();

}

function setTicketItem(event, obj, idx){
  event.preventDefault();
    item_est_dos[idx].comprobante = obj.value;
    calcularTotales();

}

function calcularTotales() {
  var total_final=0;
  for(var i=0;i<item_est_dos.length;i++){
    total_final=total_final+item_est_dos[i].precio;
  }
  console.log(total_final);
  if (total_final>50) {
    setTimeout ("Swal.fire('Se ha excedido el gasto de Caja Chica','','error')", 100);
  }
  $('#total_caja').html(total_final.toFixed(2));
  
}

function deposito_caja(){
  let usuario = $("#usuario").val();
  let monto_deposito = $("#monto_deposito").val();
  let fecha = $("#fecha").val();
  let id_caja = $("#id_caja_chica").val();
  let sucursal = $("#sucursal").val();

  $.ajax({
    url:"ajax/caja.php?op=realiza_deposito_caja",
    method:"POST",
    data:{usuario:usuario,monto_deposito:monto_deposito,fecha:fecha,id_caja:id_caja,sucursal:sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      if(data=='ok'){
       setTimeout ("Swal.fire('Se ha realizado deposito a caja chica','','success')", 100);
       setTimeout ("explode();", 2000); 
      }else{
       setTimeout ("Swal.fire('No existen fondos para realizar deposito','','warning')", 100);
       return false;
      }

    }

    });//////FIN AJAX
    setTimeout ("Swal.fire('Se ha realizado deposito a caja chica','','success')", 100);
    setTimeout ("explode();", 2000); 

}

function get_id_caja_chica(){
  let sucursal = $("#sucursal").val();

  $.ajax({
    url:"ajax/caja.php?op=get_id_caja_chica",
    method:"POST",
    data:{sucursal:sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      $("#id_caja_chica").val(data.id_caja);
    }

    });//////FIN AJAX


  $.ajax({
    url:"ajax/caja.php?op=get_saldo_caja",
    method:"POST",
    data:{sucursal:sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
      $("#saldo_caja").html(data.saldo);
    }

    });//////FIN AJAX
    
}

function fecha_com(){
  fecha = $("#fecha_comision").val();
  $("#mesage").val(fecha);
}

function year_comision(){
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

init();