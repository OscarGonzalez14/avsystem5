 
<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){

require_once("modelos/Externos.php");
$users = new Externos();
$opto = $users->get_usuarios_ventas();

require_once("header_dos.php");
require_once("modals/listar_aros_en_venta.php");
require_once("modals/modal_lente_en_venta.php");
require_once("modals/modal_accesorios_ventas.php");
require_once("modals/pacientes_con_consulta.php");
require_once("modals/pacientes_sin_consulta.php");
require_once("modals/listar_servicios_venta.php");
require_once("modals/modal_recibo_inicial.php");
require_once("modals/antireflejante_ventas.php");
require_once("modals/photosensible_ventas.php");
require_once("modals/referentes.php");
require_once("modals/empresas_credito_fiscal.php");
require_once("modals/modal_correlativo_factura.php");
require_once("modals/modal_oid.php");
require_once("modals/modal_prima_oid.php");
require_once("modals/modal_cargo_automatico.php");
?>
<style>
  html{ 
    overflow: scroll; 
    -webkit-overflow-scrolling: touch;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
  <section class="content" style="margin-top: 5px">
    <div class="row">
      <div class="col-12">
      <div class="card">
  
<div class="card-body"><!--CONTENIDO-->

<section class="content">            
  <div class="container-fluid">

<div class="invoice p-3 mb-3">
              
              <div class="row row2" style="background:#E0E0E0;border-radius: 5px">
                    <div class="form-group col-sm-2">
                      <label for="">Tipo Venta</label>
                      <select class="form-control input-dark" id="tipo_venta" required="">
                        <option value=''>Seleccionar tipo Venta</option>
                        <option value='Contado'>Contado</option>
                        <option value='Credito'>Credito</option>
                        <option value='Credito Fiscal'>Credito Fiscal</option>
                      </select>
                    </div>  

                  <div class="form-group col-sm-2">
                    <label for="">Tipo Pago</label>
                      <select class="form-control input-dark" id="tipo_pago" required="">
                        <option value=''>Seleccionar tipo Pago</option>
                        <option value='Contado'>Efectivo</option>
                        <option value='Credito'>Cheque</option>
                        <option value='Credito'>Tarjeta de Crédito</option>
                      </select>
                  </div>

                  <div class="form-group col-sm-2">
                    <label for="">Plazo</label>
                      <select class="form-control input-dark" id="plazo" required="">
                        <option value='0'> Contado</option>
                        <option value='1'>1 meses</option>
                        <option value='2'>2 meses</option>
                        <option value='3'>3 meses</option>
                        <option value='4'>4 meses</option>
                        <option value='5'>5 meses</option>
                        <option value='6'>6 meses</option>
                        <option value='7'>7 meses</option>
                        <option value='8'>8 meses</option>
                        <option value='9'>9 meses</option>
                        <option value='10'>10 meses</option>
                        <option value='11'>11 meses</option>
                        <option value='12'>12 meses</option>
                      </select>
                  </div>

                  <div class="form-group col-sm-3">
                    <label for="">Existe Consulta?</label>
                      <select class="form-control input-dark" id="consulta_ex" required="">
                        <option value=''>Seleccionar...</option>
                        <option value='Si'>Si</option>
                        <option value='No'>No</option>
                      </select>
                  </div>

                  <div class="col-sm-3 select2-purple">
                      <label for="ex3">Vendedor</label>
                      <select class="select2 form-control" id="usuario" multiple="multiple" data-placeholder="Seleccionar vendedor" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
                      <option value="0">Seleccionar usuario</option>
                      <?php
                      for ($i=0; $i < sizeof($opto); $i++) { ?>
                      <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
                      <?php  } ?>              
                      </select>              
                  </div>

                <!--<div class="form-group col-sm-3">
                    <label for="">Tipo Paciente</label>
                      <select class="form-control input-dark" id="tipo_paciente" required="">
                        <option value=''>Seleccionar...</option>
                        <option value='Normal'>Normal</option>
                        <option value='Referido'>Referido</option>
                      </select>
                  </div>-->

            </div>
            <div class="dropdown-divider"></div>
              <div class="row invoice-info callout callout-info form-row" style="border-bottom: solid 1px black;border-right: solid 1px black;border-top: solid 1px black">

                    <div class="col-sm-3 invoice-col" style="margin:0px"> 
                    <label>Encargado de cuenta</label>
                      <input type="text" class="form-control" id="titular_cuenta" readonly>
                    </div>

                    <div class="col-sm-3 invoice-col" style="display:none" id="paciente_evaluado_c" style="margin:0px">
                    <label>Paciente Evaluado</label>
                      <input type="text" class="form-control" id="evaluado" readonly>
                    </div>

                    <div class="col-sm-1 invoice-col" style="margin:0px">
                      <label>#Pac.</label>
                      <input type="text" class="form-control" id="codigo_paciente" readonly>
                    </div>

                    <div class="col-sm-1 invoice-col form-group" style="margin: 0px">
                    <label>Paciente</label>
                      <button class="btn btn-primary btn-block" id="select_paciente_venta"><i class="fas fa-plus"></i></button>
                    </div>

                    <div class="col-sm-3 invoice-col" id="paciente_refiere" style="margin:0px;display: none">
                    <label>Paciente refiere</label>
                      <input type="text" class="form-control" id="pac_refiere" readonly >
                    </div>

                    <div class="col-sm-1 invoice-col form-group" style="margin: 0px;display: none" id="div_ref">
                    <label>Refiere</label>
                      <button class="btn btn-success btn-block" id="select_paciente_refiere"><i class="fas fa-plus"></i></button>
                    </div>
                </div><!--/.row invoice-info datos Proveedor-->

           <div class="col-md-12">
              <div><!--BOTONES AGREGAR PRODUCTO-->
                <section>
                  <button class="btn btn-info" style="color:white;border-radius:1px;" data-toggle="modal" data-target="#listar_aros_ventas" data-backdrop="static" data-keyboard="false" id="btn_aros_venta"><i class="fas fa-plus"></i> Aro</button>                
                  <a class="btn btn-dark" style="color:white;border-radius:1px; background:black" data-toggle="modal" data-target="#listar_lentes_ventas" data-backdrop="static" data-keyboard="false" id="btn_aros_venta" onClick='listar_lentes_venta();'><i class="fas fa-plus"></i> Lentes</a>             

                  <a class="btn btn-dark" style="color:white;border-radius:1px; background:black" data-toggle="modal" data-target="#listar_ar_ventas" data-backdrop="static" data-keyboard="false" id="btn_ar_venta" onClick="listar_ar_venta();"><i class="fas fa-plus"></i> AR</a>

                  <a class="btn btn-dark" style="color:white;border-radius:1px; background:black" data-toggle="modal" data-target="#listar_photo_ventas" data-backdrop="static" data-keyboard="false" id="btn_photo_venta" onClick='listar_photo_venta();'><i class="fas fa-plus"></i> Photosensibles</a>

                  <a class="btn btn-dark" style="color:white;border-radius:1px; background:black" data-toggle="modal" data-target="#listar_servicios_ventas" data-backdrop="static" data-keyboard="false" id="btn_servicios_venta" onClick="listar_servicios_venta();"><i class="fas fa-plus"></i> Servicios</a>

                  <button class="btn btn-secondary" style="color:white;border-radius:1px;" data-toggle="modal" data-target="#listar_accesorios_ventas" data-backdrop="static" data-keyboard="false" id="btn_accesorios_venta"><i class="fas fa-plus"></i> Accesorios</button>

                  <a href="reporte_gral_ventas.php"><button class="btn btn-primary" style="color:white;border-radius:1px;" ><i class="fas fa-eye"></i> REPORTES </button></a>


             </section>       
            </div><!-- FIN BOTONES AGREGAR PRODUCTO-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" align="center"><strong>Detalle de Compras</strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table  id="tabla_det_ventas" width="100%">
                  <thead style="background: #00001a;color:white">
                    <tr>
                      <th style="text-align:center" width="10%">#</th>
                      <th style="text-align:center" width="40%">Descripción&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="text-align:center" width="10%">Cantidad</th>
                      <th style="text-align:center" width="10%">P/U</th>
                      <th style="text-align:center" width="10%">Desc. $</th>
                      <th style="text-align:center" width="10%">Subtotal</th>
                      <th style="text-align:center" width="10%">Quitar</th>
                    </tr>
                  </thead>
                  <tbody id="listar_det_ventas" style="width: 100%"></tbody>               

                    <tfoot style='background:#E0E0E0'>
                      <tr>
                      <td style="text-align:center;text-align:center" colspan="6"><strong>Monto total de la Venta</strong></td>
                      <td style="text-align:center;text-align:center" colspan="1"><strong><span>$</span><span id="total_venta"></span></strong></td>                      
                    </tr>
                    <tfoot>                      
                </table>
                <button class="btn btn-primary btn-block enviar_venta" id="btn_de_compra" style="border-radius:2px" onClick='saveVenta();'><i class="fas fa-save"></i> REGISTRAR VENTA</button>
              </div>
              <br>
              <div class="row post_venta" id="post_venta" style="display: flex;justify-content: space-between !important;">
                <div class="col-sm-6 post_compra">
                  <button class="btn btn-block" style="border-radius:2px;background:#333333;color:white" data-toggle="modal" data-target="#recibo_inicial" data-backdrop="static" data-keyboard="false" onClick="reciboInicial();"><i class="fas fa-print"></i> Imprimir recibo Inicial</button>
                </div>
                <div class="col-sm-6 post_compra">
                  <button class="btn btn-success btn-block" style="border-radius:2px" onClick='explode();'><i class="fas fa-plus"></i> Nueva Venta</button>
                </div>               

              </div>
              <br>

              <div class="row">
                <div class="col-sm-4" id="print_factura">
                  <button class="btn btn-info btn-block" style="border-radius:2px" onClick="print_facturas_ventas()"><i class="fas fa-print"></i> Imprimir Factura</button>
                </div>
                <div class="col-sm-4" id="print_credito_fiscal">
                  <a href="" id="credito_fiscal_print" target="_blank"><button class="btn btn-secondary btn-block" style="border-radius:2px"><i class="fas fa-print"></i> Imprimir Credito Fiscal</button></a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div> <!--Fin trable--> 
              <div class="col-sm-4" id="print_manual_oid">
                  <button class="btn btn-dark btn-block" style="border-radius:2px" data-toggle="modal" data-target="#oid"><i class="fas fa-print"></i> OID</button>
                </div>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li><input type="text" class="form-control" id="n_venta" readonly="" style="background: white;border: 1px solid white;color: black;text-align: right;"></li>
    </ul>
  </nav>  
</div>
</div>
</section>

<div class="modal" id="advertencia_creditos">
  <div class="modal-dialog" style="max-width: 90%">
    <div class="modal-content">
      <!-- Modal Header -->
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row" style="margin-top: 5px">
              <div class="col-12">
                <div class="callout callout-info" style="border-bottom: solid 1px #008080;">
                  <h3 style='font-family: Helvetica, Arial, sans-serif;font-size: 20px;text-align: center'><i class="fas fa-exclamation-circle fa-2x" style="color: red"></i></h3>
                  <h3 style='font-family: Helvetica, Arial, sans-serif;font-size: 20px;text-align: center'>EL TITULAR POSEE UNA ORDEN DE DESCUENTO ACTIVA</h3>
                  <h3 style='font-family: Helvetica, Arial, sans-serif;font-size: 18px;text-align: center'>¿Desea agregar esta cuenta a orden ya Existente?</h3>
                </div>
              </div>
            </div>
            <input type="text" id="n_orden_add" value="123">

            <table width="100%" class="table-hover table-bordered">
              
              <thead style="background:#034f84;color:white;text-align: center;font-family: Helvetica, Arial, sans-serif;font-size:12px">
                <tr>
                  <th style="width: 24% !important;font-size:11px" colspan="24">Titular</th>
                  <th style="width: 20% !important;font-size:11px" colspan="20">Empresa</th>
                  <th style="width: 23% !important;font-size:11px" colspan="23">Evaluado</th>
                  <th style="width: 11% !important;font-size:11px" colspan="11">Saldo Actual</th>
                  <th style="width: 11% !important;font-size:11px" colspan="11">Nuevo Saldo</th>
                  <th style="width: 11% !important;font-size:11px" colspan="11">Nuevo Plazo</th>
                </tr>
              </thead>

              <tr>
                  <td style="width: 24% !important;text-align: center;font-size:11px" colspan="24"><span id="tit_add_tit"></span></td>
                  <td style="width: 20% !important;text-align: center;font-size:11px" colspan="20"><span id="empresa_add_tit"></span></td>
                  <td style="width: 23% !important;text-align: center;font-size:11px" colspan="23"><span id="eval_add_tit"></span></td>
                  <td style="width: 11% !important;text-align: center;font-size:11px" colspget_numero_ventaan="11"><span id="saldo_act_add"></span></td>
                  <td style="width: 11% !important;text-align: center;font-size:11px" colspan="11"><span id="nuevo_saldo_add"></span></td>
                  <td style="width: 11% !important;text-align: center;font-size:11px" colspan="11"><input type="number" id="plazo_acts"></td>
              </tr>

            </table>

      <input type="hidden" id="plazo_acts_1">
      </div><!--Fin Modal Body-->
      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" name="action" class="btn btn-success pull-left" value="Add" onClick="newOrden();"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Orden </button>
          <button type="button" class="btn btn-info" onClick="add_beneficiario_oid();"><i class="far fa-folder-open" aria-hidden="true"></i> Agregar a orden existente</button>
      </div>

    </div>
  </div>
</div>


<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<!--<input type="hidden" name="usuario" id="usuario" value="<?php //echo $_SESSION["id_usuario"];?>"/>-->
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="MODULO VENTAS">
<input type="hidden" id="id_consulta">
<input type="hidden" id="id_paciente">
<input type="hidden" id="id_refererido">
<input type="hidden" id="optometra" value="">
<input type="hidden" id="empresa_fisc" value="">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/ventas.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/recibos.js"></script>
<script type="text/javascript" src="js/creditos.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>


</div><!-- FIN CONTENIDO-->
</div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>

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
</script>

<div id="empresasModal" class="modal fade" data-modal-index="2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <span class="modal-title">SELECCIONAR EMPRESA</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: white;color:black">
              <div class="card-body p-0" style="margin:1px">
                <table id="lista_pacientes_data_emp" width="100%" class="table-hover table-bordered">
                  <thead class="bg-secondary" style="font-family: Helvetica, Arial, sans-serif;text-align: center;font-size: 11px">
                    <tr>
                    <th>Codigo</th>          
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 11px">                                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
</div>

   <?php } else{
echo "Acceso denegado";
  } ?>
