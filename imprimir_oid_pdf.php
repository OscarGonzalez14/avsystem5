
<?php ob_start();

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
  $id_paciente =$_GET["id_paciente"];
 // $n_venta =$_GET["n_venta"];
  $n_orden =$_GET["n_orden"];
  $sucursal = $_GET["sucursal"];
if ($sucursal == "Metrocentro" or $sucursal == "Empresarial-Metrocentro") {
  $encabezado = "OPTICA AV PLUS S.A de C.V.";
  $direccion = "Boulevard de los Heroes. Centro Comercial Metrocentro Local#7 San Salvador";
  $telefono = "2260-1653";
  $wha = "7469-2542";
  $correo = "metrocentro@opticaavplussv.com";
  $dir2="San Salvador";
  $info="";
}elseif ($sucursal == "San Miguel" or $sucursal == "Empresarial-San Miguel") {
  $encabezado = "
  OPTICA AV PLUS";
  $direccion = "San Miguel, 3<sup>ra</sup> Calle Poniente Av. Roosevelt Sur Esquina #115";
  $telefono = "2661-7549";
  $wha ="6955-3056";
  $dir2="San Miguel";
  $info="<b>CARMEN ARELY VASQUEZ FLORES</b><br><strong>NIT:</strong> 0610-201188-102-4&nbsp;&nbsp;<b>No. Registro</b>: 295093-3<br>
  <b>Giro:</b> Venta al por mayor de artículos de óptica";
  $correo = "opticaavplussanmiguel@gmail.com";
}elseif ($sucursal == "Santa Ana" or $sucursal == "Empresarial-Santa Ana"){
    $encabezado = "
    OPTICA AVPLUS S.A de C.V.";
    $direccion = " 61 Calle Pte. Block K9 #10, Col, Avenida El Trebol, Santa Ana";
    $telefono = "2445 3150";
    $wha = "-";
    $correo = "opticaavplussantana@gmail.com";
    $dir2="Santa Ana";
    $info="";
}elseif ($sucursal == "Chalatenango"  or  $sucursal == "Empresarial-Chalatenango"){
    $encabezado = "OPTICA AV PLUS S.A DE C.V.";
    $direccion = "Carr. Troncal Del Nte. 48 ½, Plaza Don Yon, local #6, 3<sup>ra</sup> Etapa, Coyolito, Chalatenango";
    $telefono = "2260-1653";
    $wha = "7469-2542";
    $correo = "opticaavpluschalatenango@gmail.com";
    $dir2="Chalatenango";
    $info="";
}
//$datos_recibo = $reporteria->print_recibo_paciente($_GET["n_recibo"],$_GET["n_venta"],$_GET["id_paciente"]);
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$datos_paciente = $reporteria->get_datos_factura_paciente($id_paciente);
$data_orden_desc = $reporteria->get_data_orden_credito($id_paciente,$n_orden);
$suma_monto_orden=0;

 $evaluados_oid = $reporteria->beneficiarios_oid($id_paciente,$n_orden);

  for ($i=0; $i <sizeof($evaluados_oid) ; $i++) {
    $monto = $evaluados_oid[$i]["monto_total"];
    $suma_monto_orden = $suma_monto_orden+number_format($monto,2,".",",");
  }
 //echo $suma_monto_orden;

/////////////RECORRER DATA ORDEN DE DESCUENTO
for ($i=0; $i <sizeof($data_orden_desc) ; $i++) { 
    $monto_orden = $data_orden_desc[$i]["monto"];
    $plazo_credito = $data_orden_desc[$i]["plazo"];
    
    $inicio_credito = $data_orden_desc[$i]["fecha_inicio"];
    $fin_credito = $data_orden_desc[$i]["fecha_finalizacion"];
    $ref_uno = $data_orden_desc[$i]["ref_uno"];
    $tel_ref_uno = $data_orden_desc[$i]["tel_ref_uno"];
    $ref_dos = $data_orden_desc[$i]["ref_dos"];
    $tel_ref_dos = $data_orden_desc[$i]["tel_ref_dos"];
    $observaciones_oid = $data_orden_desc[$i]["observaciones"];
}

$cuotas_creditos = $suma_monto_orden/$plazo_credito;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
    body{
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
    }
      html{
        margin-top: 10px;
        margin-left: 30px;
        margin-right:20px; 
        margin-bottom: 0px;
    }
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

