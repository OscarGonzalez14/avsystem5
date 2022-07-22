function init(){

  listar_ordenes_pendientes();
  listar_ordenes_pendientes_cauto();
	listar_contado_creditos();
  listar_creditos_cauto();
  //listar_ordenes_pendientes();
  listar_oid_aprobadas();
   listar_cautos_aprob();
   filtrar_creditos();    
  
}
///////////OCULTAR ELEMENTOS AL INICIO
//$(document).ready(ocultar_element_ini);

function ocultar_element_ini(){
  document.getElementById("print_orden_desp").style.display = "none";
  document.getElementById("btn_print_recibos").style.display = "none";

}

//////// AL VER DETALLES EN OID APROBADAS, OCULTAR BOTONES 
$(document).on('click', '.ocultar_btns_oid', function(){ 
  document.getElementById("btns_orden").style.display = "none";
});

////////////////LISTAR CREDITOS DE CONTADO
function listar_contado_creditos(){
  var sucursal= $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  let ver_credito = $("#ver_credito").val();
  tabla_creditos_sucursal=$('#creditos_de_contado').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_creditos_contado',
        type : "post",
        dataType : "json",
        data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario,ver_credito:ver_credito},
        error: function(e){
          console.log(e.responseText);
        }
      },
      "bDestroy": true,
      "responsive": true,
      "bInfo":true,
      "iDisplayLength": 40,//Por cada 40 registros hace una paginación
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

/////////////RELLENAR LA EMPRESA DE PACIENTE EMPRESARIAL
function agregar_empresa_pac(id_empresa){      
$.ajax({
  url:"ajax/empresas.php?op=buscar_empresa_paciente",
  method:"POST",
  data:{id_empresa:id_empresa},
  dataType:"json",
  success:function(data){                       
    $('#empresasModal').modal('hide');    
    $('#empresa').val(data.nombre);
    setTimeout ("listar_creditos_oid();",1500); 
  }
})

}

function listar_ventas_ccf(){
  array_total_ccf = [];
  totalFinalCcf = 0;

  let empresa = $("#empresa").val();
  if(empresa==""){
    Swal.fire('Error!, Debe Seleccionar una empresa','','error');
    return false
  }
  $("#modal_ccf_group").modal('show');
  $("#data_ventas_ccf_group").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor   
      //dom: 'Bfrti',
      //"buttons": [ "excel"],
      "searching": true,
      "ajax":
        {
          url: 'ajax/creditos.php?op=listar_cobros_grupal_ccf',
          type : "post",
          dataType : "json",
          data:{empresa:empresa},       
          error: function(e){
            console.log(e.responseText);  
          }
        },
      "bDestroy": true,
      "responsive": true,
      "bInfo":true,
      "iDisplayLength": 20,//Por cada 20 registros hace una paginación
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
    }).buttons().container().appendTo('#data_ventas_ccf_group_wrapper .col-md-6:eq(0)');
}

///////////////LISTAR CREDITOS DESCUENTO EN PLANILLA
function listar_creditos_oid(){
  let sucursal= $("#sucursal").val();
  let empresa= $("#empresa").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  tabla_creditos_oid=$('#creditos_oid').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_creditos_oid',
        type : "post",
        dataType : "json",
        data:{sucursal:sucursal,empresa:empresa,sucursal_usuario:sucursal_usuario},
        error: function(e){
          console.log(e.responseText);
        }
      },
      "bDestroy": true,
      "responsive": true,
      "bInfo":true,
    "iDisplayLength": 20,//Por cada 20 registros hace una paginación
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


//////////////RECIBOS Y ABONOS
function realizarAbonos(id_paciente,id_credito,numero_venta){
  $("#modal_recibos_generico").modal("show");
  get_correlativo_recibo();

  $.ajax({
    url:"ajax/creditos.php?op=datos_paciente_abono",
    method:"POST",
    data:{id_paciente:id_paciente,id_credito:id_credito,numero_venta:numero_venta},
    cache:false,
    dataType:"json",
    success:function(data)
    { 
      console.log(data);

      var nuevo_saldo = data.saldo-data.cuotas;  
      $("#recibi_abono").val(data.paciente);
      $("#servicio_abono").val(data.evaluado);
      $("#telefono_abono").val(data.telefono);
      $("#empresa_abono").val(data.empresas);
      $("#monto_venta_rec_ini").val(data.monto);
      $("#n_venta_recibo_ini").val(data.numero_venta);
      $("#id_paciente").val(data.id_paciente);
      $("#saldo_credito").val(data.saldo);
      $("#saldo").val(nuevo_saldo.toFixed(2));
      $("#numero").val(data.cuotas); 

    }
  })
 //////// FIN ajax datos de paciente
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

    ////////////////abono anterior
    $.ajax({
      url:"ajax/creditos.php?op=datos_abono_anterior",
      method:"POST",
      data:{id_paciente:id_paciente,numero_venta:numero_venta},
      cache:false,
      dataType:"json",
      success:function(data)
      { 
        console.log(data);  
        $("#abono_ant").val(data.monto_abono);
      }
    })
  }

