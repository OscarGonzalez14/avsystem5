<style>
    #c_calidad_tam{
      max-width: 60% !important;
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
    .checks{
      text-align: left;
      margin-left: 8px;
    }
</style>
<div class="modal fade bd-example-modal-xl" id="cantrol_calidad_ord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" id="c_calidad_tam">
    <div class="modal-content">
      <div class="modal-header" id="c_calidad">
        <h5 class="modal-title" id="exampleModalLongTitle">CONTROL DE CALIDAD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table width="100%" class="table-hover table-bordered display nowrap"> 
         <thead>
           <th colspan="25" class="ord_1">ESTADO VARILLAS</th>
           <th colspan="25" class="ord_1">ESTADO FRENTE</th>
           <th colspan="25" class="ord_1">CODOS Y FLEX</th>
           <th colspan="25" class="ord_1">GRADUACIONES</th>
         </thead>
         
         <tr>
           <td colspan="25" style="text-align: left;margin-left: 8px" class="ord_2 checks"> 
              <input type="radio" id="estado_var" name="estado_var" value="Bueno" class="checks checkados" checked>
              <label for="male">Bueno</label><br>
              <input type="radio" name="estado_var" value="Malo" class="checks estados_malo_ord" >
              <label for="female">Malo</label><br>
            </td>
           <td colspan="25" class="ord_2 checks">
             <input type="radio" name="estado_frente" value="Bueno" class="checks checkados" checked>
              <label for="male">Bueno</label><br>
              <input type="radio" name="estado_frente" value="Malo" class="checks" class="estados_malo_ord">
              <label for="female">Malo</label><br>
           </td>

           <td colspan="25" class="ord_2 checks">
             <input type="radio" name="estado_codos" value="Bueno" class="checks checkados" checked>
              <label for="male">Bueno</label><br>
              <input type="radio" name="estado_codos" value="Malo" class="checks" class="estados_malo_ord">
              <label for="female">Malo</label><br>
           </td>
           <td colspan="25" class="ord_2 checks">
             <input type="radio" name="estado_graduaciones" value="Correctas" class="checks checkados" checked>
              <label for="male">Bueno</label><br>
              <input type="radio" name="estado_graduaciones" value="Incorrectas" class="checks" class="estados_malo_ord">
              <label for="female">Malo</label><br>
           </td>
         </tr>
         <tr>
          <thead>
            <th colspan="100" class="ord_1">KIT DE LIMPIEZA Y ACCESORIOS</th>
          </thead>
           <td colspan="100">
              <input type="checkbox" name="productos_orden" value="Estuche" class="check_producto">
              <label for="male">Estuche</label>
              <input type="checkbox" name="productos_orden" value="Spray" class="check_producto">
              <label for="male">Spray</label>
              <input type="checkbox" name="productos_orden" value="Franela" class="check_producto">
              <label for="male">Franela</label>
              <input type="checkbox" name="productos_orden" value="Bolsita" class="check_producto">
              <label for="male">Bolsita</label>
              <input type="checkbox" name="productos_orden" value="Regalía" class="check_producto">
              <label for="male">Regalias</label>
           </td>
         </tr>
       </table>
       <div style="margin:5px" id="observaciones_ca">
          <label for="exampleFormControlTextarea1">OBSERVACIONES</label>
           <textarea class="form-control control_c_clear" id="observaciones_control_ca" rows="3"></textarea>
       </div>
      </div><!--Fin Modal body-->
      <input type="hidden" id="id_paciente_ca">
      <input type="hidden" id="numero_orden_ca">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  onClick="rechazar_orden();">Rechazar</button>
        <button type="button" class="btn btn-primary" onClick="aprobar_orden_laboratorio();">Aprobar</button>
      </div>
    </div>
  </div>
</div>