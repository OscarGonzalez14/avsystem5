<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("modelos/Externos.php");
$users = new Externos();
$opto = $users->get_usuarios_ventas(); 
require_once('header_dos.php');
require_once('modals/laboratorios/nueva_orden_lab_dos.php');
require_once('modals/laboratorios/control_calidad.php');
require_once('modals/laboratorios/contactar_paciente.php');
require_once('modals/laboratorios/detalles_orden.php');
require_once('modals/laboratorios/ingreso_ccf.php');
$cat_user = $_SESSION["categoria"];
require_once("modelos/Reporteria.php");
$alerts = new Reporteria();
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
    <div class="col-md-12">
      <div style="margin-left: 1px;display: flex; justify-content: center;">&nbsp;&nbsp;

      </div>
            <div class="card">
              <div class="card-body" style="margin: 1px solid red">

                <button class="btn btn-app clear_orden"  data-toggle="modal" data-target="#nueva_orden_lab_dos" data-backdrop="static" data-keyboard="false" onClick="get_numero_orden();">
                  <i class="fas fa-plus" style="color:#008080"></i> NUEVA ORDEN
                </button>

                <a class="btn btn-app" onClick="listar_ordenes_creadas();">
                  <span class="badge bg-warning" id="alert_creadas_ord"></span>
                  <i class="fas fa-history"></i> PENDIENTES
                </a>

                <a class="btn btn-app" onClick="listar_ordenes_enviadas();">
                  <span class="badge bg-info" id="alert_enviadas_ord"></span>
                  <i class="fas fa-share"></i> ENVIADOS
                </a>

                <a class="btn btn-app" onClick="listado_ordenes_recibidas();">
                  <span class="badge bg-success" id="alert_recibidos_ord"></span>
                  <i class="fas fa-file-import"></i> RECIBIDOS
                </a>

                <a class="btn btn-app" onClick="get_ordenes_aprobadas();">
                  <span class="badge bg-primary" id="alert_aprobados_ord"></span>
                  <i class="far fa-thumbs-up"></i> APROBADOS
                </a>

                <a class="btn btn-app" onClick="get_ordenes_entregadas();">
                  <span class="badge bg-primary" id="alert_entregados_ord"></span>
                  <i class="far fa-check-circle" style="color:green"></i> ENTREGADOS
                </a>

                <a class="btn btn-app" onClick="get_ordenes_retrasadas();">
                  <span class="badge bg-danger" id="alert_retrasados_ord"></span>
                  <i class="far fa-frown"></i> RETRASOS
                </a>
                
                <a class="btn btn-app" onClick="get_ordenes_general();">
                  <span class="badge bg-success" id="alert_total_ord"></span>
                  <i class="fas fa-clipboard-list"></i> GENERAL
                </a>

            </div>
    <section>
    <table id="data_orders_lab" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:white;background-color:#001f4f;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="">
          <tr>
            <th style="background:#C0C0C0;color:black;margin:solid 1px black;font-family: Helvetica, Arial, sans-serif;font-size: 13px;text-align: center" colspan="100" id="head_th"><span id="header_title"></span></th>
          </tr>
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">
            <td style="text-align:center;width: 5%">ID</td>
            <td style="text-align:center;width: 10%"><span id="acciones_orden"></span></td>
            <td style="text-align:center;width: 15%">Paciente</td>
            <td style="text-align:center;width: 5%"><span id="col_cinco">#Orden</span></td>
            <td style="text-align:center;width: 10%"><span id="col_seis">Creación</span></td>
            <td style="text-align:center;width: 10%"><span id="lab">Laboratorio</span></td>
            <td style="text-align:center;width: 10%">Sucursal</td>
            <td style="text-align:center;width: 10%"><span id="col_ocho">Estado</span></td>
            <td style="text-align:center;width: 10%" id="col_nueve">Detalles</td>
            <td style="text-align:center;width: 10%" id="col_diez">Acciones</td>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center;"></tbody>
      </table>
    </section>
    <button type="button" class="btn btn-block send_orden" id="btn_send_lab" onClick="enviar_ordenes_lab();" style="color: white;background: #0f1f37"><i class="fas fa-share-square"></i> ENVIAR A LABORATORIO</button>
     <button type="button" class="btn btn-info btn-block" id="btn_receive_lab" onClick="recibir_ordenes_lab();"><i class="fas fa-share-square"></i> RECIBIR</button>

     <button type="button" class="btn btn-primary btn-block" id="btn_entregar_lab" onClick="entregar_ordenes_lab();"><i class="fas fa-share-square"></i> ENTREGAR</button>
    </div>
    </div>
    </div>
          <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
          <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
          <input type="hidden" name="usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
          <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
          <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="ENVIOS A LABORATORIO">

  <!-- The Modal -->
  <div class="modal fade" id="modal_consultas_orden">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">      
        <!-- Modal body -->
        <div class="modal-body">
          <table id="data_consultas_orden" width="100%" style="text-align: center;text-align:center" class="table-hover table-bordered display nowrap">
          <thead style="color:white;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-dark">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px">
            <td style="text-align:center;width: 5%">ID</td>
            <td style="text-align:center;width: 20%">Titular</td>
            <td style="text-align:center;width: 25%">Evaluado</td>
            <td style="text-align:center;width: 25%">Empresa</td>
            <td style="text-align:center;width: 15%">Fecha Consulta</td>
            <td style="text-align:center;width: 10%">Acciones</td>
         </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                                      
        </tbody>
        </table>
        </div>        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
