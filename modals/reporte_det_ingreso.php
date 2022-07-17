<style>
    #tamModal_ultima_c_admin{
      max-width: 80% !important;
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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_det_ingresos" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal_ultima_c_admin">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> DETALLES DE INGRESO A BODEGA</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

              <div class="card-body p-0" style="margin:7px">
                <table class="table" id="reporte_ingresos_bodega" width="100%">
                  <thead style="background:#034f84;color:white">
                    <tr>
                      <th style="text-align:center">Fecha</th>
                      <th style="text-align:center">ID ingreso</th>
                      <th style="text-align:center">#Compra</th>
                      <th style="text-align:center">User</th>
                      <th style="text-align:center">Producto</th>
                      <th style="text-align:center">Cant.</th>
                      <th style="text-align:center">Sucursal</th>
                      <th style="text-align:center">Destino</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center">                                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
  
    </div><!--Fin modal Content-->

  </div>
</div>
