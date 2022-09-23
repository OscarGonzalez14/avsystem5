<style>
    #tamModal_det_abonos{
      max-width: 70% !important;
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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="info_pac_mora" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal_det_abonos">

    <div class="modal-content">
     <div class="modal-header bg-secondary" id="head_det_abonos" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> DATOS DE PACIENTE Y CREDITO</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

          <div class="card-body p-0" style="margin:7px">

            <table class="table table-bordered table-sm">
              <thead style="text-align: center" class="bg-info">
                <tr>
                  <th style="text-align:center">ENCARGADO DE CUENTA</th>
                  <th style="text-align:center">TELEFONO</th>
                  <th style="text-align:center">EMPRESA</th>
                  <th style="text-align:center">DIRECCION</th>
                </tr>
              </thead>
              <tbody style="text-align: :center">
                <tr>
                  <td style="text-align:center;text-transform: capitalize"><span id="paciente_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="tel_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="empresa_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="dir_credito_mora"></span></td>
                </tr>      
              </tbody>
            </table>
            <br>
            <table class="table table-bordered table-sm">
              <thead style="text-align: center" class="bg-primary">
                <tr>
                  <th style="text-align:center">EVALUADO</th>
                  <th style="text-align:center">FECHA VENTA</th>
                  <th style="text-align:center">ASESOR</th>
                  <th style="text-align:center">TIPO VENTA</th>
                  <th style="text-align:center">TIPO PAGO</th>

                </tr>
              </thead>
              <tbody style="text-align: :center">
                <tr>
                  <td style="text-align:center;text-transform: capitalize"><span id="evaluado_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="fecha_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="asesor_credito_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="tipo_venta_mora"></span></td>
                  <td style="text-align:center;text-transform: capitalize"><span id="tipo_pago_mora"></span></td>

                </tr>      
              </tbody>
            </table>
          </div>
    </div><!--Fin modal Content-->

  </div>
</div>
