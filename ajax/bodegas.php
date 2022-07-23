<?php
//conexion de la base de datos 
require_once("../config/conexion.php");
require_once("../modelos/Bodegas.php"); 
$bodegas = new Bodegas();

require_once("../modelos/Compras.php"); 
$compras = new Compras();

switch($_GET["op"]){
////////////////MODAL PARA INGRESAR EN BODEGAS/****
case "listar_productos_ingreso_bodegas":
	$datos=$bodegas->get_productos_ingresar($_POST["numero_compra"]);
    //Vamos a declarar un array
 	$data= Array();
    foreach($datos as $row)
	{
		$sub_array = array();
    $sub_array[] = $row["id_producto"];				
		$sub_array[] = $row["numero_compra"];
		$sub_array[] = $row["descripcion"]." ".$row["diseno"]." ".$row["materiales"];
    $sub_array[] = $row["cant_ingreso"];
    $sub_array[] = '<button type="button"  class="btn btn-infos btn-sm asigna_datos_orden" onClick="agregaIngreso('.$row["id_producto"].',\''.$row["numero_compra"].'\');"><i class="fas fa-plus"></i></button>';                                 
		$data[] = $sub_array;
	}
        $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
    
    case "buscar_producto_por_compra":

        $datos=$bodegas->get_productos_ingresar_bodega($_POST["id_producto"],$_POST["numero_compra"]);

        if(is_array($datos)==true and count($datos)>0){

        foreach($datos as $row)
        {
          $output["numero_compra"] = $row["numero_compra"];
          $output["descripcion"] = $row["descripcion"]." ".$row["diseno"]." ".$row["materiales"];
          //$output["sucursal"] = $row["sucursal"];
          $output["id_producto"] = $row["id_producto"];
          $output["cant_ingreso"] = $row["cant_ingreso"];
          $output["precio_venta"] = $row["precio_venta"];
          $output["precio_compra"] = $row["precio_compra"];                              
        }      

       } 
  echo json_encode($output);
break;

///////REGISTRAR INGRESO
	case "registrar_ingreso_a_bodega";
       $bodegas->registrar_ingreso_a_bodega();
    break;
//////////////REPORTE INGRESOS BODEGA
case "reporte_ingresos_bodega":
    $datos=$bodegas->get_reporte_ingreso_bodega($_POST["numero_ingreso"]);
    //Vamos a declarar un array
    $data= Array();
    foreach($datos as $row){
    $sub_array = array(); 
    $sub_array[] = $row["fecha"];
    $sub_array[] = $row["id_detalle_ingreso"];
    $sub_array[] = $row["n_compra"];
    $sub_array[] = $row["usuario"];
    $sub_array[] = $row["producto"];
    $sub_array[] = $row["cantidad"];
    $sub_array[] = $row["sucursal"];
    $sub_array[] = $row["destino"];
    $data[] = $sub_array;
  }

 // print_r($_POST);

    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;

  case "get_numero_ingreso":
    $datos= $bodegas->get_numero_ingreso();

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){        
        $output["n_ingreso"] = "I-".$row["n_ingreso"];
      }
    }else{
        $output["n_ingreso"] = "I-1";
    }
    echo json_encode($output);    
  break;


  ////////////////GET INVENTARIO GENERAL
    case "get_inventario_general":
    $datos=$bodegas->get_stock_categoria($_POST["ubicacion"]);
    $data= Array();
    foreach($datos as $row)
      {
        $sub_array = array();
        $sub_array[] = $row["fecha_ingreso"];
        $sub_array[] = $row["num_compra"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $row["bodega"];
        $sub_array[] = $row["categoria_ub"];
        $sub_array[] = $row["descripcion"];
        $sub_array[] = $row["diseno"];
        $sub_array[] = $row["materiales"];
        $sub_array[] = $row["stock"];
        $sub_array[] = "$".$row["precio_venta"];
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    ////////////////GET PRODUCTOS TRASLADO
    case "get_productos_traslados":
        $datos=$bodegas->get_productos_traslados($_POST["id_producto"],$_POST["categoria_ub"]);

        if(is_array($datos)==true and count($datos)>0){

        foreach($datos as $row)
        {
          $output["categoria_ub"] = $row["categoria_ub"];
          $output["desc_producto"] = $row["desc_producto"];
          $output["id_ingreso"] = $row["id_ingreso"];
          $output["num_compra"] = $row["num_compra"];
          $output["precio_venta"] = $row["precio_venta"];
                       
        }      
       } 
  echo json_encode($output);

break;

case "get_numero_traslado":
  $datos= $bodegas->get_numero_traslado($_POST["sucursal"]);
  $sucursal = $_POST["sucursal"];
  $prefijo = "";
  if ($sucursal=="Metrocentro") {
    $prefijo="ME";
  }elseif ($sucursal=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal=="San Miguel") {
    $prefijo="SM";
  }
    if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){                  
      $correlativo=$row["num_traslado"];
      $cod=(substr($correlativo,4,11))+1;
      $output["correlativo"]="T".$prefijo."-".$cod;
    }             
  }else{
      $output["correlativo"] = "T".$prefijo."-1";
  }

   echo json_encode($output);

  break;

