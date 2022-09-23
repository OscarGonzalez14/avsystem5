<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("header_dos.php");
require_once("modals/modal_nuevo_usuario.php")
?>


 <div class="content-wrapper">
 	<div style="margin:7px;">
 	<a class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#nuevo_usuario" data-backdrop="static" data-keyboard="false" onClick="get_cod_user()"><i class="fas fa-plus-square"></i> Crear Usuario</a>&nbsp;
 	</div>
<section>
	<div style="margin: 1px">
	<div class="callout callout-info">
        <h5 align="center"><i class="fas fa-users" style="color:green"></i> <strong>LISTADO USUARIOS</strong></h5>              
    </div>
	<table class="table" id="data_lista_usuarios_creados" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Nombre</th>
            <th style="text-align:center">Usuario</th>
            <th style="text-align:center">Categoría</th>
            <th style="text-align:center">Teléfono</th>
            <th style="text-align:center">Correo</th>
            <th style="text-align:center">Dirección</th>
            <th style="text-align:center">Editar</th>
            <th style="text-align:center">Estado</th>
          </tr>
        </thead>
      </table>   <!-- /.content -->
	</div>
</section>
</div>

<?php require_once("footer.php"); ?>
<script src="js/usuarios.js"></script>
<script src="js/cleave.js"></script>
 <script>
	 function mayus(e) {
    e.value = e.value.toUpperCase();
}

	var tel_user = new Cleave('#tel_user', {
    delimiter: '-',
    blocks: [4,4],
    uppercase: true
});
</script>

<?php } else{
echo "Acceso denegado";
header("Location:index.php");
        exit();
  } ?>