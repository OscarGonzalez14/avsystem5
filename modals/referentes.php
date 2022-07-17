  <style>
    #cat_tamano{
      max-width: 45% !important;
      margin: auto;
    }
    .modal-dialog{
      margin: auto;
    }
}
</style>
<!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="modal_pacientes_refieren">
  <div class="modal-dialog" id="cat_tamano">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-primary" id="head" style="justify-content:space-between;text-align: center">
       <span> AGREGAR REFERENCIA</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div><!-- Modal body -->
      <div class="modal-body">

        <div class="card-body p-0" style="margin:7px">
          <table class="table-hover" id="data_pacientes_refiere" width="100%" data-order='[[ 0, "desc" ]]'>
            <thead style="background:#034f84;color:white">
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Paciente</th>
                <th style="text-align:center">Telefono</th>
                <th style="text-align:center">Sucursal</th>
                <th style="text-align:center">Agregar</th>
              </tr>
            </thead>
            <tbody style="text-align:center">                                  
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
</div>