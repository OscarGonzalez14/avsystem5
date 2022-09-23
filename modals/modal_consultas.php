<style type="text/css">
  #tamModal_con{
  max-width: 95% !important;
  }
  #head{
  background-color: black;
  color: white;
  text-align: center;
}
body.modal-open {
    position: fixed;
    overflow: hidden;
    left:0;
    right:0;
}
.modal{
    -webkit-overflow-scrolling: auto;
}
.modal-body{
  font-family: Helvetica, Arial, sans-serif;font-size: 12px;
}
</style>
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- The Modal -->
<div class="modal fade" id="consultasModal">
  <div class="modal-dialog" id="tamModal_con">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h5 class="modal-title" align="center">CONSULTAS</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body form-horizontal">        
        
            <input class="form-control" id="id_paciente" name="" type="hidden" readonly>
            <div class="form-group row">

             <div class="col-sm-3">
               <label for="ex3">Encargado de Cuenta</label>
                <input class="form-control" id="nombre_pac" type="text" name="nombre_pac" readonly>
              </div>

            <div class="col-sm-3">
              <label for="ex3">P. Evaluado&nbsp;&nbsp;&nbsp;<input class="quimica" type="checkbox" name="check_box" id="editar_eval" onClick="habilita_edit_eval();"></label>
              <input class="form-control" id="p_evaluado" type="text" name="p_evaluado" onkeyup="mayus(this);">
            </div>

            <div class="col-sm-2">
              <label for="ex1">Parentesco</label>
              <input class="form-control" id="parentesco_evaluado" name="parentesco_evaluado" type="text" onkeyup="mayus(this);">
            </div>            

            <input class="form-control" id="tel_evaluado" type="hidden" name="tel_evaluado" placeholder="Paciente Evaluado">

            <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
            <div class="col-sm-2">
              <label for="ex3">Fecha</label>
              <input class="form-control" id="fecha_consulta" type="text" name="fecha_consulta" placeholder="dd/mm/YY" value="<?php echo $hoy;?>" readonly>
            </div>

            <div class="col-sm-12">
            <label for="comment">Motivo de Consulta</label>
            <textarea cols="80" class="form-control" rows="1" id="motivo" name="motivo"></textarea>
            </div>

            <div class="col-sm-12">
              <label for="comment">Patologias</label>
              <textarea cols="80" class="form-control" rows="1" id="patologias" name="patologias"></textarea>
            </div>

          <div class="dropdown-divider"></div>
          <div class="lens-auto" style="display:flex">
<hr style="color:blue;">
    
<div class="lenso" style="margin:5px">
<h5 style="color:blue;text-align:center"><strong>Lensometria</strong></h5>
<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">

    <thead class="thead-light" style="background: black;color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
          <td> <input type="text" class="form-control" placeholder="---" name="odesferasl" id="odesferasl"></td>
          <td> <input type="text" class="form-control" placeholder="---" name="odcilndrosl" id="odcilndrosl"></td>
          <td> <input type="text" class="form-control" placeholder="---" name="odejesl" id="odejesl"></td>
          <td> <input type="text" class="form-control" placeholder="---" name="odprismal" id="odprismal"></td>
          <td> <input type="text" class="form-control" placeholder="---" name="odadicionl" id="odadicionl" onKeyup="fill_lenso_oi()"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesfreasl" id="oiesfreasl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicilindrosl" id="oicilindrosl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesl" id="oiejesl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismal" id="oiprismal"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionl" id="oiadicionl"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN LENSO-->
<hr style="color:blue;">
<div class="autorefract" style="margin:5px">


<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <h5 style="color:blue;text-align:center"><strong>Autorefractometro</strong></h5>
    <thead class="thead-light" style="background: black;color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasa" id="odesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosa" id="odcilindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesa" id="odejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaa" id="dprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddiciona" id="oddiciona"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasa" id="oiesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosa" id="oicolindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesa" id="oiejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaa" id="oiprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadiciona" id="oiadiciona"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN AUTOREFRACT-->
</div>

 <!--==================== FIN Autorefractometro==================-->
  <!--==================== Rx Final==================-->
<div class="final-agudeza" style="display:flex;align-items: center;">
 
<div class="rxfinal" style="margin:5px">
<table style="border: solid 2px gray;border-radius:8px;width:100%">
<div><center><h5 style="color:blue;"><strong>RX Final</strong></h5></center></div>
    <thead class="thead-light" style="background: black;color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>        
        <th style="text-align:center">ADICION</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasf" id="odesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosf" id="odcilindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesf" id="odejesf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaf" id="dprismaf"></td>        
        <td> <input type="text" class="form-control" placeholder="---" name="oddicionf" id="oddicionf" onKeyup="fill_rx()"></td>                
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" id="oiesferasf" ></td>
        <td> <input type="text" class="form-control" placeholder="---" id="oicolindrosf" ></td>
        <td> <input type="text" class="form-control" placeholder="---" id="oiejesf" ></td>
        <td> <input type="text" class="form-control" placeholder="---" id="oiprismaf" ></td>        
        <td> <input type="text" class="form-control" placeholder="---" id="oiadicionf"></td>
        
      </tr>
  </table>

  </div>
  <!--rxfinal-->
</div><!--fin agudezaVisual Rxfinal-->
<!--=======OBLEAS=======-->
<div class="" style="margin:5px">

<table class="table" style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <tr>        
        <td> <input type="text" class="form-control" placeholder="DIP" name="dip" id="dip" onKeyup="fill_obleas()"></td>
        <td> <input type="text" class="form-control" placeholder="OD" name="oddip" id="oddip"></td>
        <td> <input type="text" class="form-control" placeholder="OI" name="oidip" id="oidip"></td>
        <td>AO</td>
        <td><input type="text" class="form-control" placeholder="OD" name="aood" id="aood" onKeyup="fill_ao()"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="aooi" id="aooi"></td>
        <td>AP</td>
        <td><input type="text" class="form-control" placeholder="OD" name="apod" id="apod" onKeyup="fill_ap()"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="opoi" id="opoi"></td>
      </tr>      
  </tbody>
  </table>
</div>
<!--======= FIN OBLEAS=======-->
<div class="col-sm-12">
  <label for="comment">Diagnostico</label>
  <textarea cols="80" class="form-control" rows="2" id="diagnostico" name="diagnostico" placeholder="Diagnostico"></textarea>
</div>

<div class="col-sm-12">
  <label for="ex3">Medicamento</label>
  <input class="form-control" id="medicamento" type="text" name="medicamento" placeholder="Medicamento">
</div>

<div class="col-sm-12">
  <label for="comment">Observaciones</label>
  <input class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" required>
</div>
<input class="form-control" id="codigop" name="codigop" type="hidden" readonly>
<div class="col-sm-12 select2-purple">
  <label for="ex3">Optometra</label>
  <select class="select2 form-control" id="id_usuario" multiple="multiple" data-placeholder="Seleccionar optometra" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
    <option value="0">Seleccionar usuario</option>
    <?php
      for ($i=0; $i < sizeof($opto); $i++) { ?>
    <option value="<?php echo $opto[$i]["id_usuario"]?>"><?php echo $opto[$i]["nick"]?></option>
    <?php  } ?>              
  </select>              
</div>
</div><!--FIN FORM-GROUP-->
<button type="button" class="btn btn-primary btn-block" onClick="guardarConsultas()"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
Guardar</button>
 
</div><!--FIN MODAL BODY-->

<div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
