<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
 ?>

 <div class="content-wrapper">
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
                <h4 style="text-anchor:"><b>Contado</b></h4>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-coins"></i>
              </div>
              <a href="creditos_contado.php" class="small-box-footer">ir a Contado <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-primary">
              <div class="inner">
                <h4><b>Descuento Planilla</b></h4>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-cash-register"></i>
              </div>
              <a href="creditos_oid.php" class="small-box-footer">Ir a Descuentos Planilla <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h4><b>Cargos automáticos</b></h4>
                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check-alt"></i>
              </div>
              <a href="creditos_cautomaticos.php" class="small-box-footer">Ir a Cargos Automáticos<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><b>Creditos General (Desc.Planilla)</b></h4>

                <p>0</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <a href="creditos_planilla.php" class="small-box-footer"> Gestión de Créditos<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!--<div class="col-lg-3 col-6">
           
            <div class="small-box bg-primary">
              <div class="inner">
                <h4><b>Créditos Personales</b></h4>

                <p>0</p>
              </div>
              <div class="icon">
                <i class="far fa-credit-card"></i>
              </div>
              <a href="lentes.php" class="small-box-footer"> Ir a Créditos Personales<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><b>Creditos en Mora</b></h4>

                <p>0</p>
              </div>
              <div class="icon">
                <i class="far fa-thumbs-down"></i>
              </div>
              <a href="creditos_mora.php" class="small-box-footer"> Ir a Créditos en Mora<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

    
 </div>

 <?php require_once("footer.php"); ?>
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>