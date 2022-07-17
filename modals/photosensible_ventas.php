<style>
    #tamModal_photosensible_v{
      max-width: 60% !important;
    }

    .input-dark{
      border: solid 1px black;
      border-radius: 0px;
    }
    .input-dark{
      border: solid 1px black;
    }
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="listar_photo_ventas" style="border-radius:0px !important;">
  <div class="modal-dialog  modal-dialog-centered" role="document" id="tamModal_photosensible_v">

    <div class="modal-content">
     <div class="modal-header bg-info" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> SELECCIONAR PHOTOSENSIBLES</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

          <div class="card-body p-0" style="margin:7px">
            <table id="lista_photo_ventas_data" width="100%" class = "table-hover table-bordered table-striped">
              <thead style="background:#034f84;color:white;text-align:center;">
                <tr>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Agregar</th> 
                </tr>
              </thead>
              <tbody style="text-align:center;font-size:14px;">                                  
              </tbody>
            </table>
          </div>
    </div><!--Fin modal Content-->

  </div>
</div>
