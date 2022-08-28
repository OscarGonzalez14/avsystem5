<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
  require_once('header_dos.php');
  require_once("modals/modal_detalle_abonos.php");
  require_once("modals/info_pacientes_modal.php");
  ?>

  <div class="content-wrapper">
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-5" style="align-items:left">
            <h5><strong><i class="fas fa-money-check" style="color:green"></i> CRÉDITOS EN MORA</strong></h5>
          </div>
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="creditos.php" style="color:black">Créditos</a></li>
              <li class="breadcrumb-item"><a href="creditos_contado.php">Contado</a></li>
              <li class="breadcrumb-item"><a href="creditos_planilla.php">Desc. Planilla</a></li>
              <li class="breadcrumb-item"><a href="creditos_cautomaticos.php">Cargo Auto</a></li>
              <li class="breadcrumb-item active"><a>Créditos en mora</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div style="margin:2px">
      <div>
        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item" class="bg-primary" class="cat_creditos" ><a class="bg-warning cat_creditos" style="background:#FF7F50;padding: 5px;border-radius: 8px" name="cat_b">Categoría B</a></li>
            <li class="breadcrumb-item" class="bg-primary" class=""><a class="bg-danger cat_creditos" style="background:#8B0000;padding: 5px;border-radius: 8px" name="cat_c">Categoría C</a></li>
          </ol> 
        </div>
      </div><!--FIN INVOICES-->

      <table class="table-hover table-striped table-bordered" id="cats_creditos" width="100%">
        <thead class="bg-info" style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px">
          <tr>
            <th style="text-align:center">Paciente</th>
            <th style="text-align:center">Empresa</th>
            <th style="text-align: center">Telefono</th>
            <th style="text-align:center">#Venta</th>
            <th style="text-align:center">Categoría</th>
            <th style="text-align:center">Monto Crédito</th>
            <th style="text-align:center">Plazo</th>
            <th style="text-align:center">Cuota</th>
            <th style="text-align:center">Abonado</th>
            <th style="text-align:center">Saldo</th>
            <th style="text-align:center">Ultimo abono</th>
            <th style="text-align:center">Fecha abono</th>
            <th style="text-align:center">Restraso</th>
            <th style="text-align:center">Detalles</th>
          </tr>
        </thead>
        <tbody id="listar_det_traslados" style="text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 11px"></tbody>
        <tfoot>
          <tr>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center" id="montos_c"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center" id="saldo_pend"></th>
            <th style="text-align:center" id="abonado"></th>
            <th style="text-align:center" id="saldo_mora"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
            <th style="text-align:center"></th>
          </tr>
        </tfoot>         
      </table>
    </div>
  </div>

  <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
  <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
  <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
  <input type="hidden" id="fecha" value="<?php echo $hoy;?>">

  <?php require_once("footer.php");?>
  <script type="text/javascript" src="js/productos.js"></script>
  <script type="text/javascript" src="js/creditos.js"></script>
  <script type="text/javascript" src="js/sum.js"></script>
<?php } else{
  echo "Acceso no permitido";
} ?>