<!--MODAL CONFIRMAR ENVIO-->
  <div class="modal fade" id="confirm-envio">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmación de envío</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 style="font-family: Helvetica, Arial, sans-serif;font-size: 18px;text-align: center;"><b>Confirmar el envío de <span id="n_trabajos" style="color: red"></span>&nbsp;trabajos</b></h5>
              <div class="dropdown-divider"></div>
              <div>
              <div class="form-group col-sm-5 select2-purple" style="margin: auto">
                <select class="select2 form-control" id="usuario_envio" multiple="multiple" data-placeholder="Seleccionar usuario" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
                <option value="">Seleccionar usuario</option>
                  <?php for ($i=0; $i < sizeof($opto); $i++) { ?>
                    <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
                  <?php  } ?>              
                </select>   
              </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onClick="registrarEnvio()">Aceptar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!--FIN MODAL CONFIRMAR ENVIO-->
  <div class="modal fade" id="confirm-receive">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmación de recibido</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 style="font-family: Helvetica, Arial, sans-serif;font-size: 18px;text-align: center;"><b>Confirmar recibo de <span id="n_trabajos_r" style="color: red"></span>&nbsp;trabajos</b></h5>
              <div class="dropdown-divider"></div>
              <div>
              <div class="form-group col-sm-5 select2-purple" style="margin: auto">
                <select class="select2 form-control" id="usuario_recibe" multiple="multiple" data-placeholder="Seleccionar usuario" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
                <option value="">Seleccionar usuario</option>
                  <?php for ($i=0; $i < sizeof($opto); $i++) { ?>
                    <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
                  <?php  } ?>              
                </select>   
              </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onClick="recibirOrdenes();">Aceptar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!--MODAL CONTROL DE CALIDAD-->      
<div id="modal_ccalidad" class="modal fade" role="dialog">
  <div class="modal-dialog" style="max-width: 70%">
   <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Control de calidad</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <b><p style="color:blue;font-family: Helvetica, Arial, sans-serif;font-size: 14px;">Paciente: <span id="paciente_orden_cc" style="color:black"></span></p></b>
      <div class="form-group col-md-12">
        <label for="inputPassword4">Observaciones</label>
        <textarea id="justificacion_calidad" class="form-control" rows="3"></textarea>
      </div>
      <div class="form-group col-sm-5 select2-purple" style="margin: auto">
          <select class="select2 form-control" id="usuario_cc" multiple="multiple" data-placeholder="Seleccionar usuario" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">           
          <option value="">Seleccionar usuario</option>
            <?php for ($i=0; $i < sizeof($opto); $i++) { ?>
              <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
            <?php  } ?>              
          </select>   
      </div>
      </div>
      <input type="hidden" name="" id="cod_orden_cc">
      <input type="hidden" name="" id="id_orden_cc">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" onClick="ccalidadOrden('Reenviado');">Reenviar</button>
        <button type="button" class="btn btn-primary" onClick="ccalidadOrden('Aprobado');">Aceptar</button>
      </div>
    </div>

  </div>
</div><!-- FIN MODAL CONTROL DE CALIDAD-->


<!--MODAL CONTROL DE ENTREGAS-->
<div id="modal_entregas" class="modal fade" role="dialog">
  <div class="modal-dialog" style="max-width: 70%">
   <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Orden de entrega</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
      <h5 style="font-family: Helvetica, Arial, sans-serif;font-size: 18px;text-align: center;"><b>Confirmar Entrega de <span id="n_trabajos_entregar" style="color: red"></span>&nbsp;trabajos</b></h5>
      <div class="dropdown-divider"></div>
      <div class="form-group col-sm-5 select2-purple" style="margin: auto">
          <select class="select2 form-control" id="usuario_entrega" multiple="multiple" data-placeholder="Seleccionar usuario" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">           
          <option value="">Seleccionar usuario</option>
            <?php for ($i=0; $i < sizeof($opto); $i++) { ?>
              <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
            <?php  } ?>              
          </select>   
      </div>
      </div>
      <div class="modal-footer justify-content-between" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onClick="entregarOrdenes();">Entregado</button>
      </div>
    </div>

  </div>
</div>
<!--FIN MODAL CONTROL DE ENTREGAS-->

 <script type="text/javascript" src="js/envios_lab.js"></script>
 <script type="text/javascript" src="js/consultas.js"></script>
 <script type="text/javascript" src="js/bootbox.min.js"></script>
 <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
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

    <!-- MODAL DEPOSITO A CAJA CHICA -->
  
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>