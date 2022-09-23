function init(){
	get_correlativo_orden();
	listado_general_envios();
	document.getElementById("btn_recibir_lab").style.display = "none";
  listar_estado_ordenes();
  //document.getElementById("observaciones_ca").style.display = "none";	
}
//GET DATA NUEVA ORDEN

function get_data_orden(){
 get_correlativo_orden();
 let tipo_venta_orden = $("#tipo_venta_orden").val();
 let sucursal = $("#sucursal").val();
 let sucursal_usuario = $("#sucursal_usuario").val();
 let laboratorio_orden = $("#laboratorio_orden").val();


$("#modal_consultas_orden").modal('show');

	tabla = $('#data_consultas_orden').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',		           
		            'pdf'
		        ],
		"ajax":
				{
					url: 'ajax/ordenes.php?op=get_consultas',
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

function agregaConsultaOrden(id_paciente,id_consulta,evaluado){
 $("#modal_consultas_orden").modal('hide');
 console.log(`id=${id_paciente} id_consulta =${id_consulta} evaluado ${evaluado}`);
 $.ajax({
	url:"ajax/consultas.php?op=ver_consultas",
	method:"POST",
    data:{id_consulta:id_consulta},
	cache:false,
	dataType:"json",
	success:function(data){
		console.log(data);
		$("#paciente_orden").val(data.p_evaluado);
		$("#id_consulta_orden").val(id_consulta);
		$("#id_pac_orden").val(id_paciente);
	 //////////////////////////rx final oI
	    $("#oiesferasf_orden").val(data.oiesferasf);
	    $("#oicolindrosf_orden").val(data.oicolindrosf);
	    $("#oiejesf_orden").val(data.oiejesf);
	    $("#oiprismaf_orden").val(data.oiprismaf);
	    $("#oiadicionf_orden").val(data.oiadicionf);
	    //////////////////////////rx final oD
		  $("#odesferasf_orden").val(data.odesferasf);
		  $("#odcilindrosf_orden").val(data.odcilindrosf);
		  $("#odejesf_orden").val(data.odejesf);
		  $("#odprismaf_orden").val(data.dprismaf);
	    $("#oddicionf_orden").val(data.oddicionf);
	    ////////DISTANCIAS INTERPUPILARES
	    $("#dip_od").val(data.oddip);
	    $("#dip_oi").val(data.oidip);
	    $("#ao_od").val(data.aood);
	    $("#ao_oi").val(data.aooi);
	    $("#ap_od").val(data.apod);
	    $("#ap_oi").val(data.opoi);
	    
	}

})

 //////////////////GET NUMERO_VENTA
 $.ajax({
 	url: "ajax/ordenes.php?op=get_numero_venta",
 	method: "POST",
 	data: {id_paciente:id_paciente,evaluado:evaluado},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 		console.log(data);
 		let numero_venta = data.numero_venta;
 		console.log(`Numero venta ${numero_venta}`);
 		get_items_venta(numero_venta,id_paciente);
 	}
 })
}

function get_items_venta(numero_ventas,id_paciente){
  tratamientos = [];
	console.log("PPPP"+numero_ventas+"Pac"+id_paciente);
	let numero_venta = numero_ventas;
	console.log(numero_venta);
  console.log(id_paciente);
	$.ajax({
 	url: "ajax/ordenes.php?op=get_items_venta",
 	method: "POST",
 	data: {id_paciente:id_paciente,numero_venta:numero_venta},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 		console.log(data);
 		for(var i in data){
 			console.log(data[i]);
 			let codProd = (data[i]).toString();
 			console.log(codProd);
 			//////////get categoria del producto
 			$.ajax({
 	         url: "ajax/ordenes.php?op=get_categoria_producto",
 	         method: "POST",
 	         data: {codProd:codProd},
 	         cache:false,
 	         dataType: "json",
 	         success:function(data){
 		     console.log(data);
 		       for(var i in data){//GET CATEGORIA AROS
 			   console.log(data[i]);
 			   let catProd = (data[i]).toString();
         console.log(catProd);
 			   if (catProd=="aros") {
 			   	get_data_aros(codProd);
 		       }else if(catProd=="Lentes"){
 		       	get_data_lentes(codProd);
 		       }else if(catProd=="Photosensible" || catProd=="Antireflejante"){
 		       	get_data_tratamientos(codProd)
 		       }
 		    }//FIN GET CATEGORIA AROS
 		    }
        })//FIN AJAX GET CATEGORIA LENTES
 		} 		
 	}
})//////////FIN GET ITEMS VENTAS

}


