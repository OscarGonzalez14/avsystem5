<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/nueva_requisicion.php');
require_once('modals/accion_requisicion_admin.php');
require_once('modals/modals_requisicion/modal_estado_uno.php');
require_once('modals/modals_requisicion/modal_estado_dos.php');
$cat_user = $_SESSION["categoria"];
require_once("modelos/Reporteria.php");
$alerts = new Reporteria();
?>

 <style type="text/css">
    .dataTables_filter {
   float: right !important;
   width: 100%;
}
</style>

 <div class="content-wrapper">
<input type="hidden" name="cat_user" id="cat_user" value="<?php echo $cat_user;?>"/>
    <section class="content" style="border-right:50px">
      <div class="container-fluid">
    <div class="col-md-12">
      <div style="margin-left: 1px;display: flex; justify-content: center;">&nbsp;&nbsp;
        <div>
          <?php if($cat_user=="administrador"){
          echo '
          <a class="btn btn-dark" style="color:white;border-radius:3px; background:black;margin-bottom: 3px;margin-left: 1px" data-toggle="modal" data-target="#depositos_caja" data-backdrop="static" data-keyboard="false" id="btn_aros_venta" onClick="get_id_caja_chica();"><i class=" fas fa-donate"></i> Depositos a Caja Chica</a>';}
                ?>
          </div>
        <div><a class="btn btn-ligth" style="background:#D8D8D8;border-radius:3px;margin-bottom: 3px;margin-left: 1px" id="btn_aros_venta">Saldo caja chica</a></div>
      </div>
            <div class="card" style="margin: 1px">
              <div class="card-body">

                <a class="btn btn-app" data-toggle="modal" data-target="#nueva_requisicion" data-backdrop="static" data-keyboard="false">
                  <i class="fas fa-plus" style="color:#008080" onClick="get_correlativo_requisiciones();"></i> CREAR REQUISICIÓN
                </a>'

                <?php if($cat_user=="administrador"){
                  echo '
                <a class="btn btn-app" onClick="listar_requicisiones_pendientes();">
                  <span class="badge bg-danger"><i class=" fas fa-bell"></i>';?> <?php echo $alerts->count_req_pendientes()?> <?php echo '</span>
                  <i class="fas fa-clipboard-check" style="color:#00407e"></i> REQ. PENDIENTES
                </a>';
              }
                ?>
              </div>

    <table id="data_requisiciones" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">

            <td style="text-align:center">ID Req.</td>
            <td style="text-align:center">Correlativo Req.</td>
            <td style="text-align:center">Fecha</td>
            <td style="text-align:center">Estado</td>
            <td style="text-align:center">Sucursal</td>
            <td style="text-align:center">Acciones</td>
            <td style="text-align:center">Imprimir</td>
         </tr>
        </thead>
        <tbody style="text-align:center;color: black">                                        
        </tbody>
      </table>
    </div>
    </div>
          <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
          <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
          <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
          <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="MODULO CAJA CHICA">
 <script type="text/javascript" src="js/caja.js"></script>
   <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
  </script>

    <!-- MODAL DEPOSITO A CAJA CHICA -->
  <div class="modal fade" id="depositos_caja">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">CAJA CHICA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row">

            <div class="col-sm-12 invoice-col">
              <span style="margin-right: 5px"><strong>Saldo Actual $<span id="saldo_caja" style="font-size: 18px;color: blue"></span></strong><br>
              <label>Monto a Depositar $</label>
                <input type="number" class="form-control" id="monto_deposito" style="margin:0px;text-align: right;">
              </div>
          </div>
        </div>
        <input type="hidden" id="tipo_mov" value="deposito">
        <input type="hidden" id="id_caja_chica">
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clear_items_req();"> CANCELAR</button>
              <button type="button" class="btn btn-success" onClick="deposito_caja();"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i> DEPOSITAR</button>
            </div>
        
      </div>
    </div>
  </div>
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>