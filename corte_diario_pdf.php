<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';

require_once("modelos/Reporteria.php");
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
//echo $_SESSION["sucursal"];
date_default_timezone_set('America/El_Salvador');$fecha = date("d-m-Y");
$fecha_imp = date("d-m-Y H:i:s a");
$reporteria=new Reporteria();
$categoria = $_SESSION["categoria"];
//echo $categoria;
if ($categoria == "administrador") {
  $sucursal = $_SESSION["sucursal"]."-";
}elseif($_SESSION["sucursal"]=="Empresarial"){
    $sucursal="Empresarial-".$_SESSION["sucursal_usuario"];
}elseif($_SESSION["sucursal"]!="Empresarial" and $categoria != "administrador"){
  $sucursal = $_SESSION["sucursal_usuario"];
}

//$sucursal = $_POST["sucursal_user"];
$usuario = $_POST["usuario"];
$fecha =  date("d-m-Y",strtotime($_POST["fecha_corte"]));

$datos_ventas_contado = $reporteria->get_datos_ventas_cobros_contado($fecha,$sucursal);
$datos_ventas_empresarial = $reporteria->get_datos_ventas_empresarial($fecha,$sucursal);
$datos_ventas_c_auto = $reporteria->get_datos_ventas_cargo($fecha,$sucursal);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
      html{
        margin-top: 0;
        margin-left: 18px;
        margin-right:18px; 
        margin-bottom: 0;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 8px;
       font-family: Helvetica, Arial, sans-serif;
       text-align: center;
    }

    .stilot2{      
       text-align: center;
       font-size: 8px;
       font-family: Helvetica, Arial, sans-serif;
       color:white;
    }
    .stilot3{
       text-align: center;
       font-size: 8px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .table2 {
       border-collapse: collapse;
    }
    .vendedor{
      text-transform: uppercase;

    }

    @page { margin: 180px 50px; } 
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; } 
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; } 
    #footer .page:after { content: counter(page, upper-roman); } 
   </style>
  </head>
  <body>

<!-- VENTAS CONTADO-->
<table width="100%" class="table2" style="margin-top: 55px">
  <tr>
    <td colspan="35">Fecha : <span><?php echo $fecha;?></span></td>
    <td colspan="35">Sucursal: <span><?php echo $sucursal;?></span></td>
    <td colspan="35" style="font-size: 11px;text-align: right;" align="right">Impreso por: <span><?php echo ucfirst($usuario)." ".$fecha_imp;?></span></td>
  </tr>
  <tr><td colspan="105"></td></tr>
    <tr>
     <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">VENTAS DE SUCURSAL</th>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="50" class="stilot2"><span class="Estilo11">NOMBRE CLIENTE</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="20" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($datos_ventas_contado);$j++){
