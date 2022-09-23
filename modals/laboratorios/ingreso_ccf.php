<style>
    #ccf_tamano{
      max-width: 85% !important;
    }

    .ord_1{
      width: 25%;
      color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      background: #004080;
      width: 25%;
    }
    .ord_2{
      width: 25%;
      color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      width: 25%;
    }     
    .table2 {
       border-collapse: collapse;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       text-align: center;
    }
</style>

<div class="modal fade" id="ingreso_ccf_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="ccf_tamano">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INGRESO DE CREDITOS FÍSCALES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-row">
      <div class="form-group col-md-3">
        <label>Laboratorio</label>
        <input type="text" class="form-control" id="laboratorio_ccf" readonly>
      </div>

      <div class="form-group col-md-5">
        <label>Paciente</label>
        <input type="text" class="form-control" id="evaluado_cff" readonly>
      </div>

      <div class="form-group col-md-2">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha_comproante">
      </div>

      <div class="form-group col-md-2">
        <label>CCF</label>
        <input type="text" class="form-control" id="numero_comprobante">
      </div>   

      </div><!--Fin Form Row-->

      <table class="table-bordered table-hover table2" id="notas_contacto" width="100%">
        <thead style="text-align: center;">
          <th colspan="45" style="width: 45%;text-align: center" class="stilot1">Descripción</th>
          <th colspan="15" style="width: 15%;text-align: center" class="stilot1">Cantidad</th>
          <th colspan="10" style="width: 10%;text-align: center" class="stilot1">Costo</th>
          <th colspan="10" style="width: 10%;text-align: center" class="stilot1">V. Gravadas</th>
          <th colspan="20" style="width: 20%;text-align: center" class="stilot1">13% IVA</th>

        </thead>
         <tbody id="listar_items_ccf" style="text-align: center"></tbody>

           <tr>
             <td colspan="70" style="width: 70%"></td>
             <td colspan="10" style="width: 10%"><b>13% IVA</b></td>
             <td colspan="20" style="width: 20%;text-align: center;"><b><span id="tot_iva"></span></b></td>
           </tr>
           <tr>
             <td colspan="70" style="width: 70%"></td>
             <td colspan="10" style="width: 10%"><b>SUBTOTAL</b></td>
             <td colspan="20" style="width: 20%;text-align: center;"><b><span id="subtotales_ccf"></span></b></td>
           </tr>
           <tr>
             <td colspan="70" style="width: 70%"></td>
             <td colspan="10" style="width: 10%"><b>TOTAL VENTA</b></td>
             <td colspan="20" style="width: 20%;text-align: center;"><b><span id="totales_ccf_orden"></span></b></td>
           </tr>
         </tfoot>
      </table>
      <input type="hidden" id="precio_tratamiento">
      <input type="hidden" id="numero_de_orden">
      <input type="hidden" id="id_envio">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" style="margin: border-radius:0px" onClick="registrar_ccf_laboratorio();">Ingresar CCF</button>
      </div>
    </div>
  </div>
</div>