////////////////REGISTRAR ABONO
function registra_abonos(){

  console.log("ProoofV2")
  var fecha_rec_ini=$("#pr_abono").val();
  var saldo=$("#saldo").val();
  var monto = $("#numero").val();

  if (monto !="" && saldo>=0) {//VALIDA MONTO
   if (saldo >0 && fecha_rec_ini=="") {
     Swal.fire('Especifique fecha de proximo abono abono!','','error')
   }else{
    //////////////SE ENVIA RECIBO
    registrar_abono();
  }
}else{
  Swal.fire('Debe llenar los campos obligatorios correctamente!','','error')

  }//VALIDA MONTO
  
}

function registrar_abono(){
  let a_anteriores = $("#abono_ant").val();
  let n_recibo = $("#n_recibo").html();
  let n_venta_recibo_ini = $("#n_venta_recibo_ini").val();
  let monto = $("#monto_venta_rec_ini").val();
  let fecha = $("#fecha").val();
  let sucursal = $("#sucursal").val();
  let id_paciente = $("#id_paciente").val();
  //let id_usuario = $("#usuario").val();
  let telefono_ini = $("#telefono_abono").val();
  let recibi_rec_ini = $("#recibi_abono").val();
  let empresa_ini = $("#empresa_abono").val();
  let texto = $("#texto").val();
  let numero = $("#numero").val();
  let saldo = $("#saldo").val();
  let forma_pago = $("#forma_pago").val();
  let marca_aro_ini = $("#marca_aro_ini").val();
  let modelo_aro_ini = $("#modelo_aro_ini").val();    
  let color_aro_ini = $("#color_aro_ini").val();
  let lente_rec_ini = $("#lente_rec_ini").val();
  let ar_rec_ini = $("#ar_rec_ini").val();
  let photo_rec_ini = $("#photo_rec_ini").val();
  let observaciones_rec_ini = $("#observaciones_rec_ini").val();
  let pr_abono = $("#pr_abono").val();
  let servicio_rec_ini = $("#servicio_abono").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  let tipo_recibo = "recibo";
  let id_user=$("#id_gestor").val();
  let id_usuario = id_user.toString();
  if (id_usuario == 0 || id_usuario == "") {
      Swal.fire('Debe seleccionar vendedor','','error');
      return false;
  }

  if (forma_pago !="") {
    $('#creditos_de_contado').DataTable().ajax.reload();
    $.ajax({
      url:"ajax/recibos.php?op=registrar_recibo",
      method:"POST",
      data:{a_anteriores:a_anteriores,n_recibo:n_recibo,n_venta_recibo_ini:n_venta_recibo_ini,monto:monto,fecha:fecha,sucursal:sucursal,id_paciente:id_paciente,id_usuario:id_usuario,telefono_ini:telefono_ini,recibi_rec_ini:recibi_rec_ini,empresa_ini:empresa_ini,texto:texto,numero:numero,saldo:saldo,forma_pago:forma_pago,marca_aro_ini:marca_aro_ini,modelo_aro_ini:modelo_aro_ini,color_aro_ini:color_aro_ini,lente_rec_ini:lente_rec_ini,ar_rec_ini:ar_rec_ini,photo_rec_ini:photo_rec_ini,observaciones_rec_ini:observaciones_rec_ini,pr_abono:pr_abono,servicio_rec_ini:servicio_rec_ini,sucursal_usuario:sucursal_usuario,tipo_recibo:tipo_recibo},
      cache: false,
      dataType:"json",
      error:function(x,y,z){
        d_pacole.log(x);
        console.log(y);
        console.log(z);
      },      
      success:function(data){
        console.log(data);
        if(data=='error'){
          Swal.fire('Este correlativo ya fué ingresado!','','error')
          return false;
        }else if (data=="ok") {
          Swal.fire('Recibo registrado exitosamente!','','success')
          $('#creditos_de_contado').DataTable().ajax.reload();
          $('#creditos_oid').DataTable().ajax.reload();
          $('#creditos_cauto').DataTable().ajax.reload();
        }

      }

    });
  }else{
    Swal.fire('Especifique la forma de Pago!','','error')
    return false;
  }  

}
  ///////////////////////IMPRIMIR RECIBO DE ABONO
  $(document).on('click', '#registrar_abono', function(){
    var n_recibo = $("#n_recibo").html();
    var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
    var id_paciente =$("#id_paciente").val();
    document.getElementById("btn_print_recibos").style.display = "block";
    let sucursal = $("#sucursal").val();
    let sucursal_usuario = $("#sucursal_usuario").val();
    let suc ='';
    if (sucursal=="Empresarial") {
      suc = sucursal_usuario;
    }else{
      suc = sucursal;
    }

    document.getElementById("btn_print_recibos").href='imprimir_recibo_pdf.php?n_recibo='+
    n_recibo+'&'+'n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+suc;

  });
  /////////////////LISTAR DETALLE DE ABONOS
  function verDetAbonos(id_paciente,numero_venta){
    $("#detalle_abonos").modal("show");
    tabla_det_abono=$('#lista_det_abonos').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Brtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_detalle_abonos',
        type : "post",
          //dataType : "json",
          data:{id_paciente:id_paciente,numero_venta:numero_venta},
          error: function(e){
            console.log(e.responseText);
          }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
    "iDisplayLength": 20,//Por cada 20 registros hace una paginación
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

//////////////////////////////GET DATOS PACENTE CREDITO

$.ajax({
  url:"ajax/creditos.php?op=get_datos_credito_abono",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);
    let abonado_act = data.abonado; 
    $("#paciente_det_abono").html(data.nombres);
    $("#monto_det_abono").html(data.monto);
    $("#total_abonado").html(abonado_act);
    $("#saldo_det_abono").html(data.saldo);
  }
})
}