if(($datos_ventas_contado[$j]["monto_cobrado"])>0){
  $monto_c = $datos_ventas_contado[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}

?>
  <tr>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_contado[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_contado[$j]["n_recibo"];?></td>
<td colspan="50" class="stilot1"><?php echo $datos_ventas_contado[$j]["paciente"];?></td>
<td colspan="5" class="stilot1 vendedor"><?php echo $datos_ventas_contado[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($datos_ventas_contado[$j]["total_factura"],2,".",",");?></td>
<td colspan="20" class="stilot1 vendedor"><?php echo $datos_ventas_contado[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1" style="color: blue"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($datos_ventas_contado[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>
</tbody>
</table>
<!-- VENTAS EMPRESARIAL-->

<table width="100%" class="table2" style="margin-top: 2px">
      <tr>
      <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">VENTAS DESCUENTO EN PLANILLA</th>
    </tr>
  <thead>
  <tr>    
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="35" class="stilot2"><span class="Estilo11">NOMBRE CLIENTE</span></th>
    <th bgcolor="#004e00" colspan="20" class="stilot2"><span class="Estilo11">EMPRESA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="15" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($datos_ventas_empresarial);$j++){

if(($datos_ventas_empresarial[$j]["monto_cobrado"])>0){
  $monto_c = $datos_ventas_empresarial[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}
?>  

<tr>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_empresarial[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_empresarial[$j]["n_recibo"];?></td>
<td colspan="35" class="stilot1"><?php echo $datos_ventas_empresarial[$j]["nombres"];?></td>
<td colspan="20" class="stilot1"><?php echo $datos_ventas_empresarial[$j]["empresas"];?></td>
<td colspan="5" class="stilot1 vendedor"><?php echo $datos_ventas_empresarial[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($datos_ventas_empresarial[$j]["total_factura"],2,".",",");?></td>
<td colspan="15" class="stilot1 vendedor"><?php echo $datos_ventas_empresarial[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($datos_ventas_empresarial[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>
</tbody>
</table>

<!-- VENTAS CARGO AUTOMATICO-->

<table width="100%" class="table2" style="margin-top: 2px;">
      <tr>
      <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">VENTAS CARGO AUTOMATICO</th>
    </tr>
  <thead>
  <tr>    
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="50" class="stilot2"><span class="Estilo11">NOMBRE CLIENTE</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="20" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($datos_ventas_c_auto);$j++){

if(($datos_ventas_c_auto[$j]["monto_cobrado"])>0){
  $monto_c = $datos_ventas_c_auto[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}
?>
<tr>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_c_auto[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $datos_ventas_c_auto[$j]["n_recibo"];?></td>
<td colspan="50" class="stilot1"><?php echo $datos_ventas_c_auto[$j]["paciente"];?></td>
<td colspan="5" class="stilot1  vendedor"><?php echo $datos_ventas_c_auto[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($datos_ventas_c_auto[$j]["total_factura"],2,".",",");?></td>
<td colspan="20" class="stilot1 vendedor"><?php echo $datos_ventas_c_auto[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($datos_ventas_c_auto[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>

</tbody>
</table>

<!-- RRECUPERADO CONTADO-->
<?php 
  $recuperado_contado = $reporteria->get_datos_recuperado_contado($fecha,$sucursal);
?>
<table width="100%" class="table2" style="margin-top: 2px;">
      <tr>
      <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">RECUPERADO SUCURSAL</th>
    </tr>
  <thead>
  <tr>    
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="25" class="stilot2"><span class="Estilo11">NOMBRE PACIENTE</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">COBRADOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">ANTICIPOS ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">SALDO ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">NUEVO SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($recuperado_contado);$j++){

if(($recuperado_contado[$j]["monto_cobrado"])>0){
  $monto_c = $recuperado_contado[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}
?>  

<tr>
<td colspan="5" class="stilot1"><?php echo $recuperado_contado[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $recuperado_contado[$j]["n_recibo"];?></td>
<td colspan="25" class="stilot1"><?php echo $recuperado_contado[$j]["paciente"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_contado[$j]["vendedor"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_contado[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_contado[$j]["total_factura"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo "$".number_format($recuperado_contado[$j]["abono_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_contado[$j]["saldo_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo $recuperado_contado[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1" style="color:blue"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($recuperado_contado[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>

</tbody>
</table>


<!-- RECUPERADO EMPRESARIAL-->
<?php 
  $recuperado_emp = $reporteria->get_datos_recuperado_empresarial($fecha,$sucursal);
?>
<table width="100%" class="table2" style="margin-top: 2px;">
      <tr>
      <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">RECUPERADO DESCUENTO EN PLANILLA</th>
    </tr>
  <thead>
  <tr>    
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="25" class="stilot2"><span class="Estilo11">NOMBRE PACIENTE</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">COBRADOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">ANTICIPOS ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">SALDO ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">NUEVO SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($recuperado_emp);$j++){

if(($recuperado_emp[$j]["monto_cobrado"])>0){
  $monto_c = $recuperado_emp[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}
?>  

<tr>
<td colspan="5" class="stilot1"><?php echo $recuperado_emp[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $recuperado_emp[$j]["n_recibo"];?></td>
<td colspan="25" class="stilot1"><?php echo $recuperado_emp[$j]["paciente"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_emp[$j]["vendedor"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_emp[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_emp[$j]["total_factura"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo "$".number_format($recuperado_emp[$j]["abono_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_emp[$j]["saldo_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo $recuperado_emp[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1" style="color:blue"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($recuperado_emp[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>

</tbody>
</table>

<!-- RECUPERADO CARGO AUTOMATICO-->
<?php 
  $recuperado_cargo = $reporteria->get_datos_recuperado_cargo($fecha,$sucursal);
?>
<table width="100%" class="table2" style="margin-top: 2px;">
      <tr>
      <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">RECUPERADO CARGO AUTOMATICO</th>
    </tr>
  <thead>
  <tr>    
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">FACTURA</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">RECIBO</span></th>
    <th bgcolor="#004e00" colspan="25" class="stilot2"><span class="Estilo11">NOMBRE PACIENTE</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">VENDEDOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">COBRADOR</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">TOTAL FACTURA</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">ANTICIPOS ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11">SALDO ANT.</span></th>
    <th bgcolor="#004e00" colspan="10" class="stilot2"><span class="Estilo11 vendedor">FORMA DE COBRO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">TOTAL COBRADO</span></th>
    <th bgcolor="#004e00" colspan="5" class="stilot2"><span class="Estilo11">NUEVO SALDO</span></th>
  </tr>
</thead>
<tbody>

<?php for($j=0;$j<count($recuperado_cargo);$j++){
if(($recuperado_cargo[$j]["monto_cobrado"])>0){
  $monto_c = $recuperado_cargo[$j]["monto_cobrado"];
}else{
  $monto_c = 0;
}
?>  

<tr>
<td colspan="5" class="stilot1"><?php echo $recuperado_cargo[$j]["n_factura"];;?></td>
<td colspan="5" class="stilot1"><?php echo $recuperado_cargo[$j]["n_recibo"];?></td>
<td colspan="25" class="stilot1"><?php echo $recuperado_cargo[$j]["paciente"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_cargo[$j]["vendedor"];?></td>
<td colspan="10" class="stilot1  vendedor"><?php echo $recuperado_cargo[$j]["usuario"];?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_cargo[$j]["total_factura"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo "$".number_format($recuperado_cargo[$j]["abono_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1"><?php echo "$".number_format($recuperado_cargo[$j]["saldo_anterior"],2,".",",");?></td>
<td colspan="10" class="stilot1 vendedor"><?php echo $recuperado_cargo[$j]["forma_cobro"];?></td>
<td colspan="5" class="stilot1" style="color:blue"><?php echo "$".number_format($monto_c,2,".",",");?></td>
<td colspan="5" class="stilot1"><?php echo "$".number_format($recuperado_cargo[$j]["saldo_credito"],2,".",",");?></td>
</tr>
<?php
  }
?>

</tbody>
</table>

<div id="footer"> 
    <p class="page">Page <?php //$PAGE_NUM ?></p> 
    </div> 
    <div id="content"> 
    <p ></p> 
    <p style="page-break-before: always;text-align: center;margin-top: 50px">RESUMEN DE COBROS</p> 
    </div>
<!--GET DATA RESUMEN DE COBROS Y VENTAS-->

<?php
  
  $resumen_ventas_cobros = $reporteria->get_resumen_ventas_cobros($fecha,$sucursal);

  $ventas_contado=0;
  $ventas_credito=0;

  $cobros_contado_efectivo=0;
  $cobros_contado_cheque=0;
  $cobros_contado_serfinsa=0;
  $cobros_contado_credomatic=0;
  $cobros_contado_agricola=0;
  $cobros_contado_cuscatlan=0;
  $cobros_contado_davivienda=0;


  $suma_cobros_venta_contado=0;

  $cobros_credito_cheque=0;
  $cobros_credito_efectivo=0;
  $cobros_credito_serfinsa=0;
  $cobros_credito_credomatic=0;
  $cobros_credito_agricola=0;
  $cobros_credito_cuscatlan=0;
  $cobros_credito_davivienda =0;

  $suma_cobros_venta_credito=0;

  $recuperado_contado_efectivo = 0;
  $recuperado_contado_cheque = 0;
  $recuperado_contado_serfinsa = 0;
  $recuperado_contado_credomatic = 0;
  $recuperado_contado_agricola = 0;
  $recuperado_contado_cuscatlan = 0;
  $recuperado_contado_davivienda = 0;

  $suma_cobros_recuperado_contado = 0;
  $suma_cobros_recuperado_creditos =0;

  $recuperado_credito_efectivo = 0;
  $recuperado_credito_cheque = 0;
  $recuperado_credito_serfinsa = 0;
  $recuperado_credito_credomatic = 0;
  $recuperado_credito_agricola = 0;
  $recuperado_credito_cuscatlan = 0;
  $recuperado_credito_davivienda = 0;


  for($i=0;$i<count($resumen_ventas_cobros);$i++){
    
    if ($resumen_ventas_cobros[$i]["tipo_venta"]=="Contado"  and ($resumen_ventas_cobros[$i]["tipo_ingreso"]=="Venta")) {
       $ventas_contado= $ventas_contado+$resumen_ventas_cobros[$i]["total_factura"];

        if($resumen_ventas_cobros[$i]["forma_cobro"]=="Efectivo" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_efectivo=$cobros_contado_efectivo+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cheque" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_cheque=$cobros_contado_cheque+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Serfinsa" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_serfinsa=$cobros_contado_serfinsa+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Credomatic" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_credomatic=$cobros_contado_credomatic+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Agricola" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_agricola=$cobros_contado_agricola+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cuscatlan" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_cuscatlan=$cobros_contado_cuscatlan+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Davivienda" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $cobros_contado_davivienda=$cobros_contado_davivienda+$resumen_ventas_cobros[$i]["monto_cobrado"];
        }
        $suma_cobros_venta_contado = $cobros_contado_efectivo+$cobros_contado_cheque+$cobros_contado_serfinsa+$cobros_contado_credomatic+$cobros_contado_agricola+$cobros_contado_cuscatlan+$cobros_contado_davivienda;

    }elseif($resumen_ventas_cobros[$i]["tipo_venta"]=="Credito"  and ($resumen_ventas_cobros[$i]["tipo_ingreso"]=="Venta")){
      $ventas_credito= $ventas_credito+$resumen_ventas_cobros[$i]["total_factura"];

      if($resumen_ventas_cobros[$i]["forma_cobro"]=="Cheque" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_cheque=$cobros_credito_cheque + $resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Efectivo" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_efectivo=$cobros_credito_efectivo+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Serfinsa" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_serfinsa=$cobros_credito_serfinsa+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Credomatic" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_credomatic=$cobros_credito_credomatic+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Agricola" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_agricola=$cobros_credito_agricola+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cuscatlan" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
        $cobros_credito_cuscatlan=$cobros_credito_cuscatlan+$resumen_ventas_cobros[$i]["monto_cobrado"];
     }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Davivienda" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
      $cobros_credito_davivienda = $cobros_credito_davivienda+$resumen_ventas_cobros[$i]["monto_cobrado"];
     }

      $suma_cobros_venta_credito = $cobros_credito_cheque+$cobros_credito_efectivo+$cobros_credito_serfinsa+$cobros_credito_credomatic+$cobros_credito_agricola+$cobros_credito_cuscatlan+$cobros_credito_davivienda;

    }elseif($resumen_ventas_cobros[$i]["tipo_venta"]=="Contado"  and ($resumen_ventas_cobros[$i]["tipo_ingreso"]=="Recuperado")){
      if($resumen_ventas_cobros[$i]["forma_cobro"]=="Efectivo" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_efectivo = $recuperado_contado_efectivo+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cheque" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_cheque = $recuperado_contado_cheque+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Serfinsa" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_serfinsa = $recuperado_contado_serfinsa+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Credomatic" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_credomatic = $recuperado_contado_credomatic+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Agricola" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_agricola = $recuperado_contado_agricola+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cuscatlan" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_cuscatlan = $recuperado_contado_cuscatlan+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Davivienda" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_contado_davivienda = $recuperado_contado_davivienda+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }
      $suma_cobros_recuperado_contado = $suma_cobros_recuperado_contado + $resumen_ventas_cobros[$i]["monto_cobrado"];

    }elseif($resumen_ventas_cobros[$i]["tipo_venta"]=="Credito"  and ($resumen_ventas_cobros[$i]["tipo_ingreso"]=="Recuperado")){

      if($resumen_ventas_cobros[$i]["forma_cobro"]=="Efectivo" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_efectivo = $recuperado_credito_efectivo+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cheque" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_cheque = $recuperado_credito_cheque+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Serfinsa" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_serfinsa = $recuperado_credito_serfinsa+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Credomatic" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_credomatic = $recuperado_credito_credomatic+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Agricola" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_agricola = $recuperado_credito_agricola+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Cuscatlan" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_cuscatlan = $recuperado_credito_cuscatlan+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }elseif($resumen_ventas_cobros[$i]["forma_cobro"]=="Davivienda" and $resumen_ventas_cobros[$i]["monto_cobrado"]>0){
          $recuperado_credito_davivienda = $recuperado_credito_davivienda+$resumen_ventas_cobros[$i]["monto_cobrado"];
      }

      $suma_cobros_recuperado_creditos = $suma_cobros_recuperado_creditos + $resumen_ventas_cobros[$i]["monto_cobrado"];
    }

  }//////////////FIN FOR ARRAY

  $cobros_recuperado_efectivo = $recuperado_contado_efectivo+$recuperado_credito_efectivo;
  $cobros_recuprado_cheques = $recuperado_contado_cheque + $recuperado_credito_cheque;
  $cobros_recuperado_serfinsa = $recuperado_contado_serfinsa+$recuperado_credito_serfinsa;
  $cobros_recuperado_credomatic = $recuperado_contado_credomatic + $recuperado_credito_credomatic;
  $cobros_recuperado_agricola = $recuperado_contado_agricola+$recuperado_credito_agricola;
  $cobros_recuperado_cuscatlan = $recuperado_contado_cuscatlan+$recuperado_credito_cuscatlan;
  $cobros_recuperado_davivienda = $recuperado_contado_davivienda+$recuperado_credito_davivienda;

  $total_cobros_recuperado = $suma_cobros_recuperado_contado+$suma_cobros_recuperado_creditos ;
  ?>

<!--DETALLES Y RESUMEN-->
<table  width="100%" class="table2" style="margin-top: 5px">
    <tr>
    <td colspan="35">Fecha : <span><?php echo $fecha;?></span></td>
    <td colspan="35">Sucursal: <span><?php echo $sucursal;?></span></td>
    <td colspan="35" style="font-size: 11px;text-align: right;" a+
     lign="right">Impreso por: <span><?php echo ucfirst($usuario)." ".$fecha_imp;?></span></td>
  </tr>
  <tr>
    <th style="text-align: center;background: #c5e2f6" colspan="30" class="stilot1" rowspan="2">RESUMEN VENTAS</th>
    <th style="text-align: center;background: #b7d5ac;border-radius: 8px;border:0px" colspan="75" class="stilot1"> DETALLE COBROS VENTAS</th>
  </tr>
  <tr>
    <th colspan="9" style="width:10%" class="stilot1">EFECTIVO</th>
    <th colspan="9" style="width:10%" class="stilot1">CHEQUES</th>
    <th colspan="9" style="width:10%" class="stilot1">SERFINSA</th>
    <th colspan="9" style="width:10%" class="stilot1">CREDOMATIC</th>
    <th colspan="9" style="width:10%" class="stilot1">AGRICOLA</th>
    <th colspan="9" style="width:10%" class="stilot1">CUSCATLAN</th>
    <th colspan="9" style="width:10%" class="stilot1">DAVIVIENDA</th>
    <th colspan="12" style="width:15%" class="stilot1">TOTAL</th>
      <!--<th style="text-align: center;" colspan="75" class="stilot1">RESUMEN VENTAS Y COBROS</th>-->
    </tr>
  <tr>
    <th colspan="15" style="width:15%" class="stilot1">CONTADO</th>
    <th colspan="15" style="width:15%" class="stilot1"><?php echo "$".number_format($ventas_contado,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_cheque,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_cuscatlan,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_contado_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%" class="stilot1"><?php echo "$".number_format($suma_cobros_venta_contado,2,".",","); ?></th>
    
  </tr>

  <tr>
    <th colspan="15" style="width:15%" class="stilot1">CREDITO</th>
    <th colspan="15" style="width:15%" class="stilot1"><?php echo "$".number_format($ventas_credito,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_cheque,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_cuscatlan,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_credito_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%" class="stilot1"><?php echo "$".number_format($suma_cobros_venta_credito,2,".",","); ?></th>    
  </tr>

  <?php 
        $ventas_diarias = $ventas_contado+$ventas_credito;

        $cobros_ventas_efectivo = $cobros_contado_efectivo+$cobros_credito_efectivo;
        $cobros_ventas_cheques = $cobros_contado_cheque+$cobros_credito_cheque;
        $cobros_ventas_serfinsa = $cobros_contado_serfinsa+$cobros_credito_serfinsa;
        $cobros_ventas_credomatic = $cobros_contado_credomatic+$cobros_credito_credomatic;
        $cobros_ventas_agricola = $cobros_contado_agricola+$cobros_credito_agricola;
        $cobros_ventas_cuscatlan = $cobros_contado_cuscatlan+$cobros_credito_cuscatlan;
        $cobros_ventas_davivienda = $cobros_contado_davivienda+$cobros_credito_davivienda;



        $total_cobros_venta = $suma_cobros_venta_contado+$suma_cobros_venta_credito;

        $suma_cobros_contado = $suma_cobros_venta_contado+$suma_cobros_recuperado_contado;
        $suma_cobros_credito = $suma_cobros_venta_credito+$suma_cobros_recuperado_creditos;

        $total_ingresos = $suma_cobros_contado+$suma_cobros_credito;

   ?>

  <tr>
    <td colspan="15" class="stilot1" style="width:15%"><b>TOTAL VENTAS</b></td>
    <td colspan="15" class="stilot1" style="width:15%;font-size: 12px;color:green"><b><?php echo "$".number_format($ventas_diarias,2,".",","); ?></b></td>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_ventas_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_ventas_cheques,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_ventas_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_ventas_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_ventas_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:15%" class="stilot1"><?php echo "$".number_format($cobros_ventas_cuscatlan,2,".",","); ?></th>
    <th colspan="9" style="width:15%" class="stilot1"><?php echo "$".number_format($cobros_ventas_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%;color: green;font-size: 11px" class="stilot1"><b><?php echo "$".number_format($total_cobros_venta,2,".",","); ?></b></th>
  </tr>

  <tr>
    <th colspan="30" class="stilot1" style="text-align: center;background: #c5e2f6" rowspan="2">RESUMEN COBROS</th>
    <th colspan="75" class="stilot1" style="text-align: center;background: #b7d5ac;border-radius: 5px" >DETALLE COBRO DE RECUPERADO</th>
  </tr>

  <tr>
    <th colspan="9" style="width:10%" class="stilot1">EFECTIVO</th>
    <th colspan="9" style="width:10%" class="stilot1">CHEQUES</th>
    <th colspan="9" style="width:10%" class="stilot1">SERFINSA</th>
    <th colspan="9" style="width:10%" class="stilot1">CREDOMATIC</th>
    <th colspan="9" style="width:10%" class="stilot1">AGRICOLA</th>
    <th colspan="9" style="width:10%" class="stilot1">CUSCATLAN</th>
    <th colspan="9" style="width:10%" class="stilot1">DAVIVIENDA</th>
    <th colspan="12" style="width:15%" class="stilot1">TOTAL</th>
  </tr>

    <tr>
    <td colspan="15" class="stilot1">CONTADO</td>
    <td colspan="15" class="stilot1"><b><?php echo "$".number_format($suma_cobros_contado,2,".",","); ?></b></td>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_cheque,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_cuscatlan,2,".",","); ?></th>
        <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_contado_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%" class="stilot1"><?php echo "$".number_format($suma_cobros_recuperado_contado,2,".",","); ?></th>
  </tr>

  <tr>
    <th colspan="15" style="width:15%" class="stilot1">CREDITO</th>
    <th colspan="15" style="width:15%" class="stilot1"><?php echo "$".number_format($suma_cobros_credito,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_cheque,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_cuscatlan,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($recuperado_credito_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%" class="stilot1"><?php echo "$".number_format($suma_cobros_recuperado_creditos,2,".",","); ?></th> 
    
  </tr>

  <tr>
    <th colspan="15" style="width:15%" class="stilot1">TOTAL INGRESOS</th>
    <th colspan="15" style="width:15%;color:red;font-size: 12px" class="stilot1"><b><?php echo "$".number_format($total_ingresos,2,".",","); ?></b></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_efectivo,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuprado_cheques,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_serfinsa,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_credomatic,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_agricola,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_cuscatlan,2,".",","); ?></th>
    <th colspan="9" style="width:10%" class="stilot1"><?php echo "$".number_format($cobros_recuperado_davivienda,2,".",","); ?></th>
    <th colspan="12" style="width:15%;font-size: 11px;color: green" class="stilot1"><?php echo "$".number_format($total_cobros_recuperado,2,".",","); ?></th>   
  </tr>
 <?php $total_efectivo_diario = $cobros_ventas_efectivo + $cobros_recuperado_efectivo; ?>
  <tr>
    <td colspan="30" style="width:15%;font-size: 12px;color:white;background: #001a57" class="stilot1">TOTAL EFECTIVO DIARIO</td>
    <td colspan="9" style="width:15%;font-size: 12px;color: white;background: background: #001a57" class="stilot1"><?php echo "$".number_format($total_efectivo_diario,2,".",",");?></td>
    <td colspan="66" style="width:15%;font-size: 11px;color: green" class="stilot1"></td>
  </tr>

</table>


<!-- DATA CAJA CHICA-->
<?php 
  $caja_chica = $reporteria->get_data_caja_chica($fecha,$sucursal);

  $saldo_caja_chica = $reporteria->get_saldo_caja($sucursal);
  $saldo_caja =0;

  for($j=0;$j<count($saldo_caja_chica);$j++){
  $saldo_caja = $saldo_caja+$saldo_caja_chica[$j]["saldo"];
 // echo $saldo_caja;

}

?>


<table width="100%" class="table2" style="margin-top: 20px">
  <tr><td colspan="105"></td></tr>
    <tr>
     <th style="text-align: center;font-size: 12px;background: #C0C0C0" colspan="105">DETALLE DE CAJA CHICA</th>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#004e00" colspan="15" class="stilot2"  style="width:15%"><span class="Estilo11">#REQUISICIÓN</span></th>
    <th bgcolor="#004e00" colspan="15" class="stilot2" style="width:15%;"><span class="Estilo11">FECHA</span></th>
    <th bgcolor="#004e00" colspan="41" class="stilot2" style="width: 41%"><span class="Estilo11">DESCRIPCIÓN</span></th>
    <th bgcolor="#004e00" colspan="6" class="stilot2" style="width: 6%"><span class="Estilo11">CANTIDAD</span></th>
    <th bgcolor="#004e00" colspan="6" class="stilot2" style="width: 6%"><span class="Estilo11">PRECIO</span></th>
    <th bgcolor="#004e00" colspan="6" class="stilot2" style="width: 6%"><span class="Estilo11">COMPROBANTE</span></th>
    <th bgcolor="#004e00" colspan="8" class="stilot2" style="width: 8%"><span class="Estilo11">APROBADO POR</span></th>
    <th bgcolor="#004e00" colspan="8" class="stilot2" style="width: 8%"><span class="Estilo11">INGRESADO POR</span></th>
  </tr>
</thead>
<tbody>

<?php 
$gastos_caja = 0;
for($j=0;$j<count($caja_chica);$j++){
  $gastos_caja = $gastos_caja+$caja_chica[$j]["precio"];
?>

<tr>
  <td colspan="15" class="stilot1"  style="width:15%"><?php echo $caja_chica[$j]["n_requisicion"];?></td>
  <td colspan="15" class="stilot1" style="width:15%;"><?php echo $caja_chica[$j]["fecha"];?></td>
  <td colspan="41" class="stilot1" style="width: 41%"><?php echo $caja_chica[$j]["descripcion"];?></td>
  <td colspan="6" class="stilot1" style="width: 6%"><?php echo $caja_chica[$j]["cantidad"];?></td>
  <td colspan="6" class="stilot1" style="width: 6%"><?php echo "$".number_format($caja_chica[$j]["precio"],2,".",",");?></td>
  <td colspan="6" class="stilot1" style="width: 6%"><?php echo $caja_chica[$j]["comprobante"];?></td>
  <td colspan="8" class="stilot1" style="width: 8%"><?php echo $caja_chica[$j]["aprobado_por"];;?></td>
  <td colspan="8" class="stilot1" style="width: 8%"><?php echo $caja_chica[$j]["usuario"];?></td>
</tr>
<?php
  }
?>

<?php ?>

</tbody>
<?php 

$get_movimientos_caja = $reporteria->get_mov_caja($fecha,$sucursal);
if (is_array($get_movimientos_caja) and count($get_movimientos_caja)>0) {
?>
</table>

<table style="margin-top: 20px;" width="100%" class="table2">
  <tr>
    <td colspan="26"  style="background: #001a57;color: white;color;text-align: center;font-size: 11px">SALDO CAJA</td>
    <td colspan="26" style="background: #001a57;color: white;color;text-align: center;font-size: 11px">GASTOS CAJA CHICA</td>
    <td colspan="28" style="background: #001a57;color: white;color;text-align: center;font-size: 11px">TOTALES EFECTIVO</td>
  </tr>
  <?php 
$saldo_caja = 0;

for($j=0;$j<count($get_movimientos_caja);$j++){
  $saldo_caja = $saldo_caja+$get_movimientos_caja[$j]["sobrante"];
?>
  <?php $total_diario_efectivo = $total_efectivo_diario + $saldo_caja;?>
  <td colspan="26"  style="text-align: center;font-size: 12px;color: red;" class="stilot1"><strong><?php echo "$".number_format($saldo_caja,2,".",","); ?></strong></td>
    <td colspan="26" style="text-align: center;font-size: 12px;color: red;" class="stilot1"><strong><?php echo "$".number_format($gastos_caja,2,".",",");?></strong></td>
    <td colspan="28" style="text-align: center;font-size: 12px;color: red;" class="stilot1"><strong><?php echo "$".number_format($total_diario_efectivo,2,".",",");?></strong></td>
  </tr>
<?php
}
}else{
 $monto_efectivo_t = $saldo_caja+$total_efectivo_diario;
?>

  <tr>
    <td colspan="33"  style="background: #001a57;color: white;color;text-align: center;font-size: 12px" class="stilot1">SALDO CAJA</td>
    <td colspan="36" style="background: #001a57;color: white;color;text-align: center;font-size: 12px" class="stilot1">GASTOS CAJA CHICA</td>
    <td colspan="36" style="background: #001a57;color: white;color;text-align: center;font-size: 12px" class="stilot1">TOTALES EFECTIVO</td>
  </tr>
  <tr>
    <td colspan="33"  style="text-align: center;font-size: 12px" class="stilot1"><?php echo "$".number_format($saldo_caja,2,".",",");?></td>
    <td colspan="36" class="stilot1" style="text-align: center;font-size: 12px"><?php echo "$00.00"?></td>
    <td colspan="36" class="stilot1" style="text-align: center;font-size: 12px;color: blue"><b><?php echo "$".number_format($monto_efectivo_t,2,".",",");?></b></td>
  </tr>



<?php } ?>
</table>

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
<?php } else{
echo "Acceso denegado";

  } ?>
