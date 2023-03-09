
 <?php
 require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("modelos/Reporteria.php");
$alerts = new Reporteria();
$ganadores=$alerts->count_ganadores();

require_once("modelos/Externos.php");
$users = new Externos();
$opto = $users->get_usuarios();

require_once("header_dos.php");
require_once("modals/nuevo_paciente.php");
require_once("modals/modal_consultas.php");
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="margin-top: 5px">
    <input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>

    <div class="card">    
    <div class="card-body"><!--CONTENIDO-->
    <button class="btn-mds mds-primary" data-toggle="modal" data-target="#newPaciente" onClick="clear_campos();"><i class='fas fa-user'></i> Nuevo Paciente</button>
    <a href="consultas.php"><button class="btn-mds mds-success"><i class='fas fa-clipboard-list'></i> Consultas</button></a>
    <div class="invoice p-3 mb-3" style="margin: 3px;border-radius: 5px">
      
      <table id="data_pacientes" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered">
        <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 13px" class="bg-dark">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 13px">
            <th style="text-align:center">ID</th>
            <th style="text-align:center">Paciente</th>
            <th style="text-align:center">Edad</th>
            <th style="text-align:center">Telefono</th>
            <th style="text-align:center">Consulta</th>
            <th style="text-align:center">Editar</th>
            <th style="text-align:center">Eliminar</th>
            <th style="text-align:center">Información</th>
            <th style="text-align:center">Referidos</th>
          </tr>
        </thead>
        <tbody style="text-align:center;color: black;font-size: 12px">                                        
        </tbody>
      </table>  
     </div>     
         
</div><!-- /.content-wrapper -->
 <!-- Modal de empresas-->
<div id="empresasModal" class="modal fade" data-modal-index="2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <span class="modal-title">SELECCIONAR EMPRESA</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: white;color:black">
              <div class="card-body p-0" style="margin:1px">
                <table id="lista_pacientes_data_emp" width="100%">
                  <thead class="bg-secondary">
                    <tr>
                    <th>Codigo</th>          
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center">                                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
</div>

<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="id_usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="MODULO PACIENTES & CONSULTAS">

<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/consultas.js"></script>

<script type="text/javascript" src="js/bootbox.min.js"></script>
  <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+
    title;
  </script>
            </div><!-- FIN CONTENIDO-->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
        $(".select2").select2({
    maximumSelectionLength: 1
   });

    //Initialize Select2 Elements
    $('#patologias').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $("#patologias").select2({
    maximumSelectionLength: 4
   });
      })
</script>  
<script>

function mayus(e) {
    e.value = e.value.toUpperCase();
}

var medidas = new Cleave('#dui', {
    delimiter: '-',
    blocks: [8,1],
    uppercase: true
});

var nit = new Cleave('#nit', {
    delimiter: '-',
    blocks: [4,6,3,1],
    uppercase: true
});

var tel_oficina = new Cleave('#tel_oficina', {
    delimiter: '-',
    blocks: [4,4],
    uppercase: true,
    //numeral: true
});

var telefono = new Cleave('#telefono', {
    delimiter: '-',
    blocks: [4,4],
    uppercase: true
});
</script>


<script>
    $(function(){
      $('.btn[data-toggle=modal]').on('click', function(){
        var $btn = $(this);
        var currentDialog = $btn.closest('.modal-dialog'),
        targetDialog = $($btn.attr('data-target'));;
        if (!currentDialog.length)
          return;
        targetDialog.data('previous-dialog', currentDialog);
        currentDialog.addClass('aside');
        var stackedDialogCount = $('.modal.in .modal-dialog.aside').length;
        if (stackedDialogCount <= 5){
          currentDialog.addClass('aside-' + stackedDialogCount);
        }
      });

      $('.modal').on('hide.bs.modal', function(){
        var $dialog = $(this);  
        var previousDialog = $dialog.data('previous-dialog');
        if (previousDialog){
          previousDialog.removeClass('aside');
          $dialog.data('previous-dialog', undefined);
        }
      });
    })
  </script>
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script type="text/javascript">
  $(function () {
      $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
   })

  const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 3000
  });
</script>
   <?php } else{
echo "Acceso denegado";
  } ?>
