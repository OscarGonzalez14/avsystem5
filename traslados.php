<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/modal_traslados.php');

 ?>

 <div class="content-wrapper">
  <div style="margin:2px">
  <div class="callout callout-info">
    <div class="col-sm-10">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="inventarios.php">Regresar</a></li>
              <li class="breadcrumb-item active">Traslado #<span id="num_traslado"></span></li>
            </ol>
        <h4 align="center"><i class="fas fa-exchange-alt" style="color:green"></i> <strong>TRASLADOS INTERNOS</strong></h4>              
    </div>

    <div class="col-sm-2">
       <label for="inputPassword4">Buscar Producto</label>
       <button class="btn btn-dark btn-block" id="items_traslados"><i class="fas fa-search"></i></button>
    </div>

    </div><!--FIN INVOICES-->

<table class="table-hover table-striped" id="tabla_det_traslados" width="100%">
    <thead class="bg-info">
      <tr>
        <th style="text-align:center" width="10%">Item</th>
        <th style="text-align:center" width="40%">Descripción</th>
        <th style="text-align:center" width="10%">Cantidad</th>
        <th style="text-align:center" width="10%">Ub. Origen</th>
        <th style="text-align:center" width="10%">Ub. Destino</th>
        <th style="text-align:center" width="10%">Quitar</th>
      </tr>
    </thead>
    <tbody id="listar_det_traslados" style="width: 100%;text-align: center;"></tbody>               
                 
</table>
 
 <div style="margin:30px">
   <button class="btn btn-primary btn-block" id="btn_de_compra" style="border-radius:2px" onClick='registrar_traslado();'><i class="fas fa-save"></i> REALIZAR TRASLADO</button>
 </div> 

  </div>
</div>

<input type="hidden" name="tipo_traslado" id="tipo_traslado" value="interno"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">

<!--MODAL CATEGORIAS-->


<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_cat_traslados" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
     <div class="modal-header" id="" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> CATEGORÍAS</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
              <input type="hidden" id="indice_categoria"  value="">
              <div class="card-body p-0" style="margin:7px">
                <table class="table-hover table-bordered" id="data_cats_traslados" width="100%">
                  <thead style="text-align: center;" class="bg-primary">
                    <tr>
                      <th>Sucursal</th>
                      <th>Categoría</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
  
    </div><!--Fin modal Content-->

  </div>
</div>

<!--FIN MODAL CATEGORIAS-->
<?php require_once("footer.php");?>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/bodegas.js"></script>
 <?php } else{
echo "Acceso no permitido";
  } ?>