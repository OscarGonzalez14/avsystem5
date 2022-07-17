<style>
.modal-header{
  background-color:black;
  color:white;
}


/*.modal-body{
  overflow-y: auto;
}*/

</style>

<!-- The Modal -->
  <div id="modal_ingreso_bodega" class="modal fade" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog" style="max-width:95%">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-dark">
          <span class="modal-title"><strong> Ingresar Productos a Bodega</strong></span>
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <button type="button" class="btn btn-sm btn-outline-secondary btn-flat" data-toggle="modal" data-target="#nuevo_aro" data-backdrop="static" data-keyboard="false" onClick="cargar_marca()"><i class="fas fa-plus"></i> Nuevo Aro</button>

        <button class="btn btn-sm btn-outline-success btn-flat float-right" style="margin:2px" data-toggle="modal" data-target="#" onClick="agregarStockGrupal();"><i class="fas fa-box"></i> Agregar todos</button>     

        <div class="row">
          <div class="col-sm-7 select2-primary">
            <label for="sel1">Seleccionar aro:</label>
            <select class="form-control select2" name="" id="aros-list" multiple="multiple"
                 data-dropdown-css-class="select2-purple" clear_i></select>
           </div>
          <div class="col-sm-3">
         
          </div>
          <div class="col-sm-2">

          </div>
        </div>
        <br>
        <table width="100%" class="table-hover table-bordered">
        <thead style="color:white;font-family: Helvetica, Arial, sans-serif;font-size: 13px;text-align: center" class='bg-info'>
          <tr>
          <th style="width:5%">#</th>
          <th style="width:10%"><input type="checkbox" id="select-all-bod-chk" class="form-check-label" onClick="selectOrdenesEnviar(this.id)"> Selecc.</label></th>
          <th style="width:45%">Descripcion</th>
          <th style="width:8%">Costo U.</th>
          <th style="width:8%">P. venta U.</th>
          <th style="width:8%">Cantidad</th>
          <th style="width:8%">Quitar</th>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;" id="ingreso-grupal-temp">                                  
        </tbody>
        </table>
      </div>               
      </div>
    </div>
    
  </div>
