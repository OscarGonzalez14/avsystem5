<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Optica Av Plus</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
<!--Datatables-->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">

</head>
<?php $cat_user = $_SESSION["categoria"];?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-gray-dark">
    <!-- Left navbar links -->
 <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Usuario: <span><?php echo $_SESSION["usuario"];?></span></a>
      </li>
    </ul>
<span style="text-transform: uppercase;text-align:center;color: white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OPTICA AV PLUS <?php echo $_SESSION["sucursal"];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" style="text-decoration: none;color:white">
          Salir <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:black">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Av Plus</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
<nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item has-treeview">
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
          <li class="nav-item">
            <a href="empresas.php" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>Empresas</p>
            </a>
          </li>  

         
        <!--  <li class="nav-item">
            <a href="compras.php" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Compras
                <span class="right badge badge-danger" style="visibility:hidden">New</span>
              </p>
            </a>
          </li>-->
      
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

          <?php if ($_SESSION["EnviosLab"]) {

           echo '
          <li class="nav-item has-treeview">
            <a href="laboratorios.php" class="nav-link">
              <i class="fas fa-exchange-alt"></i>
              <p>
                Envios a Lab.
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            ';

        if($cat_user=="administrador"){
          echo //$cat_user;
          '<ul class="nav nav-treeview">
          <li class="nav-item has-treeview">
            <a href="laboratorios.php" class="nav-link">
              <i class="fas fa-exchange-alt"></i>
              <p>
                Envios a Lab.
                <i class="right fas fa-angle-left"></i>
              </p>
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
          ';
        }
        }?>   
          
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
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

</body>
</html>
