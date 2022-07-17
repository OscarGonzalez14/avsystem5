var tabla_recibos_emitidos;

function init(){
   get_correlativo_recibo();
    //prueba();
    //listar_recibos_emitidos();
    listar_reporte_recibos();
}

////////OCULTAR BTN DE IMPRIMIR RECIBO AL INICIO
$(document).ready(ocultar_btn_print_rec_ini);

function ocultar_btn_print_rec_ini(){
  document.getElementById("btn_print_recibos").style.display = "none";
  document.getElementById("btn_print_recibos_oid").style.display = "none";
}

//////// AL DAR IMPRIMIR EN LISTA DE RECIBOS 
/*$(document).on('click', '.imprimir_recibo', function(){ 
  document.getElementById("btns_orden").style.display = "none";
});
*/

/*function prueba(){
 $("#field_1").html("Holaaaaaaaaa"); 
}
*/
function get_correlativo_recibo(){
  let sucursal_correlativo = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  $.ajax({
    url:"ajax/recibos.php?op=get_numero_recibo",
    method:"POST",
    data:{sucursal_correlativo:sucursal_correlativo,sucursal_usuario:sucursal_usuario},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data); 
      console.log("Este es el correlativo de REcibo"+data.correlativo)       
      $("#n_recibo").html(data.correlativo);             
      }
    })
}

function get_correlativo_prima_oid(){

  recibo_inicial_prima();
  let sucursal_correlativo = $("#sucursal").val();
  let sucursal_usuario = $("#sucursal_usuario").val();

  let tipo_pago = $("#tipo_pago").val();

  $("#observaciones_rec_ini_oid").val("ABONO EN CONCEPTO DE PRIMA PARA CREDITO "+tipo_pago.toUpperCase());

  $.ajax({
    url:"ajax/recibos.php?op=get_numero_recibo",
    method:"POST",
    data:{sucursal_correlativo:sucursal_correlativo,sucursal_usuario:sucursal_usuario},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data); 
    
      $("#n_recibo_oid").html(data.correlativo);             
      }
    })

}

function registra_abono_inicial(){
  var fecha_rec_ini=$("#proxi_abono").val();
  var saldo=$("#saldo").val();
  var monto = $("#numero").val();

  if (monto !="" && saldo>=0) {//VALIDA MONTO
     if (saldo >0 && fecha_rec_ini=="") {
     Swal.fire('Especifique fecha de proximo abono abono!','','error')
    }else{
    //////////////SE ENVIA RECIBO
      save_abono_inicial();
    }
  }else{
    Swal.fire('Debe llenar los campos obligatorios correctamente!','','error')
  }//VALIDA MONTO
  
}

function save_abono_inicial(){

    let pr_abono=$("#proxi_abono").val();
    let a_anteriores="0";
    let n_recibo = $("#n_recibo").html();
    let n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
    let monto =$("#total_venta").html();
    let fecha =$("#fecha").val();
    let sucursal =$("#sucursal").val();
    let id_paciente =$("#id_paciente").val();
    //let id_usuario =$("#usuario").val();
    let telefono_ini =$("#telefono_ini").val();
    let recibi_rec_ini =$("#recibi_rec_ini").val();
    let empresa_ini =$("#empresa_ini").val();
    let texto=$("#texto").val();
    let numero=$("#numero").val();
    let saldo=$("#saldo").val();
    let forma_pago=$("#forma_pago").val();
    let marca_aro_ini=$("#marca_aro_ini").val();
    let modelo_aro_ini=$("#modelo_aro_ini").val();    
    let color_aro_ini=$("#color_aro_ini").val();
    let lente_rec_ini=$("#lente_rec_ini").val();
    let ar_rec_ini=$("#ar_rec_ini").val();
    let photo_rec_ini=$("#photo_rec_ini").val();
    let observaciones_rec_ini=$("#observaciones_rec_ini").val();    
    let servicio_rec_ini=$("#servicio_rec_ini").val();
    let tipo_recibo = "recibo";
    let sucursal_usuario = $("#sucursal_usuario").val();

    var id_user=$("#usuario").val();
    let id_usuario = id_user.toString();
    if (id_usuario == 0 || id_usuario == "") {
      Swal.fire('Debe seleccionar vendedor','','error');
      return false;
  }
    if (forma_pago !="") {

    $.ajax({
    url:"ajax/recibos.php?op=registrar_recibo",
    method:"POST",
    data:{a_anteriores:a_anteriores,n_recibo:n_recibo,n_venta_recibo_ini:n_venta_recibo_ini,monto:monto,fecha:fecha,sucursal:sucursal,id_paciente:id_paciente,id_usuario:id_usuario,telefono_ini:telefono_ini,recibi_rec_ini:recibi_rec_ini,empresa_ini:empresa_ini,texto:texto,numero:numero,saldo:saldo,forma_pago:forma_pago,marca_aro_ini:marca_aro_ini,modelo_aro_ini:modelo_aro_ini,color_aro_ini:color_aro_ini,lente_rec_ini:lente_rec_ini,ar_rec_ini:ar_rec_ini,photo_rec_ini:photo_rec_ini,observaciones_rec_ini:observaciones_rec_ini,pr_abono:pr_abono,servicio_rec_ini:servicio_rec_ini,tipo_venta:tipo_recibo,sucursal_usuario:sucursal_usuario},
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
        Swal.fire('Recibo registrado exitosamente!','','success');
        $('#creditos_de_contado').DataTable().ajax.reload();
      }      
    }

  });
  }else{
    Swal.fire('Especifique la forma de Pago!','','error')
    return false;
  }  
    
  }



