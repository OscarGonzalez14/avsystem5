<!-- IMPRIMIR FACTURA-->
<div class="modal fade" id="print_invoices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body" style="color: #ff6500;display: block;margin-left: auto;margin-right: auto;">
        <div>
          <i class="fas fa-exclamation-triangle fa-2x" style="color: #ff6500;text-align: center;"></i> <span style="font-size: 30px;color: #404040;font-family: font-family: Helvetica, Arial, sans-serif;"><b>Correlativo</span> <span style="font-size: 30px;color: red;font-family: font-family: Helvetica, Arial, sans-serif;"><span style="color: red" id="correlativo_factura"></span></span></b><br>
        </div>
      </div>
      <input type="hidden" name="" id="n_venta_factura">
      <input type="hidden" name="" id="id_paciente_venta_factura">
      <div class="modal-footer">
        <?php
         if ($level_user=="Admin") {
         echo '<a id="empty_invoice_print" target="_blank" href=""><button type="button" class="btn btn-warning btn-block" style="border: solid black 1px" id="">Formato en blanco</button></a>';
         }
         ?>        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="link_invoice_print" target="_blank" href=""><button type="button" class="btn btn-primary" onClick="registrar_impresion();">Imprimir</button></a>
      </div>
    </div>
  </div>
</div>