<table style="width: 100%;margin-top:2px">
<tr>

<td width="10%" style="width: 10%;margin:0px"><img src="images/logooficial.jpg" width="130" height="75"/></td>
<td width="75%" style="width: 75%;margin:0px">
<table style="width:100%">
 <tr>
    <td style="text-align:center; font-size:16px";font-family: Helvetica, Arial, sans-serif;><strong><?php echo $encabezado; ?></strong></td>
  </tr>
  <tr>
    <td  style="text-align: center;margin-top: 0px;color:#0088b6;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><b>ORDEN DE DESCUENTO EN PLANILLA</b></td>
  </tr>
  <tr>
    <td style="text-align: center;margin-top: 0px;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><?php echo $info; ?>      
    </td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong> <?php echo $wha;?>&nbsp;&nbsp;&nbsp;</span><br><b>E-mail:</b> <?php echo $correo;?></td>
  </tr>
</table><!--fin segunda tabla-->
</td>
<td width="30%" style="width: 30%;margin:0px">
<table>
  <tr>
    <td style="text-align:right; font-size:12px"><strong>ORDEN</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $n_orden; ?></strong></td>
  </tr>
</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>
<span style="text-align: right;font-size:11px;font-family: Helvetica, Arial, sans-serif;" align="right"><?php echo $dir2.",&nbsp;".$hoy;?></span>
<div style="width:100%;margin-top:0px;font-size:12px;font-family: Helvetica, Arial, sans-serif;height: 885px">
<!--INICIO GET DATA PACIENTES-->
<?php    
    for($j=0; $j<count($datos_paciente);$j++){
      $empresa_pac = $datos_paciente[$j]["empresas"];
      $nombre_pac = $datos_paciente[$j]["nombres"];
     ?>
      <span> <b>EMPRESA:</b>&nbsp; <u><?php echo $datos_paciente[$j]["empresas"]."."?></u></span><br>
      <span style="font-size:13px;font-family: Helvetica, Arial, sans-serif;">Por la presente y de confirmidad con el artículo N° 136 del código de trabajo, publicado en el Diario Oficial del 31 de Julio de 1972, autorizo a usted a descontar de mi sueldo mensual que devengo en esta empresa como empleado(a) de la misma; la cantidad de:&nbsp;<b style="color: black"><u><?php echo "$".number_format($suma_monto_orden,2,".",",");?></u></b> en <?php echo $plazo_credito?> cuotas mensuales de: <b><u><?php echo "$".number_format($cuotas_creditos,2,".",",");?></u></b>, las cuales deberán pagar por mi cuenta a partir de: <u><?php echo date("d-m-Y", strtotime($inicio_credito));?></u> hasta <u><?php echo date("d-m-Y", strtotime($fin_credito));?></u>. Por lo tanto autorizo a que se realicen los pagos en concepto de producto y servicios visuales. <br><br>  <b>Atentamente.</b><br></span>

  <table width="100%" class="table2">
        <tr>
    <th colspan="100" style="color:black;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>TITULAR DE CUENTA</b></th>  
    </tr>
    <tr>
      <th colspan="45" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:45%" bgcolor="#c5e2f6"><b>NOMBRE COMPLETO</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>FUNCIÓN LABORAL</b></th>
      <th colspan="25" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:25%" bgcolor="#c5e2f6"><b>DEPARTAMENTO</b></th>
    </tr>
    <tr>
      <td colspan="45" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:45%;text-align: center"><?php echo $datos_paciente[$j]["nombres"];?></td>
      <td colspan="30" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $datos_paciente[$j]["ocupacion"];?></td>
      <td colspan="25" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:25%;text-align: center"><?php echo strtoupper($datos_paciente[$j]["empresa_dept"]);?></td>
    </tr>

    <tr>
      <th colspan="10" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:10%" bgcolor="#c5e2f6"><b>COD. EMP.</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>EDAD</b></th>
      <th colspan="15" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:15%" bgcolor="#c5e2f6"><b>TELEFONO</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>TEL. OFICINA</b></th>
      <th colspan="25" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:25%" bgcolor="#c5e2f6"><b>DUI</b></th>
    </tr>
    <tr>
      <td colspan="10" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $datos_paciente[$j]["departamento"];?></td>
      <td colspan="20" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:10%;text-align: center"><?php echo $datos_paciente[$j]["edad"]." años";?></td>
      <td colspan="15" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:15%;text-align: center"><?php echo $datos_paciente[$j]["telefono"];?></td>
      <td colspan="30" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $datos_paciente[$j]["telefono_oficina"];?></td>
      <td colspan="25" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:25%;text-align: center"><?php echo $datos_paciente[$j]["dui"];?></td>
    </tr>
    <tr>
      <td colspan="100" style="font-size:12px;border: 1px solid black;font-family: Helvetica, Arial, sans-serif;width:100%">&nbsp;&nbsp;<b>DIRECCIÓN COMPLETA:</b>&nbsp;<?php echo $datos_paciente[$j]["direccion"];?></td>
      
    </tr>
  </table>
<br>    
  <table width="100%" class="table2">
    <tr>
    <th colspan="100" style="color:black;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DETALLES CRÉDITO</b></th>  
    </tr>
    <tr>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>REFERENCIA 1</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>TEL. REFERENCIA 1</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>REFERENCIA 2</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>TEL. REFERENCIA 2</b></th>
    </tr>
    <tr>
      <td colspan="30" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $ref_uno;?></td>
      <td colspan="20" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $tel_ref_uno;?></td>
      <td colspan="30" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $ref_dos;?></td>
      <td colspan="20" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $tel_ref_dos;?></td>
    </tr>
    
  </table><br>

  <?php }?>

  <?php
  $html="";

  $evaluados_oid = $reporteria->beneficiarios_oid($id_paciente,$n_orden);
  for ($i=0; $i <sizeof($evaluados_oid) ; $i++) { 
    $evaluado = $evaluados_oid[$i]["evaluado"];
    
    $det_ventas_flot = $reporteria->get_detalle_vf_beneficiario($evaluado,$n_orden);
    $html.="<thead><tr><th colspan='100' style='width:100%;text-align:center;border: solid 1px black' bgcolor='#c5e2f6'>".$evaluado."</th></tr></thead>       

    ";
    $total=0;
    foreach ($det_ventas_flot as $k => $v) {
      $precio= $v["precio_final"];
      $total = $total+$precio;
      $html.="
      <tr>
          <td colspan='25' style='width:25%;text-align:center;border: solid 1px black'>".$v["cantidad_venta"]."</td>
          <td colspan='50' style='width:50%;text-align:center;border: solid 1px black'>".$v["producto"]."</td>
          <td colspan='25' style='width:25%;text-align:center;border: solid 1px black'>"."$".number_format($v["precio_final"],2,".",",")."</td>
      </tr>   
     
     

      ";
    }
    $html.="<tr>
        <td colspan='75' style='text-align:center;background:#C8C8C8;color;black;'>TOTAL</td>
        <td colspan='25' style='text-align:center;background:#C8C8C8;color;black;'><b>"."$".number_format($total,2,".",",")."</b></td>
      </tr><tr><td style='color:white;'>H</td></tr>";

  }

  ?>
 <table width="100%" class="table2">
  <tr>
    <th colspan="100" style="color:black;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>BENEFICIARIOS Y SERVICIOS</b></th>  
    </tr>
    <tr>
        <td colspan='25' style='width:25%;text-align:center;border: solid 1px black;background:#034f84;color: white'>CANTIDAD</td>
        <td colspan='50' style='width:50%;text-align:center;border: solid 1px black;background:#034f84;color: white'>DESCRIPCION</td>
        <td colspan='25' style='width:25%;text-align:center;border: solid 1px black;background:#034f84;color: white'>PRECIO</td>
      </tr> 
 <?php echo $html;?>

 <tfoot style="margin-top: 0px">
   <tr>
     <td colspan="100" width="100%" style='width:100%;text-align:left;border: solid 1px black'>OBSERVACIONES: <span style="text-transform: uppercase;padding: 5px"><?php echo $observaciones_oid;?></span></td>
   </tr>
 </tfoot> 
