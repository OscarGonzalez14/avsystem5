
<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once("header_dos.php");
  ?>
    <style>
    body{
      font-family: Helvetica, Arial, sans-serif;
    }
  </style>
  <body>
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
            <input type="checkbox" name="chk_empreariales_item" id="chk_emp" class="chk_ventas_rep">
            <label style='color:blue'>Emp-Suc.</label>

            <input type="checkbox" name="chk_empreariales_item" id="chk_emp_solo" class="chk_ventas_rep">
            <label style='color:blue'>Solo-Emp.</label>

            &nbsp;&nbsp;&nbsp;
            <input  type="checkbox" name="chk_empreariales_item" id="consolidados_ventas" class="chk_ventas_rep">
            <label style='color:green'>Consolidados.</label>
            &nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#cortes-diarios-admin-modal">Cortes</button>
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
                    <td>Cuota</td>
                    <td>Plazo</td>
                  </tr>
                </thead>
                <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center">     
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!--MODAL CORTE_DIARIO ADMINISTRADOR-->
      <div class="modal" id="cortes-diarios-admin-modal"  data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-dark" style="padding:8px;">
          <h4 class="modal-title modal-title  w-100 text-center position-absolute" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px;">CORTE DIARIO ADMINISTRADOR</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" >
         <div class="opciones-sucursal" style="font-family: Helvetica, Arial, sans-serif;font-size: 12px;">
         <input type="radio" name="rep_corte_chk" value="Metrocentro" id="metrocentro_corte" class="chk_corte_admin">
            <label for="metrocentro_corte">Metro.</label>

            <input type="radio" name="rep_corte_chk" value="Cascadas" id="cascadas_corte" class="chk_corte_admin">
            <label for="cascadas_corte">Casc.</label>

            <input type="radio" name="rep_corte_chk" value="Chalatenango" id="chalatennago_corte" class="chk_corte_admin">
            <label for="chalatennago_corte">Chalate.</label>

            <input type="radio" name="rep_corte_chk" value="Santa Ana" id="santana_corte" class="chk_corte_admin">
            <label for="santana_corte">S. Ana</label>

            <input type="radio" name="rep_corte_chk" value="Ahuachapan" id="ahuachapan_corte" class="chk_corte_admin">
            <label for="ahuachapan_corte">Ahuach.</label>
             &nbsp;&nbsp;&nbsp;
            <input type="checkbox"  id="chk_corte_emp" class="chk_corte_admin">
            <label style='color:blue'>Emp.</label>
         </div>
         <span id="sucursal_corte"></span>
         <input type="date" id="fecha_corte" name="fecha_corte" class="form-control" >
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-block btn-outline-secondary btn-flat" onClick="ImprimirCorteAdmin()">Imprimir corte</button>
        </div>

      </div>
    </div>
</div>
  </body>
<!-- FIN MODAL CORTE_DIARIO ADMINISTRADOR-->

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
