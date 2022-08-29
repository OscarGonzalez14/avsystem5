<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 

require_once("modelos/Externos.php");
$empresa = new Externos();
$empresas = $empresa->get_empresas_creditos();

require_once("header_dos.php");
require_once("modals/modal_abonos.php");
require_once("modals/modal_detalle_abonos.php");
require_once("modals/modal_correlativo_factura.php");
?>

 <div class="content-wrapper">
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-5" style="align-items:left">
            <h5><strong><i class="fas fa-money-check" style="color:green" ></i> CREDITOS Y COBROS (PLANILLA)</strong></h5>
          </div>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="creditos.php" style="color:black">Créditos</a></li>-->
              <li class="breadcrumb-item"><a href="creditos_contado.php">Contado</a></li>
              <li class="breadcrumb-item active"><a>Desc. Planilla</a></li>
              <li class="breadcrumb-item"><a href="creditos_cautomaticos.php">Cargo Auto</a></li>
              <li class="breadcrumb-item"><a href="creditos_mora.php">Créditos en mora</a></li>
              <!--<li class="breadcrumb-item active"><a>Creditos Pl.</a></li>-->
            </ol>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="invoice p-3 mb-3" style="margin-top:12px;">
      <div class="row row2" style="background:#E0E0E0;border-radius: 5px">
        <div class="form-group col-sm-3">
          <label for="">Verificar créditos:</label>
          <select class="form-control input-dark" id="ver_credito">
            <option value=''>Seleccionar...</option>
            <option value='Creditos_Pendientes'>Creditos Pendientes</option>
            <option value='Creditos_Finalizados'>Creditos Finalizados</option>
          </select>
        </div>

        <div class="col-sm-5 select2-purple">
          <label for="ex3">Empresa</label>
          <select class="select2 form-control" id="nom_empresa" multiple="multiple" data-placeholder="Seleccionar Empresa" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
            <option value="">Seleccionar empresa</option>
            <?php
            for ($i=0; $i < sizeof($empresas); $i++) { ?>
              <option value="<?php echo $empresas[$i]["nombre"]?>"><?php echo strtoupper($empresas[$i]["nombre"]);?></option>
            <?php  } ?>              
          </select>              
        </div>

        <div class="form-group col-sm-2" style="margin-top:32px;">
          <button type="button" class=" btn btn-light visualizar" onClick="filtrar_creditos();"><i class="fas fa-search" style="color: green; border:gray;"></i> Filtrar</button>
        </div>

        <!--<div class="col-sm-2">
          <label>CCF</label>
          <div class="input-group">
            <button class="btn btn-primary" id="select_paciente_venta" onClick="listar_ventas_ccf();"><i class="fas fa-file-alt"></i> Emitir CCF</button>
          </div>
        </div>-->
      </div>
      </div>
      <!--<div class="row" style="margin:5px">
       <div class="input-group input-group-sm col-sm-3">
        <span class="input-group-append">
          <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Monto Total:&nbsp;</button>
        </span>
        <input type="text" class="form-control" id="ventas_empresa" readonly="">
      </div>
      <div class="input-group input-group-sm col-sm-3">
        <span class="input-group-append">
          <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Recuperado Actual:&nbsp;</button>
        </span>
        <input type="text" class="form-control" id="recuperado" readonly="">
      </div>
      <div class="input-group input-group-sm col-sm-3">
        <span class="input-group-append">
          <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Proyección recuperado mensual:&nbsp;</button>
        </span>
        <input type="text" class="form-control" id="proyeccion" readonly="">
      </div>
      <div class="input-group input-group-sm col-sm-3">
        <span class="input-group-append">
          <button type="button" class="btn btn-secondary btn-flat btn-md" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;border:#A8A8A8 1px solid">&nbsp;&nbsp;Saldo Total:&nbsp;</button>
        </span>
        <input type="text" class="form-control" id="proyeccion" readonly="">
      </div> 
      </div>-->
      

<section class="content" style="margin-top:5px">
  <div class="row">
   <div class="col-12">
    <div class="card">
    <div class="card-body">
      <section class="content">
      <div class="container_fluid">        
        <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>   
        <table id="creditos_globales" class="table-hover table-bordered" width="100%">
        <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">
           <tr>
            <th style='text-align: center;'>No. Venta</th>
            <th style='text-align: center;'>Titular de credito</th>
            <th style='text-align: center;'>Telefono</th>
            <th style='text-align: center;'>Empresa</th>      
            <th style='text-align: center;'>Inicio Crédito</th>
            <th style='text-align: center;'>Finalización Crédito</th>
            <th style='text-align: center;'>Plazo</th>
            <th style='text-align: center;'>Sucursal</th> 
            <th style='text-align: center;'>Monto</th> 
            <th style='text-align: center;'>Cuota</th>
            <th style='text-align: center;'>Saldo</th>
            <th style='text-align: center;'>Acciones</th>
          </tr>
     </thead>
     <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
   </table> 
      </div>
      </section>
    </div>
    </div>
   </div>
  </div>
 </section>
 </div>

