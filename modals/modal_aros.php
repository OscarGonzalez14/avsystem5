<style>
    #modalAros{
      align-items:center;
      justify-content:center;
      }
    #tamModal_aros{
      max-width:60% !important;
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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAros" style="border-radius:0px !important;">
  <div class="modal-dialog  modal-dialog-centered" role="document" id="tamModal_aros">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> Agregar Aros</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
          <span aria-hidden="true">&times;</span>
     </div>

              <div class="card-body p-0" style="margin:7px">
                <table class="table-hover table-bordered display nowrap" id="data_aros" style="cursor:pointer;" width="100%" cellspacing="0" data-order='[[0,"desc"]]'>
                  <thead style="background:#034f84;color:white">
                    <tr>
                      <th style="text-align:center">ID</th>
                      <th style="text-align:center">Marca</th>
                      <th style="text-align:center">Modelo</th>
                      <th style="text-align:center">Color</th>
                      <th style="text-align:center">Medidas</th>
                      <th style="text-align:center">Diseño</th>
                      <th style="text-align:center">Materiales</th>
                      <th style="text-align:center">Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center; font-size:14px;">
                                        
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
  
    </div><!--Fin modal Content-->

  </div>
</div>