function get_data_aros(codProd){
 //////////////////GET DETALLES DE AROS
 let id_producto = codProd; 
 $.ajax({
 	url: "ajax/ordenes.php?op=get_detalle_aro",
 	method: "POST",
 	data: {id_producto:id_producto},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 	   console.log(data);
 	   $("#modelo_aro_orden").val(data.modelo);
 	   $("#marca_aro_orden").val(data.marca);
 	   $("#color_aro_orden").val(data.color);
 	   $("#diseno_aro_orden").val(data.diseno); 		
 	}
 })
}


function get_data_lentes(codProd){
	let id_producto = codProd;
	$.ajax({
 	url: "ajax/ordenes.php?op=get_detalle_tratamientos",
 	method: "POST",
 	data: {id_producto:id_producto},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 	   console.log(data);
 	   $("#lente_orden").val(data.desc_producto);		
 	}
 })
}

tratamientos = [];
function get_data_tratamientos(codProd){

    let id_producto = codProd;
		$.ajax({
 	    url: "ajax/ordenes.php?op=get_detalle_tratamientos",
 	    method: "POST",
 	    data: {id_producto:id_producto},
 	    cache:false,
 	    dataType: "json",
 	    success:function(data){
 	    console.log(data);
 	    tratamientos.push(" "+data.desc_producto);
 	    tratamientos.toString();
 	    $("#tratamiento_orden").val(tratamientos);

 	}
 })

}

function registrarEnvio(){

    let paciente_orden = $("#paciente_orden").val();
	  let laboratorio_orden = $("#laboratorio_orden").val();
	  let id_pac_orden = $("#id_pac_orden").val();
	  let id_consulta_orden = $("#id_consulta_orden").val();
    
    let  lente_orden =$("#lente_orden").val();    
    let  tratamiento_orden =$("#tratamiento_orden").val();
    let  modelo_aro_orden =$("#modelo_aro_orden").val();
    let  marca_aro_orden =$("#marca_aro_orden").val();
    let  color_aro_orden =$("#color_aro_orden").val();
    let  diseno_aro_orden =$("#diseno_aro_orden").val();

    let  med_a =$("#med_a").val();
    let  med_b =$("#med_b").val();
    let  med_c =$("#med_c").val();
    let  med_d =$("#med_d").val();

    let  observaciones_orden =$("#observaciones_orden").val();
    let  id_usuario = $("#id_usuario").val();
    let  fecha = $("#fecha").val();
    let  sucursal = $("#sucursal").val();
    let  numero_orden = $("#correlativo_orden").html();
    let  prioridad_orden = $("#prioridad_orden").val();

    if(paciente_orden !="" && laboratorio_orden !="" && prioridad_orden !="" && lente_orden !=""){
    $.ajax({
 	   url: "ajax/ordenes.php?op=registrarEnvio",
 	   method: "POST",
 	   data: {paciente_orden:paciente_orden,laboratorio_orden:laboratorio_orden,id_pac_orden:id_pac_orden,id_consulta_orden:id_consulta_orden,
 	   lente_orden:lente_orden,tratamiento_orden:tratamiento_orden,modelo_aro_orden:modelo_aro_orden,marca_aro_orden:marca_aro_orden,
 	   color_aro_orden:color_aro_orden,diseno_aro_orden:diseno_aro_orden,med_a:med_a,med_b:med_b,med_c:med_c,med_d:med_d,observaciones_orden:observaciones_orden,
 	   id_usuario:id_usuario,fecha:fecha,sucursal:sucursal,numero_orden:numero_orden,prioridad_orden:prioridad_orden},
 	   cache:false,
 	   dataType: "json",
 	   success:function(data){
 	   console.log(data);
 	   if (data == "ok") {
 	   	Swal.fire('Envio a laboratorio registrado exitosamente!','','success');
 	   	$("#nueva_orden_lab").modal('hide');
 	   	$('#data_envios_lab').DataTable().ajax.reload();
      listar_estado_ordenes();
 	   }else{
 	   	Swal.fire('Correlativo ya Existe,  actualizar navegador!','','error');
 	   }

 	}
})
}else{
Swal.fire('Llenar los campos obligatorios correctamente!','','error');	
}
}

function get_correlativo_orden(){
	var sucursal = $("#sucursal").val();
	$.ajax({
    url:"ajax/ordenes.php?op=get_numero_orden",
    method:"POST",
    data:{sucursal:sucursal},
    cache:false,
    dataType:"json",
      success:function(data){
    	$("#correlativo_orden").html(data.correlativo);             
      }
    })
}


