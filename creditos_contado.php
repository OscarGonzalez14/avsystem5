
<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once("header_dos.php");
  require_once("modals/modal_abonos.php");
  require_once("modals/modal_detalle_abonos.php");
  require_once("modals/modal_correlativo_factura.php");
  require_once("modals/modal_ccf_generica.php");
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header" >
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
      </div><!-- /.container-fluid -->
    </section>

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
          <button type="button" class=" btn btn-light visualizar" onClick="listar_contado_creditos();"><i class="fas fa-search" style="color: green; border:gray;"></i> Filtrar</button>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content" style="border-right:50px">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="card" style="margin: 1px">
            <div class="card-body">
              <!--ESTE DATATABLE SE RECARGA DESDE  credit-->
              <table id="creditos_de_contado" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
                <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
                  <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px;text-align: center">
                    <td># Venta</td>
                    <td>Titular</td>
                    <td>Paciente evaluado</td>
                    <td>Contacto</td>
                    <td>Fecha venta</td>
                    <td>Sucursal</td>
                    <td>Monto</td>
                    <!--<td>Cobrado</td>-->
                    <td>Saldo</td>
                    <td>Acciones</td>
                  </tr>
                </thead>
                <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center">     
                </tbody>
              </table>
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