////////////////GET CREDITOS POR CATEGORÍA
$(document).on('click', '.cat_creditos', function(){
  var categoria = $(this).attr("name");
  if (categoria == "cat_b") {
    $("#name_cat").html("CATEGORIA B");
  }else if(categoria == "cat_c"){
    $("#name_cat").html("CATEGORIA C");
}
 
  let sucursal = $("#sucursal").val();

  tabla_cats_creditos=$('#cats_creditos').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      { extend: 'excelHtml5', footer: true }
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=show_cat_creditos',
        type : "post",
        dataType : "json",
        data:{categoria:categoria,sucursal:sucursal},
        error: function(e){
          console.log(e.responseText);
        }
      },
      drawCallback: function () {
        var monto_saldo = $('#cats_creditos').DataTable().column(5).data().sum();
        $('#montos_c').html('$'+monto_saldo.toFixed(2));
        var creditos = $('#cats_creditos').DataTable().column(7).data().sum();
        $('#saldo_pend').html('$'+creditos.toFixed(2));
        var abonado = $('#cats_creditos').DataTable().column(8).data().sum();
        $('#abonado').html('$'+abonado.toFixed(2));
        var saldo_mora = $('#cats_creditos').DataTable().column(9).data().sum();
        $('#saldo_mora').html('$'+saldo_mora.toFixed(2));

      },
      "bDestroy": true,
      "responsive": true,
      "bInfo":true,
    "iDisplayLength": 20,//Por cada 20 registros hace una paginación
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
  
});
////////////////GET DATOS PACIENTE CREDITOS ATRASADOS/////////////
function info_pacientes_mora(id_paciente,numero_venta){

  $.ajax({
    url:"ajax/creditos.php?op=get_datos_creditos_mora",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data)
    { 
      console.log(data);  
      $("#paciente_credito_mora").html(data.nombres);
      $("#tel_credito_mora").html(data.telefono);
      $("#empresa_credito_mora").html(data.empresas);
      $("#dir_credito_mora").html(data.direccion);

    }
  })
