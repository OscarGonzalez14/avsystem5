<style>
    #tamModal_orden_desc{
      max-width: 85% !important;
    }
     #head_oid{
        /*background-color: black;*/
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
    .obs{
      color: red;
    }
    .modal-body{
      max-height: calc(100vh-200px);
      overflow-y: auto;
    }
    .eight h1 {
    color: #003399;
    font-weight: 600;
    text-align:center; 
    text-transform:uppercase;
    font-size:14px; letter-spacing:1px;  
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    grid-template-rows: 16px 0;
    grid-gap: 22px;
  }

  .eight h1:after,.eight h1:before {
   content: "";
   display: block;
   border-bottom: 2px solid #ccc;
   background-color:#f8f8f8;
}
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nueva_orden_lab_dos" style="border-radius:0px !important;">
  <div class="modal-dialog modal-dialog-scrollable" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header bg-info" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i> ORDEN DE LABORATORIO</span>&nbsp;&nbsp;<span id="correlativo_envio_lab"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
  <div class="card card-danger" style="margin-top: 3px">

<div class="eight" style="">
    <strong><h1>DATOS GENERALES</h1></strong>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-7">
      <label for="inlineFormInputGroup">Paciente</label>
      <div class="input-group">
        <input type="text" class="form-control clear_orden_i validate" id="paciente_orden_lab">
      <div class="input-group-prepend" onClick="get_data_orden();">
            <div class="input-group-text"><i class="fas fa-search" style="color: blue"></i></div>
          </div>
      </div>
    </div>

    <div class="form-group col-sm-5">
      <label for="inlineFormInputGroup">Empresa</label>
      <div class="input-group">
        <input type="text" class="form-control clear_orden_i" id="empresa_lab">
      </div>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Laboratorio</label>
      <select class="form-control clear_orden_i validate" id="laboratorio_orden_lab" required>
        <option value="">Seleccionar Laboratorio...</option>
        <option value="Lomed">Lomed</option>
        <option value="Lenti">Lenti</option>
        <option value="Opti Procesos">Opti Procesos</option>
        <option value="PrismaLab">PrismaLab</option>
        <option value="Optiservicios">Optiservicios</option>
        <option value="Alvaro">Alvaro</option>
        <option value="Laboratorios Little">Laboratorios Little</option>
        <option value="Laboratorios Garcia">Laboratorios Garcia</option>
        <option value="Cubas">Cubas</option>
    </select>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Sucursal</label>
      <select class="form-control clear_orden_i validate" id="sucursal_orden_lab" required>
        <option value="">Seleccionar sucursal...</option>
        <option value="Metrocentro">Metrocentro</option>
        <option value="Arce">Arce</option>
    </select>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Proridad</label>
      <select class="form-control clear_orden_i validate" id="prioridad_orden_lab">
        <option value="">Seleccionar Prioridad...</option>
        <option value="5">5 dia (Normal)</option>
        <option value="3">3 dias (Intermedio)</option>
        <option value="2">2 dias (Intermedio)</option>
        <option value="1">1 dias(Urgente)</option>
        <option value="6">6 dias</option>
        <option value="7">7 dias</option>
        <option value="8">8 dias</option>
        <option value="9">9 dias</option>
        <option value="10">10 dias</option>
        <option value="12">12 dias</option>
        <option value="13">13 dias</option>
        <option value="14">14 dias</option>
        <option value="15">15 dias</option>

    </select>
    </div>

</div>
</div><!--fin eigth #1-->

<div class="eight lente">
  <h1>TIPO DE LENTE + TRATAMIENTO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-12">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">LENTE</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i validate" id="lente_orden_lab">
      </div>
    </div>


  </div>
</div>

<div class="eight">
  <h1>ARO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-3">
      <label for="">Marca</label>
      <input type="text" class="form-control clear_orden_i validate" id="marca_aro_lab">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Modelo</label>
      <input type="text" class="form-control clear_orden_i" id="modelo_aro_lab">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Color</label>
      <input type="text" class="form-control clear_orden_i" id="color_aro_lab">
    </div>

    <div class="form-group col-sm-3 select2-purple">
      <label for="">Usuario</label>
      <select class="select2 form-control" id="usuario_orden" multiple="multiple" data-placeholder="Seleccionar usuario" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
      <option value="">Seleccionar usuario</option>
      <?php for ($i=0; $i < sizeof($opto); $i++) { ?>
        <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo strtoupper($opto[$i]["nick"]);?></option>
      <?php  } ?>              
      </select>   
    </div>
  </div>

  <div class="form-group col-sm-12">
    <label for="">Observaciones</label>
    <input type="text" class="form-control clear_orden_i" id="observaciones_orden_lab">
  </div>

</div>

<div class="card-body p-0" id="section_acciones">
  <table  id="tabla_det_acciones" width="100%" class="table-hover table-bordered">
    <thead style="background: #00001a;color:white;width: 100%;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">
      <tr>
        <th style="text-align:center;width: 15%" colspan="15%">Fecha</th>
        <th style="text-align:center;width: 35%" colspan="35%">Accion
        <th style="text-align:center;width: 35%" colspan="35%">Observaciones
        <th style="text-align:center;width: 15%" colspan="15%">Usuario</th>
      </tr>
    </thead>
    <tbody id="det_acciones_ordenes" style="width: 100%;;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;"></tbody>        
   </table>
</div>
<button type="button" id="btn_new_order" class="btn btn-primary btn-block btn-flat" onClick="registrarEnvioLab();"><span id="edit_orden">CREAR ORDEN</span></button>
</div><!--Fin Card-->
</div>
  </div><!-- /.card-body -->  
  </div><!--Fin modal Content-->
</div>

<script type="text/javascript" src="js/cleave.js"></script>
<script>

function mayus(e) {
  e.value = e.value.toUpperCase();
}

var dui = new Cleave('#dui_pac', {
  delimiter: '-',
  blocks: [8,1],
  uppercase : true
});

var dui = new Cleave('#nit_pac', {
  delimiter: '-',
  blocks: [4,6,3,1],
  uppercase : true
});

var dui = new Cleave('#tel_pac', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_of_pac', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_ref1', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_ref2', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
</script>