$(document).on('click', '#btn_enviar_ini', function(){
  var n_recibo = $("#n_recibo").html();
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();
  var sucursal = $("#sucursal").val();

  document.getElementById("btn_print_recibo").href='imprimir_recibo_pdf.php?n_recibo='+n_recibo+'&'+'n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal;
    
});
/////////////IMPRIME FACTURA DE CONTADO
$(document).on('click', '#btn_enviar_ini', function(){
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();
  var empresa_fisc = $("#empresa_fisc").val();
  var tipo_venta = $("#tipo_venta").val();
  
console.log(tipo_venta);
if (tipo_venta=="Credito Fiscal"){
  document.getElementById("credito_fiscal_print").href='imprimir_c_fiscal_pdf.php?n_venta='+empresa_fisc+'&'+'id_paciente='+id_paciente;
}
  comprobarSaldo();  
  document.getElementById("btn_print_recibo").style.display = "block";
  //document.getElementById("factura_contado").href='imprimir_factura_pdf.php?n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente;  

});

function comprobarSaldo(){
  var n_venta =$("#n_venta").val();
  var id_paciente =$("#id_paciente").val();

  $.ajax({
  url:"ajax/recibos.php?op=consultar_saldo",
  method:"POST",
  data:{n_venta:n_venta,id_paciente:id_paciente},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
  }, 
      
    success:function(data){
      console.log("El saldo es: "+data.saldo);
      //return false;
      saldo= data.saldo;
      if(saldo=='0'){
      document.getElementById("print_factura").style.display = "block";
      }else if (saldo>0) {
       document.getElementById("print_factura").style.display = "none";
      }
      
    }

  });

}

/////////LISTAR RECIBOS EMITIDOS
function listar_recibos_emitidos(){
  var sucursal= $("#sucursal").val();
  tabla_recibos_emitidos=$('#recibos_emitidos').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/recibos.php?op=listar_recibos_emitidos',
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

function recibo_inicial_prima(){

  let numero_venta = $("#n_venta").val();
  let id_paciente = $("#id_paciente").val();
  let evaluado = $("#evaluado").val();
  let titular_cuenta = $("#titular_cuenta").val();
  let monto_total = $("#total_venta").html();

  $("#n_venta_recibo_ini_oid").val(numero_venta);
  $("#id_pac_ini_oid").val(id_paciente);
  $("#servicio_abono_oid").val(evaluado);
  $("#recibi_abono_oid").val(titular_cuenta);
  $("#monto_venta_rec_ini_oid").val(monto_total);

  ///////////////SE OBTENDRA EL DETALLE DE PRODUCTOS DESDE VENTAS FLOTANTES ////////////
  let correlativo_oid = document.getElementById('correlativo_orden').innerHTML;

  $.ajax({
  url:"ajax/recibos.php?op=get_datos_lentes_prima",
  method:"POST",
  data:{id_paciente:id_paciente,correlativo_oid:correlativo_oid},
  cache:false,
  dataType:"json",
  success:function(data)
  {

    console.log(data);  
    $("#lente_rec_ini_oid").val(data.producto);
  }
  })
  ////////////////photo
  $.ajax({
  url:"ajax/recibos.php?op=get_datos_photo_prima",
  method:"POST",
  data:{id_paciente:id_paciente,correlativo_oid:correlativo_oid},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#photo_rec_ini_oid").val(data.producto);
  }
  })

    ////////////////antireflejante
  $.ajax({
  url:"ajax/recibos.php?op=get_datos_prima",
  method:"POST",
  data:{id_paciente:id_paciente,correlativo_oid:correlativo_oid},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#ar_rec_ini_oid").val(data.producto);
  }
  })

////////////////aros
  $.ajax({
  url:"ajax/recibos.php?op=get_datos_aros_prima",
  method:"POST",
  data:{id_paciente:id_paciente,correlativo_oid:correlativo_oid},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#marca_aro_ini_oid").val(data.marca);
    $("#modelo_aro_ini_oid").val(data.modelo);
    $("#color_aro_ini_oid").val(data.color);
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
    $("#telefono_ini_oid").val(data.telefono);
    $("#empresa_ini_oid").val(data.empresas);
  }
  })

  
}///////////FIN FUNCION RECIBO INICIAL



