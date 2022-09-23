<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/modal_ingreso_bodega.php');
?>
<div class="content-wrapper">
<div style="margin: 5px">
    <h5 align="center"><strong>INGRESAR COMPRAS A BODEGA</strong></h5>
	<table class="table" id="data_ingresos_bodega" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Fecha</th>
            <th style="text-align:center"># Compra</th>
            <th style="text-align:center">Proveedor</th>
            <th style="text-align:center">Estado</th>            
            <th style="text-align:center">Ingresar</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
</div>
</div>
<?php require_once("footer.php"); ?>
<script src='js/compras.js'></script>
<script src='js/bodegas.js'></script>
<?php } else{
echo "Acceso no permitido";
  } ?>