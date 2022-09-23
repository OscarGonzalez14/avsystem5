<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 

require_once('header.php');


  require_once("modals/modal_consultas_edit.php");?>
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-8">
            <h5 align="center">MÓDULO CONSULTAS</h5>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="pacientes.php">Nueva Consulta</a></li>
              <li class="breadcrumb-item active">Consultas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div style="margin:5px">
      <div class="dropdown-divider"></div>
      <table id="consultas_data" width="100%" style="text-align: center;text-align: center;margin:5px" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
        <thead style="color:white;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info" data-order='[[ 0, "desc" ]]'>
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Fecha Consulta</th>
            <th style="text-align:center">Cliente</th>
            <th style="text-align:center">Paciente Evaluado</th>
            <th style="text-align:center">Edad</th>
            <th style="text-align:center">Optometra</th>
            <th style="text-align:center">Ver y editar</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table> 
    </div> 
  </div>     
  
</div><!-- /.content-wrapper -->

<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="id_usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
<input type="text" id="fecha" value="<?php echo $hoy;?>">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/consultas.js"></script>

<?php } else{
  echo "Acceso denegado";
  header("Location:index.php");
  exit();
} ?>