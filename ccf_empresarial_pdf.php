<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';
require_once 'pages/convierte_a_texto.php';
$empresa = $_POST["empresa_cff"];
$direccion = $_POST["direcion_ccf"];
$registro_ccf = $_POST["registro_ccf"];
$direcion_ccf = $_POST["direcion_ccf"];
$giro_ccf = $_POST["giro_ccf"];
$items = $_POST["items_ccf_det"];
$nit =$_POST["nit_ccf"];
$monto = $_POST["monto_ccf_det"];
$total_items = $_POST["items_lengt"];
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y");

if (isset($_POST["contribuyente_tipo"])) {
   $tipo_contribuyente=1;
} else {
   $tipo_contribuyente=0;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CCF</title>
</head>
<body>
<style>
      html{
      	margin-top: 0;
        margin-left: 10px;
        margin-right:10px; 
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

<!--PARTE 1-->
<div style="margin-top: 70px;height:525px"> <!--div 1--> 
<?php	include 'helpers/plantilla_ccf_emp.php'; ?>
</div><!--FIN div-->
<!--PARTE 2-->
<div style="margin-top: 25px;height:445px" >
	<?php	include 'helpers/plantilla_ccf_emp.php'; ?>
</div>
<!--PARTE 3-->
<div style="margin-top: 110px;" >
	<?php	include 'helpers/plantilla_ccf_emp.php'; ?>
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
$dompdf->setPaper('tabloid', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>