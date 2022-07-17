<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/modal_detalle_orden.php');
require_once("modals/modal_correlativo_factura.php");

$cat_user = $_SESSION["categoria"];
require_once("modelos/Reporteria.php");
$reporteria = new Reporteria();
?>

 <style type="text/css">
    .dataTables_filter {
   float: right !important;
   width: 100%;
}
</style>

<div  class="content-wrapper">
<input type="hidden" name="cat_user" id="cat_user" value="<?php echo $cat_user;?>"/>


  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-9">
            <h5 align="center"><i class="fas fa-list" style="color:green"></i> <strong>&nbsp;CARGOS AUTOMATICOS APROBADOS</strong></h5>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="cargos_pend.php">Cargos Pendientes</a></li>
              <li class="breadcrumb-item active">Cargos aprobados</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="col-md-12">

    <div class="card" style="margin: 1px">
     
    <!-- ESTE DATATABLE SE RECARGA DESDE  creditos -->
    <table id="cargos_aprobados" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px;text-align: center">
            <td style="text-align:center;">ID</td>
            <td style="text-align:center;"># Orden</td>
            <td style="text-align:center;">Titular</td>
            <td style="text-align:center;">Fecha creación</td>
            <td style="text-align:center;">Estado</td>
            <td style="text-align:center;">Acciones</td>
            <td style="text-align:center;">Cargo</td>
            <td style="text-align:center;">Pagaré</td>
         </tr>
        </thead>
        <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center">                                        
        </tbody>
      </table>
    </div>
    </div>
    <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
    <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
    <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
    <input type="hidden" id="fecha" value="<?php echo $hoy;?>">          
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="DESCUENTOS EN PLANILLA">
 <script type="text/javascript" src="js/creditos.js"></script>
 <script type="text/javascript" src="js/bootbox.min.js"></script>
   <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
  </script>
</div>
   
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>