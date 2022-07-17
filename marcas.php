<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/editar_marca.php');
 ?>

 <div class="content-wrapper">
 	<div style="margin: 1px">
	<div class="callout callout-info" style="margin-top:10px;">
        <h5 align="center"><i class="fas fa-glasses" style="color:green"></i> <strong>LISTADO MARCAS</strong></h5>
    </div>
	<table class="table" id="lista_marcas_creadas" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Marca</th>
            <th style="text-align:center">Editar</th>
            <th style="text-align:center">Eliminar</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
	</div>
 </div>
<script src='js/bootbox.min.js'></script>
<script src='js/productos.js'></script>
<script src='js/marca.js'></script>
<?php } else{
  echo "Acceso no permitido";
  header("Location:index.php");
        exit();
  } ?>



