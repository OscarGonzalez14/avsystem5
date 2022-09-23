      <div class="modal fade" id="modal_estado_uno">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-info" style="color:white">
              <h4 class="modal-title">REQUISICIÓN&nbsp;&nbsp;#<span id="n_requisicion" class="n_requisicion"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_items_req();">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="card-body p-0 table-responsive" style="margin:1px">
            <table id="lista_aros_ventas_data" width="100%" class="table-hover table-bordered">
              <thead style="background:#034f84;color:white;text-align: center;">
                <tr>
                  <th style="width: 75% !important">Descripcion</th>
                  <th style="width: 10% !important">Cantidad</th>
                  <th style="width: 15%">Estado</th>
                </tr>
              </thead>
              <tbody style="text-align:center" id="det_modal_aprobada">                                  
              </tbody>
            </table>
          </div>

            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clear_items_req();"> CANCELAR</button>
              <button type="button" class="btn btn-success" onClick="aceptar_requisicion();"><i class="fas fa-thumbs-o-up" aria-hidden="true"></i> ACEPTAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>