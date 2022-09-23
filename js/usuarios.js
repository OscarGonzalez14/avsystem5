var tabla_usuarios_creados;

function init(){
  listar_usuarios();

  //////listar permisos de usuario
  $.post("ajax/usuarios.php?op=permisos&id_usuario=",function(r){
          $("#permisos").html(r);
   });

}

function guardarUsuario(){

  var permisos = [];
  // Initializing array with Checkbox checked values
  $("input[name='permisos_user']:checked").each(function(){
  var obj = {
    permisos : this.value,
    //categoria : this.className
  }
  permisos.push(obj);
  }); 
  
  console.log(permisos);
	//se definen las varibles segun id de los campos en modal nuevo usuario
	var nom_user =$("#nom_user").val();
	var tel_user =$("#tel_user").val();
	var correo_user	=$("#correo_user").val();
	var dir_user =$("#dir_user").val();
	var user =$("#user").val();
	var pass_user =$("#pass_user").val();
	var fecha_ingreso =$("#fecha_ingreso").val();
	var cat_user =$("#cat_user").val();
	var est_user =$("#est_user").val();
	var suc_user =$("#suc_user").val();
  var cod_user =$("#cod_user").val();
  var id_usuario = $("#id_user").val();

	//Se validan los campos de modal nuevo usuario
	if (nom_user !="" && user !="" && pass_user !="" && cat_user !="" && suc_user !=""){
		$.ajax({
		url:"ajax/usuarios.php?op=guardar_usuario",
		method:"POST",
		data:{'permisosUser':JSON.stringify(permisos),nom_user:nom_user,tel_user:tel_user,correo_user:correo_user,dir_user:dir_user,user:user,pass_user:pass_user,fecha_ingreso:fecha_ingreso,cat_user:cat_user,est_user:est_user,suc_user:suc_user,cod_user:cod_user,id_usuario:id_usuario},
		cache: false,
		dataType: "json",
		error:function(x,y,z){
			d_pacole.log(x);
			console.log(y);
			console.log(z);
		},
		success:function(data){
		console.log(data);
			if (data=="ok"){
        setTimeout ("Swal.fire('Se ha registrado un nuevo usuario','','success')", 100)
        setTimeout ("explode();", 2000);
      }else{
        setTimeout ("Swal.fire('El usuario ha sido editado','','info')", 100)

      }
      setTimeout ("explode();", 2000);
		}

		});
		/*setTimeout ("Swal.fire('Se ha registrado un nuevo usuario','','success')", 100)
        setTimeout ("explode();", 2000);*/
	
	}
}

function get_cod_user(){

  $.ajax({
    url:"ajax/usuarios.php?op=get_numero_usuario",
    method:"get",
    cache:false,
    dataType:"json",
      success:function(data){
      $("#cod_user").val(data.correlativo);             
      }
    })

}

////////////////EDITAR USUARIO
function show_datos_paciente(id_usuario){

  $.post("ajax/usuarios.php?op=show_datos_usuario",{id_usuario : id_usuario}, function(data, status){
    data = JSON.parse(data);
    console.log(data);
            $('#nuevo_usuario').modal('show');
            $('#id_user').val(data.id_usuario);
            $("#nom_user").val(data.nombres);
            $('#tel_user').val(data.telefono);
            $("#correo_user").val(data.correo);
            $('#dir_user').val(data.direccion);
            $('#user').val(data.usuario);
            $('#pass_user').val(data.password);
            $('#cat_user').val(data.categoria);
            $('#est_user').val(data.estado);
            $('#suc_user').val(data.sucursal);
            $('#head').text("Editar Usuario");
            $('#id_usuario').val(id_usuario);
            $('#cod_user').val(data.id_user_emp);

      });

         //muestra los checkbox en la ventana modal de usuarios
   $.post("ajax/usuarios.php?op=permisos&id_usuario="+id_usuario,function(r){
          $("#permisos").html(r);
    });

}

 function explode(){
    location.reload();
  }

  /////////////////LISTAR USUARIOS///////
function listar_usuarios(){
  tabla_usuarios_creados=$('#data_lista_usuarios_creados').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/usuarios.php?op=listar_usuarios',
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


init();

