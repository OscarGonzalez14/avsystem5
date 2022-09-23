
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
   var precio = $("#precio_requi").val();

   if(descripcion !=""){

		var item = {
			descripcion : descripcion,
			cantidad : cantidad,
			precio : precio
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
	var filas = "";
	for(var i=0; i<item_req.length; i++){
		var filas = filas + "<tr id='fila"+i+"'><td>"+(i+1)+
		"</td><td style='text-align:center;'>"+item_req[i].descripcion+
		"<td style='text-align:center'>"+item_req[i].cantidad+"</td>"+
		"<td style='text-align:center'><i class='nav-icon fas fa-times-circle fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>"

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
    var precio = $("#precio_requi").val();
    var cantidad = $("#cant_requi").val();

	if(cuenta_elem > 0 && numero_req !=""){

	$.ajax({
    url:"ajax/caja.php?op=registrar_req",
    method:"POST",
    data:{'arrayRequisicion':JSON.stringify(item_req),'fecha_req':fecha_req,'numero_req':numero_req,'sucursal':sucursal,'usuario':usuario,'precio':precio,'cantidad':cantidad},
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






/
init();