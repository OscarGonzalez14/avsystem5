<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/modal_detalle_ventas.php');
date_default_timezone_set('America/El_Salvador'); $hoy = date("Y-m-d");;
?>

<div class="content-wrapper">

  <div class="content" id="reporte_ventas">

    <div class="header" style="padding:20px;">
      <div class="row mb-2">
        <div class="col-sm-9">
        <section>
          <h4 style="text-align:center"><i class="far fa-file-alt" style="color:green"></i><strong>  REPORTE GENERAL DE VENTAS</strong></h4>
        </section>
          </div>
          <div class="col-sm-3">
            <div>
             <ul class="breadcrumb float-sm-right" style="background-color:transparent;padding:0px;">
               <li class="breadcrumb-item active">Ventas</li>
               <li class="breadcrumb-item"><a href="reporte_recibos.php">Recibos</a></li>
               <li class="breadcrumb-item"><a href="reporte_facturas.php">Facturas</a></li>
             </ul>
           </div>
          </div>
      </div>       

    </div>

    <div class="card-body p-0" style="margin:7px">
      <table id="lista_reporte_ventas_data" width="100%" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered">
        <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
          <tr>
          <th>ID</th>
          <th>#Venta</th>
          <th>Asesor</th>
          <th>Optometra</th>
          <th>Fecha</th>
          <th>Paciente</th>
          <th>Evaluado</th>
          <th>Tipo Venta</th>
          <th>Tipo Pago</th>
          <th>Sucursal</th>
          <th>Monto</th>
          <th>Detalles</th>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                                  
        </tbody>
      </table>
    </div>
 
  </div>
</div>


<?php require_once("footer.php");?>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>

<script src="js/ventas.js"> </script>
<script type="text/javascript">
  function get_date_corte() {
    let fecha_corte = document.getElementById("date_corte").value;
    console.log(fecha_corte);
    document.getElementById("fecha_corte").value = fecha_corte;
  }
  get_date_corte();
</script>
<?php } else{
    echo "Acceso no permitido";
  } ?>

 
