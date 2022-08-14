
<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once("header_dos.php");
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <div class="row" style="margin-left:15px;font-family: Helvetica, Arial, sans-serif;font-size: 12px">
        <div class="col-sm-3">
        <label for="">Rango fechas</label>
          <input type="text" class="form-control float-right" id="rango-cobro" name="daterange"  value="00000">
        </div>

        <div class="col-sm-9" style="margin-top:35px">
            <input type="checkbox" name="sucursales_chk" value="Metrocentro" id="metrocentro" class="chk_ventas_rep">
            <label for="metrocentro">Metro.</label>

            <input type="checkbox" name="sucursales_chk" value="Cascadas" id="cascadas" class="chk_ventas_rep">
            <label for="cascadas">Casc.</label>

            <input type="checkbox" name="sucursales_chk" value="Chalatenango" id="chalatennago" class="chk_ventas_rep">
            <label for="chalatennago">Chalate.</label>

            <input type="checkbox" name="sucursales_chk" value="Santa Ana" id="santana" class="chk_ventas_rep">
            <label for="santana">S. Ana</label>

            <input type="checkbox" name="sucursales_chk" value="Ahuachapan" id="ahuachapan" class="chk_ventas_rep">
            <label for="ahuachapan">Ahuach.</label>
             &nbsp;&nbsp;&nbsp;
            <input type="radio" name="chk_empreariales_item" id="chk_emp" class="chk_ventas_rep">
            <label style='color:blue'>Emp-Suc.</label>

            <input type="radio" name="chk_empreariales_item" id="chk_emp_solo" class="chk_ventas_rep">
            <label style='color:blue'>Solo-Emp.</label>

            &nbsp;&nbsp;&nbsp;
            <input type="radio">
            <label style='color:green'>Det. ventas.</label>
        </div>



      </div>
   
    <!-- Main content -->
    <section class="content" style="border-right:50px;margin-top:3px">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="card" style="margin: 1px">
            <div class="card-body">
              <!--ESTE DATATABLE SE RECARGA DESDE  credit-->
              <table id="reporte_ventas_admin" width="100%" style="text-align: center;text-align:center"  class="table-hover table-bordered display nowrap">
                <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
                  <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px;text-align: center">

                    <td>#Venta</td>
                    <td>Fecha venta</td>
                    <td>Tipo venta</td>
                    <td>Titular</td>
                    <td>Sucursal</td>
                    <td>Monto</td>
                    <td>Saldo</td>
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
      <input type="hidden" id="name_pag" value="REPORTES ADMINISTRATIVOS">
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

  $('input[name="daterange"]').daterangepicker({
  locale: {
    format: 'DD-MM-YYYY',
            separator: " hasta "

      }
}, function(start, end, label) {
  let fecha = start.format('DD-MM-YYYY') + '/' + end.format('DD-MM-YYYY');   
  //filtrarFechas(fecha)
});
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
