<style type="text/css">
  #tamModal_con{
  max-width: 98% !important;
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
</style>
<!-- The Modal -->
<div class="modal fade" id="consultasModal_edit" style="overflow-y: scroll;">
  <div class="modal-dialog" id="tamModal_con">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h5 class="modal-title" align="center">CONSULTAS</h5>
        <button type="button" class="close" data-dismiss="modal" onClick="clear_det_ventas();">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">        

            <input class="form-control" id="id_paciente" name="" type="hidden" readonly>
            <div class="form-group row">

             <div class="col-sm-3">
               <label for="ex3">Encargado de Cuenta</label>
                <input class="form-control" id="nombre_pac" type="text" name="nombre_pac" readonly>
              </div>

            <div class="col-sm-3">
              <label for="ex3">Paciente evaluado</label>
              <input class="form-control" id="p_evaluado" type="text" name="p_evaluado" onkeyup="mayus(this);">
            </div>

            <div class="col-sm-2">
              <label for="ex1">Edad</label>
              <input class="form-control" id="edad_p" name="edad_p" type="text" readonly>
            </div>

            <div class="col-sm-2">
              <label for="ex3">Telefono</label>
              <input class="form-control" id="tel_evaluado" type="text" name="tel_evaluado" placeholder="Paciente Evaluado" id="tel_evaluado">
            </div>
            <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
            <div class="col-sm-2">
              <label for="ex3">Fecha de Consulta</label>
              <input class="form-control" id="fecha_consulta" type="text" name="fecha_consulta" placeholder="dd/mm/YY" value="<?php echo $hoy;?>">
            </div>

            <div class="col-sm-12">
            <label for="comment">Motivo de Consulta</label>
            <textarea cols="80" class="form-control" rows="1" id="mot_consulta" name="motivo"></textarea>
            </div>

            <div class="col-sm-12">
              <label for="comment">Patologias</label>
              <textarea cols="80" class="form-control" rows="1" id="patologias_c" name="patologias"></textarea>
            </div>

            <div class="dropdown-divider"></div>
<div class="lens-auto" style="display:flex">
<hr style="color:blue;">
    
<div class="lenso" style="margin:5px">
<h5 style="color:blue;text-align:center"><strong>Lensometria</strong></h5>
<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">

    <thead class="thead-light bg-secondary">
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
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasl" id="odesferasl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilndrosl" id="odcilndrosl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesl" id="odejesl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odprismal" id="odprismal_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odadicionl" id="odadicionl_e" onKeyup="fill_lenso_oi()"></td>
        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesfreasl" id="oiesfreasl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicilindrosl" id="oicilindrosl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesl" id="oiejesl_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismal" id="oiprismal_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionl" id="oiadicionl_e"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN LENSO-->
<hr style="color:blue;">
<div class="autorefract" style="margin:5px">


<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <h5 style="color:blue;text-align:center"><strong>Autorefractometro</strong></h5>
    <thead class="thead-light bg-primary">
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
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasa" id="odesferasa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosa" id="odcilindrosa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesa" id="odejesa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaa" id="dprismaa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddiciona" id="oddiciona_e"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasa" id="oiesferasa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosa" id="oicolindrosa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesa" id="oiejesa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaa" id="oiprismaa_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadiciona" id="oiadiciona_e"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN AUTOREFRACT-->
</div>

 <!--==================== FIN Autorefractometro==================-->
  <!--==================== Rx Final==================-->
<div class="final-agudeza" style="display:flex">
  <!--==================== AgudezaVisual==================-->
<!--<div class="aguvisual" style="margin:5px">
<table style="border: solid 2px gray;border-radius:8px;width:100%">
<div><center><h5 style="color:blue;"><strong>Agudeza Visual</strong></h5></center></div>
    <thead class="thead-light">
    <tr>
    <td colspan="1">.</td>
      <td style="text-align:center;" colspan="3">VISION LEJANA</td>
      <td style="text-align:center; background-color:#E0E0E0" colspan="2">VISION CERCANA</td>
    </tr>

      <tr>
        <th style="text-align:center" colspan="1">OJO</th>
        <th style="text-align:center" colspan="1">S/C</th>
        <th style="text-align:center" colspan="1">PH</th>
        <th style="text-align:center" colspan="1">C/C</th>
        <th style="text-align:center;background-color:#E0E0E0" colspan="1">S/C</th>
        <th style="text-align:center;background-color:#E0E0E0" colspan="1">C/C</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavsclejos" id="odavsclejos_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavphlejos" id="odavphlejos_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavcclejos" id="odavcclejos_e"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="odavsccerca" id="odavsccerca_e"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="odavcccerca" id="odavcccerca_e"></td>
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavesferasf" id="oiavesferasf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavcolindrosf" id="oiavcolindrosf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavejesf" id="oiavejesf_e"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="oiavprismaf" id="oiavprismaf_e"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="oiavadicionf" id="oiavadicionf_e"></td>
      </tr>
  </tbody>
  </table>
  </div>-->

  <!--==================== FIN AgudezaVisual==================-->

