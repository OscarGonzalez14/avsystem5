  <style >

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
  <!-- The Modal marca -->
  <div class="modal fade bd-example" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="newMarca" style="border-radius:0px !important;">
    <div class="modal-dialog modal-md" id="tanModal">
      <!-- cabecera de la modal-->
      <div class="modal-content" >
        <div class="modal-header" style="justify-content: space-between;background: black;color:white">
          <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row" autocomplete="on">
            <div class="form-group col-md-12">
              <input type="text"  class="form-control" name="" placeholder="Ingrese marca" required="" id="marca" onkeyup="mayus(this);" placeholder="Nombre marca">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
