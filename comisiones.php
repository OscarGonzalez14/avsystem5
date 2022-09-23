<?php 
  require_once("config/conexion.php");
  if(isset($_SESSION["usuario"])){ 
  require_once('header_dos.php');
  require_once("modelos/Reporteria.php");
  $reportes = new Reporteria();
  require_once("modelos/Externos.php");
$users = new Externos();
$emp = $users->get_usuarios_comision($_SESSION["sucursal"]);
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
      <div class="card" style="margin: 0px">
        <div class="card-body" style="margin-top: 1px">
          <div class="row">
            <div class="col-sm-3">
              <label for="">Año</label>
              <select name="" id="year_comision" class="form-control"></select>
            </div>

            <div class="col-sm-3 select2-purple">
              <label for="">Mes</label>
              <select name="" id="month_comision" class="form-control">
                <option value="0">Seleccionar mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
            </div>

            <div class="col-sm-4 select2-purple">
              <label for="">Empleado</label>
                <select class="select2 form-control" id="emp_comision" multiple="multiple" data-placeholder="Seleccionar vendedor" data-dropdown-css-class="select2-purple" style="width: 100%;color:black">              
                <option value="0" style="width: 100%;color:black">Seleccionar empleado</option>
                  <?php for ($i=0; $i < sizeof($emp); $i++) { ?>
                      <option value="<?php echo $emp[$i]["id_usuario"]?>"><?php echo strtoupper($emp[$i]["nick"]);?></option>
                  <?php  } ?>              
                </select>    
            </div>

            <div class="col-sm-2">
              <label style="">Calcular</label>
              <button class="btn btn-dark btn-block" onClick="get_categoria_empleado();"><i class="fas fa-file-invoice-dollar"></i></button>
            </div>
          </div><!--FIN FORM row-->

          <div class="row" style="margin-top: 3px">
            
              <div class="input-group input-group-sm col-sm-3">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Sucursal  &nbsp;&nbsp;</button>
                  </span>
                  <input type="text" class="form-control" value="<?php echo $_SESSION["sucursal"];?>" readonly="">
                </div>

                <div class="input-group input-group-sm col-sm-3">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Categoría&nbsp;</button>
                  </span>
                  <input type="text" class="form-control" readonly="">
                </div>

                <div class="input-group input-group-sm col-sm-3">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">Total ventas</button>
                  </span>
                  <input type="text" class="form-control" id="ventas_uno" readonly="">
                </div>

                <div class="input-group input-group-sm col-sm-3">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Comisión&nbsp;&nbsp;</button>
                  </span>
                  <input type="text" class="form-control" id="com_uno" readonly="">
                </div>
                
            </div>
        </div>

  <h4 style="text-align: center;font-size: 14px">DETALLE DE VENTAS <span>.</span></h4>
   <table id="data_comisiones" width="100%" style="text-align: center;text-align:center;font-family: Helvetica, Arial, sans-serif" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 12px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px">
            <td style="text-align:center">Fecha</td>
            <td style="text-align:center">#Venta</td>
            <td style="text-align:center">Titular</td>
            <td style="text-align:center">Sucursal</td>
            <td style="text-align:center">Tipo pago</td>
            <td style="text-align:center">Monto</td>
         </tr>
        </thead>
        <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 12px"></tbody>
        <tfoot>
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px">
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:right;font-size:14"><b>Total Ventas</b></td>
            <td style="text-align:center;color: green;font-size:14" id="tot_ventas_mes"><b></b></td>

         </tr>
        </tfoot>
      </table>
    </div>

    <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
    <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
    <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="COMISIONES">
 <script type="text/javascript" src="js/empleados.js"></script>
 <script type="text/javascript" src="js/sum.js"></script>
   <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
  </script>

  <script>
 $(function () {
    /// Date range picker /// 
    $('#fecha_comision').daterangepicker();
    $('#fecha_comision').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), 
     moment().subtract(1, 'month').endOf('month')]
    },
    "dateLimit": {
            "month": 1
        },
 }, cb);     
  });
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
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>