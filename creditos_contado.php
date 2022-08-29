
<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once("header_dos.php");
  require_once("modals/modal_abonos.php");
  require_once("modals/modal_detalle_abonos.php");
  require_once("modals/modal_correlativo_factura.php");
  require_once("modals/modal_ccf_generica.php");
  require_once("modelos/Reporteria.php");

  $sucursal = $_GET["sucursal"];
  $reporteria=new Reporteria();
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2" style="margin: 2px">
        <div class="col-sm-5" style="align-items:left">
          <h5><strong><i class="fas fa-money-check" style="color:green"></i> CRÉDITOS AL CONTADO</strong></h5>
        </div>
        <div class="col-sm-7">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="creditos.php" style="color:black">Créditos</a></li>
            <li class="breadcrumb-item active"><a>Contado</a></li>
            <li class="breadcrumb-item"><a href="creditos_planilla.php">Desc. Planilla</a></li>
            <li class="breadcrumb-item"><a href="creditos_cautomaticos.php">Cargo Auto</a></li>
            <li class="breadcrumb-item"><a href="creditos_mora.php">Créditos en mora</a></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

    <!-- Main content -->
    <section class="content" style="margin-top:5px">
      <div class="row">
       <div class="col-12">
        <div class="card">
          <div class="card-body">
            <section class="content">
              <div class="container_fluid">
                <div>
                  <div class="col-sm-10">
                    <ol class="breadcrumb float-xs-left">
                      <li class="breadcrumb-item" class="bg-primary" class="" onClick=""><a class="bg-warning cat_contado" style="background:#FCFAF9;padding: 5px;border-radius: 8px" name="contado_pendientes">Pendientes</a></li>
                      <li class="breadcrumb-item" class="bg-primary" class="" onclick=""><a class="bg-success cat_contado" style="background:#FCFAF9;padding: 5px;border-radius: 8px" name="contado_finalizados">Finalizados</a></li>
                    </ol> 
                  </div>
                </div>


                <table id="creditos_de_contado" class="table-hover table-bordered display nowrap" width="100%">
                  <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">
                   <tr>
                    <td># Venta</td>
                    <td>Fecha venta</td>
                    <td>Titular</td>
                    <td>Contacto</td>
                    <td>Paciente evaluado</td>
                    <td>Sucursal</td>
                    <td>Monto</td>
                    <td>Saldo</td>
                    <td>Acciones</td>
                  </tr>
                </thead>
                <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
                </table> 
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once("footer.php");?>
  <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
  <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
  <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
  <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
  <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
  <input type="hidden" id="name_pag" value="COBROS DE CONTADO">
  <input type="hidden" id="id_consulta">
  <input type="hidden" id="id_paciente">
  <input type="hidden" id="optometra" value="">
  <script type="text/javascript" src="js/cleave.js"></script>
  <script type="text/javascript" src="js/productos.js"></script>
  <script type="text/javascript" src="js/pacientes.js"></script>
  <script type="text/javascript" src="js/creditos.js"></script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script type="text/javascript" src="js/recibos.js"></script>
  <script type="text/javascript" src="js/reporteria.js"></script>
  <script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $(".select2").select2({
      maximumSelectionLength: 1
    });
  })
</script>

<script type="text/javascript">
  var title = document.getElementById("name_pag").value;
  document.getElementById("title_mod").innerHTML=" "+
  title;
</script>
</div><!-- FIN CONTENIDO-->
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }


<?php } else{
  echo "Acceso denegado";
} ?>
