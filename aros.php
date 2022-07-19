<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/nuevo_aro.php');
require_once('modals/nueva_marca.php');
require_once('modals/editar_aro.php');
?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
<div style="margin:5px;">
<!--<a class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#newMarca" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-square"></i> Crear Marca</a>&nbsp;
 <a class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#new_aro" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-square"></i> Crear Aro</a>&nbsp;-->
 <a href="stock.php" class="btn btn-info" style="color:white;border-radius:2px; background:#001a33;margin:solid #000066 1px"data-backdrop="static" data-keyboard="false"><i class="fas fa-file-import"></i> VER STOCK</a>
</div>

<div style="margin: 1px">
	<div class="callout callout-info">
        <h5 align="center"><i class="fas fa-glasses" style="color:green"></i> <strong>STOCK GENERAL AROS</strong></h5>              
    </div>
	<table class="table-bordered table-hover" id="data_lista_aros_creados" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Descripción</th>
            <th style="text-align:center">Diseño</th>
            <th style="text-align:center">Material</th>
            <th style="text-align:center">Categoría</th>
            <th style="text-align:center">Editar</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
</div>
    
</div><!-- /.wrapper -->
<?php require_once("footer.php"); ?>
<script src='js/bootbox.min.js'></script>
<script src='js/productos.js'></script>
<script src='js/marca.js'></script>
<?php } else{
  echo "Acceso no permitido";
  header("Location:index.php");
        exit();
  } ?>