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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nueva_orden_lab" style="border-radius:0px !important;">
  <div class="modal-dialog modal-dialog-scrollable" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header bg-info" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i> ORDEN DE LABORATORIO</span>&nbsp;&nbsp;<span id="correlativo_orden"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
  <div class="card card-danger" style="margin-top: 3px">

<div class="eight" style="">
    <strong><h1>DATOS GENERALES</h1></strong>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <label for="inlineFormInputGroup">Paciente</label>
      <div class="input-group">
        <input type="text" class="form-control clear_orden_i" id="paciente_orden" placeholder="Buscar Paciente --> " readonly>
          <div class="input-group-prepend" onClick="get_data_orden();">
            <div class="input-group-text"><i class="fas fa-search" style="color: blue"></i></div>
          </div>
      </div>
    </div>

    <div class="form-group col-sm-3">
      <label for="inputPassword4">Laboratorio</label>
      <select class="form-control clear_orden_i" id="laboratorio_orden" required>
        <option value="">Seleccionar Laboratorio...</option>
        <option value="Lomed">Lomed</option>
        <option value="Lenti">Lenti</option>
        <option value="Opti Procesos">Opti Procesos</option>
        <option value="PrismaLab">PrismaLab</option>
        <option value="Optiservicios">Optiservicios</option>
        <option value="Cubas">Cubas</option>
    </select>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Proridad</label>
      <select class="form-control clear_orden_i" id="prioridad_orden" required>
        <option value="">Seleccionar Prioridad...</option>
        <option value="5">5 dia (Normal)</option>
        <option value="3">3 dias (Intermedio)</option>
        <option value="2">2 dias (Intermedio)</option>
        <option value="1">1 dias(Urgente)</option>
    </select>
    </div>

    <input type="hidden" id="id_pac_orden">
    <input type="hidden" id="id_consulta_orden">
</div>
</div><!--fin eigth #1-->

<div class="eight">
  <strong><h1 style="color: #034f84">GRADUACIÓN Y MEDIDAS</h1></strong>
  <div class="row">
  <div class="col-sm-6">    
  <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>      
        <th style="text-align:center">ADICION</th>
        <th style="text-align:center">PRISMA</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odesferasf_orden" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odcilindrosf_orden" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odejesf_orden" readonly="" style="text-align: center"></td>             
        <td> <input type="text" class="form-control clear_orden_i"  id="oddicionf_orden" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odprismaf_orden" readonly="" style="text-align: center"></td>                
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiesferasf_orden"  readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oicolindrosf_orden"  readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiejesf_orden"  readonly="" style="text-align: center"></td>              
        <td> <input type="text" class="form-control clear_orden_i"  id="oiadicionf_orden" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiprismaf_orden" readonly="" style="text-align: center"></td>     
      </tr>
     </tbody>
  </table>
  </div>  
  <div class="col-sm-6" style="margin-left: 0px">
      <table width="100%">
      <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
        <th colspan="5" style="width: 5%"></th>
        <th colspan="5" style="width: 5%;text-align: center">DIP</th>
        <th colspan="5" style="width: 5%;text-align: center">AP</th>
        <th colspan="5" style="width: 5%;text-align: center">AO</th>
      </thead>
      <tr>
        <td colspan="5" style="text-align:right;">OD</td>
        <td colspan="5"><input style="text-align: center" readonly id="dip_od" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ap_od" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ao_od" class="form-control clear_orden_i"></td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right;">OI</td>
        <td colspan="5"><input style="text-align: center" readonly id="dip_oi" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ap_oi" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ao_oi" class="form-control clear_orden_i"></td>
      </tr>
    </table>
  </div>
</div>
</div>

<div class="eight">
  <h1>TIPO DE LENTE + TRATAMIENTO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">LENTE</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i" id="lente_orden" readonly>
      </div>
    </div>

    <div class="form-group col-sm-7">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">TRATAMIENTOS</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i" id="tratamiento_orden" readonly>
      </div>
    </div>
  </div>
</div>

<div class="eight">
  <h1>ARO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">
    <div class="form-group col-sm-3">
      <label for="">Modelo</label>
      <input type="text" class="form-control clear_orden_i" id="modelo_aro_orden" readonly="">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Marca</label>
      <input type="text" class="form-control clear_orden_i" id="marca_aro_orden" readonly="">
    </div>

      <div class="form-group col-sm-3">
      <label for="">Color</label>
      <input type="text" class="form-control clear_orden_i" id="color_aro_orden" readonly="">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Diseño</label>
      <input type="text" class="form-control clear_orden_i" id="diseno_aro_orden" readonly="">
    </div>
  </div>

 <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th  colspan="25" style="text-align:center;width:25%">HORIZONTAL</th>
        <th  colspan="25" style="text-align:center;width:25%">DIAGONAL</th>
        <th  colspan="25" style="text-align:center;width:25%">VERTICAL</th>
        <th  colspan="25" style="text-align:center;width:25%">PUENTE</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_a" onClick="get_correlativo_orden();"></td>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_b" onClick="get_correlativo_orden();"></td>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_c" onClick="get_correlativo_orden();"></td>     
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_d" onClick="get_correlativo_orden();"></td>                
      </tr>
  </table>

  <div class="form-group col-sm-12">
    <label for="">Observaciones</label>
    <input type="text" class="form-control clear_orden_i" id="observaciones_orden">
  </div>

</div>
<button type="button" class="btn btn-primary btn-block btn-flat" onClick="registrarEnvio();">CREAR ORDEN</button>
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