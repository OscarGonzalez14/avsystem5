      <div class="modal fade" id="accion_req_admin">
        <div class="modal-dialog modal-xl">
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
                <th style="width: 5%"></th>
                <th style="width: 75% !important">Descripcion</th>
                <th style="width: 5% !important">Cantidad</th>
                </tr>
              </thead>
              <tbody style="text-align:center" id="det_items_requisicion_admin">                                  
              </tbody>
            </table>
          </div>

          </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-thumbs-o-down" aria-hidden="true"></i> DENEGAR</button>
              <button type="button" class="btn btn-success" onClick="aprobar_requisicion();"><i class="fas fa-thumbs-o-up" aria-hidden="true"></i> APROBAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>