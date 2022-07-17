  <style>
    #pac_tamano{
      max-width: 65% !important;
      margin: auto;
    }
    #head_pac{
      background-color:#034f84;
      color: white;
    }
    html{ 
    overflow: scroll; 
    -webkit-overflow-scrolling: touch;
  }
</style>      

      <div class="modal fade bd-example-modal-lg" role="dialog" id="newPaciente">
        <div class="modal-dialog" id="pac_tamano">
          <div class="modal-content">
            <div class="modal-header" id="head_pac">
              <h5 class="modal-title">CREAR NUEVO PACIENTE</h5>
              <button type="button" class="close justify-content-between" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row">

                 <input type="hidden" class="form-control" id="codigo_paciente" name="codigo_paciente" value="" >              

                <div class="col-sm-7">
                  <label for="ex1">Nombre<span style="color:red">*</span></label>
                  <input class="form-control" id="nombres" name="nombres" type="text" placeholder="Escriba el Nombre del paciente"  required onkeyup="mayus(this);">      
                </div>

                <div class="col-sm-2">
                  <label for="ex3">Edad</label>
                  <input class="form-control" id="edad" type="number" name="edad" placeholder="edad" required pattern='^[0-9]+'>
                </div>
                
                <div class="col-sm-3">
                  <label for="ex2">Teléfono<span style="visibility: hidden;color: red" id="label_telefono">*</span></label>
                  <input class="form-control" id="telefono" type="text" name="telefono" required pattern='^[0-9]+'>
                </div>                
            </div>
            <span style="color: red">**LLenar si paciente es empresarial </span>
            <div class="form-group row">

              <div class="form-group col-md-7">
                  <label for="inputPassword4">Departamento</label>
                  <input type="text" class="form-control input-dark" id="departamento_paciente" onkeyup="mayus(this);" >
               </div>

              <div class="form-group col-md-5">
             <label for="inputEmail4">#Cod. Empleado</label>
              <input type="text" class="form-control input-dark" id="codigo_emp" placeholder="Código de empleado" required="" onkeyup="mayus(this);" >
              </div> 

            </div><!--Fin form-group-->
              
            </div>
            <input id="id_paciente" type="hidden">
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" onClick="save_paciente();" id="save_paciente"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>Guardar</button>
              <button class="btn btn-primary btn-block" onClick="save_paciente();" id="edit_paci">Editar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->