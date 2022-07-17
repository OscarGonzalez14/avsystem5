<?php
//llamo a la conexion de la base de datos 
require_once("../config/conexion.php");
//llamo al modelo Proveedores
require_once("../modelos/Proveedores.php");
  
$proveedores = new Proveedor();

    switch($_GET["op"]){
        
    case "listar_proveedores":
     $datos=$proveedores->get_proveedores();
     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();				
				
	            $sub_array[] = $row["codigo_proveedor"];
				$sub_array[] = $row["nombre"];
                $sub_array[] = '<button type="button" class="btn btn-dark agrega_proveedor" id="'.$row["id_proveedor"].'">Seleccionar</button>';
                                 
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

        break;


    case "agrega_proveedor_compra":

    $datos= $proveedores->get_proveedores_compra($_POST["id_proveedor"]);

	    if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["codigo_proveedor"] = $row["codigo_proveedor"];
					$output["nombre"] = $row["nombre"];		
				}			 

	    }
	echo json_encode($output);
    break;    
}