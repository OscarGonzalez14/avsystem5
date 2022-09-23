<style>
    #tamModal_servicio{
      max-width: 65% !important;
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
     /* height: 45vh;*/
      display: flex;
      align-items: center;
}
</style>


<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="listar_servicios_ventas" style="border-radius:0px !important;">
  <div class="modal-dialog  modal-dialog-centered" role="document" id="tamModal_servicio">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> SELECCIONAR SERVICIO</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

          <div class="card-body p-0" style="margin:7px">
            <table id="lista_servicios_ventas_data" width="100%" class = "table-hover table-bordered table-striped">
              <thead style="background:#034f84;color:white;text-align: center;">
                <tr>
                <th style="text-align:center" width="5%">ID</th>
                <th style="text-align:center" width="70%">Servicio</th>
                <th style="text-align:center" width="20%">Precio</th>
                <th style="text-align:center" width="5%">Agregar</th> 
                </tr>
              </thead>
              <tbody style="text-align:center;font-size:14px;">                                  
              </tbody>
            </table>
          </div>
    </div><!--Fin modal Content-->

  </div>
</div>
