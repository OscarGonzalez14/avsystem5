<?php
require_once("config/conexion.php");

if(isset($_SESSION["usuario"])){ 

 require_once('header_dos.php');
 require_once('modals/nuevo_aro.php');
 require_once('modals/nuevo_accesorio.php'); 
 require_once('modals/nuevo_lente.php');
 require_once('modals/nueva_marca.php');
 require_once('modals/modal_proveedores.php');
 require_once('modals/modal_aros.php');
 require_once('modals/modal_accesorios.php');
 require_once('modals/otros_servicios.php');
 //require_once('modals/modal_reporte_ultima_compra_admin.php');

?>
<style type="text/css">
  .breadcrumb > li + li:before {
   color: #CCCCCC;
   content: "/ ";
   padding: 0 5px;
}

a .btn{
  color: white;
}

div .post_compra{
  align-items: flex-end;
}


</style>

<div class="content-wrapper" >
<section class="content">
  <div class="container-fluid">
  <div class="btn-group bg-light" style="margin:5px"> <!--inicio div contenedor de botones-->
  <div class="card-body">
    <button class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#nuevo_aro" data-backdrop="static" data-keyboard="false" onClick="campos_modal_aros();"><i class="fas fa-plus-square" ></i> Crear Aro</button>&nbsp;

    <button class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#accesorios_save" data-backdrop="static" data-keyboard="false" onClick="campos_modal_acc();"><i class="fas fa-plus-square"></i> Crear Acc</button>&nbsp;

    <a href="lentes.php" class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px"data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-square"></i> Crear Lente</a>&nbsp;

    <button class="btn btn-dark" style="color:white;border-radius:2px; background:black;margin:solid black 1px" data-toggle="modal" data-target="#nuevo_servicio"><i class="fas fa-plus-square"></i> Crear Servicio</button>&nbsp;

    <!-- <button type="button" class="btn btn-dark btn-flat">DISTRIBUIR COMPRA</button>&nbsp;-->
    <button type="button" class="btn btn-info btn-flat">REPORTE DE COMPRAS</button>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon btn-flat" data-toggle="dropdown">
     <span class="sr-only">Toggle Dropdown</span>
      <div class="dropdown-menu" role="menu">
        <a class="dropdown-item" href="#" style="text-decoration: none;color:black">Reporte diario de Compras</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" style="text-decoration: none;color:black">Reporte mensual de Compras</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"  style="text-decoration: none;color:black">Reporte anual compras</a>
        <div class="dropdown-divider"></div>
        <!--<a class="dropdown-item" style="border-radius:2px" onClick="reporte_compras_admin();">Descargar/imprimir compras admin</a>-->
      </div>
  </button> 
  </div>    
  </div><!--fin div contenedor de bontones-->

              
    <div class="row" style="margin-top: 5px"><!--Inicio encabezado compras-->
      <div class="col-12">
        <div class="callout callout-info" style="border-bottom: solid 1px #008080;">
          <h3 style='text-align:center;max-height: 20px'>COMPRAS</h3>
        </div>
      </div>
    </div><!--fin encabezado compras-->

    <div class="invoice p-3 mb-3">

      <div class="row invoice-info callout callout-info" style="border-bottom: solid 1px black;border-right: solid 1px black;border-top: solid 1px black">
        <div class="col-sm-2 invoice-col">
          <label># Compra</label>
          <input type="text" class="form-control input-dark" id="n_compra" style="margin:2px;background:white;border-radius: 6px;text-align: center;">
        </div>

        <div class="col-sm-6 invoice-col">
          <label>Proveedor</label>
          <input type="text" class="form-control input-dark" id="proveedor_compra" style="margin:2px;background:white;border-radius: 6px;text-align: center;" readonly>
        </div>

        <div class="col-sm-2 invoice-col">
          <label>Cod. Prov.</label>
          <input type="text" class="form-control input-dark" id="codigo_proveedor" style="margin:2px;background:white;border-radius: 6px;text-align: center;" readonly>
        </div>

        <div class="col-sm-2 invoice-col">
          <label>Buscar</label>
          <button class="btn btn-primary btn-block" style="border-radius:2px" data-toggle="modal" data-target="#modalProveedores">Proveedor</button>
        </div>
      </div><!--/.row invoice-info datos Proveedor-->

      <div class="row row2" style="background:#E0E0E0">
        <div class="form-group col-sm-2">
          <label for="">Tipo Compra</label>
          <select class="form-control input-dark" id="tipo_compra" required="">
            <option value=''>Seleccionar tipo Venta</option>
            <option value='Contado'>Contado</option>
            <option value='Credito'>Credito</option>
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
            <option value='contado'> Contado</option>
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

        <div class="form-group col-sm-2">
          <label for=""># Doc.</label>
          <select class="form-control input-dark" id="tipo_documento" required="">
            <option value=''>Seleccionar tipo Documento</option>
            <option value='Factura'>Factura</option>
            <option value='Credito Fiscal'>Credito Fiscal</option>
          </select>
        </div>

        <div class="form-group col-sm-2">
          <label for="inputPassword4"># CCF/Factura</label>
          <input type="text" class="form-control input-dark" id="documento" required>
        </div>
        <div class="form-group col-sm-2">
          <label for="">Sucursal</label>
          <select class="form-control input-dark" id="sucursal" required="">
            <option value=''>Seleccionar sucursal</option>
            <option value='Metrocentro'>Metrocentro</option>
            <option value='Santa Ana'>Santa Ana</option>
            <option value='San Miguel'>San Miguel</option>
          </select>
        </div>   

      </div><!--/.row2-->

      <div style="margin:20px;">
       <a class="btn btn-dark" style="color:white;border-radius:3px; background:black" data-toggle="modal" data-target="#modalAros" data-backdrop="static" data-keyboard="false" onClick="listar_aros();"><i class="fas fa-glasses"></i> Agregar Aro</a>

       <a class="btn btn-dark" style="color:white;border-radius:3px; background:black" data-toggle="modal" data-target="#modalAccesorios" data-backdrop="static" data-keyboard="false" onClick="listar_acc_compras();"><i class="fas fa-glasses"></i> Agregar Accesorio</a>

       <!--<a class="btn btn-dark" style="color:white;border-radius:3px; background:black"data-backdrop="static" data-keyboard="false"><i class="fas fa-glasses"></i> Agregar Lente</a>

       <a class="btn btn-dark" style="color:white;border-radius:3px; background:black"  data-backdrop="static" data-keyboard="false"><i class="fas fa-gift"></i> Regalías</a>-->
     </div>


     <div class="col-md-12"><!--inicio de datatable compras-->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" align="center"><strong>Detalle de Compras</strong></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0 table-responsive">
          <table class="table table-striped" id="tabla_det_compras">
            <thead class="bg-info">
              <tr>
                <th style="text-align:center" width="10%">#</th>
                <th style="text-align:center" width="40%">Descripción&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th style="text-align:center" width="10%">P. C/U</th>
                <th style="text-align:center" width="10%">Cantidad</th>
                <th style="text-align:center" width="10%">P. V/U</th>
                <th style="text-align:center" width="10%">Subtotal</th>
                <th style="text-align:center" width="10%">Eliminar</th>
              </tr>
            </thead>
            <tbody id="listar_det_compras" style="width: 100%"></tbody>                    

            <tfoot style='background:#E0E0E0' onmouseover="get_numero_recibo();">
              <tr>
                <td style="text-align:center;text-align:center" colspan="6"><strong>Monto total de la Compra</strong></td>
                <td style="text-align:center;text-align:center" colspan="1"><strong><span>$</span><span id="total_compra"></span></strong></td>                      
              </tr>
              <tfoot>                      
              </table>
              <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
              <input type="hidden" id="usuario" value="<?php echo $_SESSION["usuario"]?>">
              <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
              <button class="btn btn-dark btn-block" id="btn_de_compra" style="border-radius:2px" onClick='registrarCompra();' onmouseover="get_numero_recibo();"><i class="fas fa-save"></i> REGISTRAR COMPRA</button>
            </div><!--Fin tabla de dtcompras-->
        

            <div class="row post_compra" id="post_compra" style="display: flex;justify-content: space-between !important; margin-top:5px;">
                

               <!-- <div class="col-sm-4 post_compra">
                  <button class="btn btn-primary btn-block" style="border-radius:2px" data-toggle="modal" data-target="#modal_print_admin" data-backdrop="static" data-keyboard="false" onClick="reporte_compras_admin();";><i class="fas fa-print"></i> Descargar/Imprimir compra(Admin)&nbsp;<i class="fas fa-lock"></i></button>
                </div>-->
                <div class="col-sm-4 post_compra">
                  <button class="btn btn-info btn-block" style="border-radius:2px" onClick='explode();'><i class="fas fa-plus"></i> Nueva Compra</button>
                </div>
                <div class="col-sm-4 post_compra">
                  <input type="hidden" name="">
                </div>
                <div class="col-sm-4 post_compra">
                  <a href="ingresos_bodega.php" class="btn btn-block" style="color:white;border-radius:2px; background:#001a33;margin:solid #000066 1px"data-backdrop="static" data-keyboard="false"><i class="fas fa-boxes"></i>  Ingresar Compra a Bodega</a>
                </div>
                <!--<div class="col-sm-4 post_compra" style="margin-top: 10px">
                  <button class="btn btn-success btn-block" style="border-radius:2px"><i class="fas fa-print"></i> Descargar/Imprimir compra(Bodega)&nbsp;<i class="fas fa-unlock"></i></button>
                </div>
                <br>
                <div class="col-sm-7 post_compra">
                  <input type="hidden" name="">
                </div>-->

              </div>
            
            

              
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div> <!--Fin datatable-->    
      </div>

  </div>
</section>

</div><!-- /.content wrapper-->
<?php require_once("footer.php"); ?>
<script src='js/compras.js'></script>
<script src='js/proveedores.js'></script>
<script src='js/productos.js'></script>
<script src='js/marca.js'></script>

<script>
  function campos_modal_aros(){
    document.getElementById("marca_aros").value = "";
    document.getElementById("modelo_aros").value = "";
    document.getElementById("color_aros").value = "";
    document.getElementById("medidas_aros").value = "";
    document.getElementById("diseno_aros").value = "";
    document.getElementById("materiales_aros").value = "";
    document.getElementById("cat_vta_aros").value = "";
  }
  
  function campos_modal_acc(){
    document.getElementById("cod_acc").value = "";
    document.getElementById("tipo_accesorio").value = "";
    document.getElementById("marca_accesorio").value = "";
    document.getElementById("desc_accesorio").value = "";

  }
</script>

<?php } else{
echo "Acceso denegado";
  } ?>