</table>

<br><br>   
<table width="100%">
  <tr>
    <td colspan="50"style="text-align: center"><u>______________________________________</u></td>
    <td colspan="50"style="text-align: center"><u>______________________________________</u></td>
  </tr>
  <tr>
    <td colspan="50"style="text-align: center">Firma del solicitante</td>
    <td colspan="50"style="text-align: center">Firma y sello Óptica AV Plus</td>
  </tr>
</table>  
<!--FIN INICIO GET DATA PACIENTES-->

 <br>

 <div style="border: solid 1px black;">
 <h3 style="text-align: center;">AREA DE PAGADURÍA <?php echo strtoupper($empresa_pac)?></h3>
 <div style="margin: 8px">
 <b style="font-size: 11px">Presente.</b><br> 
 <span style="font-size: 12px;text-align: justify;text-justify:inter-word;">Al tomar nota de la carta anterior nos comprometemos con optica AV Plus a descontar del sueldo mensual de Sr.(a) con nombre <u><?php echo strtoupper($nombre_pac)?>.</u> Las cuotas de <b><?php echo "$".number_format($cuotas_creditos,2,".",","); ?></b>, durante un período de tiempo que consta de <?php echo $plazo_credito." meses "?>para remitirlas a su cuenta con forma de pago: ____Mensual ___Quincenal. Cada Fecha:_______________________</span>
 <br><br>
 <table width="100%">
  <tr>
    <td colspan="50"style="text-align: center"><u>____________________________________________</u></td>
    <td colspan="50"style="text-align: center"><u>______________________________________</u></td>
  </tr>
  <tr>
    <td colspan="50"style="text-align: center">Firma y nombre de tesorero o pagador</td>
    <td colspan="50"style="text-align: center">Sello de Aprobación</td>
  </tr>
  <tr>
    <td colspan="100" style="color: white">H</td>
  </tr>
  <tr>
    <td colspan="100"style="text-align: center">Telefonos: _____________________________</td>
  </tr>
