  <style>
    #cat_tamano{
      max-width: 85% !important;
      margin: auto;
    }

    .modal-dialog{
      margin: auto;
    }

}
</style>
  <!-- The Modal -->
  <!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="modal_pacientes_consulta">
  <div class="modal-dialog" id="cat_tamano">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-primary" id="head" style="justify-content:space-between;text-align: center">
       <span> PACIENTES CON CONSULTAS</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="card-body p-0" style="margin:7px">
          <table class="table-hover table-bordered" id="data_pacientes_consulta" width="100%" data-order='[[ 0, "desc" ]]'>
            <thead style="background:#034f84;color:white">
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Encargado de Cuenta</th>
                <th style="text-align:center">Fecha_consulta</th>
                <th style="text-align:center">Paciente Evaluado</th>
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