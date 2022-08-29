<style>
    #tamModal_det_abonos{
      max-width: 80% !important;
    }
     #head_det_abonos{
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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detalle_abonos" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal_det_abonos">

    <div class="modal-content">
     <div class="modal-header bg-secondary" id="head_det_abonos" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> DETALLE DE ABONOS</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

          <div class="card-body p-0" style="margin:7px">

            <table class="table table-bordered table-sm">
              <thead style="text-align: center" class="bg-info">
                <tr>
                  <th style="text-align:center">PACIENTE</th>
                  <th style="text-align:center">MONTO DEL CREDITO</th>
                  <th style="text-align:center">TOTAL ABONADO</th>
                  <th style="text-align:center">SALDO</th>
                </tr>
              </thead>
              <tbody style="text-align: :center">
                <tr>
                  <td style="text-align:center"><span id="paciente_det_abono"></span></td>
                  <td style="text-align:center">$<span id="monto_det_abono"></span></td>
                  <td style="text-align:center">$<span id="total_abonado"></span></td>
                  <td style="text-align:center">$<span id="saldo_det_abono"></span></td>
                </tr>      
              </tbody>
            </table><br>

            <table id="lista_det_abonos" width="100%" class ="table-hover table-bordered">
              <thead style="background:#034f84;color:white;text-align: center;font-size: 14px;font-family: Helvetica, Arial, sans-serif;">
                <tr>
                <th>Fecha Abono</th>
                <th>Paciente</th>
                <th>Empresa</th>
                <th>Recibió</th>
                <th>Sucursal</th>
                <th>No. Recibo</th>
                <th>Forma de abono</th>
                <th>Monto</th> 
                </tr>
              </thead>
              <tbody style="text-align:center;font-size: 12px;font-family: Helvetica, Arial, sans-serif;">                                  
              </tbody>
            </table>
          </div>
    </div><!--Fin modal Content-->

  </div>
</div>
