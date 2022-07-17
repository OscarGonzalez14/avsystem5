<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/modal_ingreso_bodega.php');
require_once('modals/nuevo_aro.php');
require_once('modals/nueva_marca.php');
//require_once('modals/editar_aro.php');
?>
<div class="content-wrapper" >
<!--$('[name="country-of-operation-edit[]"]').val()-->
<div style="margin: 1px">
	<div class="callout callout-info">
        <h5 align="center" style="margin:0px"><i class="fas fa-glasses" style="color:green"></i> <strong>BODEGA CENTRAL</strong></h5>
        <?php include 'sources-view/nav-bar-aros.php'?>             
    </div>
	
</div>

<table width="100%" class="table-bordered table-hover" id="data_stock_bdcentral" data-order='[[ 0, "desc" ]]' style="margin:5px">
      <thead style="background:#0b1118;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
          <tr>
          <th>ID</th>
          <th>Modelo</th>
          <th>Marca</th>
          <th>Color</th>
          <th>Medidas</th>
          <th>Diseño</th>
          <th>Material</th>
          <th>Stock</th>
          <th>Distribuir</th>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;" id="ingreso-ind-temp">                                  
        </tbody>
  </table>
   
<style>
      #table-det-lentes{
  font-family: "Avenir Next", Avenir, 'Helvetica Neue', 'Lato', 'Segoe UI', Helvetica, Arial, sans-serif;
  font-size: 13px;
  border-radius: 2px;
  text-align: left;
  text-transform: uppercase;
  width: 100%;
  margin-left: 0px
}

#table-det-lentes td{
  padding: 4px;
  margin-left: 6px
  margin: 1em;
 }
</style>

<!-- Modal ubicacion individual-->
<div class="modal" id="ubicacion-ind">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-dark" style="background: #073763 !impoprtant;color:white;padding:10px">        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      <div class="callout callout-info">
        <table id="table-det-lentes" width="100%" >
          <tr>
            <td colspan="50" style="width: 50%;border-bottom: 1px solid #5bc0de;border-right: 1px solid #5bc0de;">&nbsp;&nbsp;<b>MARCA</b>: <span id="marca-aro-indiv" class="data-det-orden"></span></td>
            <td colspan="50" style="width: 50%;border-bottom: 1px solid #5bc0de;">&nbsp;&nbsp;<b>MODELO</b>: <span id="modelo-aro-indiv" class="data-det-orden"></span></td>
          </tr>
          <tr>
            <td colspan="50" style="width: 50%;border-right: 1px solid #5bc0de;">&nbsp;&nbsp;<b>COLOR</b>: <span id="color-aro-indiv" class="data-det-orden"></span></td>
            <td colspan="50" style="width: 50%">&nbsp;&nbsp;<b>MATERIAL</b> <span id="material-aro-indiv" class="data-det-orden"></span></td>
          </tr>
        </table>
      </div>

      <div class="form-row" autocomplete="off">

        <div class="form-group col-md-6">
            <label for="ubicacion">Ubicacion</label>
            <select name="" id="ubicacion_ind" class="form-control clear_i">
                <option value="Bodega central">Bodega central</option>
            </select>
       </div>

        <div class="form-group col-md-6">
            <label for="ubicacion">Cantidad</label>
            <input type="number" class="form-control clear_i" id="cantidad_ind">
        </div>

        <div class="form-group col-md-6">
            <label for="ubicacion">$ Costo unitario</label>
            <input type="number" class="form-control clear_i" id="costo_ind_unit">
        </div>

        <div class="form-group col-md-6">
            <label for="ubicacion">P. venta(Unidad)</label>
            <input type="number" class="form-control clear_i" id="pventa_ind">
        </div>

      </div><!--Form row-->
      </div>
      <input type="hidden" id="id-envio-ind">
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" onClick="envioBodegaIndividual();"><i class="fas fa-dolly"></i> Enviar a bodega</button>
      </div>

      </div>
  </div>
</div>

<!--MODAL RESUMEN INGRESOS BODEGA -->

<div class="modal" id="ingresos-bodega-grupal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ingresos a bodega</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-striped" width="100%" style="text-align: center">
          <thead>
          <tr>
            <th>Total Productos</th>
            <th>Total Costos</th>
            <th>Total P. Venta</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><span id="tot-prod-grup"></span></th>
            <td><span id="costos-grup"></span></td>
            <td><span id="pventa-grup"></span></td>
          </tr>
          <tr>
        </tbody>
      </table>


     <input type="hidden" value="bodega-cental" id="ubicacion_ind_grup">

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-block" data-dismiss="modal" onClick="ingresosGrupal()"><span class="material-symbols-outlined">add_home</span></button>
      </div>

    </div>
  </div>
</div>

<!--MODAL RESUMEN INGRESOS BODEGA -->

<input type="hidden" id="usuario" value="<?php echo $_SESSION["usuario"];?>">
<input type="hidden" id="sucursal" value="Bodega Central">
<input type="hidden" id="idx-prod">




</div><!-- /.wrapper -->
<?php require_once("footer.php"); ?>
<script src='js/bootbox.min.js'></script>
<script src='js/productos.js'></script>
<script src='js/marca.js'></script>
<script src='js/bodegas.js'></script>
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

   $('#lista-aros-sel').bootstrapDualListbox()
  
    })

    function EnterEvent() {
        if (event.keyCode == 13) {
            guardarMarca();
        }
    }
    window.onkeydown = EnterEvent;
    var medidas = new Cleave('#medidas_aro', {
    delimiter: '-',
    blocks: [2,2,3],
    uppercase: true
});
</script>
<?php } else{
  echo "Acceso no permitido";
  header("Location:index.php");
        exit();
  } ?>