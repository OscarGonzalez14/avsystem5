<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';

require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();

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

<table style="width: 100%;">
<tr>
<td width="20%"><h1 style="text-align: left; margin-right:20px;"><img src="images/logooficial.jpg" width="100" height="50"  /></h1></td>

<td width="65%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:18px"><strong>CORTE DE CAJA DIARIO</strong></td>
  </tr>
    
</table><!--fin segunda tabla-->
</td>
<td width="15%">
<table>
    <?php date_default_timezone_set('America/El_Salvador');
    $date_act = date("d-m-Y H:i:s");?>
  <tr>
    <td style="text-align:right; font-size:12px"><strong style="text-align:right; font-size:13px">No. Corte</strong></td>
  </tr>
  <tr>
    <td style="text-align:right;font-size:15px;color:red;"><span style="font-size:16px"><?php echo $date_act;?></strong></td>
  </tr>  
</table><!--fin segunda tabla-->
</td> <!--fin segunda columna--> 
</tr>
</table>
<div style="width:100%;margin-top:0px;">
<table style="width:100%">
<tr>
  <th bgcolor="black" colspan="105" style="font-size:12px;color:white;width:100%;text-align:center"><span >VENTAS DE CONTADO</span></th>
</tr>
  <tr>
    <th bgcolor="#034f84" colspan="5" style="font-size:12px;color:white;width:5%"><span >#Factura</span></th>
    <th bgcolor="#034f84" colspan="5" style="font-size:12px;color:white;width:5%"><span >#Recibo</span></th>
    <th bgcolor="#034f84" colspan="5" style="font-size:12px;color:white;width:5%"><span >#Venta</span></th>
    <th bgcolor="#034f84" colspan="25" style="font-size:12px;color:white;width:25%"><span >Nombre Cliente</span></th>
    <th bgcolor="#034f84" colspan="23" style="font-size:12px;color:white;width:23%"><span >Vendedor</span></th>
    <th bgcolor="#034f84" colspan="10" style="font-size:12px;color:white;width:10%"><span >Monto Credito</span></th>
    <th bgcolor="#034f84" colspan="12" style="font-size:12px;color:white;width:12%"><span >Forma Cobro</span></th>
    <th bgcolor="#034f84" colspan="10" style="font-size:12px;color:white;width:10%"><span >Total cobrado</span></th>
    <th bgcolor="#034f84" colspan="10" style="font-size:12px;color:white;width:10%"><span >Saldo</span></th>
</tr>
</body>
</html>
<?php
$salida_html = ob_get_contents();

  //$user=$_SESSION["id_usuario"];

  ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>