<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AV Plus 3.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<!-- Mis estilos -->
  <link rel="stylesheet" href="css/styles.css">  
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!--Datatables-->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">



<style type="text/css">
<?php 
$cat_user = $_SESSION["categoria"];
$level_user = $_SESSION["id_user_emp"];
//echo $level_user;
?>
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-gray-dark" style="background: black">
    <!-- Left navbar links -->
 <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-map-marker-alt"></i><span style="text-transform: uppercase; color:white" id="title_mod">&nbsp;</span></i></a>
      </li>
    </ul>
    <span style="text-transform: uppercase;text-align:center;color: white">&nbsp;&nbsp;&nbsp;OPTICA AV PLUS <?php echo $_SESSION["sucursal"];?></span>&nbsp;
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" style="text-decoration: none;color:white">
          Salir <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4"  style="background: black">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">

        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <li class="nav-item has-treeview li_1">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Ordenes de Desc.
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-danger right">.</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="desc_planilla.php" class="nav-link">
                  <i class="far fa-file"></i>
                  <p>Descuentos en Planilla</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cargos_pend.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargos Automaticos</p>
                </a>
              </li>

            </ul>
          </li>
        
        <?php if ($_SESSION["Empresas"]) {
           echo '
          <li class="nav-item">
            <a href="empresas.php" class="nav-link">
              <i class="nav-icon fas fa-bulding"></i>
              <p>
                Empresas
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>';
        }?>

          <li class="nav-item">
            <a href="adquisiciones.php" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Adquisiciones
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="inventario.php" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Inventarios
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pacientes.php" class="nav-link">
              <i class="nav-icon fas fas fa-id-card-alt"></i>
              <p>Pacientes & Consultas</p>
            </a>
          </li>

          <li class="nav-item has-treeview li_1">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Envios Lab.
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-danger right">.</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="laboratorios.php" class="nav-link">
                  <i class="far fa-file"></i>
                  <p>Envios lab.</p>
                </a>
              </li>-->
              <?php if ($_SESSION["Control_labs"]) {
                echo '
              <li class="nav-item">
                <a href="control_labs.php" class="nav-link">
                  <i class="far fa-circle text-danger nav-icon"></i>
                  <p>Control Ordenes</p>
                </a>
              </li>
              ';
            }
            ?>
            </li>

            </ul>
          </li>          
            
          <!---CREDITOS FISCALES LABORATORIOS
            </a>
            </li>
              <li class="nav-item">
                <a href="pagos_ccf.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pagos CFF Lab.</p>
                </a>
              </li>
            </ul>
          </li>
        -->
          
          <li class="nav-item">
            <a href="ventas.php" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Ventas</p>
            </a>
          </li>
 
          <li class="nav-item">
            <a href="creditos.php" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>Creditos y cobros</p>
            </a>
          </li>

        <?php if ($_SESSION["Caja Chica"]) {
           echo '
          <li class="nav-item">
            <a href="caja_chica.php" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Caja Chica
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>';
        }?>

        

        <?php 
        if ($level_user=="Admin") {
          echo '
          <li class="nav-item">
            <a href="aros-inv.php" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Bodega Central
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>';
        }
      ?>
        
        <?php
          if ($level_user=="Admin") {
            echo '
            <li class="nav-item">
            <a href="reportes.php" class="nav-link">
              <i class="nav-icon  fas fa-file-alt"></i>
              <p>
                Reportes
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li> 
            ';
          }
        ?>

<?php
          if ($level_user=="Admin") {
            echo '
            <li class="nav-item">
            <a href="comisiones.php" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Comisiones y planillas
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li> 
            ';
          }
        ?>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


