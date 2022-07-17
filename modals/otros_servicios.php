<style>
  #servicio{
    max-width: 65% !important;
    margin: auto;
  }
  #head{
    background-color: black !important;
    color: white;
    text-align: center;
  }
  .modal-dialog{
    margin: auto;
  }
</style>

<!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="nuevo_servicio">
  <div class="modal-dialog" id="servicio">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-info" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> CREAR NUEVO SERVICIO</span>
       <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body">
       <div class="form-row">
        <div class="form-group col-md-5">
          <label>Tipo Servicio</label>
          <input type="text" class="form-control" name="" placeholder="Servicio" id="tipo_servicio" onkeyup="mayus(this);">
        </div>
        <div class="form-group col-md-5">
          <label>Descripción</label>
          <input type="text" class="form-control" name="" placeholder="Descripción servicio" id="des_servicio" onkeyup="mayus(this);">
        </div>
        <div class="form-group col-md-2">
          <label>Precio $</label>
          <div class="input-group">
            <input type="number" class="form-control" name="precio" placeholder="" id="precio_servicio" >
          </div>
        </div>
        <input type="hidden" name="" id="cat_servicio" value="servicio">
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" onClick="guardarServicio();"><i class="fas fa-save"></i> Guardar</button>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>