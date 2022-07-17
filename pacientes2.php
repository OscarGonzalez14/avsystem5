<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once("modals/nuevo_paciente.php");
require_once("modals/modal_consultas.php");
?>
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-8">
            <h5 align="center">MÓDULO PACIENTES</h5>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pacientes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <div class="invoice p-3 mb-3" style="margin: 3px;border-radius: 5px">
     	<div class="row">
     	<div class="col-sm-3">
     	<button type="button" class="btn btn-block btn-outline-primary btn-flat" data-toggle="modal" data-target="#newPaciente" onClick="clear_campos();"><i class="fas fas fa-user-plus"></i> Agregar Paciente</button>
     	</div>

     	<div class="col-sm-3">
     	<a href="consultas.php"><button type="button" class="btn btn-block btn-outline-success btn-flat" data-toggle="modal" data-target="#consultasModal"><i class="fas fa-clipboard-list"></i> Ver Consultas</button></a>
     	</div> 
      </div>
      <div class="dropdown-divider"></div>
      <table id="data_pacientes" width="100%" style="text-align: center;text-align: center" >
      <thead style="color:white;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">
            <th style="text-align:center">Fecha Ingreso</th>
            <th style="text-align:center">Codigo</th>
            <th style="text-align:center">Tipo Pac.</th>
            <th style="text-align:center">Paciente</th>
            <th style="text-align:center">Telefono</th>
            <th style="text-align:center">Consulta</th>
            <th style="text-align:center">Editar</th>
            <th style="text-align:center">Eliminar</th>
            <th style="text-align:center">Información</th>
            <th style="text-align:center">Expediente</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                        
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
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="id_usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="text" id="fecha" value="<?php echo $hoy;?>">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>

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
  <?php } else{
echo "Acceso denegado";
  } ?>