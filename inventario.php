<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once("modelos/Reporteria.php");
  $alerts = new Reporteria();
?>
<div class="content-wrapper" >
    <!-- Main content -->
    <p style="visibility:hidden">H</p>
    <section class="content" style="border-right:50px">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Traslados</h3>
              </div> 
              <div class="icon">
                <i class="fas fa-exchange-alt"></i>
              </div>

              &nbsp&nbsp<a href="traslados.php" style="color:white"><span>Traslados Internos</span><br></a>
              &nbsp&nbsp<a href="#" style="text-decoration: none;color:white"><span>Traslados Externos</span></a>
             
              <a href="traslados.php" class="small-box-footer"> Ir a Traslados<i class="fas fa-arrow-circle-right"></i></a>

            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
            <div class="inner">
              <h3>Aros</h3>
              <br>
              <br>
            </div>
              <div class="icon">
                <i class="fas fa-glasses"></i>
              </div>
              <a href="aros.php" class="small-box-footer">Inventarios<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            <div class="inner">
              <h3>Ingresos</h3>
              <br>
              <br>
            </div>
              <div class="icon">
                <i class="fas fa-boxes"></i>
              </div>
              <a href="ingresos_bodega.php" class="small-box-footer">Ingresos a Bodega<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



        <!-- /.row -->
  </div>  
</div><!--fin content wraper-->
</section>
</div>
<?php require_once("footer.php"); ?>
<?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>