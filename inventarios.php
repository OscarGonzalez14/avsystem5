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
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Aros</h3>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-glasses"></i>
              </div>
              <a href="aros.php" class="small-box-footer">ir a Aros <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Accesorios</h3>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="icon ion-grid"></i>
              </div>
              <a href="accesorios.php" class="small-box-footer">Ir a Accesorios <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Regalias</h3>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetag"></i>
              </div>
              <a href="#" class="small-box-footer">Ir a Regalias <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Lentes</h3>

                <p>0</p>
              </div>
              <div class="icon">
                <i class="ion ion-contrast"></i>
              </div>
              <a href="lentes.php" class="small-box-footer"> Ir a Lentes<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Ingresos</h3>
                <a href="ingresos_bodega.php" style="text-decoration: none;color:white"><span>Compras a ingresar: <span class="right badge badge-danger"><i class=" fas fa-bell"></i> <?php echo $alerts->count_compras_ingresar_bodegas()?></span></span><br></a>
                <a href="#" style="text-decoration: none;color:white"><span>Compras Ingresadas: <span>0</span></span></a>
              </div>
              <div class="icon">
                <i class="fas fa-cart-arrow-down"></i>
              </div>
              <a href="#" class="small-box-footer"> Ir a Compras <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Categorías</h3>
                <a href="#" style="text-decoration: none;color:white"><span>Crear categoría:</span><br></a>
                <a href="#" style="text-decoration: none;color:white;visibility: hidden;"><span>Compras Ingresadas: <span>0</span></span></a>           
              </div>
              <div class="icon">
                <i class="fas fa-project-diagram"></i>
              </div>
              <a href="#" class="small-box-footer"> Ir a Categorías <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Usuarios</h3>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="Usuarios.php" class="small-box-footer">ir a Usuarios <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Traslados</h3>
              <div class="icon">
                 <a href="traslados.php" style="color:white"><span>Traslados Internos</span><br></a>
                <a href="#" style="text-decoration: none;color:white"><span>Traslados Externos</span></a>
              </div>
              <a href="traslados.php" class="small-box-footer"> Ir a Traslados<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>



        <!-- /.row -->
    
</div>
<?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>