<div id="modal_ccf_group" class="modal fade" data-modal-index="2">
        <div class="modal-dialog modal-lg" style="max-width: 85%">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <span class="modal-title">SELECCIONAR PACIENTE</span>              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: white;color:black">
              <div class="card-body p-0" style="margin:1px">
                <table id="data_ventas_ccf_group" width="100%" class="table-hover table-bordered">
                  <button class="btn btn-dark" data-toggle="modal" data-target="#modal-default" onClick="get_data_ccf();"><i class="fas fa-print" ></i> IMPRIMIR CCF</button>
                  <thead class="bg-secondary" style="text-align:center;font-size: 12px">
                    <tr>
                      <th>#Venta</th>          
                      <th>Paciente</th>
                      <th>Empresa</th>
                      <th>Monto</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;font-size: 12px">                                  
                  </tbody>
                  <tfoot style="text-align: center">
                    <th></th>
                      <th></th>
                      <th></th>
                      <th>Monto</th>
                      <th>$ <span id="monto_total_ccf_group"></span></th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
</div>


 <div class="modal fade" id="modal-default">
        <div class="modal-dialog" style="max-width: 80%">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h4 class="modal-title" style="font-size: 14px">DETALLES CREDITOS FISCAL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
      <div class="modal-body">

        <form method="post" action="ccf_empresarial_pdf.php" target="_blank">
          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputEmail4">Empresa</label>
              <input type="text" class="form-control" id="empresa_cff" name="empresa_cff">
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4">Dirección</label>
              <input type="text" class="form-control" id="direcion_ccf" name="direcion_ccf" required>
            </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4">Registro</label>
              <input type="text" class="form-control" id="registro_ccf" name="registro_ccf" required>
            </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4">NIT</label>
              <input type="text" class="form-control" id="nit_ccf" name="nit_ccf" required>
            </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4">Giro</label>
              <input type="text" class="form-control" id="giro_ccf" name="giro_ccf" required>
            </div>

            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="contribuyente_tipo" name="contribuyente_tipo">
                <label class="form-check-label" for="gridCheck">
                  Gran contribuyente
              </label>
            </div>
          </div>

          <input type="hidden" id="monto_ccf_det" name="monto_ccf_det">
          <input type="hidden" id="items_ccf_det" name="items_ccf_det">
          <input type="hidden" id="items_lengt" name="items_lengt">
        </div><!--fin form row--> 
        <button type="submit" class="btn btn-primary btn-block">IMPRIMIR</button>
      </form>
      </div><!--MODAL BODY-->
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>              
      </div>
      </div>
          <!-- /.modal-content -->
      </div>
        <!-- /.modal-dialog -->
      </div>  
<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="COBROS DE CREDITOS">
<input type="hidden" id="id_consulta">
<input type="hidden" id="id_paciente">
<input type="hidden" id="optometra" value="">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/recibos.js"></script>
<script type="text/javascript" src="js/creditos.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/reporteria.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>

<script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+
    title;

     function mayus(e) {
    e.value = e.value.toUpperCase();
  }
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

  $(function(){
      $('.btn[data-toggle=modal]').on('click', function(){
        var $btn = $(this);
        var currentDialog = $btn.closest('.modal-dialog'),
        targetDialog = $($btn.attr('data-target'));;
        if (!currentDialog.length)
          return;
        targetDialog.data('previous-dialog', currentDialog);
        currentDialog.addClass('aside');
        var stackedDialogCount = $('.modal.in .modal-dialog.aside').length;
        if (stackedDialogCount <= 5){
          currentDialog.addClass('aside-' + stackedDialogCount);
        }
      });

      $('.modal').on('hide.bs.modal', function(){
        var $dialog = $(this);  
        var previousDialog = $dialog.data('previous-dialog');
        if (previousDialog){
          previousDialog.removeClass('aside');
          $dialog.data('previous-dialog', undefined);
        }
      });
    })
</script>


<?php } else{
echo "Acceso denegado";
  } ?>  