////////////////////LISTADO GENERAL DE ENVIOS A LABORATORIO
function listado_general_envios(){
	document.getElementById("btn_recibir_lab").style.display = "none";
    document.getElementById("btn_enviar_lab").style.display = "block";
    document.getElementById("fecha_ord").innerHTML = "Fecha Creación";
    document.getElementById("dias_orden").innerHTML = "Usuario";
  var sucursal = $("#sucursal").val();
  let peticion = "creadas";
  tabla_envios_gral=$('#data_envios_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ordenes_enviadas',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,peticion:peticion},
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

////////////////////LISTADO ORDENES ENVIADAS
function listado_ordenes_enviadas(){
  document.getElementById("btn_recibir_lab").style.display = "block";
  document.getElementById("btn_enviar_lab").style.display = "none";
  document.getElementById("fecha_ord").innerHTML = "Fecha Envío";
  document.getElementById("dias_orden").innerHTML = "Dias transcurridos";
  var sucursal = $("#sucursal").val();
  let peticion = "envios";
  tabla_envios_gral=$('#data_envios_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ordenes_enviadas',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,peticion:peticion},
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

///////////////////LISTADO ORDENES RECIBIDAS
function listado_ordenes_recibidas(){
  document.getElementById("btn_recibir_lab").style.display = "none";
  document.getElementById("btn_enviar_lab").style.display = "none";
  document.getElementById("fecha_ord").innerHTML = "Fecha Recibido";
  document.getElementById("acciones_orden").innerHTML = "Revisión";
  document.getElementById("dias_orden").innerHTML = "Recibido por";
  
  var sucursal = $("#sucursal").val();
  let peticion = "recibidas";

  tabla_envios_gral=$('#data_envios_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ordenes_enviadas',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,peticion:peticion},
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

////////////// ACCIONES ORDENES DE LABORATORIOS //////////////////////////

function acciones_envios_lab(id_paciente,numero_orden,evaluado,estado,laboratorio){
	//console.log(`id paciente ${id_paciente} numero_orden: ${numero_orden} evaluado: ${evaluado} estado ${estado} laboratorio ${laboratorio}`)
	let tipo_accion = "Envio a Laboratorio";
    let sucursal = $("#sucursal").val();
    let id_usuario	= $("#id_usuario").val();
	if (estado==0) {		
        bootbox.confirm("Confirmar envio a laboratorios "+laboratorio+", la orden de: "+evaluado, function(result){
            if(result){
             // console.log("Holaaaaaa");
              $.ajax({
                url:"ajax/ordenes.php?op=registrar_envio_lab",
                method:"POST",
                data:{id_paciente:id_paciente,numero_orden:numero_orden,evaluado:evaluado,estado:estado,laboratorio:laboratorio,tipo_accion:tipo_accion,sucursal:sucursal,id_usuario:id_usuario},
                dataType:"json",
                success:function(data){
                console.log(data);//return false;
                $('#data_envios_lab').DataTable().ajax.reload();       
        
                }
             })
            }///fin result
        });//bootbox
	}else if(estado == 1){
		////////////LANZAR VENTANA DE CONTROL DE CALIDAD
	}
}
//****ENVIAR ORDENES******////
var items_envios = [];

$(document).on('click', '.send_orden', function(){
  listar_estado_ordenes();
  var id_pac = $(this).attr("value");
  var orden = $(this).attr("name");
  let id_item = $(this).attr("id");

  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;

  if (check_state == true) {
  	    let obj = {
       	id_paciente : id_pac,
       	numero_orden : orden
       }
       items_envios.push(obj);
  }else if(check_state == false){
	let index = items_envios.findIndex(x => x.numero_orden==orden)
	console.log(index)
	items_envios.splice(index, 1)
  }
  
});

function send_orden_lab(){
   let  tipo_accion = "Envio a laboratorio";
   let  id_usuario = $("#id_usuario").val();
   let  sucursal = $("#sucursal").val();

   $.ajax({
   	url:"ajax/ordenes.php?op=registrar_envio_lab",
    method:"POST",
    data:{'arrayEnvio':JSON.stringify(items_envios),'tipo_accion':tipo_accion,'id_usuario':id_usuario,'sucursal':sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
      },
      success:function(data){
      console.log(data)
       $('#data_envios_lab').DataTable().ajax.reload();
      }     
 
  });
}

////////////////////RECIBIR TRABAJOS /////////////////
var items_recibidos = [];
$(document).on('click','.recibir_orden',function(){
	 console.log("holarec Mundo");
  var id_pac = $(this).attr("value");
  var orden = $(this).attr("name");
  let id_item = $(this).attr("id");
  //console.log(`id ${id_pac} orden ${orden} item ${id_item}`)
  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;
  console.log(check_state);

  if (check_state == true) {
  	    let obj = {
       	id_paciente : id_pac,
       	numero_orden : orden
       }
       items_recibidos.push(obj);
  }else if(check_state == false){
	let index = items_recibidos.findIndex(x => x.numero_orden==orden)
	console.log(index)
	items_recibidos.splice(index, 1)
  }
});

function recibir_orden_lab(){
   let  tipo_accion = "Recibir de laboratorio";
   let  id_usuario = $("#id_usuario").val();
   let  sucursal = $("#sucursal").val();

   $.ajax({
   	url:"ajax/ordenes.php?op=registrar_entrega_lab",
    method:"POST",
    data:{'arrayRecibir':JSON.stringify(items_recibidos),'tipo_accion':tipo_accion,'id_usuario':id_usuario,'sucursal':sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
      },
      success:function(data){
      console.log(data)
       $('#data_envios_lab').DataTable().ajax.reload();
       listar_estado_ordenes();
      }     
 
  });
}

function aprobar_orden_laboratorio(){

  var numero_orden = $("#numero_orden_ca").val();
  var id_paciente =$("#id_paciente_ca").val();
  var estado_varilla = [];
  var estado_frente = [];
  var codos_flex = [];
  var graduaciones = [];
  var productos = [];
  var items_malos = [];  
  var observaciones = $("#observaciones_control_ca").val();
  var id_usuario = $("#id_usuario").val();
  let  tipo_accion = "Control de calidad";
  let  sucursal = $("#sucursal").val();
  //let  id_usuario = $("#id_usuario").val();

  $.each($("input[name='estado_var']:checked"), function(){
    estado_varilla.push($(this).val());
  });
  $.each($("input[name='estado_frente']:checked"), function(){
    estado_frente.push($(this).val());
  });
  $.each($("input[name='estado_codos']:checked"), function(){
    codos_flex.push($(this).val());
  });
  $.each($("input[name='estado_graduaciones']:checked"), function(){
    graduaciones.push($(this).val());
  });
  $.each($("input[name='productos_orden']:checked"), function(){
    productos.push($(this).val());
  });
  //console.log(`Estado Varilla ${estado_varilla} Estado frente ${estado_frente} Estado frente ${codos_flex} Estado frente ${graduaciones}`);  
  let estado_varilla_f = estado_varilla.toString();
  let estado_frente_f = estado_frente.toString();
  let codos_flex_f = codos_flex.toString();
  let graduaciones_f = graduaciones.toString();
  let productos_f = productos.toString();
  

  for(var i=0;i < estado_varilla.length;i++){
    if(estado_varilla[i]=="Malo"){
      items_malos.push("1");
    }
  }
  for(var i=0;i < estado_frente.length;i++){
    if(estado_frente[i]=="Malo"){
      items_malos.push("1");
    }
  }
    for(var i=0;i < codos_flex.length;i++){
    if(codos_flex[i]=="Malo"){
      items_malos.push("1");
    }
  }
  for(var i=0;i < graduaciones.length;i++){
    if(graduaciones[i]=="Malo"){
      items_malos.push("1");
    }
  }

if (productos.length == 0) {
  setTimeout ("Swal.fire('Verificar la entrega de Accesorios','','warning')", 100);
  return false; 
}


  if (items_malos.length>0 && observaciones == "") {
    setTimeout ("Swal.fire('Debe colocar una observacion','','error')", 100);
  }else{
    $.ajax({
    url:"ajax/ordenes.php?op=registrar_control_calidad",
    method:"POST",
    data:{numero_orden:numero_orden,id_paciente:id_paciente,estado_varilla_f:estado_varilla_f,estado_frente_f:estado_frente_f,
    codos_flex_f:codos_flex_f,graduaciones_f:graduaciones_f,productos_f:productos_f,observaciones:observaciones,id_usuario:id_usuario,tipo_accion:tipo_accion,sucursal:sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
      },
      success:function(data){
      console.log(data)
      $("#cantrol_calidad_ord").modal('hide');
       $('#data_envios_lab').DataTable().ajax.reload();
      }     
 
  });
  }

}

function rechazar_orden(){
  let numero_orden = $("#numero_orden_ca").val();
  let id_paciente =$("#id_paciente_ca").val();
  let observaciones = $("#observaciones_control_ca").val();
  let id_usuario = $("#id_usuario").val();
  let tipo_accion = "Rechazar";
  let sucursal = $("#sucursal").val();
  if(observaciones != ""){
  bootbox.confirm("¿Está eguro de rechazar estar orden?", function(result){
    if(result){
  $.ajax({
    url:"ajax/ordenes.php?op=rechazar_orden_lab",
    method:"POST",
    data: {numero_orden:numero_orden,id_paciente:id_paciente,observaciones:observaciones,id_usuario:id_usuario,tipo_accion:tipo_accion,sucursal:sucursal},
    cache: false,
    dataType:"json",
      success:function(data){
        console.log(data);
      setTimeout ("Swal.fire('Se ha rechazado la orden','','warning')", 100);
      $('#data_envios_lab').DataTable().ajax.reload();
      listar_estado_ordenes();
    } 
 
  });
}
});//bootbox
}else{
  setTimeout ("Swal.fire('Especifique el motivo de rechazo','','info')", 100);
  return false;
}
}

function control_calidad_orden(id_paciente,numero_orden){
  $("#cantrol_calidad_ord").modal('show');
  $("#id_paciente_ca").val(id_paciente);
  $("#numero_orden_ca").val(numero_orden);

  var elements=document.getElementsByClassName('check_producto');
  var elements_checkados=document.getElementsByClassName('checkados');

    Array.prototype.forEach.call(elements, function(element) {
       element.checked = false;
    });

    Array.prototype.forEach.call(elements_checkados, function(element) {
       element.checked = true;
    });

    $(".control_c_clear").val("");

}

var notas = [];
function contacto_paciente(id_paciente,numero_orden){
  notas = [];
  $("#observaciones_contacto").val("");
  $("#contactos_pac_orden").modal('show');
  $("#id_pac_contact").val(id_paciente);
  $("#n_orden_contact").val(numero_orden);


  $.ajax({
    url:"ajax/ordenes.php?op=get_datos_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache: false,
    dataType:"json",
      success:function(data){
      $("#evaluado_cont").html(data.evaluado);
      $("#titular_cont").html(data.nombres);
      $("#empresa_cont").html(data.empresas);
      $("#cel_cont").html(data.telefono);
      $("#tel_ofi_c").html(data.telefono_oficina);
      $("#correo_cont").html(data.correo);
      $('#data_envios_lab').DataTable().ajax.reload();
    } 
 
  });

  $.ajax({
    url:"ajax/ordenes.php?op=get_notas_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache: false,
    dataType:"json",
      success:function(data){
      console.log(data);
      for( var i in data){
        var obj = {
          fecha : data[i].fecha,
          usuario : data[i].usuario,
          observaciones : data[i].observaciones
        };
       notas.push(obj);
      }
      listar_notas_de_contacto();
      $('#data_envios_lab').DataTable().ajax.reload();
    }     

  });
}

function listar_notas_de_contacto(){

    $('#listar_notas_contacto').html('');
    var filas = "";

    for(var i=0; i<notas.length; i++){
      var filas = filas + "<tr id='fila"+i+"'><td colspan='15' style='width: 15%'>"+notas[i].fecha+"</td>"+
       "<td colspan='15' style='width: 15%'>"+notas[i].usuario+"</td>"+
      "<td colspan='70' style='width: 70%'>"+notas[i].observaciones+"</td>"+"</tr>";
    }
  $('#listar_notas_contacto').html(filas);
}

$(document).keypress(function(e) {
    if(e.which == 13) {
        registrar_contacto();
    }
});

function registrar_contacto(){
 let id_paciente = $("#id_pac_contact").val();
 let numero_orden = $("#n_orden_contact").val();
 let observaciones = $("#observaciones_contacto").val();
 let tipo_accion = "LLamada";
 let id_usuario = $("#id_usuario").val();
 let sucursal = $("#sucursal").val(); 
  
  $.ajax({
    url:"ajax/ordenes.php?op=registrar_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden,observaciones:observaciones,tipo_accion:tipo_accion,id_usuario:id_usuario,sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    if(data=="ok"){
    setTimeout ("Swal.fire('Se ha registrado un intento de contacto','','info')", 100);
    $("#contactos_pac_orden").modal('hide');
    $('#data_envios_lab').DataTable().ajax.reload();       
    } 
    }
  }) 

}

///////////LIMPIAR CAMPOS DE MODAL ORDEN
$(document).on('click', '.clear_orden', function(){    
  $(".clear_orden_i").val("")
});

////////// LISTAR ORDENES RETRASADAS  ///////////
function listar_estado_ordenes(){
  let sucursal = $("#sucursal").val();
    $.ajax({
    url:"ajax/ordenes.php?op=get_ordenes_retrasadas",
    method:"POST",
    data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_retrasados").html(data);    
    }     
  });

  ///////////LISTAR ORDENES RECIBIDAS  //////////
  $.ajax({
    url:"ajax/ordenes.php?op=get_ordenes_recibidas",
    method:"POST",
    data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_recibidos").html(data);    
    }     
  });

  /////////////////LISTAR ORDENES ENVIADAS /////////
  $.ajax({
    url:"ajax/ordenes.php?op=get_ordenes_enviadas",
    method:"POST",
    data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_enviadas").html(data);    
    }     
  });

  ///////////LISTAR ORDENES CREADAS ///////////////
    $.ajax({
    url:"ajax/ordenes.php?op=get_ordenes_creadas",
    method:"POST",
    data:{sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    $("#alert_creadas").html(data);    
    }     
  });

}
var historial_orden = [];
function detalles_orden(id_paciente,numero_orden,evaluado,id_consulta){

  $("#detalles_orden_lab").modal("show");

    $.ajax({
    url:"ajax/ordenes.php?op=get_detalles_orden",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden,evaluado:evaluado},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
      $("#n_orden_det").val(data.numero_orden);
      $("#titular_det").val(data.nombres);
      $("#evaluado_det").val(data.evaluado);
      $("#laboratorio_det").val(data.laboratorio);
    }     
  });

 $.ajax({
  url:"ajax/consultas.php?op=ver_consultas",
  method:"POST",
  data:{id_consulta:id_consulta},
  cache:false,
  dataType:"json",
  success:function(data){
    console.log(data);
     $("#paciente_orden_det").val(data.p_evaluado);
     $("#id_consulta_orden_det").val(id_consulta);
     $("#id_pac_orden_det").val(id_paciente);
   //////////////////////////rx final oI
      $("#oiesferasf_orden_det").val(data.oiesferasf);
      $("#oicolindrosf_orden_det").val(data.oicolindrosf);
      $("#oiejesf_orden_det").val(data.oiejesf);
      $("#oiprismaf_orden_det").val(data.oiprismaf);
      $("#oiadicionf_orden_det").val(data.oiadicionf);
      //////////////////////////rx final oD
      $("#odesferasf_orden_det").val(data.odesferasf);
      $("#odcilindrosf_orden_det").val(data.odcilindrosf);
      $("#odejesf_orden_det").val(data.odejesf);
      $("#odprismaf_orden_det").val(data.dprismaf);
      $("#oddicionf_orden_det").val(data.oddicionf);
      ////////DISTANCIAS INTERPUPILARES
      $("#dip_od_det").val(data.oddip);
      $("#dip_oi_det").val(data.oidip);
      $("#ao_od_det").val(data.aood);
      $("#ao_oi_det").val(data.aooi);
      $("#ap_od_det").val(data.apod);
      $("#ap_oi_det").val(data.opoi);      
    }
  });

  $.ajax({
  url:"ajax/ordenes.php?op=get_data_envios",
  method:"POST",
  data:{id_consulta:id_consulta,id_paciente:id_paciente,numero_orden:numero_orden,evaluado:evaluado},
  cache:false,
  dataType:"json",
  success:function(data){
  console.log(data);
    $("#lente_orden_det").val(data.lente);
    $("#tratamiento_orden_det").val(data.tratamientos);
    $("#lente_orden_det").val(data.lente);
    $("#modelo_aro_orden_det").val(data.modelo_aro);
    $("#marca_aro_orden_det").val(data.marca_aro);
    $("#color_aro_orden_det").val(data.color_aro);
    $("#diseno_aro_orden_det").val(data.diseno);    
    $("#med_a_det").val(data.med_a);
    $("#med_b_det").val(data.med_b);
    $("#med_c_det").val(data.med_c);
    $("#med_d_det").val(data.med_d);
    $("#observaciones_orden_det").val(data.observaciones);
    $("#prioridad_orden_det").val(data.prioridad+" dias");
    }
   });

    $.ajax({
      url:"ajax/ordenes.php?op=get_creacion_orden",
      method:"POST",
      data:{id_consulta:id_consulta,id_paciente:id_paciente,numero_orden:numero_orden,evaluado:evaluado},
      cache:false,
      dataType:"json",
      success:function(data){
      console.log(data);
      $("#fecha_acc_ord").html(data.fecha_creacion);
      $("#usuario_acc_ord").html(data.usuario);
      $("#acc_orden").html(data.accion);
     }
  });

  historial_orden = [];
  $.ajax({
    url:"ajax/ordenes.php?op=get_historial_orden",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache: false,
    dataType:"json",
      success:function(data){
      console.log(data);
      for( var i in data){
        var obj = {
          fecha : data[i].fecha,
          usuario : data[i].usuario,
          tipo_accion : data[i].tipo_accion
        };
       historial_orden.push(obj);
      }
      listar_historial_orden();
      //$('#data_envios_lab').DataTable().ajax.reload();
    }     

  });
}

