<?php
require_once('modelos/Externos.php');
$marca = new Externos();
$marcas=$marca->get_marca();
?>
 <style>
    #tamModal{
      width: 75% !important;
    }
     #head{
        background-color: black;
        color: white;
        text-align: center;
    }

    .input-dark{
      border: solid 1px black;
      border-radius: 0px;
    }

    .input-dark{
      border: solid 1px black;
    }

</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="edit_aro" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> EDITAR ARO</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
     <div id="resultados_ajax"></div>
<section style="margin:15px">
  <div class="form-row" autocomplete="off">

    <div class="form-group col-md-4">
      <label for="exampleFormControlSelect2">Marca</label>
      <select class="form-control input-dark" id="marca_aros_edit">
       <option value="">Seleccione marca</option>
      <?php 
      for ($i=0; $i < sizeof($marcas); $i++) {  ?>
        <option value="<?php echo($marcas[$i]["marca"]) ?>"><?php echo $marcas[$i]["marca"]?></option>
        <?php } ?>

     </select>
      </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Modelo</label>
      <input type="text" class="form-control input-dark" id="modelo_aro_edit" placeholder="Escriba el Modelo" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Color</label>
      <input type="text" class="form-control input-dark" id="color_aro_edit" placeholder="Escriba el color" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-3">
      <label for="inputEmail4">Medidas</label>
      <input type="text" class="form-control input-dark" id="medidas_aro_edit" placeholder="Medidas" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">Diseño</label>
      <select class="form-control input-dark" id="diseno_aro_edit" required="">
        <option value="">Seleccionar Diseño</option>
        <option value="Completo">Completo</option>
        <option value="Semi-Aereo">Semi Aereo</option>
        <option value="Aereo">Aereo</option>
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">Materiales</label>
      <select class="form-control input-dark" id="materiales_aro_edit" required="">
        <option value="">Seleccionar Material</option>
        <option value="Metal">Metal</option>
        <option value="Acetato">Acetato</option>
        <option value="Metal/Acetato">Metal/Acetato</option>
        <option value="Fibra de Carbono">Fibra de Carbono</option>
        <option value="Titanio">Titanio</option>
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="exampleFormControlSelect2">Categoría</label>
      <select id="cat_venta_aros_edit" class="form-control input-dark" required="">
        <option value='Básico'>Básico</option>
        <option value='Intermedio'>Intermedio</option>
        <option value='Premium'>Premium</option>
      </select>
    </div>
  </div>
<input type="hidden" id="categoria_producto_edit" value="aros"/>
<input type="hidden" id="id_producto_edit">
<button class="btn btn-primary btn-block" style="border-radius:0px" onClick="editar_aro();"><i class="fas fa-save"></i> Guardar</button>
</section>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript">
  function mayus(e) {
       e.value = e.value.toUpperCase();
  }

  var medidas = new Cleave('#medidas_aro', {
    delimiter: '-',
    blocks: [2,2,3],
    uppercase: true
});
</script>
