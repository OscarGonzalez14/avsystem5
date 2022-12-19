 <table width="100%">
    <tr>

    <td colspan="40" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>CLIENTE:</strong> <?php echo $empresa;?></td>
    <td colspan="40" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>DIRECCION:</strong> <?php echo $direccion;?></td> <td colspan="20" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>FECHA:</strong> <?php echo $hoy;?></td>

</tr>

<tr>
  <td colspan="40" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>REGISTRO No:</strong> <?php echo $registro_ccf;?></td>
  <td colspan="40" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>GIRO:</strong> <?php echo $giro_ccf;?></td>
  <td colspan="20" style="color:black;font-size:11px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 40%"><strong>NIT:</strong> <?php echo $nit;?></td>
</tr>

</table>
<table id="table2" width="100%">
<tr>
    <th bgcolor="#0061a9" colspan="10" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 10%"><span class="Estilo11">CANT.</span></th>
    <th bgcolor="#0061a9" colspan="50" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 50%"><span class="Estilo11">DESCRIPCIÓN</span></th>
    <th bgcolor="#0061a9" colspan="10" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 10%"><span class="Estilo11">P/UNITARIO</span></th>
    <th bgcolor="#0061a9" colspan="10" style="color:white;font-size:7px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 10%"><span class="Estilo11">VENTAS NO SUJETAS</span></th>
    <th bgcolor="#0061a9" colspan="10" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:10% "><span class="Estilo11">VENTAS EXENTAS</span></th>
    <th bgcolor="#0061a9" colspan="10" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 10%"><span class="Estilo11">VENTAS AFECTAS</span></th>
</tr>



<tr style="height:50px;">
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 10px;text-align: center;margin:20px;height: 95px">
 <?php 
   echo 
   "203<>br
   264<>br
   125<>br
   255<>br
   204<>br
   264<>br
   61
   "
   
   ;?>     
  </td>
 
  <td colspan="50" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 10px;text-align: left;margin:20px">
     <?php 
     echo "SUMINISTRO DE SERVICIO ÓPTICO (EXÁMEN VISUAL, ARO, LENTE, ESTUCHE, FRANELA Y SOLUCIÓN DE LIMPIEZA)";
     ?>    
  </td>
 
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: right;margin:20px">

       
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: right;margin:20px">

    <?php 
     echo "<span style='font-size:11px'><b>$ ".number_format($monto,2,".",",")."</span></b>";
    ?>
   
  </td>
</tr>
<!---CALCULOS-->
<?php
$exentas = $monto/(1.13);
$iva = $exentas*0.13;
$subtotal_ccf = $exentas+$iva;

if ($tipo_contribuyente==1) {
  $retenido = $exentas*0.01;
}else{
  $retenido = 0;
}

if ($retenido>0) {
  $total = ($subtotal_ccf)-$retenido;
}else{
  $total= $subtotal_ccf;
}



?>
<!---FIN CALCULOS-->
<tr>
  <td colspan="60" rowspan="2" class="stilot1" style="width: 60%;text-align: left">Son: <?php echo numletras(number_format($total,2,".",""),$_moneda);?></td>
  <td colspan="10" class="stilot1" style="font-size:8px">SUMAS</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="font-size:10px;"><?php echo "$".number_format($exentas,2,".",","); ?></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA EXENTA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="text-align: center;font-size: 10px"></td>
</tr>

<tr>
  <td colspan="60" class="stilot1" style="font-size:8px">LLENAR SI LA OPERACIÓN IGUAL O MAYOR A $11,428.58</td>
  <td colspan="20" class="stilot1" style="font-size:8px">IVA 13%</td>
   <td colspan="10" class="stilot1" style="font-size:8px"></td>
  <td colspan="10" class="stilot1" style="text-align: center;font-size: 10px"> <?php echo "$".number_format($iva,2,".",",");?></td>
</tr>

<tr>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Entregado por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Entregado por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="20" class="stilot1" style="font-size:8px; height:8px">SUBTOTAL</td>
  <td colspan="10" class="stilot1" style="height:8px"></td>
  <td colspan="10" class="stilot1" style="height:8px;font-size: 10px"><?php echo "$".number_format($subtotal_ccf,2,".",",");?></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">IVA RETENIDO (1%)</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="text-align: right;font-size:9px"><?php echo "$".number_format($retenido,2,".",",");?></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA NO SUJETA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
</tr>

<tr>
  <td colspan="20" class="stilot1" style="font-size:8px"><strong>TOTAL</strong></td>
  <td colspan="20" class="stilot1" style="text-align: right;font-size:11px"><strong><?php echo "$".number_format($total,2,".",",");?></strong></td>
</tr>
</table>