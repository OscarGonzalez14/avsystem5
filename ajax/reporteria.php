<?php
require_once("../config/conexion.php");
require_once("../modelos/Reportes.php");

$reportes = new Reporteria();

switch ($_GET["op"]) {
	case 'listar_facturas':
	$sucursal = $_POST['sucursal'];

	if ($sucursal=="Empresarial"){
		$suc = $_POST["sucursal_usuario"];
	}else{
		$suc = $_POST["sucursal"];
	}

	$datos=$reportes->listar_facturas($suc);

	$data= Array();

	foreach($datos as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["id_correlativo"];
		$sub_array[] = $row["fecha"];
		$sub_array[] = $row["n_correlativo"];
		$sub_array[] = $row["titular"];
		$sub_array[] = "$".number_format(($row["monto"]),2,".",",");
		$sub_array[] = $row["sucursal"];

		$data[] = $sub_array;
	}

	$results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
	echo json_encode($results);
	break;
	
	default:
		// code...
	break;
}