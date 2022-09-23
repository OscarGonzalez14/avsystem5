<style>
    #tamModal_orden_desc{
      max-width: 85% !important;
    }
     #head_oid{
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
    .obs{
      color: red;
    }
     .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .table2 {
       border-collapse: collapse;
    }
    .bordes_c{
      border: 1px solid   black;
    }
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detalle_oid" style="border-radius:0px !important;">
  <div class="modal-dialog" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i> DETALLE ORDEN DESCUENTO EN PLANILLA #</span><span id="correlativo_orden"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
    
    <div class="card-body p-0" style="margin:7px">
  <input type="hidden" id="plazo_orden_desc">
  <input type="hidden" id="n_orden_des">

  <table width="100%" class="table-hover table-bordered display nowrap">
    <tr class="bg-dark">
    <th colspan="100" style="color:white;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DATOS TITULAR DE LA CUENTA</b></th>  
    </tr>
    <tr style="background:  #C8C8C8">
      <th colspan="25" style="text-align:center;font-size: 12px;width:25%;font-family: Helvetica, Arial, sans-serif" class="bordes_c">NOMBRE COMPLETO</th>
      <th colspan="30" style="text-align:center;font-size: 12px;width:30%;font-family: Helvetica, Arial, sans-serif" class="bordes_c">EMPRESA</th>
      <th colspan="20" style="text-align:center;font-size: 12px;width:20%;font-family: Helvetica, Arial, sans-serif" class="bordes_c">FUNCIÓN LABORAL</th>
      <th colspan="25" style="text-align:center;font-size: 12px;width:25%;font-family: Helvetica, Arial, sans-serif" class="bordes_c">DUI</th>
    </tr>
    <tr class="bg-light">
      <td colspan="25" style="text-align:center;font-size: 14px;width:25%;text-align: center"><span id="paciente_orden"></span></td>
      <td colspan="30" style="text-align:center;font-size: 14px;width:30%;text-align: center"><span id="empresa_pac_orden"></span></td>
      <td colspan="20" style="text-align:center;font-size: 14px;width:20%;text-align: center"><span id="funcion_pac_orden"></span></td>
      <td colspan="25" style="text-align:center;font-size: 14px;width:25%;text-align: center"><span id="dui_pac_orden"></span></td>
    </tr>

    <tr style="background:  #C8C8C8">
      <th colspan="10" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:10%;font-size: 12px"><b>EDAD</b></th>
      <th colspan="20" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:20%;font-size: 12px"><b>NIT</b></th>
      <th colspan="15" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:15%;font-size: 12px"><b>TELEFONO</b></th>
      <th colspan="30" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:30%;font-size: 12px"><b>TEL. OFICINA</b></th>
      <th colspan="25" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:25%;font-size: 12px"><b>CORREO</b></th>
    </tr>
    <tr>
      <td colspan="10" style="text-align:center;width:10%;text-align: center;font-size: 14px"><span id="edad_pac_orden"></span></td>
      <td colspan="20" style="text-align:center;width:20%;text-align: center;font-size: 14px"><span id="nit_pac_orden"></span></td>
      <td colspan="15" style="text-align:center;width:15%;text-align: center;font-size: 14px"><span id="tel_pac_orden"></span></td>
      <td colspan="30" style="text-align:center;width:30%;text-align: center;font-size: 14px"><span id="tel_of_pac_orden"></span></td>
      <td colspan="25" style="text-align:center;width:25%;text-align: center;font-size: 14px"><span id="correo_pac_orden"></span></td>
    </tr>
    <tr>
      <td colspan="100" style="font-size:14px;text-align:center;font-family: Helvetica, Arial, sans-serif;width:100%">&nbsp;&nbsp;<b>DIRECCIÓN COMPLETA:</b>&nbsp;<span id="dir_pac_orden"></span></td>
      
    </tr>
  </table><br>
            <!--DETALLES DE CREDITO SOLICITADO SE CARGA DESDE CREDITOS.JS funcion acciones_oid.js-->
  <table width="100%" class="table-hover table-bordered display nowrap">
    <thead style="text-align: center" class="table-hover table-bordered display nowrap">
      <tr class="bg-dark">
        <th colspan="100" style="color:white;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DETALLE CRÉDITO</b></th>  
      </tr>
      <tr>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">MONTO</th>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">PLAZO</th>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">CUOTA</th>
        <th colspan="35" style="text-align:center;font-size: 12px;width: 35%">REFERENCIA 1</th>
        <th colspan="35" style="text-align:center;font-size: 12px;width: 35%">REFERENCIA 2</th>
      </tr>
      </thead>
      <tbody style="text-align: :center">
        <tr>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="monto_orden"></span></td>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="plazo_orden"></span></td>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="cuota_orden"></span></td>
          <td colspan="35" style="text-align:center;width: 35%;font-size: 14px"><span id="ref1_orden"></span></td>
          <td colspan="35" style="text-align:center;width: 35%;font-size: 14px"><span id="ref2_orden"></span></td>
        </tr>      
      </tbody>
    </table><br>

        <!--TABLA DE BENEFICIARIOS-->
    
    <table id="beneficiarios_productos_vf" class="table-striped table-bordered table-hover" width="100%" style="font-size:13px">

          <thead class="bg-success">
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Subtotal</th>
          </thead>                            
    </table>

    <!--TABLA DE BENEFICIARIOS-->
      <div class="card-body p-0 table-responsive" style="margin:1px">
            <table id="lista_aros_ventas_data" width="100%" class="table-hover table-bordered">

              <thead>
                <tr class="bg-dark"><th colspan="100" style="width: 100%;text-align: center">BENEFICIARIOS</th></tr>
              </thead>

                <tr style="text-align: center;font-size: 14px;background:  #C8C8C8">
                  <td style="width: 15%"></td>
                  <td style="width: 10%;text-transform: uppercase;"><b>Estado</b></td>
                  <td style="width: 65%;text-transform: uppercase;"><b>Evaluado (Beneficiario)</b></td>
                  <td style="width: 10%;text-transform: uppercase;"><b>Monto</b></td>
                </tr>

              <tbody style="text-align:center;font-size: 14px" id="benefiaciarios_orden"></tbody>
            </table>
          </div><br>

</div>

<div class="modal-footer justify-content-between" id="btns_orden">
  <button type="button" class="btn btn-info btn-block" onClick="aprobar_od_planilla();" style="color: white"><i class="fas fa-save" aria-hidden="true"></i> GUARDAR CAMBIOS</button>
</div>
</div><!--Fin Card-->
</div>
</div><!-- /.card-body -->  
</div><!--Fin modal Content-->


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