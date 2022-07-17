<style>
    #anti{
      max-width: 90% !important;
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
<div class="modal fade bd-example-modal-lg" role="dialog" id="nuevo_anti">
  <div class="modal-dialog" id="anti">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-info" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> CREAR NUEVO ANTIREFLEJANTE</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-sm-6">
              <label>Descripción</label>
              <input type="text" class="form-control" name="" placeholder="Descripción del antireflejantes" id="describe_dos" onkeyup="mayus(this);">
          </div>
          <div class="form-group col-sm-3">
            <label>Costo $</label>
              <div class="input-group">
                <input type="number" class="form-control" name="precio" placeholder="" id="costo_anti" >
              </div>
          </div>
          <div class="form-group col-sm-3">
              <label>P.V. $</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="precio" placeholder="" id="precio_anti" >
                </div>
          </div>
          <input type="hidden" name="" id="cat_prod_dos" value="Antireflejante">
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" onClick="guardarAntireflejante();"><i class="fas fa-save"></i>Guardar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>