case "registrar_traslado";
$bodegas->agrega_detalle_traslado();
break;


case "ingresoIndividualBodega":

  $n_compra = $compras->get_numero_compras();
  $n_ingreso = $bodegas->get_numero_ingreso();

  $bodegas->ingresoIndividual($_POST["id_producto"],$_POST["cantidad_ingreso"],$_POST["precio_venta"],$_POST["ubicacion"],$_POST["usuario"],$_POST["sucursal"],$n_compra,$n_ingreso,$_POST["costo_u"]);

  break;

  case "ingreso_grupal":
    $n_compra = $compras->get_numero_compras();
    $n_ingreso = $bodegas->get_numero_ingreso();
    $bodegas->ingresoGrupal($_POST["ubicacion"],$_POST["usuario"],$_POST["sucursal"],$n_compra,$n_ingreso,$_POST["totales_compra"]);

    break;

    case "ingreso_agrupado":
      $n_compra = $compras->get_numero_compras();
      $n_ingreso = $bodegas->get_numero_ingreso();
      $bodegas->ingresoAgrupado($_POST["ubicacion"],$_POST["usuario"],$_POST["sucursal"],$n_compra,$n_ingreso,$_POST["costo_u"],$_POST["pventa"]);
  
      break;
  

  case 'listar_aros_bodega':
    require_once '../modelos/Productos.php';
    $productos = new Productos();

    $aros = $productos->get_aros();
    /*$lista_aros = Array();
    foreach($aros as $a){
      array_push($lista_aros,array('id'=>$a["id_producto"],'text'=>"Mod.:".$a["modelo"]." ".$a["marca"]." C.:".$a["color"]." Med.:".$a["medidas"]));
    }
    echo json_encode($lista_aros);  */ 

    $data= Array();
      foreach($aros as $row){
        $sub_array = array();
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = $row["marca"];
        $sub_array[] = $row["color"];
        $sub_array[] = $row["medidas"];
        $sub_array[] = $row["diseno"];
        $sub_array[] = $row["materiales"];
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="addProductoBd('.$row["id_producto"].',\''."Mod.:".$row["modelo"]." Marca.:".$row["marca"]." Col.:".$row["color"]." Med.:".$row["medidas"]."Mat.:".$row["materiales"].'\')"
        ><i class="fas fa-plus" aria-hidden="true" style="color:blue"></i></button>';
        $data[] = $sub_array;
      }
  
        $results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
    break;


    case "get_inventario_bdcentral":
      $datos=$bodegas->getStockBdCentral();
      $data= Array();
      foreach($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["id_ingreso"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = $row["marca"];
        $sub_array[] = $row["color"];
        $sub_array[] = $row["medidas"];
        $sub_array[] = $row["diseno"];
        $sub_array[] = $row["materiales"];
        $sub_array[] = $row["stock"];
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="modalDistribuir('.$row["id_producto"].',\''.$row["num_compra"].'\',\''.$row["stock"].'\',\''.$row["precio_venta"].'\',\''.$row["marca"]." - Mod.: ".$row["modelo"]." - Color.: ".$row["color"].'\')"><i class="fas fa-dolly" aria-hidden="true" style="color:blue"></i></button>';
        $data[] = $sub_array;
      }
  
        $results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
  
      break;

      case "distribuir_aros_sucursal":
        $bodegas->distribuirArosSucursal($_POST["id_producto"],$_POST["cantidad"],$_POST["numero_compra"],$_POST["usuario"],$_POST["sucursal"],$_POST["precio_venta"]);
        break;

}