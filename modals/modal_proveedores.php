 <style>
    #tamModal{
      width: 65% !important;
    }
     #head{
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

    .modal-dialog {
     /* height: 45vh;*/
      display: flex;
      align-items: center;
}
</style>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalProveedores" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i> Proveedores</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>

              <div class="card-body p-0">
                <table class="table" id="data_proveedores" width="100%">
                  <thead style="background:#034f84;color:white">
                    <tr>
                      <th style="text-align:center">Codigo</th>
                      <th style="text-align:center">Nombre Proveedor</th>
                      <th style="text-align:center">Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center">
                                        
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
  
    </div><!--Fin modal Content-->

  </div>
</div>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript">
  function mayus(e) {
       e.value = e.value.toUpperCase();
  }

  var medidas = new Cleave('#medidas_aro', {
    delimiter: '-',
    blocks: [2,2,3],
    uppercase: true
});     
</script>