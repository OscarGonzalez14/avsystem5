<?php
 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
$n_compra =$_GET["numero_compra"];
require_once('modals/modal_ingreso_bodega.php');
require_once('modals/reporte_det_ingreso.php');
require_once('modals/modal_categorias.php');
require_once('modelos/Externos.php');
$categorias = new Externos();
$sucursal=$_SESSION["sucursal"];
$cats=$categorias->get_categorias($sucursal);

?>
<input type="hidden" name="" id="numero_compra_bod" value="<?php echo $n_compra; ?>">
<div class="content-wrapper">
<div style="margin: 5px">
    <h5 align="center"><strong>DISTRIBUIR COMPRAS A BODEGA</strong></h5>
    <div class="callout callout-dark">
	  <div class="row" style="margin: 0px;padding: 0px">
        <div class="callout callout-warning col-sm-2">
          <span><strong>#INGRESO:</strong></span><span id="id_ingreso_c"></span>
        </div>&nbsp;
		    <div class="callout callout-danger col-sm-2">
          <span><strong>#COMPRA:</strong></span><span id="numero_compra_i"><?php echo $n_compra; ?></span>
        </div>&nbsp;
        <div class="callout callout-success col-sm-3">
            <span><strong>Fecha:</strong> </span><span id=""><?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s"); echo $hoy;?></span>
        </div>&nbsp;
       
        <div class="callout callout-info col-sm-3">
            <span><strong>Sucursal: </strong> </span><span id="sucursal_i"><?php echo $_SESSION["sucursal"];?></span>
        </div>
	  </div>
	  </div>

	 <div style="margin:2px;" class="row">
      <div class="col-sm-5">
       <button class="btn btn-dark btn-flat" style="color:white;border-radius:3px; background:black" data-backdrop="static" data-keyboard="false" onClick="ingresar_compras_bodega();" id="select_prod"><i class="fas fa-cubes"></i> Seleccionar Producto</button>&nbsp;
       <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal_cats">CREAR CATEGORÍA</button>&nbsp;
      </div>
      <div class="col-sm-3">
       <select class='form-control' id="categoria_ubicacion">
       <option value="">Seleccione Categoría/Ubicación</option>
        <?php
        for ($i=0; $i < sizeof($cats); $i++) { ?>
          <option value="<?php echo $cats[$i]["nombre"]?>"><?php echo $cats[$i]["nombre"]?></option>
         <?php  } ?>

       </select>
      </div>
       <div class="col-sm-3">
         <a href="stock.php"><button type="button" class="btn btn-info btn-flat"><i class="fas fas fa-clipboard-list"></i> INVENTARIO GENERAL</button></a>
       </div>
  </div>

        <div class="card" style="margin-top:10px">
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table style="margin:10px" width="100%" id="display_ingresos">
                  <thead style="background:black;color:white">
                    <tr>
                      <th style="text-align:center" width="5%">Item</th>
                      <th style="text-align:center" width="5%">Orden</th>
                      <th style="text-align:center" width="5%">Disp.</th>
                      <th style="text-align:center" width="40%">Descripción</th>
                      <th style="text-align:center" width="30%">Ubicación</th>
                      <th style="text-align:center" width="5%">Cantidad</th>
                      <th style="text-align:center" width="10%">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id="listar_productos_de_ingreso" style="width: 100%"></tbody>                    
                     
                </table>
                <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
                <input type="hidden" id="usuario" value="<?php echo $_SESSION["usuario"];?>">
                <input type="hidden" id="fecha_ingreso" value="<?php echo $hoy;?>">
                <button class="btn btn-primary btn-block" style="border-radius:3px;margin:10px" onClick='registrarIngresoBodega();' onmouseover="get_numero_recibo();" id="btn_ingreso"><i class="fas fa-download"></i> INGRESAR A INVENTARIO</button>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="row" id="post_ingreso" style="display: flex;justify-content: space-between !important;">
                <div class="col-sm-6">
                  <button class="btn btn-primary btn-block" style="border-radius:2px" data-toggle="modal" data-target="#modal_det_ingresos" data-backdrop="static" data-keyboard="false" onClick="reporte_ingresos_bodega();";><i class="fas fa-print"></i> Descargar/Imprimir Reporte Ingreso&nbsp;<i class="fas fa-lock"></i></button>
                </div>
                <div class="col-sm-6">
                  <button class="btn btn-success btn-block" style="border-radius:2px" onClick='explode();'><i class="fas fa-plus"></i> Nuevo Ingreso</button>
                </div>
              </div>

</div>
</div>
<?php require_once("footer.php"); ?>
<script src='js/compras.js'></script>
<script src='js/bodegas.js'></script>
<script src='js/categorias.js'></script>
<?php } else{
echo "Acceso denegado";
  } ?>