<div class="rxfinal" style="margin:5px">
<table style="border: solid 2px gray;border-radius:8px;width:100%">
<div><center><h5 style="color:blue;"><strong>RX Final</strong></h5></center></div>
    <thead class="thead-light bg-primary">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">CORRIGE</th>
        <th style="text-align:center">ADICION</th>
        <th style="text-align:center">CORRIGE</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasf" id="odesferasf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosf" id="odcilindrosf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesf" id="odejesf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaf" id="dprismaf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="prisodcorrige" id="prisodcorrige_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddicionf" id="oddicionf_e" onKeyup="fill_rx()"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="addodcorrige" id="addodcorrige_e"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasf" id="oiesferasf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosf" id="oicolindrosf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesf" id="oiejesf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaf" id="oiprismaf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="prisoicorrige" id="prisoicorrige_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionf" id="oiadicionf_e"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="addoicorrige" id="addoicorrige_e"></td>
      </tr>
    <tr style="display:hidden">
      <td colspan="1" style="display:hidden"></td>
      <td style="text-align:center;display:hidden" colspan="3"></td>
      <td style="text-align:center;display:hidden" colspan="4"><span style="color:white">.</span></td>
    </tr>
  </table>

  </div>
  <!--rxfinal-->
</div><!--fin agudezaVisual Rxfinal-->
<!--=======OBLEAS=======-->
<div class="" style="margin:5px">

<table class="table" style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <tr>
        
        <td> <input type="text" class="form-control" placeholder="DIP" name="dip" id="dip_e"></td>
        <td> <input type="text" class="form-control" placeholder="OD" name="oddip" id="oddip_e"></td>
        <td> <input type="text" class="form-control" placeholder="OI" name="oidip" id="oidip_e"></td>
        <td>AO</td>
        <td><input type="text" class="form-control" placeholder="OD" name="aood" id="aood_e"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="aooi" id="aooi_e"></td>
        <td>AP</td>
        <td><input type="text" class="form-control" placeholder="OD" name="apod" id="apod_e"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="opoi" id="opoi_e"></td>
      </tr>      
  </tbody>
  </table>
<input type="hidden" id="id_paciente_consulta">
<input type="hidden" id="numero_venta_cons">
<div class="col-sm-12">
  <label for="comment">Observaciones</label>
  <input class="form-control" id="observaciones_e" name="observaciones" placeholder="Observaciones" required>
</div>
</script>
<div class="card-body">
  <div id="accordion">                  
    <div class="card card-primary" id="item_ventas_exp">
      <div class="card-header">
        <h4 class="card-title" style="display: flex;">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <button type="button" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-eye"></i> Ver detalle venta</button>
          </a>
        </h4>
      </div>

      <div id="collapseOne" class="panel-collapse collapse in">
        <div class="card-body">
          <table  id="tabla_det_ventas" width="100%">
            <thead style="background: #00001a;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 12px;text-align: center">
              <tr>
                <th style="text-align:center" width="10%">Fecha Venta</th>
                <th style="text-align:center" width="40%">Producto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th style="text-align:center" width="10%">Precio final</th>
              </tr>
            </thead>
            <tbody id="listar_det_ventas_cons" style="width: 100%;text-align: center;"></tbody>
          </table>        
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--======= FIN OBLEAS=======-->
<div class="row">

</div>

<input type="hidden" class="form-control" id="id_consulta_e" name="codigop">
<input type="hidden" name="id_usuario" id="id_usuario_e" value="<?php echo $_SESSION["id_usuario"];?>"/>
</div><!--FIN FORM-GROUP-->
<button class="btn btn-success btn-block btn-flat" onClick="editarConsultas();"><span class="fas fa-edit" aria-hidden="true"></span>
Editar</button>
</form>  
</div><!--FIN MODAL BODY-->
      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>