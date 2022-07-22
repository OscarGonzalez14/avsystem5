<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once("header_dos.php");
  require_once("modals/modal_abonos.php");
  require_once("modals/modal_detalle_abonos.php");
  require_once("modals/modal_correlativo_factura.php");
  ?>

  <div class="content-wrapper">
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-5" style="align-items:left">
            <h5><strong><i class="fas fa-money-check" style="color:green"></i> CARGO AUTOMÁTICO</strong></h5>
          </div>
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="creditos.php" style="color:black">Créditos</a></li>
              <li class="breadcrumb-item"><a href="creditos_contado.php">Contado</a></li>
              <li class="breadcrumb-item"><a href="creditos_planilla.php">Desc. Planilla</a></li>
              <li class="breadcrumb-item active"><a>Cargo Auto</a></li>
              <li class="breadcrumb-item"><a href="creditos_mora.php">Créditos en mora</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content" style="margin-top:5px">
      <div class="invoice p-3 mb-3" style="margin-top:12px;">
        <div class="row row2" style="background:#E0E0E0;border-radius: 5px">
          <div class="form-group col-sm-3">
            <label for="">Verificar créditos:</label>
            <select class="form-control input-dark" id="ver_credito">
              <option value=''>Seleccionar...</option>
              <option value='Creditos_Finalizados'>Creditos Finalizados</option>
              <option value='Creditos_Pendientes'>Creditos Pendientes</option>
            </select>
          </div>
          <div class="form-group col-sm-2" style="margin-top:32px;">
            <button type="button" class=" btn btn-light visualizar" onClick="listar_creditos_cauto();"><i class="fas fa-search" style="color: green; border:gray;"></i> Filtrar</button>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-12">
        <div class="card">
          <div class="card-body">
            <section class="content">
              <div class="container_fluid"><!--inicio del contenido-->
                <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>   
                <table id="creditos_cauto" class="table-hover table-bordered" width="100%">
                 <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">
                  <tr>
                    <th>No. Venta</th>
                    <th>Titular</th>
                    <th>Paciente Evaluado</th>
                    <th>Empresa</th>        
                    <th>Contacto</th>
                    <th>Fecha venta</th>
                    <th>Sucursal</th>
                    <th>Monto</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
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
</div>
<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
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

<script type="text/javascript">
  var title = document.getElementById("name_pag").value;
  document.getElementById("title_mod").innerHTML=" "+
  title;

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

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


<?php } else{
  echo "Acceso denegado";
} ?>
