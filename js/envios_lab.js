
function init(){
  get_ordenes_retrasadas();
  get_numero_orden();
  count_states_orders();
  get_ordenes_general();
}
$(document).ready(ocultar_btns);

function ocultar_btns(){
  document.getElementById("btn_send_lab").style.display = "none";
  document.getElementById("btn_receive_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "none";
  document.getElementById("section_acciones").style.display = "none";
  document.getElementById("section_acciones").style.display = "block";
}

function get_numero_orden(){

  $.ajax({
      url:"ajax/laboratorios.php?op=get_correlativo_orden",
      method:"POST",
      cache:false,
      dataType:"json",
      success:function(data){
       console.log(data)   
       $("#correlativo_envio_lab").html(data.cod_orden);     
      }
  });
  document.getElementById("section_acciones").style.display = "none";
  document.getElementById("btn_new_order").style.display = "block";
  clear_form_orden();

}

function clear_form_orden(){
  
  var element = document.getElementsByClassName("clear_orden_i");

    for(i=0;i<element.length;i++){
      let id_element = element[i].id;
      document.getElementById(id_element).classList.remove('is-invalid');
      document.getElementById(id_element).classList.remove('is-valid');
      document.getElementById(id_element).value="";
    }
}

function registrarEnvioLab(){

    var clase = document.getElementsByClassName("validate");

    for(i=0;i<clase.length;i++){
      let val_element = clase[i].value;
      let id_element = clase[i].id;

      if(val_element==""){
        let elemento = document.getElementById(id_element);
        elemento.className += " is-invalid";
        alerts("warning");
        console.log(id_element)
        return false
      }else{
        let elemento = document.getElementById(id_element);
        document.getElementById(id_element).classList.remove('is-invalid');
        elemento.className += " is-valid";
      }
    }


  let cod_orden = $("#correlativo_envio_lab").html();
  let paciente = $("#paciente_orden_lab").val();
  let empresa = $("#empresa_lab").val();
  let laboratorio = $("#laboratorio_orden_lab").val();
  let lente = $("#lente_orden_lab").val();
  let modelo_aro = $("#modelo_aro_lab").val();
  let marca_aro = $("#marca_aro_lab").val();
  let color_aro = $("#color_aro_lab").val();
  let diseno_aro = "0";
  let user = $("#usuario_orden").val();
  let usuario = user.toString();
  let sucursal = $("#sucursal_orden_lab").val();
  let prioridad = $("#prioridad_orden_lab").val();
  let observaciones = $("#observaciones_orden_lab").val();

  //if (cod_orden != "" && paciente) {}
    $.ajax({
      url:"ajax/laboratorios.php?op=registrarEnvioLab",
      method:"POST",
      cache:false,
      data: {cod_orden:cod_orden,paciente:paciente,empresa:empresa,laboratorio:laboratorio,lente:lente,modelo_aro:modelo_aro,marca_aro:marca_aro,color_aro:color_aro,diseno_aro:diseno_aro,usuario:usuario,sucursal:sucursal,prioridad:prioridad,observaciones:observaciones},
      dataType:"json",
      success:function(data){
       console.log(data)   
       if(data == 'ok'){
        Swal.fire('Se ha registrado una orden a la lista de pendientes por enviar!','','success');
        $("#nueva_orden_lab_dos").modal('hide');
        count_states_orders();
        listar_ordenes_creadas();
       }else{
        Swal.fire('Orden ha sido modificada!','','success');
        $("#nueva_orden_lab_dos").modal('hide');
        count_states_orders();
        listar_ordenes_creadas();
       }     
      }
    });
}


$(document).on('keyup', '.is-invalid', function(){
let id  = $(this).attr("id");
document.getElementById(id).classList.remove('is-invalid');
document.getElementById(id).classList.add('is-valid');

});
$(document).on('click', '.is-valid', function(){
let id  = $(this).attr("value");
console.log(id)
if (id!="") {
  document.getElementById(id).classList.remove('is-invalid');
  document.getElementById(id).classList.add('is-valid');
}


});

function alerts(alert){
    Swal.fire('Existen Campos obligatorios vacios!','',alert);
}
////////////ORDENES ERECIBIDAS ////////
function listar_ordenes_creadas(){
  document.getElementById("head_th").style.background = "#C0C0C0";
  document.getElementById("header_title").style.color = "black";
  $("#acciones_orden").html("Acción");
  $("#col_seis").html("Fecha creación");
  let estado = "Creadas";
  let titulo = "ORDENES POR ENVIAR";
  let tabla = 'data_orders_lab';
  document.getElementById("btn_receive_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "none";  
  listar_ordenes(tabla,estado,titulo)
}
////////////////ORDENES ENVIADAS /////////
function listar_ordenes_enviadas(){
  let estado = "Enviadas";
  $("#header_title").html("ORDENES ENVIADAS");
  document.getElementById("head_th").style.background = "#0275d8";
  document.getElementById("header_title").style.color = "white";
  //let tabla = 'data_orders_lab';
  $("#col_cinco").html("Empresa");
  $("#col_diez").html("Tiempo transc.");
  $("#col_seis").html("Fecha Envío");
  document.getElementById("btn_send_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "none";
  document.getElementById("btn_receive_lab").style.display = "block";
  get_ordenes_enviadas_data(tabla);
}

function listado_ordenes_recibidas(){
  let estado = "Recibidas";
  $("#header_title").html("ORDENES RECIBIDAS");
  document.getElementById("head_th").style.background = "#007E93";
  document.getElementById("header_title").style.color = "white";
  $("#acciones_orden").html("Cod. orden");
  $("#col_cinco").html("Empresa");
  $("#col_seis").html("Fecha Recibido");
  $("#col_diez").html("Acciones");
  $("#col_nueve").html("Detalles");
  document.getElementById("btn_send_lab").style.display = "none";
  document.getElementById("btn_receive_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "block";
  get_ordenes_recibidas_data();
}

function get_ordenes_retrasadas(){
  $("#header_title").html("ORDENES RETRASADAS");
  document.getElementById("head_th").style.background = "#d9534f";
  document.getElementById("header_title").style.color = "white";
  $("#acciones_orden").html("Detalles");
  $("#col_ocho").html("prioridad");
  $("#col_diez").html("Retraso");
  $("#col_cinco").html("Empresa");
  $("#col_seis").html("Fecha Envío");
  $("#col_ocho").html("Estado");
  $("#col_nueve").html("Prioridad");
  document.getElementById("btn_send_lab").style.display = "none";
  document.getElementById("btn_receive_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "none";
  get_ordenes_retrasadas_data();
  count_states_orders();
}

function get_ordenes_entregadas(){
  $("#header_title").html("ORDENES ENTREGADAS");
  document.getElementById("head_th").style.background = "#00758F";
  document.getElementById("header_title").style.color = "white";
  $("#acciones_orden").html("# Orden");
  $("#col_cinco").html("Empresa");
  $("#col_seis").html("Fecha Entrega");
  $("#col_diez").html("Acciones");
  $("#col_nueve").html("Detalles");
  get_ordenes_entregadas_data();
}


function get_ordenes_aprobadas(){
  let estado = "Recibidas";
  $("#header_title").html("ORDENES APROBADAS");
  document.getElementById("head_th").style.background = "#007E93";
  document.getElementById("header_title").style.color = "white";
  $("#acciones_orden").html("");
  $("#col_cinco").html("Empresa");
  $("#col_diez").html("Acciones");
  $("#col_seis").html("Fecha Recibido");
  document.getElementById("btn_send_lab").style.display = "none";
  document.getElementById("btn_receive_lab").style.display = "none";
  document.getElementById("btn_entregar_lab").style.display = "block";
  get_ordenes_aprobadas_data();
}

function get_ordenes_general(){
$("#header_title").html("VERIFICACION DEl ESTADO DE LA ORDEN");
document.getElementById("head_th").style.background = "#00758F";
document.getElementById("header_title").style.color = "white";
$("#acciones_orden").html("Cod. orden");
$("#col_cinco").html("Empresa");
$("#col_seis").html("Fecha Envío");
$("#col_diez").html("Acciones");
$("#col_ocho").html("Estado");
$("#col_nueve").html("Detalles");
get_ordenes_general_data();
}
/////////////////////LISTAR ORDENES CREADAS - PENDIENTES
function listar_ordenes(tabla,estado,titulo){

$("#header_title").html(titulo);
tabla_envios_gral=$('#'+tabla).dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes',
          type : "post",
          dataType : "json",
          data:{estado:estado},
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
document.getElementById("btn_send_lab").style.display = "block";
}

/////////////////////   LISTAR ORDENES ENVIADAS ///////////////
function get_ordenes_enviadas_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes_enviadas',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
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

/////////////////////  LISTAR ORDENES RECIBIDAS ///////////////
function get_ordenes_recibidas_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes_recibidas',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
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

//////////////////  LISTAR ORDENES RETRASADAS ////////////////
function get_ordenes_retrasadas_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes_retrasadas',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
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
////////////////   LISTAR ORDENES ENTREGADOS ////
function get_ordenes_entregadas_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
        'excelHtml5'
      ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes_entregadas',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
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
/////////////////LISTAR ORDEENS APROBADAS
function get_ordenes_aprobadas_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
        'excelHtml5'
      ],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=get_ordenes_aprobadas',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
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

////////////////CREATE ARRAY SEND ORDENES //////
let items_envios_ord = [];

$(document).on('click', '.envio_orden_labs', function(){

  let codigo = $(this).attr("value");
  let paciente = $(this).attr("name");
  let id_item = $(this).attr("id");
  let checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;
  /****GET ESTADO ORDEN****/
  $.ajax({
  url:"ajax/laboratorios.php?op=get_estado_orden",
  method:"POST",
  data:{codigo:codigo},
  cache: false,
  dataType:"json",
  success:function(data){
    let estado = data;
    if (check_state == true) {
        let obj = {
         cod : codigo,
         paciente : paciente,
         state : estado 
       }
       items_envios_ord.push(obj);
    }else if(check_state == false){
    let indice = items_envios_ord.findIndex((objeto, indice, items_envios_ord) =>{
      return objeto.cod == codigo
    });

    items_envios_ord.splice(indice, 1)

  }



  }//fin success
  });//fin de ajax

});

///////CREATE ARRAY RECEIVED ORDERS ///////////cc
let items_received_ord = [];

$(document).on('click', '.receive_ordenes_lab', function(){
  let codigo = $(this).attr("value");
  let paciente = $(this).attr("name");
  let id_item = $(this).attr("id");

  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;

  if (check_state == true) {
        let obj = {
         codigo : codigo,
         paciente : paciente 
       }
       items_received_ord.push(obj);
  }else if(check_state == false){
  let index = items_received_ord.findIndex(x => x.cod==codigo)
  console.log(index)
  items_received_ord.splice(index, 1)
  }
  
});

var item_entregar_ordenes = [];
$(document).on('click', '.entregar_ordenes_lab', function(){

  let codigo = $(this).attr("value");
  let paciente = $(this).attr("name");
  let id_item = $(this).attr("id");

  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;

  if (check_state == true) {
        let obj = {
         codigo : codigo,
         paciente : paciente 
       }
       item_entregar_ordenes.push(obj);
  }else if(check_state == false){
  let index = item_entregar_ordenes.findIndex(x => x.cod==codigo)
  console.log(index)
  item_entregar_ordenes.splice(index, 1)
  }
  
});

//////////////////// REGISTRAR ENVIO ///////////////
function enviar_ordenes_lab(){  
  let cant_trabajos = items_envios_ord.length;
  if (cant_trabajos<1){
    Swal.fire('La orden de envíos está vacia!','','error');
    return false;
  }
  $("#confirm-envio").modal("show");
  $("#n_trabajos").html(cant_trabajos);  
}

////////////// REGISTRAR RECIBIR //////////////////
function recibir_ordenes_lab(){  
  let cant_trabajos_r = items_received_ord.length;
  if (cant_trabajos_r<1){
    Swal.fire('Debe agregar trabajos a la orden de recibidos!','','error');
    return false;
  }
  $("#confirm-receive").modal("show");
  $("#n_trabajos_r").html(cant_trabajos_r);  
}

function entregar_ordenes_lab(){  
  let cant_trabajos_entregar = item_entregar_ordenes.length;
  if (cant_trabajos_entregar<1){
    Swal.fire('Lista Vacía!','','error');
    return false;
  }
  $("#modal_entregas").modal("show");
  $("#n_trabajos_entregar").html(cant_trabajos_entregar);  
}

function registrarEnvio(){
  let user_envio = $("#usuario_envio").val();
  if (user_envio=="") {
    Swal.fire('Seleccionar usuario!','','error');
    return false;
  }
  
  let usuario = user_envio.toString(); 
  //let observaciones = $("#observaciones_envio").val();
  $("#confirm-envio").modal("hide");
  $.ajax({
    url:"ajax/laboratorios.php?op=registrar_envio",
    method:"POST",
    data:{'arrayDetEnvio':JSON.stringify(items_envios_ord),'usuario':usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
    if (data=='ok') {
      Swal.fire('Se ha registrado un envio a laboratorios!','','success');
      $('#data_orders_lab').DataTable().ajax.reload();
      listar_ordenes_creadas();
      count_states_orders();
      items_envios_ord = [];
      items_received_ord = [];

    }
    }

    });//////FIN AJAX

}

function recibirOrdenes(){
  let user_recibe = $("#usuario_recibe").val();
  if (user_recibe=="") {
    Swal.fire('Seleccionar usuario!','','error');
    return false;
  }
  
  let usuario = user_recibe.toString(); 
  //let observaciones = $("#observaciones_envio").val();
  $("#confirm-receive").modal("hide");
  $.ajax({
    url:"ajax/laboratorios.php?op=recibir_ordenes",
    method:"POST",
    data:{'arrayDetRecibe':JSON.stringify(items_received_ord),'usuario':usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);

    if (data=='ok') {
      Swal.fire('Orden de recibidos, registrados exitosamente!','','success');
      $('#data_orders_lab').DataTable().ajax.reload();
      get_ordenes_enviadas_data();
      count_states_orders();
      items_received_ord = [];
      items_envios_ord = [];

    }
    }

    });//////FIN AJAX

}
////////////////ENTREGAR ORDENES 

function entregarOrdenes(){
  let user_entrega = $("#usuario_entrega").val();
  if (user_entrega == "") {
   Swal.fire('Seleccionar usuario!','','error');
    return false; 
  }

  let usuario = user_entrega.toString(); 
  //let observaciones = $("#observaciones_envio").val();
  $("#modal_entregas").modal("hide");
  $.ajax({
    url:"ajax/laboratorios.php?op=entregar_ordenes",
    method:"POST",
    data:{'ordenesEntregarArray':JSON.stringify(item_entregar_ordenes),'usuario':usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
    if (data=='ok') {
      Swal.fire('Ordenes entregadas exitosamente!','','success');
      $('#data_orders_lab').DataTable().ajax.reload();
      count_states_orders();
      items_received_ord = [];
      items_envios_ord = [];
      item_entregar_ordenes = [];

    }
    }

    });//////FIN AJAX

}

//////////////////  
function count_states_orders(){
  $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_creadas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_creadas_ord").html(data);    
    }     
  });

  $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_enviadas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_enviadas_ord").html(data);    
    }     
  });

  $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_recibidas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_recibidos_ord").html(data);    
    }     
  });

    $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_aprobadas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_aprobados_ord").html(data);    
    }     
  });

  $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_retrasadas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_retrasados_ord").html(data);    
    }     
  });

  $.ajax({
    url:"ajax/laboratorios.php?op=count_ordenes_entregadas",
    method:"POST",
    //data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_entregados_ord").html(data);    
    }     
  });

}

