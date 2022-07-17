  <style >
    #tanModal{
      max-width: 30% !important;
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
    .modal-dialog {
      height: 75vh;
      display: flex;
      align-items: center;
    }
    
  </style>
  <!-- The Modal marca -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id=edit_marca style="border-radius:0px !important;">
    <div class="modal-dialog modal-lg" id="tanModal">
      <!-- cabecera de la modal-->
      <div class="modal-content" >
        <div class="modal-header" id="head" style="justify-content: space-between">
          <span><i class="fas fa-plus-square"></i> EDITAR MARCA</span>
          <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row" autocomplete="on">
            <div class="form-group col-md-12">
              <input type="text"  class="form-control" name="" placeholder="Ingrese marca" required="" id="marca_edit" onkeyup="mayus(this);">
            </div>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" style="border-radius:0px" onClick="guardarMarcaEdit();" ><i class="fas fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
