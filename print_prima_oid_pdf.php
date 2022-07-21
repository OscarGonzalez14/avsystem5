<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';

require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
$id_paciente =$_GET["id_paciente"];
$n_orden =$_GET["n_orden"];
$n_recibo =$_GET["n_recibo"];
$sucursal = $_GET["sucursal"];

/////////////DESCRIBE DETALLE DE RECIBO---FROM FACTURAS
$datos_factura_cantidad = $reporteria->get_data_prima_oid($_GET["n_orden"],$_GET["id_paciente"]);
$datos_factura_producto = $reporteria->get_datos_det_vflotante($_GET["n_orden"],$_GET["id_paciente"]);
$datos_factura_precio_u = $reporteria->get_datos_prima_p_unitario($_GET["n_orden"],$_GET["id_paciente"]);
$datos_factura_subtotal = $reporteria->get_datos_prima_subtotal($_GET["n_orden"],$_GET["id_paciente"]);
$datos_factura_paciente = $reporteria->get_datos_factura_paciente($_GET["id_paciente"]);
//$datos_factura_venta    = $reporteria->get_datos_factura_venta($_GET["n_venta"],$_GET["id_paciente"]);


if ($sucursal == "Metrocentro") {
  $direccion = "Boulevard de los Heroes. Centro Comercial Metrocentro Local#7 San Salvador";
  $telefono = "2260-1653";
  $wha = "7469-2542";
  $correo = "metrocentro@opticaavplussv.com";
}elseif ($sucursal == "San Miguel") {
  $direccion = "3<sup>ra</sup> Calle Poniente Av. Roosevelt Sur Esquina #115 ";
  $telefono = "2661 7549";
  $wha = "7946-0464";
  $correo = "opticaavplussanmiguel@gmail.com";
}elseif ($sucursal == "Santa Ana"){
    $direccion = " 61 Calle Pte. Block K9 #10, Col, Avenida El Trebol, Santa Ana";
    $telefono = "2445 3150";
    $wha = "-";
    $correo = "opticaavplussantana@gmail.com";
}elseif ($sucursal == "Chalatenango"){
    $encabezado = "OPTICA AV PLUS S.A DE C.V.";
    $direccion = "Carr. Troncal Del Nte. 48 ½, Plaza Don Yon, local #6, 3<sup>ra</sup> Etapa, Coyolito, Chalatenango";
    $telefono = "-";
    $wha = "-";
    $correo = "opticaavpluschalatenango@gmail.com";
}elseif ($sucursal == "Ahuachapán"  or  $sucursal == "Empresarial-Ahuachapán"){
    $encabezado = "OPTICA AV PLUS S.A DE C.V.";
    $direccion = "Ahuachapán 2<sup>da</sup> Avenida Sur #1-5 entre 1 Calle Gerardo Barrios ";
    $telefono = "-";
    $wha = "-";
    $correo = "ahuachapan@opticasavplus.com";
}elseif ($sucursal == "Cascadas"  or  $sucursal == "Empresarial-Cascadas"){
    $encabezado = "OPTICA AV PLUS S.A DE C.V.";
    $direccion = "Centro Comercial Las Cascadas, La Libertad Hiper local#219";
    $telefono = "-";
    $wha = "-";
    $correo = "cascadas@opticasavplus.com";
}