////////////////////GET DATOS VENTA CREDITO EN MORA
$.ajax({
  url:"ajax/creditos.php?op=get_datos_venta_mora",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data){ 
    console.log(data);  
    $("#evaluado_credito_mora").html(data.evaluado);
    $("#fecha_credito_mora").html(data.fecha_venta);
    $("#asesor_credito_mora").html(data.usuario);
    $("#tipo_venta_mora").html(data.tipo_venta);
    $("#tipo_pago_mora").html(data.tipo_pago);

  }
})

}

function print_facturas_ventas(){

  let id_paciente = $("#id_paciente").val();
  let numero_venta = $("#n_venta").val();

  console.log(numero_venta);
  print_invoices(id_paciente,numero_venta);
}

function print_invoices(id_paciente,numero_venta){
 //console.log("YY-***");return false;
 let sucursal = $("#sucursal").val();
 let sucursal_usuario = $("#sucursal_usuario").val();
 let id_usuario = $("#usuario").val();
 let fecha_fac = $("#fecha_facturacion").val();
 $("#id_paciente_venta_factura").val(id_paciente);
 $("#print_invoices").modal("show");
 $("#n_venta_factura").val(numero_venta);

 $.ajax({
  url:"ajax/creditos.php?op=get_correlativo_factura",
  method:"POST",
  data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},
  cache:false,
  dataType:"json",
  success:function(data){ 
    console.log(data);

    $("#correlativo_factura").html(data.correlativo);
    var correlativo_f = data.correlativo;
    //console.log(correlativo_f);
    document.getElementById("link_invoice_print").href='imprimir_factura_pdf.php?n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'correlativo_f='+correlativo_f+'&'+'fecha_fac='+fecha_fac;
    document.getElementById("empty_invoice_print").href='imprimir_factura_empty_pdf.php?n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'correlativo_f='+correlativo_f+'&'+'fecha_fac='+fecha_fac;
  }
})

  //var enlace = document.getElementById("link_invoice_print");
  //enlace.addEventListener("click", registrar_impresion, false);
}


function registrar_impresion(){

  let sucursal = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  let id_usuario = $("#usuario").val();
  let correlativo_fac = $("#correlativo_factura").html();
  let numero_venta = $("#n_venta_factura").val();
  let id_paciente = $("#id_paciente_venta_factura").val();
  $("#print_invoices").modal("hide");

  ///////////// REGISTRA CORRELATIVO EN BD ////////////////
  $.ajax({
    url:"ajax/creditos.php?op=save_correlativo_factura",
    method:"POST",
    data:{sucursal:sucursal,numero_venta:numero_venta,id_usuario:id_usuario,correlativo_fac:correlativo_fac,id_paciente:id_paciente,sucursal_usuario:sucursal_usuario},
    cache:false,
    dataType:"json",
    success:function(data){ 
      console.log(data);
      if(data=='ok'){
        $('#creditos_de_contado').DataTable().ajax.reload();
        $('#creditos_oid').DataTable().ajax.reload();
        $('#creditos_cauto').DataTable().ajax.reload();
      }  

    }
  })

}

///////////////REGISTRAR ORDEN DE DESCUENTO //////////////
function calculaFinCredito(){
  setTimeout ("get_finaliza();", 3000);
}

