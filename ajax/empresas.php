<?php 
// se agrega el enlace de conexión a la base de datos
require_once("../config/conexion.php");
//se llame el modelo Empresas
require_once("../modelos/Empresas.php");


$empresas = new Empresas();
switch ($_GET["op"]){

	case 'guardar_empresa':
	$valida_empresa = $empresas->comprueba_existe_empresa($_POST["nomEmpresa"]);

	if (is_array($valida_empresa)==true and count($valida_empresa)==0 ){
		$empresas->registrarEmpresa($_POST["nomEmpresa"], $_POST["dirEmpresa"], $_POST["nitEmpresa"], $_POST["telEmpresa"], $_POST["respEmpresa"], $_POST["correoEmpresa"], $_POST["encargado"], $_POST["registro"], $_POST["giro"]);
		$messages[]="ok";

	}else{
		$empresas->edit_empresa($_POST["nomEmpresa"], $_POST["dirEmpresa"], $_POST["nitEmpresa"], $_POST["telEmpresa"], $_POST["respEmpresa"], $_POST["correoEmpresa"], $_POST["encargado"], $_POST["registro"], $_POST["giro"], $_POST["id_empresa"]);
		$errors[]="existe";
	}
	if (isset($messages)){
		?>
		<?php
		foreach ($messages as $message) {
			echo json_encode($message);
		}
		?>
		<?php
	}
    //mensaje error
	if (isset($errors)){

		?>

		<?php
		foreach ($errors as $error) {
			echo json_encode($error);
		}
		?>
		<?php
	}
	break;	

	case 'listar_en_pacientes':
	$datos=$empresas->get_empresas_en_pacientes();
	$data= Array();

	foreach($datos as $row){

		$sub_array = array();
		$sub_array[] = $row["id_empresa"];
		$sub_array[] = $row["nombre"];
		$sub_array[] = $row["ubicacion"];
		$sub_array[] = '<button type="button" onClick="agregar_empresa_pac('.$row["id_empresa"].');" id="'.$row["id_empresa"].'" class="btn btn-md bg-success"d"><i class="fa fa-plus" aria-hidden="true"></i></button>';
		$data[] = $sub_array;
	}

	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
	break;

////////////rellenar campo de empresas en modal de nuevo paciente
	case "buscar_empresa_paciente":
	$datos=$empresas->add_empresa_paciente($_POST["id_empresa"]);

	if(is_array($datos)==true and count($datos)>0){
		foreach($datos as $row)
		{
			$output["nombre"] = $row["nombre"];       

		} 
	}

	echo json_encode($output);

	break;

//////////////////GET DATA CONTRIBUYENTES////////////////////////

	case "listar_contribuyentes":

	$datos=$empresas->get_contribuyentes();
	$data= Array();
	foreach($datos as $row){
		$sub_array = array();
		$sub_array[] = $row["nombres"];
		$sub_array[] = $row["empresa"];    
		//$sub_array[] = $row["ubicacion"]; 
		$sub_array[] = $row["nit"];        

		$sub_array[] = '<button type="button" onClick="contribuyenteData('.$row["id_paciente"].',\''.$row["empresa"].'\');" id="'.$row["id_paciente"].'" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';            

		$data[] = $sub_array;
	}

	$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
	echo json_encode($results);
	break;

 ////////////////LISTAR EMPRESAS CREADAS
	case "listar_empresas":
	$datos=$empresas->get_empresas();
		//Vamos a declarar un array
	$data= Array();

	foreach($datos as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["id_empresa"];
		$sub_array[] = $row["nombre"];
		$sub_array[] = $row["ubicacion"];
		$sub_array[] = $row["telefono"];
		$sub_array[] = $row["correo"];
		$sub_array[] = $row["responsable"];

		$sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="('.$row["id_empresa"].')"><i class="fa fa-info-circle" aria-hidden="true" style="color:#17a2b8"></i></button>';


		$sub_array[] = '<button type="button"  id="'.$row["nombre"].'" class="btn btn-edit btn-md edit_Empresa bg-light" style="text-align:center" onClick="show_datos_empresa('.$row["id_empresa"].');" data-toggle="modal" data-target="#newEmpresa" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';

		$sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="eliminar_empresa('.$row["id_empresa"].')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';

		$data[] = $sub_array;
	}

	$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
	echo json_encode($results);

	break;

			/////////////////SHOW DATOS DE PACIENTE EN MODAL PARA EDITAR
	case 'show_datos_empresa':    
	$datos=$empresas->show_datos_empresa($_POST["id_empresa"]);
	foreach($datos as $row){
		$output["id_empresa"] = $row["id_empresa"];
		$output["nombre"] = $row["nombre"];
		$output["ubicacion"] = $row["ubicacion"];
		$output["nit"] = $row["nit"];
		$output["telefono"] = $row["telefono"];
		$output["responsable"] = $row["responsable"];
		$output["correo"] = $row["correo"];
		$output["encargado_optica"] = $row["encargado_optica"];
		$output["registro"] = $row["registro"]; 
		$output["giro"] = $row["giro"]; 
	}
	echo json_encode($output);
	break;


	/// funcion para eliminar empresa
case "eliminar_empresa":
$datos=$empresas->ver_en_pacientes($_POST["nomEmpresa"]);

	if (is_array($datos)==true and count($datos)==0 ){ //Si existe consulta(no eliminar)
		$empresas->eliminar_empresa($_POST["nomEmpresa"]);
		$messages[]="ok";
	}else{
		$errors[]="existe";
	}
	if (isset($messages)){
		?>
		<?php
		foreach ($messages as $message) {
			echo json_encode($message);
		}
		?>
		<?php
	}
		//mensaje error
	if (isset($errors)){

		?>

		<?php
		foreach ($errors as $error) {
			echo json_encode($error);
		}
		?>
		<?php
	}
//fin 
	break;
	

// se agrega el enlace de conexión a la base de datos
	require_once("../config/conexion.php");
//se llame el modelo Empresas
	require_once("../modelos/Empresas.php");

}