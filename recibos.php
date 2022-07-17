<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
  require_once('header_dos.php');

  $cat_user = $_SESSION["categoria"];
  require_once("modelos/Reporteria.php");
  $reporteria = new Reporteria();
  ?>

  <style type="text/css">
    .dataTables_filter {
     float: right !important;
     width: 100%;
   }
 </style>

 <div class="content-wrapper">
  <input type="hidden" name="cat_user" id="cat_user" value="<?php echo $cat_user;?>"/>
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
             <ul class="breadcrumb float-sm-right" style="background-color:transparent;padding:0px;">
               <li class="breadcrumb-item"><a href="ventas.php">Nueva Venta</a></li>
               <li class="breadcrumb-item"><a href="reporte_gral_ventas.php">Reporte</a></li>
               <li class="breadcrumb-item active">Recibos</li>
             </ul>
          </div>
          <div class="col-sm-1">
          </div>
          <div class="col-sm-8">
            <h5 align="left"><i class="fas fa-list" style="color:green"></i> <strong>&nbsp;LISTA DE RECIBOS EMITIDOS</strong></h5>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
     
  <section class="content" style="border-right:50px">
    <div class="container-fluid">
      <div class="col-md-12">

        <div class="card" style="margin: 1px">
          <div class="card-body">
            
          <!--ESTE DATATABLE SE RECARGA DESDE  credit-->
          <table id="recibos_emitidos" width="100%" style="text-align: center;text-align:center" class="table-hover table-bordered display nowrap">
            <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
              <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px;text-align: center">
                <td style="text-align:center;" width="3%">ID</td>
                <td style="text-align:center;" width="4%"># Recibo</td>
                <td style="text-align:center;" width="4%"># Venta</td>
                <td style="text-align:center;" width="25%">Titular</td>
                <td style="text-align:center;" width="25%">Servicio para</td>
                <td style="text-align:center;" width="3%">Editar</td>
                <td style="text-align:center;" width="3%">Imprimir</td>
              </tr>
            </thead>
            <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center">                                        
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">


<?php require_once("footer.php"); ?>
<script type="text/javascript" src="js/recibos.js"></script>
<!--<script type="text/javascript" src="js/bootbox.min.js"></script>-->
<script type="text/javascript">
  var title = document.getElementById("name_pag").value;
  document.getElementById("title_mod").innerHTML=" "+ title;
</script>

<?php } else{
  echo "Acceso no permitido";
  header("Location:index.php");
  exit();
} ?>