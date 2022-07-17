<?php
require_once("modelos/Externos.php");
$users = new Externos();
$opto = $users->get_usuarios_ventas();
?>

<style>
    #tamModal_abonosg{
      max-width: 92% !important;
    }
     #head_abonosg{
        background-color:#034f84;
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
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_recibos_generico" style="border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document" id="tamModal_abonosg">

    <div class="modal-content">
     <div class="modal-header text-center" id="head_abonosg">
       <h5 class="text-center" style="text-align: center" align="center"><i class="fas fa-plus-square"></i> RECIBOS&nbsp; & &nbsp;ABONOS#<span id="n_recibo"></span></h5>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
    
    <div class="row" style="margin: 8px"><!--aros datos-->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Recibí de:</label>
      <input type="text" class="form-control" id="recibi_abono" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Servicio para:</label>
      <input type="text" class="form-control" id="servicio_abono" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-2">
      <label for="inputEmail4">Télefono</label>
      <input type="text" class="form-control" id="telefono_abono" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-2">
      <label for="inputEmail4">Empresa</label>
      <input type="text" class="form-control" id="empresa_abono" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-9">
      <label for="inputEmail4">Cantidad en letras</label>      
      <input type="text" class="form-control" id="texto" readonly="" placeholder="CANTIDAD EN LETRAS">
    </div>
    <div class="col-sm-3 select2-purple">
      <label for="ex3">Gestor</label>
      <select class="select2 form-control" id="id_gestor" multiple="multiple" data-placeholder="Seleccionar gestor" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
      <option value="0">Seleccionar usuario</option>
      <?php
        for ($i=0; $i < sizeof($opto); $i++) { ?>
          <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo $opto[$i]["usuario"]?></option>
            <?php  } ?>              
      </select>              
    </div>

    </div><!--FIN aros datos-->

        <table style="margin: 8px">
        <thead style="background-color: #034f84 ;color:white;text-align: center">
          <tr>
          <th>Monto</th>
          <th>Abonos Ant.</th>
          <th>Saldo Act.</th>
          <th>Abono Actual</th>
          <th>NuevoSaldo</th> 
          <th>Forma de Pago</th>
          <th id="pr_abono_ini">Prox. Abono</th>

          </tr>
        </thead>

        <tbody>
          <td align='center'>
            <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
            <input class='form-control' type='text' class='monto' name='monto' id="monto_venta_rec_ini" style="text-align: right;" readonly>
            </div>
          </td>
          <td align='center'>
            <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
            <input class='form-control' type='text' class='monto' name='abono_ant' id="abono_ant" style="text-align: right;" readonly value="0">
            </div>
          </td>

          <td align='center'>
            <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
            <input class='form-control' type='text' class='monto' name='saldo_credito' id="saldo_credito" style="text-align: right;" readonly>
            </div>
          </td>

          <td align='center'>
          <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
          <input class='form-control' type='text' name='numero' id="numero" onkeyup="nuevo_saldo()" style="text-align: right;" required>
        </div>  
        </td>
        <td align='center'>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
        <input class='form-control' type='text' class='saldo' name='saldo' id="saldo" style="text-align: right;" readonly></div>
      </td>
        <td align='center'><select class='form-control' id='forma_pago' name='forma_pago'>
          <option value=''>Seleccione...</option>
          <option value='Efectivo'>Efectivo</option>
          <option value='Cheque'>Cheque</option>
          <option value='Serfinsa'>Serfinsa</option>
          <option value='Credomatic'>Credomatic</option>
          <option value='Cuscatlan'>Cuscatlan</option>
          <option value='Agricola'>Agricola</option>
          <option value='Davivienda'>Davivienda</option>
          <option value='Transferencia'>Transferencia</option>
        </select></td>
        <td id="datepickers"><input type='date' class='form-control' id='pr_abono' name='pr_abono'></td>

        </tbody>
      </table>

    <div class="row" style="margin: 8px"><!--aros datos-->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Marca Aro</label>
      <input type="text" class="form-control" id="marca_aro_ini" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Modelo Aros</label>
      <input type="text" class="form-control" id="modelo_aro_ini" readonly="" style="background: white">
    </div>

    <div class="form-group col-md-4">
      <label for="inputEmail4">Color</label>
      <input type="text" class="form-control" id="color_aro_ini" readonly="" style="background: white">
    </div>

    </div><!--FIN aros datos-->

    <div class="form-row" style="margin: 8px">

    <div class="form-group col-md-4">
      <label for="inputPassword4">Lente</label>
      <input type="text" class="form-control" id="lente_rec_ini" style="background: white" readonly="">
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Photosensible</label>
      <input type="text" class="form-control" id="photo_rec_ini" style="background: white" readonly="">
    </div>

    <div class="form-group col-md-4">
      <label for="inputEmail4">Antireflejante</label>
      <input type="text" class="form-control" id="ar_rec_ini" style="background: white" readonly="">
    </div>

    <div class="form-group col-md-12">
      <input type="text" class="form-control" id="observaciones_rec_ini" style="background: white" placeholder="OBSERVACIONES">
    </div>

  </div>

    <button type="button" onClick="registra_abonos()" id="registrar_abono" style="background: #3fb0ac;color:white"><i class="fa fa-save"></i>  Registrar Abono</button>

    <a class="btn btn-primary" style="color:white;border-radius:1px;" href="" id="btn_print_recibos" target="_blank"><i class="fas fa-print"></i> Imprimir</a>

</div><!--Fin modal Content-->
<input type="hidden" id="id_pac_ini">
<input type="hidden" id="n_venta_recibo_ini">

  </div>
</div>

<script type="text/javascript">

  function nuevo_saldo(){

  var monto = document.getElementById("saldo_credito").value;
  var abono_ini_rec = document.getElementById("numero").value;
  //var abono_ini_rec = document.getElementById("numero").toFixed(2);
  var saldo = monto-abono_ini_rec;

  if (saldo<0) {
    Swal.fire('El abono debe ser menor o igual al saldo!','','error')
    document.getElementById("numero").value = "";
    
  }

  document.getElementById("saldo").value = saldo.toFixed(2);
  if(saldo==0){
    document.getElementById('datepickers').style.display = 'none';
    document.getElementById('pr_abono_ini').style.display = 'none';
  }else{
    document.getElementById('datepickers').style.display = 'block';
    document.getElementById('pr_abono_ini').style.display = 'block';

  }

}

  document.getElementById("numero").addEventListener("click",function(e){
  document.getElementById("texto").value = NumeroALetras(this.value);});

  document.getElementById("numero").addEventListener("keyup",function(e){
  document.getElementById("texto").value = NumeroALetras(this.value);});

  function Unidades(num){
 
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="DOLARES";
    data.letrasMonedaSingular="DOLAR";
  }else{
    data.letrasMonedaPlural="CENTAVOS";
    data.letrasMonedaSingular="CENTAVOS";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()


</script>