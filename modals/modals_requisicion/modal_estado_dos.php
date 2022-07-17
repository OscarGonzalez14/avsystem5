      <div class="modal fade" id="modal_estado_dos">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-info" style="color:white">
              <h4 class="modal-title">REQUISICIÓN&nbsp;&nbsp;#<span id="n_requisicion" class="n_requisicion"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_items_req();">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="card-body p-0" style="margin:1px">
            <table id="lista_aros_ventas_data" width="100%" class="table-hover table-bordered">
              <thead style="background:#034f84;color:white;text-align: center;">
                <tr>
                  <th style="width: 60% !important" colspan="60">Descripcion</th>
                  <th style="width: 10% !important" colspan="10">Cantidad</th>
                  <th style="width: 10% !important" colspan="10">Precio</th>
                  <th style="width: 20% !important" colspan="20">#Ticket</th>
                </tr>
              </thead>
              <tbody style="text-align:center" id="det_modal_aceptada">                                  
              </tbody>
              <tfoot>
                <tr>
                  <th style="width: 70% !important;text-align: center" colspan="70">Total</th>
                  <th style="width: 10%" colspan="10"><span>$</span><span id="total_caja"></span></th>
                  <th style="width: 20%" colspan="20"></th>
                </tr>
              </tfoot>
            </table>
          </div>

            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clear_items_req();"> CANCELAR</button>
              <button type="button" class="btn btn-danger" onClick="finalizar_requisicion();"><i class="fas fa-thumbs-o-up" aria-hidden="true"></i> FINALIZAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>