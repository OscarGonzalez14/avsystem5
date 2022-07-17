<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/modal_ingreso_bodega.php');
?>
<div class="content-wrapper">
<div>
  <input type="hidden" id="sucursal_user" value="<?php echo $_SESSION["sucursal"];?>">
    <h5 align="center"><strong>INVENTARIO GENERAL</strong></h5>
	  <div class="row" style="margin: 5px">
      <div class="col-sm-4">
        <label for="sel1">Seleccione Categoría:</label>
          <select class="form-control" id="tipo_categoria" name="tipo_categoria">
            <option value="">Seleccione</option>
            <option value="Gaveta" class="cats_suscursal">Gaveta</option>
            <option value="Accesorios" class="cats_suscursal">Accesorios</option>
            <option value="Exhibicion" class="cats_suscursal">Exhibicion</option>
            <option value="Maleta" class="cats_suscursal">Maleta</option>
            <option value="Bandeja" class="cats_suscursal">Bandeja</option>
          </select>
      </div>

      <div class="col-sm-4">
      <div class="form-group">
      <label for="sel1">Seleccione Ubicación:</label>
      <select class="form-control" name="" id="categoria_ubicaciones"></select>
      </div>      
    </div>
  </div>
  <table id="data_inventario_genaral" width="100%" style="text-align: center">
      <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center">Fecha Ingreso</th>
            <th style="text-align:center">#Compra</th>
            <th style="text-align:center">Usuario</th>
            <th style="text-align:center">Bodega</th>
            <th style="text-align:center">Ubicación</th>
            <th style="text-align:center">Descripción</th>
            <th style="text-align:center">Diseño</th>
            <th style="text-align:center">Materiales</th>
            <th style="text-align:center">Stock</th>
            <th style="text-align:center">Pr.Venta</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
        </tbody>
      </table>   <!-- /.content -->
</div>
</div>

<?php require_once("footer.php"); ?>
<script src='js/compras.js'></script>
<script src='js/bodegas.js'></script>
<?php } else{
echo "Acceso no permitido";
}
?>