</table>
</div>
</div>
<span style="text-align: right;font-size: 9px;margin-top: 8PX" align="right">Este documento ha sido emitido por el departamento Empresarial de Óptica AV Plus y creado por: <?php echo $_SESSION["nombres"]."&nbsp;-&nbsp;".$hoy;?></span>
</div><!--Fin primera parte-->




<?php
//$datos_recibo = $reporteria->print_recibo_paciente($_GET["n_recibo"],$_GET["n_venta"],$_GET["id_paciente"]);
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$datos_paciente = $reporteria->get_datos_factura_paciente($id_paciente);
$data_orden_desc = $reporteria->get_data_orden_credito($id_paciente,$n_orden);
/////////////RECORRER DATA ORDEN DE DESCUENTO
for ($i=0; $i <sizeof($data_orden_desc) ; $i++) { 
    $monto_orden = $data_orden_desc[$i]["monto"];
    $plazo_credito = $data_orden_desc[$i]["plazo"];
    $cuotas_creditos = $monto_orden/$plazo_credito;
    $inicio_credito = $data_orden_desc[$i]["fecha_inicio"];
    $fin_credito = $data_orden_desc[$i]["fecha_finalizacion"];

    $ref_uno = $data_orden_desc[$i]["ref_uno"];
    $tel_ref_uno = $data_orden_desc[$i]["tel_ref_uno"];
    $ref_dos = $data_orden_desc[$i]["ref_dos"];
    $tel_ref_dos = $data_orden_desc[$i]["tel_ref_dos"];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
    body{
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
    }
      html{
        margin-top: 10px;
        margin-left: 30px;
        margin-right:20px; 
        margin-bottom: 0px;
    }
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

<table style="width: 100%;margin-top:2px">
<tr>
<td width="10%"><img src="images/logooficial.jpg" width="130" height="75"/></td>

<td width="75%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:16px";font-family: Helvetica, Arial, sans-serif;><strong><?php echo $encabezado; ?></strong></td>
  </tr>
  <tr>
    <td  style="text-align: center;margin-top: 0px;color:#0088b6;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><b>PAGARÉ SIN PROTESTO</b></td>
  </tr>
    <tr>
    <td style="text-align: center;margin-top: 0px;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><?php echo $info; ?>      
    </td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>

  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong> <?php echo $wha;?>&nbsp;&nbsp;&nbsp;</span><br><b>E-mail:</b> <?php echo $correo;?></td>
  </tr>


</table><!--fin segunda tabla-->
</td>
<td width="30%">
<table>
  <tr>
    <td style="text-align:right; font-size:12px"><strong>ORDEN</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $n_orden; ?></strong></td>
  </tr>
</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>
<p style="text-align: right;font-size:11px;font-family: Helvetica, Arial, sans-serif;" align="right"><?php echo $dir2.",&nbsp;".$hoy;?></p>
<div style="width:100%;margin-top:0px;font-size:12px;font-family: Helvetica, Arial, sans-serif;height: 835px">
<!--INICIO GET DATA PACIENTES-->
<?php    
    for($j=0; $j<count($datos_paciente);$j++){
      $empresa_pac = $datos_paciente[$j]["empresas"];
      $nombre_pac = $datos_paciente[$j]["nombres"];
     ?>

  <p style="font-size:15px;text-align:justify;font-family: Helvetica, Arial, sans-serif;">
  Por: <strong>$<span><?php echo number_format($suma_monto_orden,2,".",",");?></span></strong>
<br><br><br>
Por este pagaré, Yo:<strong><span>&nbsp;<?php echo $nombre_pac;?></span></strong>  de <strong><span>&nbsp;<?php echo $datos_paciente[$j]["edad"];?></span></strong>   años de edad; del domicilio de:<strong><span>&nbsp;<?php echo $datos_paciente[$j]["direccion"];?> </span></strong>   Departamento de: San Salvador  con Documento Único de Identidad número: <strong><span>&nbsp;<?php echo $datos_paciente[$j]["dui"];?></span></strong>(en adelante, “el Deudor”), prometo pagar incondicionalmente a Optica AV Plus S. A. de C. V. de este  domicilio,  con número de Identificación Tributaria No. 0614 191018 101 1 (Adelante, el “Acreedor”), la suma de &nbsp;<strong>$<span><?php echo number_format($suma_monto_orden,2,".",",");?></span></strong>&nbsp;Dolares de Estados Unidos de America, moneda de curso legal, en dinero en efectivo, en caso de retraso el día sesenta.  El Deudor cancelará la presente obligación mediante un solo pago. El pago lo hará el Deudor en cualquiera de las sucursales de Optica AV Plus.<br><br><br>

<strong>La suma adeudada contenida en este pagaré, devengará los siguientes intereses:</strong><br>
a)&nbsp;<u>De 30 a 60 días posteriores al plazo de pago, el cero por ciento de interés (5%) sobre monto total.</u><br>
b)&nbsp;<u>De 61 a 90 días posteriores al plazo de pago, el cinco por ciento de interés (5%) anual.</u><br>
c)&nbsp;<u>De 91 en adelante al plazo de pago, un diez por ciento de interés (10.0%) anual.</u><br><br><br>