//////////////  
function get_finaliza(){
  let inicio = $("#fecha_inicio").val();
  let plazo_credito = $("#plazo_credito").val();
  console.log("inicioo"+inicio+plazo_credito);
  $.ajax({
    url:"ajax/creditos.php?op=get_finaliza_fecha",
    method:"POST",
    data:{inicio:inicio,plazo_credito:plazo_credito},
    cache:false,
    dataType:"json",
    success:function(data){ 
      console.log(data);  
      $("#end_credito").val(data);
    }
  })
}
    /************************************************************
    *****************ORDENES DE DESCUENTO EN PLANILLA************
    *************************************************************/
 
    function listar_ordenes_pendientes(){

    let sucursal = $("#sucursal").val();
    let sucursal_usuario = $("#sucursal_usuario").val();
    tabla_ordenes_pla = $('#data_orden_aprob').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
    //'copyHtml5',
    'excelHtml5',
    //'csvHtml5',
    //'pdf'
    ],

    "ajax":{
      url:"ajax/creditos.php?op=listar_oid_pendientes",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},         
      error: function(e){
        console.log(e.responseText);
      },           
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
        });
    }

    /************************************************************
    *****************ORDENES DE CARGO AUTOMATICO************
    *************************************************************/
    function listar_ordenes_pendientes_cauto(){
    let sucursal = $("#sucursal").val();
    let sucursal_usuario = $("#sucursal_usuario").val();
    tabla_ordenes_pla = $('#cargos_pendientes').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
    //'copyHtml5',
    'excelHtml5',
    //'csvHtml5',
    //'pdf'
    ],

    "ajax":{
      url:"ajax/creditos.php?op=listar_cautos_pendientes",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},         
      error: function(e){
        console.log(e.responseText);
      },           
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
        });
    }  

  var detalle_venta_flotante = [];
  var venta_flotante = [];
  var beneficiarios_orden = [];

  function acciones_oid(numero_orden,id_paciente,estado){
  detalle_venta_flotante = [];
  venta_flotante = [];
  beneficiarios_orden=[]
  let categoria_usuario = $('#cat_user').val();
  //console.log(`cat ${categoria_usuario} orden ${numero_orden} id_paciente ${id_paciente} estado ${estado}`)
  $("#detalle_oid").modal("show");
  if (categoria_usuario != "administrador") {
    document.getElementById("btns_orden").style.display = "none";
  }
  /////////////ajax data detalles del  orden
  //$("#nnn").val(numero_orden)
  $.ajax({
    url:"ajax/creditos.php?op=get_detalles_orden_oid",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache:false,
    dataType:"json",
    success:function(data){ 
     // console.log(data);  
      $("#monto_orden").html(data.monto);
      $("#plazo_orden").html(`${data.plazo} cuotas`);
      $("#cuota_orden").html(data.cuota);
      $("#ref1_orden").html(data.referencia_uno);
      $("#ref2_orden").html(data.referencia_dos);
      $("#total_orden_t").html(data.monto);
      $("#plazo_orden_desc").val(data.plazo);
      $("#n_orden_des").val(numero_orden);
    }
  })


  $.ajax({
    url:"ajax/creditos.php?op=get_detalles_orden_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    //  console.log(data);  
      $("#paciente_orden").html(data.nombres);
      $("#funcion_pac_orden").html(data.ocupacion);
      $("#dui_pac_orden").html(data.dui);
      $("#edad_pac_orden").html(`${data.edad} años`);
      $("#nit_pac_orden").html(data.nit);
      $("#tel_pac_orden").html(data.telefono);
      $("#tel_of_pac_orden").html(data.telefono_oficina);
      $("#correo_pac_orden").html(data.correo);
      $("#dir_pac_orden").html(data.direccion);
      $("#empresa_pac_orden").html(data.empresas);
    }
  })

  ///////////////////////GET DATA BENEFICIARIOS //////////////////
  $.ajax({
    url : "ajax/creditos.php?op=get_beneficiarios",
    method :"POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
   // console.log(data);  

    for(var i in data){
    var obj = {
      numero_orden : data[i].numero_orden,
      nombres : data[i].nombres,
      empresas : data[i].empresas,
      id_paciente : data[i].id_paciente,
      estado : data[i].estado,
      id_orden : data[i].id_orden,
      sucursal : data[i].sucursal,
      evaluado : data[i].evaluado,
      monto_total : data[i].monto_total,
      tipo_orden : data[i].tipo_orden
    };//FIN OBJ
      beneficiarios_orden.push(obj);
     // console.log(beneficiarios_orden);
      detalle_beneficiarios_orden();
    }//Fin for
    

    }
  })

  var total = 0
  ////////////////GET DETALLE PRODUCTOS ORDEN
  $.ajax({
    url : "ajax/creditos.php?op=get_detalle_productos_orden",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
      console.log(data);

    for(var i in data){
     //var total = parseInt(total) + parseInt(data[i].precio_final);
     var obj = {
      id_producto : data[i].id_producto,
      cantidad : data[i].cantidad,
      producto : data[i].producto,
      precio_venta : data[i].precio_venta,
      descuento : data[i].descuento,
      precio_final : data[i].precio_final,
      descuento : data[i].descuento,
      fecha_venta : data[i].fecha_venta,
      id_usuario : data[i].id_usuario,
      id_paciente : data[i].id_paciente,
      beneficiario : data[i].beneficiario,
      categoria_ub : data[i].categoria_ub
      };//FIN OBJ
      detalle_venta_flotante.push(obj);
      detalle_productos_flotantes();

    }

  }
})

  $.ajax({
    url: "ajax/creditos.php?op=get_detalle_venta_flotante",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
     // console.log(data);
      for(var i in data){
        var obj_dos = {
         fecha_venta : data[i].fecha_venta,
         paciente: data[i].paciente,
         vendedor: data[i].vendedor,
         monto_total: data[i].monto_total,
         tipo_pago: data[i].tipo_pago,
         tipo_venta: data[i].tipo_venta,
         id_usuario: data[i].id_usuario,
         id_paciente: data[i].id_paciente,
         sucursal: data[i].sucursal,
         evaluado: data[i].evaluado,
         optometra: data[i].optometra
      }; //Fin obj_dos
      venta_flotante.push(obj_dos);
    }

  }
})