function listar_historial_orden(){

    $('#historial_orden_detalles').html('');
    var filas = "";

    for(var i=0; i<historial_orden.length; i++){
      var filas = filas + "<tr id='fila"+i+"'><td colspan='15' style='width: 15%'>"+historial_orden[i].fecha+"</td>"+
       "<td colspan='20' style='width: 20%'>"+historial_orden[i].usuario+"</td>"+
      "<td colspan='65' style='width: 65%'>"+historial_orden[i].tipo_accion+"</td>"+"</tr>";
    }
    
    $('#historial_orden_detalles').html(filas);
}
var items_ccf = [];

function get_data_ccf(id_envio){
  items_ccf = [];
  $("#ingreso_ccf_lab").modal('show');
  $.ajax({
  url:"ajax/ordenes.php?op=get_data_ccf",
  method:"POST",
  data:{id_envio:id_envio},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);
    $("#laboratorio_ccf").val(data.laboratorio);
    $("#evaluado_cff").val(data.evaluado);
    $("#numero_de_orden").val(data.numero_orden);
    $("#id_envio").val(id_envio);


    var tratamientos_lentes = data.lente+","+data.tratamientos;
    var elementos_ccf = tratamientos_lentes.split(",");
    console.log(elementos_ccf);

    for (i = 0; i < elementos_ccf.length; i++){
      var precio = 0;
      var tratamiento_i =elementos_ccf[i];
      let tratamiento_2= elementos_ccf[i];
      let tratamiento_1 = tratamiento_2.trim();
      console.log("Este es un item del tratamiento"+tratamiento_1);
        $.ajax({//Ajax2
        url:"ajax/ordenes.php?op=get_precio_tratamiento",
        method:"POST",
        data:{tratamiento_1:tratamiento_1},
        cache:false,
        dataType:"json",
        success:function(data){ //1
        console.log(data);  
        precio = data.precio;
        console.log("Estes el precio del tratamiento" + precio);
        console.log(tratamiento_1);
        create_object(precio,tratamiento_1);
      }//Fin 1
    });//Fin Ajax 2
    //var precio = $("#precio_tratamiento").val();
    /*var obj = {
          tratamiento : tratamiento_i,
          cantidad : 1,
          p_unit : 0,
          subtotal : 0,
          ventas_afectas : 0,
          iva : 0,
          precio : precio
        }
       items_ccf.push(obj);*/
  }/////Fin foreach
  listar_items_cff();
}///////Fin Success1
  });
 
}

