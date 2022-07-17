
var tabla_compras_ingresar;
var tabla_compras_admin_report;
function init(){
 clear_c_compra();
 get_numero_recibo();
 ingresar_compras_inventario();
 reporte_compras_admin();
 ocultar_btn_post_compra();
}

//$(document).ready(ocultar_btn_post_compra);

function hola_mundo(){
  console.log("probando esto")
}
 function ocultar_btn_post_compra(){
  document.getElementById("post_compra").style.display = "none";
}

  function mostrar_btn_post_compra(){
  document.getElementById("post_compra").style.display = "flex";
}
  function ocultar_btn_de_compra(){
  document.getElementById("btn_de_compra").style.display = "none";
  document.getElementById("tabla_det_compras").style.display = "none";
}
function clear_c_compra() {
    $("#n_compra").val("");
    $("#tipo_compra").val("");
    $("#plazo").val("");
    $("#proveedor_compra").val("");
    $("#codigo_proveedor").val("");
}

function get_numero_recibo(){
  //var sucursal_correlativo = $("#sucursal").val();
    //var sucursal_correlativo = 'METROCENTRO';
    $.ajax({
      url:"ajax/compras.php?op=get_numero_compra",
      method:"POST",
      //data:{sucursal_correlativo:sucursal_correlativo},
      cache:false,
      dataType:"json",
      success:function(data)
      {
        $("#n_compra").val(data.num_recibo);
      }
    })
}

var detalles = [];
function agregar_aro(id_producto){
  $.ajax({
  url:"ajax/compras.php?op=buscar_aros_id",
  method:"POST",
  data:{id_producto:id_producto},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);   
    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      modelo   : data.modelo,
      marca    : data.marca,
      color    : data.color,
      medidas  : data.medidas,
      diseno   : data.diseno,
      materiales : data.materiales,
      precio_compra : 0,
      precio_venta  : 0,
      subtotal : 0,
      categoria : data.categoria
    };//Fin objeto
    detalles.push(obj);
    listarDetallesCompras();
    $('#modalAros').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax

}

////////////AGREGAR ACCESORIOS A COMPRA**
var detalles = [];
function agregar_accesorio(id_producto){
  $.ajax({
  url:"ajax/compras.php?op=buscar_acc_id",
  method:"POST",
  data:{id_producto:id_producto},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);   
    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      modelo   : data.modelo,
      marca    : data.marca,
      color    : "",
      medidas  : "",
      diseno   : "",
      materiales : "",
      precio_compra : 0,
      precio_venta  : 0,
      subtotal : 0,
      categoria : data.categoria
    };//Fin objeto
    detalles.push(obj);
    listarDetallesCompras();
    $('#modalAccesorios').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax

}

/////////fin aggergar acc a compra
function listarDetallesCompras(){

    $('#listar_det_compras').html('');

    var filas = "";
    //var subtotal = 0;
    var total = 0;

    for(var i=0; i<detalles.length; i++){

    var subtotal = detalles[i].subtotal = detalles[i].cantidad * detalles[i].precio_compra;

        var filas = filas + "<tr id='fila"+i+"'><td>"+(i+1)+
        "</td><td style='text-align:center;'>"+detalles[i].categoria+" "+detalles[i].marca+" "+
        "Mod.: "+detalles[i].modelo+" "+detalles[i].color+" "+
        detalles[i].medidas+" "+detalles[i].diseno+" "+detalles[i].materiales+

        "</td><td style='text-align:center'><input style='text-align:right;border-radius:3px' type='text' class='cantidad form-control' name='precio_compra[]' id='precio_compra[]' onClick='setPrecioCompra(event, this, "+(i)+");' onKeyUp='setPrecioCompra(event, this, "+(i)+");' value='"+  detalles[i].precio_compra+"'><td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'><td style='text-align:center'><input style='text-align:right' type='text' class='cantidad form-control' name='cantidad[]' id='pv"+(i)+"' onClick='setPrecioVenta(event, this, "+(i)+");' onKeyUp='setPrecioVenta(event, this, "+(i)+");' value='"+detalles[i].precio_venta+"'></td><td style='text-align:center;'><span>$</span><span style='text-align:right' name='subtotal[]' id=subtotal"+i+" >"+detalles[i].subtotal+"</span><td style='text-align:center'><i class='nav-icon fas fa-trash-alt fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>";

        "</td><td style='text-align:center'><input style='text-align:right;border-radius:3px' type='text' class='cantidad form-control' name='precio_compra[]' id='precio_compra[]' onClick='setPrecioCompra(event, this, "+(i)+");' onKeyUp='setPrecioCompra(event, this, "+(i)+");' value='"+  detalles[i].precio_compra+"'><td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'><td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' name='cantidad[]' id='pv"+(i)+"' onClick='setPrecioVenta(event, this, "+(i)+");' onKeyUp='setPrecioVenta(event, this, "+(i)+");' value='"+detalles[i].precio_venta+"'></td><td style='text-align:center;'><span>$</span><span style='text-align:right' name='subtotal[]' id=subtotal"+i+" >"+detalles[i].subtotal+"</span><td style='text-align:center'><i class='nav-icon fas fa-trash-alt fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>";


    //subtotal = subtotal + importe;

  }//cierre for
  $('#listar_det_compras').html(filas);
}

function setCantidad(event, obj, idx){
    event.preventDefault();
    detalles[idx].cantidad = parseInt(obj.value);
    recalcular(idx);
  }