////////////////////////////GET BENEFIACIOS EN VENTAS FLOTANTES PARA DETALLE VENTAS FLOTANTES ///////////////
  $.ajax({
    url: "ajax/creditos.php?op=get_beneficiarios_ventas_flot",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
      console.log(data)
      for(var i in data){
      let flotante_benf = data[i].evaluado;
      let flotante_b = flotante_benf.toString();
       get_det_f_ben(id_paciente,numero_orden,flotante_b);
      //GET DETALLE DE VENTA FLOTANTE POR PACIENTE      
////FIN DETALLE DE VENTA FLOTANTE POR PACIENTE
}; //Fin GET VENTAS FLOTANTES ASOCIADOS A LA ORDEN
}

})
 //listar_beneficiarios_productos();
}



function get_det_f_ben(id_paciente,numero_orden){

  console.log(`Este es el ID: ${id_paciente} Este es # orden ${numero_orden}`);
 
   $.ajax({
      url:"ajax/creditos.php?op=get_det_ventas_flotantes",
      method:"POST",
      data:{numero_orden:numero_orden,id_paciente:id_paciente},
      cache:false,
      //dataType:"json",
      success:function(data)
      { 

        $("#beneficiarios_productos_vf").html(data);
   
      }
    })

}

function listar_beneficiarios_productos(){

  $('#beneficiarios_productos_vf').html('');
  var filas = "";
  for(var i=0; i<det_ventas_flotantes.length; i++){
  var filas = filas +"<tr>"+
      "<td style='text-align:center;width: 10% !important'>"+det_ventas_flotantes[i].cantidad_venta+"</td>"+
      "<td style='text-align:center;width: 65% !important'>"+det_ventas_flotantes[i].producto+"</td>"+
      "<td style='text-align:center;width: 15% !important'>"+"$"+det_ventas_flotantes[i].precio_final+"</td>"
      +"</tr>";
  }

  $('#beneficiarios_productos_vf').html(filas);

}

function detalle_beneficiarios_orden(){
  let monto_total = 0;
  $('#benefiaciarios_orden').html('');
  var filas = "";
  for(var i=0; i<beneficiarios_orden.length; i++){
    let est_ord = beneficiarios_orden[i].estado;
  if(est_ord=="Aprobado"){
    monto_total = parseFloat(monto_total)+parseFloat(beneficiarios_orden[i].monto_total);
    var color = "green";
  }else{
    var color = "orange";
  }

  var filas = filas + "<tr id='fila"+i+"'><td style='width: 15%;color: blue'>"+"<input class='check_beneficiarios' style='color:red' type='checkbox' name='check_beneficiarios' value='valor"+i+"' id=item"+i+" onClick='estado_check_beneficiario(event, this, "+(i)+");'></td>"+
      "<td style='text-align:center;width: 10% !important;color:"+color+"'>"+beneficiarios_orden[i].estado+"</td>"+
      "<td style='text-align:center;width: 65% !important'>"+beneficiarios_orden[i].evaluado+"</td>"+
      "<td style='text-align:center;width: 10% !important'>"+"$"+beneficiarios_orden[i].monto_total+"</td>"
      +"</td>"+
      "</tr>";
  }
  console.log("SUMMA"+monto_total)
  $('#benefiaciarios_orden').html(filas);

  for(var i=0; i<beneficiarios_orden.length; i++){
    let id_item = "item"+i;
    console.log(id_item);
    if((beneficiarios_orden[i].estado)=="Aprobado"){
       document.getElementById(id_item).checked = true;
       document.getElementById(id_item).disabled = true;
       document.getElementById(id_item).style.background  = "red"
    }
  }
}