/////////////// 
function controlCalidad(n_orden,paciente,id_orden){ 
 $("#paciente_orden_cc").html(paciente);
 $("#cod_orden_cc").val(n_orden);
 $("#id_orden_cc").val(id_orden); 
}

//////////// ACEPTAR ORDENES ////////////
function ccalidadOrden(accion){

  let numero_orden = $("#cod_orden_cc").val();
  let paciente = $("#paciente_orden_cc").html();
  let observaciones = $("#justificacion_calidad").val();
  let user = $("#usuario_cc").val();
  let usuario = user.toString();
  let id_orden = $("#id_orden_cc").val();

  if(usuario==""){Swal.fire('Seleccionar usuario!','','error'); return false}
  if (accion=='Reenviado' && observaciones=="") {
    Swal.fire('Debe especificar el motivo del reenvio!','','error');
    return false;
  }
 
  $("#modal_ccalidad").modal('hide');

  $.ajax({
    url:"ajax/laboratorios.php?op=aceptar_orden",
    method:"POST",
    data:{numero_orden:numero_orden,paciente:paciente,observaciones:observaciones,usuario:usuario,id_orden:id_orden,accion:accion},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $('#data_orders_lab').DataTable().ajax.reload();
    count_states_orders();        
    }     
  });

}

function detOrdenes(id_orden,cod_orden){
  document.getElementById("btn_new_order").style.display = "block";
  document.getElementById("section_acciones").style.display = "block";
  $("#nueva_orden_lab_dos").modal('show');
    $.ajax({
    url:"ajax/laboratorios.php?op=get_data_orden",
    method:"POST",
    data:{id_orden:id_orden,cod_orden:cod_orden},
    dataType:"json",
    success:function(data){
    $("#paciente_orden_lab").val(data.paciente);
    $("#empresa_lab").val(data.empresa);
    $("#laboratorio_orden_lab").val(data.laboratorio);
    $("#sucursal_orden_lab").val(data.sucursal);
    $("#prioridad_orden_lab").val(data.prioridad);
    $("#lente_orden_lab").val(data.lente);
    $("#marca_aro_lab").val(data.marca_aro);
    $("#modelo_aro_lab").val(data.modelo_aro);
    $("#color_aro_lab").val(data.color_aro);
    $("#usuario_orden").val(data.usuario);
    $("#observaciones_orden_lab").val(data.observaciones);
    $("#correlativo_envio_lab").html(data.cod_orden);
      
    }     
  });
  $("#edit_orden").html('Guardar Cambios')
  get_actions_orders(id_orden,cod_orden);
}