function create_object(precio,tratamiento_1){
  var obj = {
    tratamiento : tratamiento_1,
    cantidad : 0,
    p_unit : 0,
    subtotal : 0,
    ventas_afectas : 0,
    iva : 0,
    precio : precio
  }
  items_ccf.push(obj);
  listar_items_cff();
}

function listar_items_cff(){
    $('#listar_items_ccf').html(""); 
  var filas = "";   
  for (i = 0; i < items_ccf.length; i++){
       var filas = filas + "<tr id='fila"+i+"'><td colspan='45' style='width: 45%'>"+items_ccf[i].tratamiento+"</td>"+
       "<td colspan='15' style='width: 15%'><input type='number' class='form-control cantidad' style='text-align: right' value='"+items_ccf[i].cantidad+"' onKeyUp='setCantidad_ccf(event, this, "+(i)+");' onClick='setCantidad_ccf(event, this, "+(i)+");'></td>"+
       "<td colspan='10' style='width: 10%'><input type='number' class='form-control p_unit' style='text-align: right' value='"+items_ccf[i].precio+"' readonly></td>"+
       "<td colspan='10' style='width: 10%'><input type='text' class='form-control gravadas' style='text-align: right' value='"+items_ccf[i].subtotal+"' readonly id='subtotal"+i+"'></td>"+
      "<td colspan='20' style='width: 20%'><input type='text' class='form-control iva' style='text-align: right' value='' readonly id='afectas"+i+"'></td>"+"</tr>";
  }
  
  $('#listar_items_ccf').html(filas);
}