function registrar_abono_oid(){


  let sucursal_usuario = $("#sucursal_usuario").val();
  let a_anteriores = "";
  let n_recibo = $("#n_recibo_oid").html();
  let n_venta_recibo_ini = $("#correlativo_orden").html();
  let monto = $("#monto_venta_rec_ini_oid").val();
  let fecha = "";
  let sucursal = $("#sucursal").val();
  let id_paciente = $("#id_paciente").val();  
  let telefono_ini = $("#telefono_ini_oid").val();
  let recibi_rec_ini = $("#recibi_abono_oid").val();
  let empresa_ini = $("#empresa_ini_oid").val();
  let texto = $("#texto_oid").val();
  let numero = $("#numero_oid").val();
  let saldo = $("#saldo_oid").val();
  let forma_pago = $("#forma_pago_oid").val();
  let marca_aro_ini = $("#marca_aro_ini_oid").val();
  let modelo_aro_ini = $("#modelo_aro_ini_oid").val();    
  let color_aro_ini = $("#color_aro_ini_oid").val();
  let lente_rec_ini = $("#lente_rec_ini_oid").val();
  let ar_rec_ini = $("#ar_rec_ini_oid").val();
  let photo_rec_ini = $("#photo_rec_ini_oid").val();
  let observaciones_rec_ini = $("#observaciones_rec_ini_oid").val();
  let pr_abono = "";
  let servicio_rec_ini = $("#servicio_abono_oid").val();
  let numero_orden = $("#correlativo_orden").html();
  let tipo_recibo = "prima";
  var id_user=$("#usuario").val();
  let id_usuario = id_user.toString();

  if (forma_pago !="") {

    $.ajax({
    url:"ajax/recibos.php?op=registrar_prima",
    method:"POST",
    data:{a_anteriores:a_anteriores,n_recibo:n_recibo,n_venta_recibo_ini:n_venta_recibo_ini,monto:monto,fecha:fecha,sucursal:sucursal,id_paciente:id_paciente,id_usuario:id_usuario,telefono_ini:telefono_ini,recibi_rec_ini:recibi_rec_ini,empresa_ini:empresa_ini,texto:texto,numero:numero,saldo:saldo,forma_pago:forma_pago,marca_aro_ini:marca_aro_ini,modelo_aro_ini:modelo_aro_ini,color_aro_ini:color_aro_ini,lente_rec_ini:lente_rec_ini,ar_rec_ini:ar_rec_ini,photo_rec_ini:photo_rec_ini,observaciones_rec_ini:observaciones_rec_ini,pr_abono:pr_abono,servicio_rec_ini:servicio_rec_ini,tipo_recibo:tipo_recibo,numero_orden:numero_orden,sucursal_usuario:sucursal_usuario},
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
        Swal.fire('Recibo registrado exitosamente!','','success');
        $('#creditos_de_contado').DataTable().ajax.reload();
      }      
    }

  });
  }else{
    Swal.fire('Especifique la forma de Pago!','','error')
    return false;
  } 

}
///////////////////////////   BTN RECIBO CARGAR DATA IMPRIMIR RECIBO
  $(document).on('click', '#reg_abono_oid', function(){
    var n_recibo = $("#n_recibo_oid").html();
    var n_orden =$("#correlativo_orden").html();
    var id_paciente =$("#id_paciente").val();
    document.getElementById("btn_print_recibos_oid").style.display = "block";
    let sucursal = $("#sucursal").val();
    let sucursal_usuario = $("#sucursal_usuario").val();
    let suc ='';
    if (sucursal=="Empresarial") {
      suc = sucursal_usuario;
    }else{
      suc = sucursal;
    }

    document.getElementById("btn_print_recibos_oid").href='print_prima_oid_pdf.php?n_recibo='+
    n_recibo+'&'+'n_orden='+n_orden+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+suc;

  });

  ///LISTAR RECIBOS 
  function listar_reporte_recibos(){
    var sucursal = $("#sucursal").val();
    var sucursal_usuario = $("#sucursal_usuario").val();

    $("#listar_reporte_recibos").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      dom: 'Bfrtip',
      "buttons": [ "excel"],
      "searching": true,
      "ajax":
      {
        url: "ajax/recibos.php?op=listar_recibos",
        type : "post",
        dataType : "json",    
        data:{sucursal:sucursal,sucursal_usuario:sucursal_usuario},    
        error: function(e){
          //console.log(e.responseText);  
        },
      },
      "iDisplayLength": 30,//Por cada 10 registros hace una paginación
      "language": {
        "sSearch": "Buscar:"

      }
    }).buttons().container().appendTo('#dt_recibos_wrapper .col-md-6:eq(0)');

  }

init();