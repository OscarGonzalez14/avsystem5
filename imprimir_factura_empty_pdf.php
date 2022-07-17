<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';
require_once 'pages/convierte_a_texto.php';
require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
$id_paciente =$_GET["id_paciente"];
$n_venta =$_GET["n_venta"];
$correlativo = $_GET["correlativo_f"];

$datos_factura_cantidad = $reporteria->get_datos_factura_cantidad($_GET["n_venta"],$_GET["id_paciente"]);
$datos_factura_producto = $reporteria->get_datos_factura($_GET["n_venta"],$_GET["id_paciente"]);
$datos_factura_precio_u = $reporteria->get_datos_factura_p_unitario($_GET["n_venta"],$_GET["id_paciente"]);
$datos_factura_subtotal = $reporteria->get_datos_factura_subtotal($_GET["n_venta"],$_GET["id_paciente"]);
$datos_factura_paciente = $reporteria->get_datos_factura_paciente($_GET["id_paciente"]);
$datos_factura_venta    = $reporteria->get_datos_factura_venta($_GET["n_venta"],$_GET["id_paciente"]);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
      html{
        margin-top: 0;
        margin-left: 28px;
        margin-right:20px; 
        margin-bottom: 0;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       border-collapse: collapse;
       text-align: center;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }

    #table2 {
       border-collapse: collapse;
    }
   </style>
  </head>
  <body>
 <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<div style="margin-top: 130px;height:500px" >
  <table width="100%">
    <tr>
      <?php

  for($i=0;$i<sizeof($datos_factura_paciente);$i++){

?>
  <td colspan="30" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 65%"><strong>EDWIN ARMANDO CLAROS NAVARRO.</strong></td>

    <td colspan="18" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 18%"><strong>TELEFONO:</strong></td>
    <td colspan="17" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 17%"><strong>FECHA:</strong> <?php echo "19/08/2021";?></td>
    <?php
  }
?>
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
 
     <span style="margin-left: 0px !important">1</span><br>
     <span style="margin-left: 0px !important">1</span><br>
    
  </td>
 
  <td colspan="50" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 10px;text-align: left;margin:20px;text-transform: uppercase;
  ">
   <span style="margin-left: 0px !important">ARO ANDVAS MOD. A2036 COLOR C3</span><br>
   <span style="margin-left: 0px !important">LENTE VISIÓN SENCILLA BLANCO POLY AR GREEN</span><br>
  </td>
 
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px">

     
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px">
     <span style="margin-left: 0px !important">$30.00</span><br>
     <span style="margin-left: 0px !important">$70.00</span><br>
  </td>
</tr>

<tr>
  <td colspan="60" rowspan="2" class="stilot1" style="width: 60%;text-align: left"><b>SON</b>: <?php echo "CUARENTA DOLARES. 00/100"//echo numletras(number_format($subtotal,2,".",","),$_moneda);?></td>
  <td colspan="10" class="stilot1" style="font-size:8px">SUMAS</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="font-size:8px"><?php echo "$60.00";//echo "$".number_format($subtotal,2,".",","); ?></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA EXENTA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
</tr>
<tr>
  <td colspan="60" class="stilot1" style="font-size:8px">LLENAR SI LA OPERACIÓN IGUAL O MAYOR A $200.00</td>
  <td colspan="20" class="stilot1"></td>
  <td colspan="20" class="stilot1"></td>
</tr>

<tr>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Entregado por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Recibido por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="20" class="stilot1" style="font-size:8px; height:8px">SUBTOTAL</td>
  <td colspan="10" class="stilot1" style="height:8px"></td>
  <td colspan="10" class="stilot1" style="height:8px"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">(1%)IVA RETENIDO</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="font-size:8px"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA NO SUJETA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px"><strong>TOTAL</strong></td>
  <td colspan="20" class="stilot1"><strong><?php echo "$60.00"; //echo "$".number_format($subtotal,2,".",",");?></strong></td>
</tr>
</table>
<?php
  for($i=0;$i<sizeof($datos_factura_venta);$i++){
 ?>

<p style="font-size: 10px;text-align: right;"></p>
    <?php
  }
?>
</div>

<!--ORIGINAL EMISOR-->
<div style="margin-top: 30px;max-height:100px" >
   <table width="100%">
    <tr>
      <?php

  for($i=0;$i<sizeof($datos_factura_paciente);$i++){

?>
  <td colspan="30" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 65%"><strong>EDWIN ARMANDO CLAROS NAVARRO.</strong></td>

    <td colspan="18" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 18%"><strong>TELEFONO:</strong></td>
    <td colspan="17" style="color:black;font-size:9px;border: 1px solid white;font-family: Helvetica, Arial, sans-serif;width: 17%"><strong>FECHA:</strong> <?php echo "19/08/2021";?></td>
    <?php
  }
?>
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
 
     <span style="margin-left: 0px !important">1</span><br>
     <span style="margin-left: 0px !important">1</span><br>
    
  </td>
 
  <td colspan="50" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size: 10px;text-align: left;margin:20px;text-transform: uppercase;
  ">
   <span style="margin-left: 0px !important">ARO ANDVAS MOD. A2036 COLOR C3</span><br>
   <span style="margin-left: 0px !important">LENTE VISIÓN SENCILLA BLANCO POLY AR GREEN</span><br>
  </td>
 
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px">

     
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black">
      
  </td>
  <td colspan="10" style="border: 1px solid black;font-family: Helvetica, Arial, sans-serif;font-size:10px;text-align: center;margin:20px">
     <span style="margin-left: 0px !important">$30.00</span><br>
     <span style="margin-left: 0px !important">$70.00</span><br>
  </td>
</tr>

<tr>
  <td colspan="60" rowspan="2" class="stilot1" style="width: 60%;text-align: left"><b>SON</b>: <?php echo "CUARENTA DOLARES. 00/100"//echo numletras(number_format($subtotal,2,".",","),$_moneda);?></td>
  <td colspan="10" class="stilot1" style="font-size:8px">SUMAS</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="font-size:8px"><?php echo "$60.00";//echo "$".number_format($subtotal,2,".",","); ?></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA EXENTA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
</tr>
<tr>
  <td colspan="60" class="stilot1" style="font-size:8px">LLENAR SI LA OPERACIÓN IGUAL O MAYOR A $200.00</td>
  <td colspan="20" class="stilot1"></td>
  <td colspan="20" class="stilot1"></td>
</tr>

<tr>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Entregado por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="30" rowspan="4" class="stilot1" style="width: 60%;text-align: left;font-size: 9px">
  Recibido por:<br>
  Nombre:<br>
  DUI:<br>
  Firma:<br>
  </td>
  <td colspan="20" class="stilot1" style="font-size:8px; height:8px">SUBTOTAL</td>
  <td colspan="10" class="stilot1" style="height:8px"></td>
  <td colspan="10" class="stilot1" style="height:8px"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">(1%)IVA RETENIDO</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1" style="font-size:8px"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px">VENTA NO SUJETA</td>
  <td colspan="10" class="stilot1"></td>
  <td colspan="10" class="stilot1"></td>
</tr>
<tr>
  <td colspan="20" class="stilot1" style="font-size:8px"><strong>TOTAL</strong></td>
  <td colspan="20" class="stilot1"><strong><?php echo "$60.00"; //echo "$".number_format($subtotal,2,".",",");?></strong></td>
</tr>
</table>
<?php
  for($i=0;$i<sizeof($datos_factura_venta);$i++){
 ?>

<p style="font-size: 10px;text-align: right;"></p>
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
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>