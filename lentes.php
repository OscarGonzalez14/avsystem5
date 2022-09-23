<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/nuevo_lente.php');
require_once('modals/nuevo_antireflejante.php');
require_once('modals/nuevo_photosensible.php');
 ?>


<div class="content-wrapper" >  <!-- Inicio de content wraper -->
  <!-- Button to Open the Modals -->
  <div style="margin-left:10px;"> 
   <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuevo_photo"><i class="fas fa-plus-square"></i> NUEVO PHOTOSENSIBLE</button>&nbsp;&nbsp;
  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuevo_anti"><i class="fas fa-plus-square"></i> NUEVO ANTIREFLEJANTE</button>&nbsp;&nbsp;
  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuevo_lente"><i class="fas fa-plus-square"></i> NUEVO LENTE</button>&nbsp;
  </div>



  <section style="margin:10px;text-align:center;">
 	<div style="margin: 1px">
 	<div class="callout callout-info">
      <h5 align="center"><i class="fas fa-glasses" style="color:green"></i> <strong>LENTES + TRATAMIENTOS</strong></h5>              
    </div>
 		<table class="table" id="data_lente_tratamientos" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Producto</th>
            <th style="text-align:center">Precio </th>
            <th style="text-align:center">Descripción</th>
          </tr>
        </thead>
      	</table>   <!-- /.content -->
 	</div>
  </section>

</div> <!-- Fin content wraper -->
<?php require_once("footer.php"); ?>
<script src="js/productos.js"></script>
<?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>