function setPrecioCompra(event, obj, idx){
    event.preventDefault();
    detalles[idx].precio_compra = parseFloat(obj.value);
    recalcular(idx);
  }

function setPrecioVenta(event, obj, idx){
    event.preventDefault();
    detalles[idx].precio_venta = parseFloat(obj.value);
    recalcular(idx);
  }

function recalcular(idx){

    console.log(detalles[idx].cantidad);
    console.log((detalles[idx].cantidad * detalles[idx].precio_compra));

    var subtotal =detalles[idx].subtotal = detalles[idx].cantidad * detalles[idx].precio_compra;

    console.log(subtotal.toFixed(2));
    //importe = detalles[idx].importe = detalles[idx].importe - (detalles[idx].importe * detalles[idx].dscto/100);

    subtotalFinal = subtotal.toFixed(2);
    $('#subtotal'+idx).html(subtotalFinal);

    calcularTotales();
  }

function calcularTotales() {
  var total_final=0;
  for(var i=0;i<detalles.length;i++){
    total_final=total_final+detalles[i].subtotal;
  }

  $('#total_compra').html(total_final.toFixed(2));
}

//////////////REGISTRAR COMPRA

 function registrarCompra(){

  var  n_compra = $("#n_compra").val();
  var  proveedor_compra = $("#proveedor_compra").val();
  var  codigo_proveedor = $("#codigo_proveedor").val();
  var  tipo_compra = $("#tipo_compra").val();
  var  tipo_pago= $("#tipo_pago").val();
  var  plazo= $("#plazo").val();
  var  sucursal= $("#sucursal").val();
  var  tipo_documento= $("#tipo_documento").val();
  var  documento= $('#documento').val();
  var  usuario= $('#usuario').val();
  var  fecha= $('#fecha').val();
  var  total_compra= $('#total_compra').html();

  compra_precio_empty=[];
  for(var i=0;i<detalles.length;i++){
    var currentPrecioCompra = detalles[i].precio_compra;
    var currentPrecioVenta = detalles[i].precio_venta;
    if(currentPrecioVenta<=currentPrecioCompra){
      Swal.fire('El precio de venta debe ser mayor al precio de compra!','','error')
      var parametro ='pv'+i;
      document.getElementById(parametro).style.border='solid 1px red';
      return false;
    }
    if(currentPrecioCompra == 0){
      compra_precio_empty.push(currentPrecioCompra);
    }
    if(currentPrecioVenta == 0){
      compra_precio_empty.push(currentPrecioVenta);
    }
  }

var test_array = detalles.length;
  if (test_array<1) {
  Swal.fire('Debe Agregar Productos a la compra!','','error')
  return false;
}
var cuenta_vacios = compra_precio_empty.length;
if (cuenta_vacios>0) {
  Swal.fire('Debe llenar los precios de compra y precios de venta correctamente!','','error')
  return false;
}

if(tipo_compra=='Credito' && plazo=='contado'){
  Swal.fire('Su compra es un Crédito seleccione el plazo!','','error')
  return false
}

  if(n_compra!="" && proveedor_compra!="" && codigo_proveedor!='' && tipo_compra!='' && tipo_pago!='' && plazo!='' && tipo_documento!='' && documento!='' && total_compra!=''){
    console.log('Message Oscar');
    $.ajax({
    url:"ajax/compras.php?op=registrar_compra",
    method:"POST",
    data:{'arrayCompra':JSON.stringify(detalles),'n_compra':n_compra,'proveedor_compra':proveedor_compra,'codigo_proveedor':codigo_proveedor,'tipo_compra':tipo_compra,'tipo_pago':tipo_pago,'plazo':plazo,'tipo_documento':tipo_documento,'documento':documento,'usuario':usuario,'fecha':fecha,'total_compra':total_compra,'sucursal':sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      console.log(x);
      console.log(y);
      console.log(z);
    },

  success:function(data){
    console.log(data);
    if (data=='ok') {
    detalles = [];
    $('#listar_det_compras').html('');
    setTimeout ("Swal.fire('La Compra ha sido Exitosa!','','success')", 100);
    ocultar_btn_de_compra();
    setTimeout ("mostrar_btn_post_compra()", 2000);
  }else{
    setTimeout ("Swal.fire('El numero de compra ya se ncuentra registrado','','error')", 100);
    return false;
  }
  }

  });

   //cierre del condicional de validacion de los campos del producto,proveedor,pago
  }else{
    Swal.fire('Existen campos  vacios o sin seleccionar!','','error')
    return false;
  }

}

function explode(){
  location.reload();
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
////////////////////GET COMPRAS INGRESAR
function ingresar_compras_inventario()
{
  tabla_compras_ingresar=$('#data_ingresos_bodega').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/compras.php?op=compras_ingreso',
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
///////////////////////REPORTE DE COMPRAS ADMIN
////////////////////GET COMPRAS INGRESAR
function ingresar_compras_inventario()
{
  tabla_compras_ingresar=$('#data_ingresos_bodega').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
             buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/compras.php?op=compras_ingreso',
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
///////////////////////REPORTE DE COMPRAS ADMIN
function reporte_compras_admin()
{
  var numero_compra = $("#n_compra").val();
  $("#modal_print_admin").modal("show");
  //alert(numero_compra);
  //return false;
  tabla_compras_admin_report=$('#reporte_compra_admin').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
             buttons: [
                'excelHtml5'
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

function cursor_d(){
  $('div.dataTables_filter input').focus();
}
init();
