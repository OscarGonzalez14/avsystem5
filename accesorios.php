<?php
 require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/nuevo_accesorio.php'); 
require_once('modals/nueva_marca.php');
require_once('modals/editar_accesorio.php');
?>

<div class="content-wrapper" > <!-- Inicio content wraper-->
  <!-- Button to Open the Modal -->
  <div style="margin:5px;">
  <a class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#newMarca" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-square"></i> Crear Marca</a>&nbsp;&nbsp; 
 <a class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#accesorios_save" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-square"></i>
  	Crear Accesorios
  </a>

  </div>

  <div style="margin: 1px">
	<div class="callout callout-info">
    <h5 align="center"><i class="fas fa-glasses" style="color:green"></i> <strong>LISTADO DE ACCESORIOS</strong></h5>              
    </div>
	<table class="table" id="data_lista_accesorios_creados" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Marca</th>
            <th style="text-align:center">Modelo</th>
            <th style="text-align:center">Categoría</th>
            <th style="text-align:center">Categoría_producto</th>
            <th style="text-align:center">Descripción</th>
             <th style="text-align:center">Editar</th>
            <th style="text-align:center">Eliminar</th>

          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
</div>

</div>     <!-- fin content wraper-->

<script src="js/productos.js"></script>
<script src="js/marca.js"></script>
<script src='js/bootbox.min.js'></script>


   <?php } else{
echo "Acceso denegado";
  } ?>

  <script>
  	function myFunction() {
  document.getElementById("eliminar").ID = "red";
}
  </script>