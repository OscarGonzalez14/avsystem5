<?php
//llamo a la conexion de la base de datos
require_once("../config/conexion.php");
require_once("../modelos/Empleados.php");
$empleado = new Empleados();  
switch($_GET["op"]){

	case 'categoria_user':
		$datos=$empleado->get_level_employee($_POST["id_empleado"]);
			if (is_array($datos)==true and count($datos)>0) {		
				foreach ($datos as $row) {
                  $level = $row["level"];				
				}
			}
		echo json_encode($level);	
		break;
////////////////////////////  CATEGORIA UNO ////////////////////////
	case 'get_comision_cat_uno':

		$datos=$empleado->get_comision_cat_uno($_POST["sucursal"],$_POST["year"],$_POST["mes"]);
			if (is_array($datos) and count($datos)) {
			    foreach ($datos as $row) {
				    $total_ventas = $row["total"];					
		    }
		}

        if ($total_ventas>19000) {
        	$comision = 100;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>24000){
        	$comision = 200;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>29000){
        	$comision = 300;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>34000){
        	$comision = 400;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>39000){
        	$comision = 500;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>44000){
        	$comision = 600;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }else{
        	$comision = 0;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }		
		echo json_encode($data);
	break;

    case 'data_comisiones_cat_uno':
    	$datos = $empleado->data_comisiones_cat_uno($_POST['sucursal'],$_POST['year'],$_POST['mes']);
    	$data = Array();
    	foreach ($datos as $row) {
    		$subarray = array();
    		$subarray[] = $row["fecha_venta"];
    		$subarray[] = $row["numero_venta"];
    		$subarray[] = $row["paciente"];
    		$subarray[] = $row["sucursal"];
    		$subarray[] = $row["tipo_pago"];
    		$subarray[] = "$".number_format($row["monto_total"],2,".",",");

    		$data[] = $subarray;

    	}

    	$results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
    	break;

/////////////////////////////DATA COMISONES CATEGORIA DOS 

	case 'get_comision_cat_dos':

		$datos=$empleado->get_comision_cat_dos($_POST["sucursal"],$_POST["year"],$_POST["mes"],$_POST["id_empleado"]);
			if (is_array($datos) and count($datos)) {
				foreach ($datos as $row) {
					$total_ventas = $row["total"];					
				}
			}

        	$comision = $total_ventas*0.01;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        	
		echo json_encode($data);
	break;

    case 'data_comisiones_cat_dos':
    	$datos = $empleado->data_comisiones_cat_dos($_POST['sucursal'],$_POST['year'],$_POST['mes'],$_POST['id_empleado']);
    	$data = Array();
    	foreach ($datos as $row) {
    		$subarray = array();
    		$subarray[] = $row["fecha_venta"];
    		$subarray[] = $row["numero_venta"];
    		$subarray[] = $row["paciente"];
    		$subarray[] = $row["sucursal"];
    		$subarray[] = $row["tipo_pago"];
    		$subarray[] = "$".number_format($row["monto_total"],2,".",",");

    		$data[] = $subarray;

    	}
        //$data_r = $_POST['sucursal']."*".$_POST['year']."*".$_POST['mes']."*".$_POST['id_empleado'];
    	$results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
        //echo json_encode($data_r);
    	break;



////////////////////////////  CATEGORIA TRES ////////////////////////
	case 'get_comision_cat_tres':

		$datos=$empleado->get_comision_cat_tres($_POST["sucursal"],$_POST["year"],$_POST["mes"],$_POST["id_empleado"]);
			if (is_array($datos) and count($datos)) {
				foreach ($datos as $row) {
					$total_ventas = $row["total"];					
			}
		}

        if ($total_ventas>19000) {
        	$comision = 100;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>24000){
        	$comision = 200;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>29000){
        	$comision = 300;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>34000){
        	$comision = 400;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
		    $data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>39000){
        	$comision = 500;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }elseif($total_ventas>44000){
        	$comision = 600;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }else{
        	$comision = 0;
        	$data["total_ventas"] = number_format($total_ventas,2,".",",");
        	$data["comision"] = number_format($comision,2,".",",");
        }		
		echo json_encode($data);
	break;

    case 'data_comisiones_cat_tres':
    	$datos = $empleado->data_comisiones_cat_tres($_POST['sucursal'],$_POST['year'],$_POST['mes'],$_POST['id_empleado']);
    	$data = Array();
    	foreach ($datos as $row) {
    		$subarray = array();
    		$subarray[] = $row["fecha_venta"];
    		$subarray[] = $row["numero_venta"];
    		$subarray[] = $row["paciente"];
    		$subarray[] = $row["sucursal"];
    		$subarray[] = $row["tipo_pago"];
    		$subarray[] = "$".number_format($row["monto_total"],2,".",",");

    		$data[] = $subarray;

    	}
        //$data_r = $_POST['sucursal']."*".$_POST['year']."*".$_POST['mes']."*".$_POST['id_empleado'];
    	$results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
        //echo json_encode($data_r);
    	break;


}