function estado_check_beneficiario(event, obj, idx){
 
 let estado_check =  beneficiarios_orden[idx].estado;
 console.log(estado_check);

 if(estado_check=="Sin aprobar"){
  beneficiarios_orden[idx].estado = "Ok";
 }else if(estado_check=="Ok"){
  beneficiarios_orden[idx].estado = "Denegado";
 }else if(estado_check=="Denegado")
  beneficiarios_orden[idx].estado = "Ok";
}


function detalle_productos_flotantes(){ 
  $('#detalle_productos_orden').html('');
  var filas = "";
  for(var i=0; i<detalle_venta_flotante.length; i++){
    var filas = filas +"<tr id='fila"+i+"'><td style='text-align:center;width: 25% !important' colspan='25'>"+detalle_venta_flotante[i].cantidad+
    "</td>"+"<td style='text-align:center;width: 50% !important' colspan='50'>"+detalle_venta_flotante[i].producto+"</td>"+
    "<td style='text-align:center;width: 25%' colspan='25'>"+detalle_venta_flotante[i].precio_final+"</td>"+"</tr>";
  }
  $('#detalle_productos_orden').html(filas);
}


function aprobar_od_planilla(){
 let plazo = $("#plazo_orden_desc").val();
 let numero_orden = $("#n_orden_des").val();
 let sucursal_usuario = $("#sucursal_usuario").val() 

 $.ajax({
  url:"ajax/creditos.php?op=aprobar_orden_planilla",
  method: "POST",
  data: {'beneficiariosArray':JSON.stringify(beneficiarios_orden),'sucursal_usuario':sucursal_usuario},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
    d_pacole.log(x);
    console.log(y);
    console.log(z);
  },     
  success:function(data){
    console.log(data);
    $('#data_orden_aprob').DataTable().ajax.reload();
    $('#cargos_pendientes').DataTable().ajax.reload();
  }
})
 Swal.fire('Orden de descuento registrado!','','success');
 $("#detalle_oid").modal('hide');
}


function aprobar_od_planillassss(){
 let plazo = $("#plazo_orden_desc").val();
 let numero_orden = $("#n_orden_des").val();
 $.ajax({
  url:"ajax/creditos.php?op=aprobar_orden_planilla",
  method: "POST",
  data: {'detOrden':JSON.stringify(detalle_venta_flotante),'arrayVenta':JSON.stringify(venta_flotante),'plazo':plazo,'numero_orden':numero_orden},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
    d_pacole.log(x);
    console.log(y);
    console.log(z);
  },     
  success:function(data){
    console.log(data);
    $('#ordenes_desc_pendientes').DataTable().ajax.reload();
  }
})
 Swal.fire('Orden de descuento registrado!','','success');
 $("#detalle_oid").modal('hide');
}

function denegar_od_planilla(){
  let numero_orden = $("#n_orden_des").val();

  bootbox.confirm("¿Está Seguro de denegar esta orden?", function(result){
    if(result){

      $.ajax({
        url:"ajax/creditos.php?op=denegar_orden",
        method:"POST",
        data:{numero_orden:numero_orden},
        dataType:"json",
        success:function(data)
        {
          console.log(data);
          if(data=="ok"){
            setTimeout ("Swal.fire('La orden ha sido denegada','','warning')", 100);
      }          //alert(data);
      $("#data_pacientes").DataTable().ajax.reload();
    }
  });

    }
});//bootbox

}