function setCantidad_ccf(event, obj, idx){
  console.log("change");
    event.preventDefault();
    items_ccf[idx].cantidad = parseFloat(obj.value);
    recalcular_ccf(idx);
}

function setP_unit(event, obj, idx){
  event.preventDefault();
  items_ccf[idx].precio = parseFloat(obj.value);
  recalcular_ccf(idx);
  
}

function recalcular_ccf(idx){
  var subtotal = items_ccf[idx].subtotal = items_ccf[idx].cantidad * items_ccf[idx].precio;
  console.log(subtotal);
  subtotalFinal = subtotal.toFixed(2);
  $('#subtotal'+idx).val("$"+subtotalFinal);

  var afectas = subtotalFinal*0.13;
  var total_afectas_item = parseFloat(subtotalFinal)+parseFloat(afectas);
  items_ccf[idx].ventas_afectas = parseFloat(total_afectas_item.toFixed(2))
  $('#afectas'+idx).val(`IVA: $ (${afectas.toFixed(2)}) || +IVA($${total_afectas_item.toFixed(2)})`);
  items_ccf[idx].iva = afectas.toFixed(2);  ////////  IVA 
  calcularTotalesccf();
}

function calcularTotalesccf(){
  var total_items = items_ccf.length;
  let totales_p_unit =0;
  let subtotales = 0;
  for(var i=0; i<items_ccf.length;i++){
    totales_p_unit = totales_p_unit + items_ccf[i].p_unit;
    subtotales = subtotales + items_ccf[i].subtotal;
  
  }
  let total_iva = subtotales*0.13;
  let total_ventas_orden = total_iva+subtotales;
  $("#tot_p_unit").html("$"+totales_p_unit.toFixed(2));
  $("#tot_gravadas_ccf").html("$"+subtotales.toFixed(2));
  $("#tot_iva").html("$"+total_iva.toFixed(2));
  $("#subtotales_ccf").html("$"+subtotales.toFixed(2));
  $("#totales_ccf_orden").html("$"+total_ventas_orden.toFixed(2));

  }

  ///////////////  GUARDAR CCF LABORATORIOS  /////
