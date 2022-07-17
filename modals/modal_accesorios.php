<style>
    #tamModal_acc{
      max-width: 60% !important;
    }
    #modalAccesorios{
      align-items:center;
      justify-content:center;
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
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAccesorios" style="border-radius:0px !important;">
  <div class="modal-dialog  modal-dialog-centered" role="document" id="tamModal_acc">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> Agregar Accesorios a Compra</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

              <div class="card-body p-0" style="margin:7px">
                <table class="table-hover table-bordered" id="data_acc_compras" width="100%" cellspacing="0">
                  <thead style="background:#034f84;color:white">
                    <tr>
                      <th style="text-align:center">Marca</th>
                      <th style="text-align:center">Código</th>
                      <th style="text-align:center">Tipo Accesorio</th>
                      <th style="text-align:center">Descripción</th>
                      <th style="text-align:center">Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;font-size:14px;">
                                        
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
  
    </div><!--Fin modal Content-->

  </div>
</div>