En caso de incumplimiento de pago en los términos aquí prometidos o de incumplimiento de cualquier otro compromiso aquí establecido, el Acreedor podrá tener por vencida, liquida y exigible la obligación y recurrir legalmente a su cobro, renunciando el Deudor a su domicilio y a los requerimientos de pago. En caso de ejecución, el Deudor responderá por la suma que se le adeude al Acreedor en ese momento por concepto de capital así como los intereses ordinarios que adeude conforme a las tasas referidas. La obligación del Deudor se origina de operaciones mercantiles entre el Acreedor y el Deudor. Este título se rige por las disposiciones del Código de Comercio y se suscribe en San Salvador, El Salvador.<br><br><br>

Para los efectos de esta obligación mercantil el Deudor fija como domicilio especial la ciudad de San Salvador, a cuyos tribunales se somete y en caso de acción judicial renuncia al derecho de apelar del decreto de embargo, sentencia de remate y de toda otra providencia apelable que se dictare en su contra en el juicio mercantil ejecutivo o en sus incidentes, siendo a cargo del Deudor los costos procesales y cualquier otro gastos que el Acreedor hiciere en el cobro de este Pagaré, inclusive los llamados gastos personales y aun cuando por regla general no hubiere condenación en costos y faculta al Acreedor para que designe a su entera libertad a la persona depositaria de los bienes que se embarguen, a quien releva de la obligación de rendir fianza.<br><br><br>

Firmo de conformidad de lo anteriormente mencionado<br>

San Salvador, El Salvador,&nbsp;<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y"); echo $hoy; ?><br><br>
Firma  Deudor: ______________________
</p>
<?php
  }
?>
     
</div>
<p style="text-align: right;font-size: 9px" align="right">Este documento ha sido emitido por el departamento Empresarial de Óptica AV Plus y creado por: <?php echo $_SESSION["nombres"]."&nbsp;-&nbsp;".$hoy;?></p>
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
<?php  } else{

     header("Location: index.php");
  }?>
  