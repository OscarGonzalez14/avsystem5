   <style>
    #tamModal_cat{
      max-width: 65% !important;
    }
     #head_cat{
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

    .modal-dialog {
      height: 75vh;
      display: flex;
      align-items: center;
}
</style>
  <!-- The Modal -->
  <div class="modal fade bd-example-modal-lg" id="modal_cats">
    <div class="modal-dialog" id="tamModal_cat">
      <div class="modal-content">
<!-- Modal Header -->
        <div class="modal-header" id="head_cat">
          <span><i class="fas fa-plus-square"></i> CREAR CATEGORÍA</span>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

       		<div class="form-row">

       			<div class="form-group col-md-6">
       				<label>Nombre</label>
       				<input type="text" class="form-control" name="" placeholder=" Ingrese categoría" id="cat_nombre" onkeyup="mayus(this);">  				
       			</div>
        <div class="form-group col-md-6">
          <label>Seleccionar Sucursal</label>
          <select name="Sucursal" class="form-control" id="cat_sucursal">
            <option value="">Seleccione...</option>
            <option value="Santa Ana">Santa Ana</option>
            <option value="Metrocentro">Metrocentro</option>
            <option value="San Miguel">San Miguel</option>                
          </select>         
        </div>

            <div class="form-group col-md-4">
              <label>Tipo Categoria</label>
              <select id="tipo_categoria" class="form-control">
                <option value="">Seleccione...</option>
                <option value="Gaveta">Gaveta</option>
                <option value="Exhibición">Exhibición</option>
                <option value="Maleta">Maleta</option>
                <option value="Accesorios">Accesorios</option>
                <option value="Bandeja">Bandeja</option>
              </select>         
            </div>
       			<div class="form-group col-md-8">
       				<label>Descripción</label>
       				<input type="text" class="form-control" name="" placeholder="Descripción de categoría" id="cat_descripcion" onkeyup="mayus(this);">  				
       			</div>
       			
       		</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" onClick="guardarCategoria();"><i class="fas fa-save"></i> Guardar</button>
        </div>
        
      </div>
    </div>
  </div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>