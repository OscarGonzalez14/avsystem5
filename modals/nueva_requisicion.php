      <div class="modal fade" id="nueva_requisicion">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-info" style="color:white">
              <h4 class="modal-title">NUEVA REQUISICIÓN&nbsp;&nbsp;#<span id="n_requisicion"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4" style="display: flex;align-items: left;background:white;border:solid 1px white"><input type="text" readonly value="<?php echo $hoy;?>" class="form-control" id="fecha_requi"></div>
                </div>

            <div class="form-row" autocomplete="on">

              <div class="form-group col-md-8">
                <label for="inputPassword4">Descripción</label>
                <input type="text" class="form-control" id="desc_requi" required="" >
              </div>

              <div class="form-group col-md-2">
                <label for="inputPassword4">Cantidad</label>
                <input type="number" class="form-control" id="cant_requi" required="" >
              </div>


              <div class="form-group col-md-2">
                <label for="inputPassword4">Agregar</label>
                <button class="btn btn-success btn-block" onClick="agregar_item_requi();"><i class="fas fa-plus"></i></button>
              </div>

            </div>

            <!--SECTION TABLA DE ITEM REQUISICION-->
            <div class="card-body p-0" style="margin:7px">
            <table id="lista_aros_ventas_data" width="100%" class="table-hover table-bordered">
              <thead style="background:#034f84;color:white;text-align: center;">
                <tr>
                <th>#</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Quitar</th>
                </tr>
              </thead>
              <tbody style="text-align:center" id="listar_det_items_requisicion">                                  
              </tbody>
            </table>
          </div>

          <!-- FIN SECTION TABLA DE ITEM REQUISICION-->

           </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onClick="registrar_requisicion();"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar Solicitud</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>