function registrar_ccf_laboratorio(){

  let numero_comprobante = $("#numero_comprobante").val();
  let laboratorio = $("#laboratorio_ccf").val();
  let evaluado_cff = $("#evaluado_cff").val();
  let fecha = $("#fecha_comproante").val();
  let numero_orden = $("#numero_de_orden").val();
  let id_usuario = $("#id_usuario").val();
  let sucursal = $("#sucursal").val();
  let id_envio = $("#id_envio").val();
  let iva = $("#tot_iva").html();
  let subtotal = $("#subtotales_ccf").html();
  let total_venta = $("#totales_ccf_orden").html();

  var cantidad_empty = 0;

  for(var i=0;i<items_ccf.length;i++){
    
    var current_cantidad = items_ccf[i].cantidad;
    if (current_cantidad == 0) {
      cantidad_empty = cantidad_empty+1;
    }

  }

  if (cantidad_empty > 0){
    Swal.fire('Especifique la cantidad de cada item!','','warning');
    return false;
  }

  if(numero_comprobante != "" && cantidad_empty == 0){
    $.ajax({
    url:"ajax/ordenes.php?op=registrar_ccf_labs",
    method:"POST",
    data:{'arrayCcf':JSON.stringify(items_ccf),'numero_comprobante':numero_comprobante,'laboratorio':laboratorio,'evaluado_cff':evaluado_cff,'fecha':fecha,'numero_orden':numero_orden,'id_usuario':id_usuario,'sucursal':sucursal,'id_envio':id_envio,'iva':iva,'subtotal':subtotal,'total_venta':total_venta},
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
    Swal.fire('El credito fiscal ha sido registrado exitosamente!','','success');
    $("#ingreso_ccf_lab").modal('hide');
    $('#data_envios_lab').DataTable().ajax.reload();
  }else{
    Swal.fire('Este comprobante ya ha sido ingresado!','','error');
  }
  }
    });
  }else{
    Swal.fire('LLenar el formulario correctamente!','','error');
  }
}

function show_ccf(){

  let fecha_inicio = $("#fecha_inicio").val();
  let fin_fecha = $("#fecha_fin").val();
  let laboratorio = $("#lab_ccf").val();
  let sucursal = $("#sucursal_pagos_cff").val();

  console.log(`fecha_inicio: ${fecha_inicio}fin_fecha: ${fin_fecha}laboratorio: ${laboratorio}sucursal: ${sucursal}`)


  tabla_envios_gral=$('#data_pagos_ccf').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ccf_pagos',
          type : "post",
          dataType : "json",
          data:{fin_fecha:fin_fecha,fecha_inicio:fecha_inicio,laboratorio:laboratorio,sucursal:sucursal},
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
init();