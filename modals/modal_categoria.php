  <style>
    #cat_tamano{
      max-width: 65% !important;
      margin: auto;
    }

    .modal-dialog{
      margin: auto;
    }

}
</style>
  <!-- The Modal -->
  <!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="modal_categoria">
  <div class="modal-dialog" id="cat_tamano">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-info" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> CREAR NUEVA CATEGORÍA</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nombre</label>
            <input type="text" class="form-control" name="" placeholder=" Ingrese categoría" id="cat_nombre">       
          </div>


        <div class="form-group col-md-6">
          <label>Seleccionar Sucursal</label>
          <select name="Sucursal" class="form-control" id="cat_sucursal">
            <option>Santa Ana</option>
            <option>Metrocentro</option>
            <option>San Miguel</option>                
          </select>         
        </div>
        <div class="form-group col-md-4">
          <label>Tipo categoría</label>
          <select name="tipo_categoria" class="form-control" id="tipo_categoria">
            <option value="0">Seleccione Tipo</option>
            <option value="gaveta">Gaveta</option>
            <option value="exhibicion">Exhibición</option>
            <option value="maletas">Maletas</option>                
          </select>         
        </div>
        <div class="form-group col-md-8">
          <label>Descripción</label>
          <input type="text" class="form-control" name="" placeholder="Descripción de categoría" id="cat_descripcion">
        </div>

      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-block" data-dismiss="modal" onClick="guardarCategoria();">Guardar categoría</button>
      </div>

    </div>
  </div>
</div>