$datos_recibo = $reporteria->print_recibo_paciente($_GET["n_recibo"],$_GET["n_orden"],$_GET["id_paciente"]);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
      html{
        margin-top: 10px;
        margin-left: 30px;
        margin-right:20px; 
        margin-bottom: 0px;
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
   </style>
  </head>
  <body>
<table style="width: 100%;margin-top:10px">
<tr>
<td width="10%"><img src="images/logooficial.jpg" width="180" height="100"  /></td>

<td width="70%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:20px";font-family: Helvetica, Arial, sans-serif;><strong>OPTICA AVPLUS S.A de C.V.</strong></td>
  </tr>

  <tr>
    <td style="text-align:center; font-size:14px;font-family: Helvetica, Arial, sans-serif;"><strong>GIRO: </strong>OTROS SERVICIO RELACIONADOS CON LA SALUD</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong> <?php echo $wha;?>&nbsp;&nbsp;&nbsp;<br></span>E-mail;&nbsp;<?php echo $correo;?></td>
  </tr>


</table><!--fin segunda tabla-->
</td>
<td width="35%">
<table>

  <tr>
    <td style="text-align:right; font-size:12px"><strong>RECIBO</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $n_recibo;?></strong></td>
  </tr>

</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>

<div style="height:425px;width:100%;margin-top:0px;"><!--Cliente--->
  <table width="100%" class="table2">

<tr>
    <th bgcolor="#0061a9" colspan="39" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:39%"><span class="Estilo11">RECIBI DE</span></th>
    <th bgcolor="#0061a9" colspan="39" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:39%"><span class="Estilo11">SERVICIO PARA</span></th>
    <!--<th bgcolor="#0061a9" colspan="20" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%"><span class="Estilo11">EMPRESA</span></th>-->
    <th bgcolor="#0061a9" colspan="22" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:22%"><span class="Estilo11">FECHA</span></th>
</tr>
<?php
  for($i=0;$i<sizeof($datos_recibo);$i++){
?>
<tr style="font-size:12px" class="even_row">
    <td style="text-align: center;width:39%" colspan="39" class="stilot1"><?php echo $datos_recibo[$i]["recibi_de"];?></td>
    <td style="text-align: center;width:39%" colspan="39" class="stilot1"><span class=""><?php echo $datos_recibo[$i]["servicio_para"];?></span></td>
    <td style="text-align: center;width:22%" colspan="22" class="stilot1"><span class=""><span style="text-align:center; font-size:12px"><?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s"); echo $hoy; ?></span></td>   

</tr>
</table>
<table width="100%" class="table2">
<tr>
    <td class="stilot1" colspan="39" style="width: 39%;text-align: center;color:white" bgcolor="#0061a9"><strong>EMPRESA: </strong> </span></td>
    <td class="stilot1" colspan="39" bgcolor="#0061a9" style="color: white;font-size:12px;text-align:center;width:39%">TELEFONO</td>
    <td class="stilot1" colspan="22" bgcolor="#0061a9" style="color: white;font-size:12px;text-align:center;width:22%">PROX. ABONO</td>    
  </tr>
  <tr>
    <td class="stilot1" colspan="39" style="width: 39%;text-align: center;"><?php echo $datos_recibo[$i]["empresa"];?></td>
    <td class="stilot1" colspan="39" style="text-align:center;width: 39%"><span style="text-align:center; font-size:12px"><?php echo $datos_recibo[$i]["telefono"];?></span></td>
    <td class="stilot1" colspan="22" style="text-align:center;width: 22%"><?php echo $datos_recibo[$i]["prox_abono"];?></td>
  </tr>
</table>
<?php
  }
?>

<table  width="100%" class="table2">
<tr>
    <th bgcolor="#0061a9" colspan="15" style="color:white;font-size:15px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 15%;text-align: center;"><span class="Estilo11">CANT.</span></th>
    <th bgcolor="#0061a9" colspan="67" style="color:white;font-size:10px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 67%;text-align: center;"><span class="Estilo11">DESCRIPCIÓN</span></th>
    <th bgcolor="#0061a9" colspan="11" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 11%"><span class="Estilo11">P/UNITARIO</span></th>
    <th bgcolor="#0061a9" colspan="12" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 12%"><span class="Estilo11">VENTAS AFECTAS</span></th>
</tr>


<tr style="height:40px;">
<td colspan="15" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;margin:20px;height: 95px;width: 15%;text-align: center;">
   <?php 
    for ($i=0; $i < sizeof($datos_factura_cantidad); $i++) {
     ?><span style="margin-left: 0px !important"><?php echo $datos_factura_cantidad[$i]["cantidad_venta"]?></span><br>
     <?php } ?>     
  </td>
 
  <td colspan="67" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: left;margin:20px;text-transform: uppercase;width: 67%;text-align: center;
  ">
     <?php 
    for ($i=0; $i < sizeof($datos_factura_producto); $i++) {
     echo "&nbsp;&nbsp;&nbsp;".$datos_factura_producto[$i]["producto"]?><br>
     <?php } ?>    
  </td>
 
   <td colspan="11" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px;width: 11%">

    <?php 
    for ($i=0; $i < sizeof($datos_factura_precio_u); $i++) {
     echo "$".number_format($datos_factura_precio_u[$i]["precio_final"],2,".",",");?><br>
     <?php } ?> 
    
  </td>

    <td colspan="12" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px;width: 12%">

    <?php 
    $subtotal=0;
    for ($i=0; $i < sizeof($datos_factura_subtotal); $i++) {
      $subtotal=$subtotal+$datos_factura_subtotal[$i]["subtotal"];
     echo "$".number_format(($datos_factura_subtotal[$i]["subtotal"]),2,".",",");?><br>

     <?php } ?>
   
  </td>
 
</tr>
</table>

<table width="100%" class="table2">
  <tr>
    <td  colspan="100" style="border: white 1px solid;"></td>
</tr>
<tr>
    <th bgcolor="#0061a9" colspan="14" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 14%"><span class="Estilo11">MONTO</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">ABONOS ANT.</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">ABONO ACT.</span></th>
    <th bgcolor="#0061a9" colspan="20" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 20%"><span class="Estilo11">SALDO</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">FORMA  PAGO</span></th>
</tr>
<?php
  for($i=0;$i<sizeof($datos_recibo);$i++){
?>
<tr style="font-size:10pt" class="even_row">
    <td style="text-align: center;width: 14%" colspan="14" class="stilot1"><span class=""><?php echo "$ ".$datos_recibo[$i]["monto"];?></span></td>
    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo "$".number_format(floatval($datos_recibo[$i]["a_anteriores"]),2,".",",");?></span></td>

    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo "$ ".number_format(floatval($datos_recibo[$i]["abono_act"]),2,".",",");?></span></td>
    <td style="text-align: center;width: 20%" colspan="20" class="stilot1"><span class=""><?php echo "$ ".$datos_recibo[$i]["saldo"];?></span></td>
    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo $datos_recibo[$i]["forma_pago"];?></span></td>
</tr>

<tr style="font-size:10pt" class="even_row">
    <td style="text-align: left;" colspan="100" class="stilot1"><span class="">OBSERVACIONES:&nbsp;<?php echo $datos_recibo[$i]["observaciones"];?></span></td>
    
</tr>
<tr>
    <td  colspan="100" style="border: white 1px solid;padding: 5px"></td>

</tr>
<tr>
    <td  colspan="100" class="stilot3"><span>Nota: Yo&nbsp;<?php echo $datos_recibo[$i]["recibi_de"];?>: Declaro que me fue explicada de forma detallada y explícita las caracteristicas del aro,lentes,accesorios o tratamientos que estoy adquiriendo con el servicio recibido de lo cual firmo conforme. </span></td>
</tr>
<tr>
    <td  colspan="100" style="border: white 1px solid;padding: 5px">.</td>

</tr>
<tr>
    <td  colspan="40" class="stilot3">Firma paciente:___________________________</td>
    <td  colspan="30" class="stilot3"><div align="center"><span class=""><?php echo "Asesor:".": ".$datos_recibo[$i]["id_usuario"];?></span></div></td>
    <td  colspan="30" class="stilot3"><?php echo $datos_recibo[$i]["numero_venta"];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px"><strong>Original: Emisor</strong></span></td>
</tr>

</table>
<?php
  }
?>
</div><!--Fin primera parte-->

<!--**///////////////SEGUNDA PARTE-->
<table style="width: 100%;margin-top:0px">
  <tr>
    <td><span style="color: white">H</span></td>
  </tr>
<tr>
<td width="10%"><img src="images/logooficial.jpg" width="180" height="100"  /></td>

<td width="70%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:20px";font-family: Helvetica, Arial, sans-serif;><strong>OPTICA AVPLUS S.A de C.V.</strong></td>
  </tr>

  <tr>
    <td style="text-align:center; font-size:14px;font-family: Helvetica, Arial, sans-serif;"><strong>GIRO: </strong>OTROS SERVICIO RELACIONADOS CON LA SALUD</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>
  <tr>
   <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong><?php echo $wha;?>&nbsp;&nbsp;&nbsp;<br></span>E-mail: <?php echo $correo?></td>
  </tr>


</table><!--fin segunda tabla-->
</td>
<td width="35%">
<table>

  <tr>
    <td style="text-align:right; font-size:12px"><strong>RECIBO</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $n_recibo;?></strong></td>
  </tr>

</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>

<div style="height:420px;width:100%;margin-top:0px;"><!--Cliente--->
  <table width="100%" class="table2">

<tr>
    <th bgcolor="#0061a9" colspan="39" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:39%"><span class="Estilo11">RECIBI DE</span></th>
    <th bgcolor="#0061a9" colspan="39" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:39%"><span class="Estilo11">SERVICIO PARA</span></th>
    <!--<th bgcolor="#0061a9" colspan="20" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%"><span class="Estilo11">EMPRESA</span></th>-->
    <th bgcolor="#0061a9" colspan="22" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:22%"><span class="Estilo11">FECHA</span></th>
</tr>
<?php
  for($i=0;$i<sizeof($datos_recibo);$i++){
?>
<tr style="font-size:12px" class="even_row">
    <td style="text-align: center;width:39%" colspan="39" class="stilot1"><?php echo $datos_recibo[$i]["recibi_de"];?></td>
    <td style="text-align: center;width:39%" colspan="39" class="stilot1"><span class=""><?php echo $datos_recibo[$i]["servicio_para"];?></span></td>
    <td style="text-align: center;width:22%" colspan="22" class="stilot1"><span class=""><span style="text-align:center; font-size:12px"><?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s"); echo $hoy; ?></span></td>   

</tr>
</table>
<table width="100%" class="table2">
<tr>
    <td class="stilot1" colspan="39" style="width: 39%;text-align: center;color:white" bgcolor="#0061a9"><strong>EMPRESA: </strong> </span></td>
    <td class="stilot1" colspan="39" bgcolor="#0061a9" style="color: white;font-size:12px;text-align:center;width:39%">TELEFONO</td>
    <td class="stilot1" colspan="22" bgcolor="#0061a9" style="color: white;font-size:12px;text-align:center;width:22%">PROX. ABONO</td>    
  </tr>
  <tr>
    <td class="stilot1" colspan="39" style="width: 39%;text-align: center;"><?php echo $datos_recibo[$i]["empresa"];?></td>
    <td class="stilot1" colspan="39" style="text-align:center;width: 39%"><span style="text-align:center; font-size:12px"><?php echo $datos_recibo[$i]["telefono"];?></span></td>
    <td class="stilot1" colspan="22" style="text-align:center;width: 22%"><?php echo $datos_recibo[$i]["prox_abono"];?></td>
  </tr>
</table>
<?php
  }
?>

<table  width="100%" class="table2">
<tr>
    <th bgcolor="#0061a9" colspan="15" style="color:white;font-size:15px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 15%;text-align: center;"><span class="Estilo11">CANT.</span></th>
    <th bgcolor="#0061a9" colspan="67" style="color:white;font-size:10px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 67%;text-align: center;"><span class="Estilo11">DESCRIPCIÓN</span></th>
    <th bgcolor="#0061a9" colspan="11" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 11%"><span class="Estilo11">P/UNITARIO</span></th>
    <th bgcolor="#0061a9" colspan="12" style="color:white;font-size:8px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width: 12%"><span class="Estilo11">VENTAS AFECTAS</span></th>
</tr>


<tr style="height:40px;">
<td colspan="15" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;margin:20px;height: 95px;width: 15%;text-align: center;">
   <?php 
    for ($i=0; $i < sizeof($datos_factura_cantidad); $i++) {
     ?><span style="margin-left: 0px !important"><?php echo $datos_factura_cantidad[$i]["cantidad_venta"]?></span><br>
     <?php } ?>     
  </td>
 
  <td colspan="67" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: left;margin:20px;text-transform: uppercase;width: 67%;text-align: center;
  ">
     <?php 
    for ($i=0; $i < sizeof($datos_factura_producto); $i++) {
     echo "&nbsp;&nbsp;&nbsp;".$datos_factura_producto[$i]["producto"]?><br>
     <?php } ?>    
  </td>
 
   <td colspan="11" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px;width: 11%">

    <?php 
    for ($i=0; $i < sizeof($datos_factura_precio_u); $i++) {
     echo "$".number_format($datos_factura_precio_u[$i]["precio_final"],2,".",",");?><br>
     <?php } ?> 
    
  </td>

    <td colspan="12" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px;width: 12%">

    <?php 
    $subtotal=0;
    for ($i=0; $i < sizeof($datos_factura_subtotal); $i++) {
      $subtotal=$subtotal+$datos_factura_subtotal[$i]["subtotal"];
     echo "$".number_format(($datos_factura_subtotal[$i]["subtotal"]),2,".",",");?><br>

     <?php } ?>
   
  </td>
 
</tr>
</table>

<table width="100%" class="table2">
  <tr>
    <td  colspan="100" style="border: white 1px solid;"></td>
</tr>
<tr>
<th bgcolor="#0061a9" colspan="14" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 14%"><span class="Estilo11">MONTO</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">ABONOS ANT.</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">ABONO ACT.</span></th>
    <th bgcolor="#0061a9" colspan="20" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 20%"><span class="Estilo11">SALDO</span></th>
    <th bgcolor="#0061a9" colspan="22" style="font-size:12px;border:#0061a9 1px solid;color:white;font-family: Helvetica, Arial, sans-serif;width: 22%"><span class="Estilo11">FORMA  PAGO</span></th>
</tr>
<?php
  for($i=0;$i<sizeof($datos_recibo);$i++){
?>
<tr style="font-size:10pt" class="even_row">
    <td style="text-align: center;width: 14%" colspan="14" class="stilot1"><span class=""><?php echo "$ ".$datos_recibo[$i]["monto"];?></span></td>
    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo "$".number_format(floatval($datos_recibo[$i]["a_anteriores"]),2,".",",");?></span></td>

    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo "$ ".number_format(floatval($datos_recibo[$i]["abono_act"]),2,".",",");?></span></td>
    <td style="text-align: center;width: 20%" colspan="20" class="stilot1"><span class=""><?php echo "$ ".$datos_recibo[$i]["saldo"];?></span></td>
    <td style="text-align: center;width: 22%" colspan="22" class="stilot1"><span class=""><?php echo $datos_recibo[$i]["forma_pago"];?></span></td>
</tr>

<tr style="font-size:10pt" class="even_row">
    <td style="text-align: left;" colspan="100" class="stilot1"><span class="">OBSERVACIONES:&nbsp;<?php echo $datos_recibo[$i]["observaciones"];?></span></td>
    
</tr>
<tr>
    <td  colspan="100" style="border: white 1px solid;padding: 5px"></td>

</tr>
<tr>
    <td  colspan="100" class="stilot3"><span>Nota: Yo&nbsp;<?php echo $datos_recibo[$i]["recibi_de"];?>: Declaro que me fue explicada de forma detallada y explícita las caracteristicas del aro,lentes,accesorios o tratamientos que estoy adquiriendo con el servicio recibido de lo cual firmo conforme. </span></td>
</tr>
<tr>
    <td  colspan="100" style="border: white 1px solid;padding: 5px">.</td>

</tr>
<tr>
    <td  colspan="40" class="stilot3">Firma paciente:___________________________</td>
    <td  colspan="30" class="stilot3"><div align="center"><span class=""><?php echo "Asesor:".": ".$datos_recibo[$i]["id_usuario"];?></span></div></td>
    <td  colspan="30" class="stilot3"><?php echo $datos_recibo[$i]["numero_venta"];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px"><strong>Duplicado: Cliente</strong></span></td>
</tr>

</table>
<?php
  }
?>
</div>
</body>
</html>
<?php
$salida_html = ob_get_contents();

  //$user=$_SESSION["id_usuario"];

  ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>