var lista_acciones_orden =[];
function get_actions_orders(id_orden,cod_orden){

  lista_acciones_orden =[];
  $.ajax({
  url:"ajax/laboratorios.php?op=get_actions_orders",
  method:"POST",
  data:{id_orden:id_orden,cod_orden:cod_orden},
  cache: false,
  dataType:"json",
  success:function(data){
  console.log(data);

  for(let i in data){
    let obj ={
     fecha:data[i].fecha,
     tipo_accion:data[i].tipo_accion,
     nick:data[i].nick,
     observaciones:data[i].observaciones
    }

    lista_acciones_orden.push(obj);
  }
    listar_historial_orden();
  }//fin success
  });//fin de ajax

}

function listar_historial_orden(){
    $('#det_acciones_ordenes').html('');
    var filas = "";

    for(var i=0; i<lista_acciones_orden.length; i++){
      var filas = filas + "<tr id='fila"+i+"'><td colspan='15' style='width: 15%'>"+lista_acciones_orden[i].fecha+"</td>"+
      "<td colspan='35' style='width: 35%'>"+lista_acciones_orden[i].tipo_accion+"</td>"+
      "<td colspan='35' style='width: 35%'>"+lista_acciones_orden[i].observaciones+"</td>"+
      "<td colspan='15' style='width: 15%'>"+lista_acciones_orden[i].nick+"</td>"+"</tr>";
    }
    
    $('#det_acciones_ordenes').html(filas);
}

