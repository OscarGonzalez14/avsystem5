<?php
 require_once("config/conexion.php");    

    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
       require_once("modelos/Usuarios.php");
       $usuario = new Usuarios();
       $usuario->login();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AVSYS 3.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page" style="background: #383838">
<div class="register-box">
<!--************************Validacines******************-->
  <div class="row">
    <div class="col-lg-12">        
      <div class="box-body">         


             
  </div>
<!--************************ Validaciones******************-->

  <div class="card" style="border-radius: 5px">
    <div class="card-body register-card-body" style="border-radius: 7px">
        <div class="register-logo">
          <a href="#" style="font-size:18px !important; color:#383838"><strong>Avsys 2021</strong></a>
      </div>
        <div class="register-logo">
    <img src="images/logooficial.jpg" width="160" height="80"  />
  </div>
      <form method="post" class="login" autocomplete="off">
        <div class="input-group mb-3">
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required="required">          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">          
          <select name="sucursal" id="sucursal" class="form-control">
            <option value="">Seleccione Sucursal</option>
            <option value="Metrocentro">Metrocentro</option>
            <option value="Santa Ana">Santa Ana</option>
            <option value="San Miguel">San Miguel</option>
            <option value="Chalatenango">Chalatenango</option>
            <option value="Ahuachapan">Ahuachapan</option>
            <option value="Cascadas">Cascadas</option>
            <option value="Empresarial">Empresarial</option>
          </select>
        </div>

        <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      <div class="form-group">
        <input type="hidden" name="enviar" class="form-control" value="si">       
      </div>      
      <div>
          <button type="submit" name="action" class="btn btn-block" style="background:  #000033;border-radius: 0px;color:white"><i class="fas fa-power-off" aria-hidden="true"></i>  Iniciar Sesión</button>
        </div>
      </div>
      </form>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
