
 <?php
 require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("header_dos.php");

 ?>
 <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Main content -->
  <section class="content" style="margin-top: 5px">
  <div class="form-row">

    <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-2">
      <label for="fecha_inicio">Desde</label>
        <input type="date" class="form-control float-right rango-date" id="fecha_inicio" onClick="rango_date();">
    </div>
    
    <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-2">
        <label for="fecha_fin">Hasta</label>
        <input type="date" class="form-control float-right rango-date" id="fecha_fin" onClick="rango_date();">
    </div>

    <div class="form-group col-sm-2">
      <label for="lab_ccf">Laboratorio</label>
      <select id="lab_ccf" class="form-control">
        <option selected>Laboratorio...Seleccionar</option>
        <option value="LOMED">LOMED</option>
        <option value="PRISMA LAB">PRISMA LAB</option>
        <option value="OPTIPROCESOS">OPTIPROCESOS</option>
      </select>
    </div>

    <div class="form-group col-sm-2">
      <label for="sucursal_pagos_cff">Sucursal</label>
      <select id="sucursal_pagos_cff" class="form-control">
        <option selected>Seleccione Sucursal...</option>
        <option value="Metrocentro">Metrocentro</option>
        <option value="Santa Ana">Santa Ana</option>
        <option value="San Miguel">San Miguel</option>
      </select>
    </div>

<div style="margin-left:5px;margin-right:5px" class="form-group col-sm-2">
    <label for="fecha_fin">Mostrar</label>
    <div class="input-group-prepend" onClick="show_ccf();">
        <span class="input-group-text" id="basic-addon1" style="background:#001a57;color: white">&nbsp;&nbsp;<i class="fas fa-search">&nbsp;&nbsp;</i></span>
       </div>
    </div>
</div><!--Fin row 1-->

<table id="data_pagos_ccf" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered">
    <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
      <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">
        <th style="text-align:center">ID</th>
        <th style="text-align:center">Fecha</th>
        <th style="text-align:center">Laboratorio</th>
        <th style="text-align:center">Paciente</th>
        <th style="text-align:center">Monto</th>
        <th style="text-align:center">IVA</th>
        <th style="text-align:center">Totales</th>
      </tr>
    </thead>
    <tbody style="text-align:center;color: black">                                        
    </tbody>
  </table>  
  </div>     
         
</div><!-- /.content-wrapper -->


<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="id_usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="MODULO PACIENTES & CONSULTAS">

<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/laboratorios.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
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

</script>



<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(function () {
      $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
   })

  const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 3000
  });
</script>
<!-- date-range-picker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })

    $( "#reservation" ).datepicker({
       format: 'dd-mm-yyyy'
    });
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

  function rango_date(){
    $( "#reservation" ).datepicker({
       format: 'dd-mm-yyyy'
    });
  }
</script>
   <?php } else{
echo "Acceso denegado";
  } ?>