function listar_creditos_cauto(){
  var sucursal= $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  tabla_creditos_cauto=$('#creditos_cauto').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_creditos_cauto',
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
    "iDisplayLength": 20,//Por cada 20 registros hace una paginación
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


/////////LISTAR OIDS CREADAS
function listar_oid_aprobadas(){
  let sucursal= $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();
  //console.log(sucursal_usuario).val();return false;
  tabla_oid_creadas=$('#oid_aprobadas').dataTable({
      "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_oid_aprobadas',
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
    "iDisplayLength": 30,//Por cada 30 registros hace una paginación
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

//////Eliminar oid solo para administradores


function eliminar_oid(id_orden, numero_orden, id_paciente){

  let cat_user = $("#cat_user").val();
  console.log(cat_user);
  if (cat_user=="administrador"){

    bootbox.confirm("¿Está Seguro de eliminar OID aprobada?", function(result){
      if(result){

        $.ajax({
          url:"ajax/creditos.php?op=eliminar_oid",
          method:"POST",
          data:{id_orden:id_orden,numero_orden:numero_orden,id_paciente:id_paciente},
          dataType:"json",
          success:function(data)
          {
            console.log(data);
            if(data=="ok"){
              setTimeout ("Swal.fire('OID Eliminada Existosamente','','success')", 100);
              setTimeout ("explode();", 2000);
            }
            $("#oid_aprobadas").DataTable().ajax.reload();   
          }
        });

      }
});//bootbox

  }else if (cat_user=="optometra","asesor") {
      setTimeout ("Swal.fire('No posse permisos para eliminar OID','','error')", 100);
    }
}

/////////////////////////agregar item a credito fiscal //////////////
let array_total_ccf = [];

$(document).on('click', '.add_item_ccf', function(){

  let id_item = $(this).attr("id");
  let monto_item = $(this).attr("value");
  let n_venta = $(this).attr("name");
  
  let chk = document.getElementById(id_item);
  let status_chk = chk.checked;

  if (status_chk==true) {
    let obj ={
      monto_venta : monto_item,
      numero_venta : n_venta
    }
    array_total_ccf.push(obj);
    calcularMontoCcf();
  }else if(status_chk==false){
    let index_obj = array_total_ccf.findIndex(x => x.numero_venta==n_venta);
    array_total_ccf.splice(index_obj, 1);
    calcularMontoCcf();
  }

});

function calcularMontoCcf(){
  let totalFinalCcf = 0;
  for(let i=0; i<array_total_ccf.length;i++){
    totalFinalCcf += parseFloat(array_total_ccf[i].monto_venta)
  }
  $("#monto_total_ccf_group").html(totalFinalCcf.toFixed(2));
}

/************************************************************
    ****************CARGOS AUTOMATICOS APROBADOS************
    *************************************************************/
    function listar_cautos_aprob(){
      let sucursal = $("#sucursal").val();
      let sucursal_usuario = $("#sucursal_usuario").val();
      tabla_cargos_aprob = $('#cargos_aprobados').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
    //'copyHtml5',
    'excelHtml5',
    //'csvHtml5',
    //'pdf'
    ],

    "ajax":{
      url:"ajax/creditos.php?op=listar_cautos_aprob",
      type : "post",
      dataType : "json",
      data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},         
      error: function(e){
        console.log(e.responseText);
      },           
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
        });
    }  
    
    function eliminar_oid_p(numero_orden){

  let cat_user = $("#cat_user").val();
  console.log(cat_user);
  if (cat_user=="administrador"){

    bootbox.confirm("¿Está Seguro de eliminar Orden pendiente de aprobación?", function(result){
      if(result){

        $.ajax({
          url:"ajax/creditos.php?op=eliminar_oid_p",
          method:"POST",
          data:{numero_orden:numero_orden},
          //dataType:"json",
          success:function(data)
          {
            console.log(data);
            if(data=="ok"){
              setTimeout ("Swal.fire('Orden Eliminada Existosamente','','success')", 100);            
          }
        }
      });
      }
      $("#data_orden_aprob").DataTable().ajax.reload();
      $("#cargos_pendientes").DataTable().ajax.reload();
    });//bootbox

  }else if (cat_user=="optometra","asesor"){
      setTimeout ("Swal.fire('No posse permisos para eliminar OID','','error')", 100);
    }
}

//listar todos los creditos de planilla
  function filtrar_creditos(){
    let ver_credito = $("#ver_credito").val();
    let empresa = $("#nom_empresa").val();
    let nombre_empresa = empresa.toString();
    let sucursal = $("#sucursal").val();
    let sucursal_usuario = $("#sucursal_usuario").val();

    table_creditos = $('#creditos_globales').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: ['excelHtml5'],
    "ajax":{
      url:"ajax/creditos.php?op=filtra_creditos",
      type : "POST",
      //dataType : "json",
      data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario,ver_credito:ver_credito,nombre_empresa:nombre_empresa},
      error: function(e){
      console.log(data);
    },},
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength":50,//Por cada 50 registros hace una paginación
    "order": [[ 0, "desc" ]],//Ordenar (columna,orden
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
      "sFirst":"Primero","sLast":"Último","sNext":"Siguiente","sPrevious": "Anterior"       
      },      
      "oAria": {       
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",       
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"       
      }
    }, //cerrando language
  });
  } 

init();


// console.log()
