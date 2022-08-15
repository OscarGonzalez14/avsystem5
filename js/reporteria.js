function init(){
listar_reporte_facturas();
}

function get_data_ccf(){

 let items = array_total_ccf.length;

 if (items<1) {
 	Swal.fire('Debe Seleccionar pacientes','','error');
 	$("#modal-default").modal('hide');
 	return false;
 }

 document.getElementById("contribuyente_tipo").checked = false;
 let monto_ccf = 0;
 let items_ccf = '';

 for(let j=0;j<array_total_ccf.length;j++){
 	monto_ccf += parseFloat(array_total_ccf[j].monto_venta);
 	items_ccf += "<b>"+array_total_ccf[j].numero_venta+"</b>"+"=$"+array_total_ccf[j].monto_venta+"; ";
 }
 let empresa = $("#empresa").val();

 $("#monto_ccf_det").val(monto_ccf);
 $("#items_ccf_det").val(items_ccf);
 $("#items_lengt").val(array_total_ccf.length);
 $("#empresa_cff").val(empresa);
}

function emitir_ccf(id_paciente,numero_venta,nombres){
	$("#ccf_generica").modal('show');
	$("#n_venta_ccf").val(numero_venta);
	$("#id_paciente_ccf").val(id_paciente);
	$("#cliente_ccf").val(nombres);
}

 ///LISTAR FACTURAS EN DATATABLES REPORTE
  function listar_reporte_facturas(){
    var sucursal = $("#sucursal").val();
    var sucursal_usuario = $("#sucursal_usuario").val();

    $("#listar_reporte_facturas").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      dom: 'Bfrtip',
      "buttons": [ "excel"],
      "searching": true,
      "ajax":
      {
        url: "ajax/reporteria.php?op=listar_facturas",
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


  var sucursales = [];
  var empresarial = [];
  var data = [];
  document.querySelectorAll(".chk_ventas_rep").forEach(i => i.addEventListener("click", e => {
    sucursales = [];
    empresarial = [];
    data = [];

    let rango_fecha = document.getElementById("rango-cobro").value;
    let rango = rango_fecha.replace(" hasta ","*");

    let checkbox_emp = document.getElementById('chk_emp');
    let check_state_emp = checkbox_emp.checked; 

    let checkbox_solo = document.getElementById('chk_emp_solo');
    let check_state_solo = checkbox_solo.checked;

    let checkbox_consolidado = document.getElementById('consolidados_ventas');
    let check_state_consolidado = checkbox_consolidado.checked;

       
    $("input[name='sucursales_chk']:checked").each(function (){
      sucursales.push(($(this).attr("value")));
    });

    for (i = 0; i < sucursales.length; i++) {
      empresarial.push("Empresarial-"+sucursales[i])
    } 

    if(check_state_emp==true && check_state_solo==false){
      data  = sucursales.concat(empresarial);
    }else if(check_state_emp==false && check_state_solo==true){
      data = empresarial;
    }else if(check_state_emp==false && check_state_solo==false){
      data = sucursales;
    }
    let data_ventas = data.toString();
       
    dtTemplateReporteria("reporte_ventas_admin","reporte_ventas_global",rango,data_ventas,check_state_consolidado)

  }));

  function dtTemplateReporteria(table,route,...Args){
  
    tabla = $('#'+table).DataTable({      
      "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [     
        'excelHtml5',
      ],
  
      "ajax":{
        url:"ajax/reporteria.php?op="+ route,
        type : "POST",
        data: {Args:Args},
        dataType : "json",
         
        error: function(e){
        console.log(e.responseText);
      },      
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