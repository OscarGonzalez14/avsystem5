   <style>
    #cat_tamano_sc{
      max-width: 45% !important;
      margin: auto;
    }

    .modal-dialog{
      margin: auto;
    }

}
</style>
  <!-- The Modal -->
  <!-- The Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="contribuyente_credito_fiscal">
  <div class="modal-dialog" id="cat_tamano_sc">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-secondary" id="head" style="justify-content:space-between;color:white">
       <span> CONTRIBUYENTES CREDITO FISCAL</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="card-body p-0" style="margin:7px">
          <table class="table-hover" id="data_contribuyentes_fisc" width="100%" data-order='[[ 0, "desc" ]]'>
            <thead style="background:#034f84;color:white">
              <tr>
                <th style="text-align:center">CONTRIBUYENTE</th>
                <th style="text-align:center">EMPRESA</th>
                <th style="text-align:center">NIT</th>
                <th style="text-align:center">AGREGAR</th>
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