function get_ordenes_general_data(){
  tabla_envios_gral=$('#data_orders_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: ['excelHtml5'],
    "ajax":
        {
          url: 'ajax/laboratorios.php?op=listar_ordenes_general',
          type : "post",
          dataType : "json",
          //data:{estado:estado},
          error: function(e){
            console.log(e.responseText);}
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
              "sPrevious": "Anterior" },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
         }//cerrando language
  }).DataTable();
}

function eliminar_orden_lab(cod_orden){

  let cat_user = $("#cat_user").val();
  console.log(cat_user);
  if (cat_user=="administrador"){

    bootbox.confirm("¿Está Seguro de eliminar esta orden?", function(result){
      if(result){

        $.ajax({
          url:"ajax/laboratorios.php?op=eliminar_orden_lab",
          method:"POST",
          data:{cod_orden:cod_orden},
          dataType:"json",
          success:function(data)
          {
            console.log(data);
            if(data=="ok"){
              setTimeout ("Swal.fire('La orden ha sido eliminada Existosamente','','success')", 100);
              setTimeout ("explode();", 2000);
            }
          }
        });
         $("#data_orders_lab").DataTable().ajax.reload();   
      }
});//bootbox
  }else if (cat_user=="optometra","asesor") {
      setTimeout ("Swal.fire('No posse permisos para eliminar orden','','error')", 100);
    }
}

 init();