<?php
require_once("../config/conexion.php");
// llamada al modelo categoria
require_once("../modelos/Categorias.php");

$categorias = new Categoria();

switch ($_GET["op"]){
	case 'guardar_categoria':
		$datos = $categorias->valida_existencia_categoria($_POST["cat_nombre"],$_POST["cat_sucursal"],$_POST["tipo_categoria"]);
		if (is_array($datos)==true and count($datos)==0) {
		$categorias->registrar_categoria($_POST["cat_nombre"],$_POST["cat_sucursal"],$_POST["cat_descripcion"],$_POST["tipo_categoria"]);
			$messages[]='ok';
		}else{
			$errors[]='error';
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
   ///fin mensaje error
	break;

	case "get_categorias":
    $datos= $categorias->get_categorias();	
    $data= Array();

    foreach($datos as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["nombre"];
		$data[] = $sub_array;

	}
		$results=$data;
 
 		echo json_encode($results);
break;

case "get_categorias_sucursal":
    $datos= $categorias->get_categorias_suc($_POST["categoria"],$_POST["sucursal"]);	
    $data= Array();

    foreach($datos as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["nombre"];
		$data[] = $sub_array;

	}
		$results=$data;
 
 		echo json_encode($results);
break;

case "get_categorias_traslado":
    $datos= $categorias->get_categorias_suc($_POST["categoria"],$_POST["sucursal"]);  
    $data= Array();

    foreach($datos as $row)
  {
    $sub_array = array();
    $sub_array[] = $row["nombre"];
    $data[] = $sub_array;

  }
    $results=$data;
 
    echo json_encode($results);
break;

case "get_categorias_traslados":
    $datos= $categorias->get_categorias_traslados($_POST["sucursal"]);
    $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["nombre"];
        $sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="agregar_item_traslado(\''.$row["nombre"].'\')"><i class="fas fa-plus" aria-hidden="true" style="color:blue"></i></button>';


        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results); 
    
break;
}
 ?>