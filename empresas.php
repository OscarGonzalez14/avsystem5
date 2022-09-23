<?php
require_once("config/conexion.php");

if(isset($_SESSION["usuario"])){

require_once('header_dos.php');
require_once('modals/empresa.php');
 ?>


<div class="content-wrapper" >
  <!-- Button to Open the Modal -->
  <div style="margin: 5px;">
  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#newEmpresa"><i class="fas fa-plus"></i>
    CREAR EMPRESA
  </button>
  </div>


<div style="margin: 1px">
  <div class="callout callout-info">
        <h5 align="center"><i class="fas fa-building" style="color:green"></i> <strong>LISTADO EMPRESAS</strong></h5>              
    </div>
  <table class="table" id="data_empresas_creadas" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Nombre</th>
            <th style="text-align:center">Dirección</th>
            <th style="text-align:center">Teléfono</th>
            <th style="text-align:center">correo</th>
            <th style="text-align:center">Encargado</th>
            <th style="text-align:center">Detalles</th>
            <th style="text-align:center">Editar</th>
            <th style="text-align:center">Eliminar</th>

          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
</div>



</div>><!--fin content wrapper-->
<?php require_once("footer.php"); ?>
<script src="js/empresas.js"></script>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script>
  var nit = new Cleave('#nitEmpresa', {
    delimiter: '-',
    blocks: [4,6,3,1],
    uppercase: true
});
var telefono = new Cleave('#telEmpresa', {
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
