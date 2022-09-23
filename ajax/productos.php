<?php

	  //llamo a la conexion de la base de datos
     require_once("../config/conexion.php");
     //llamo al modelo pacientes
     require_once("../modelos/Productos.php");
      //llamo al modelo Ventas
     $productos = new productos();

    switch($_GET["op"]){

    case "guardar_aros":
    $datos = $productos->valida_existencia_aros($_POST["marca_aros"],$_POST["modelo_aro"],$_POST["color_aro"],$_POST["medidas_aro"],$_POST["diseno_aro"],$_POST["materiales_aro"],$_POST["cat_venta_aros"]);
		if(is_array($datos)==true and count($datos)==0){
		    $productos->registrar_aro($_POST["marca_aros"],$_POST["modelo_aro"],$_POST["color_aro"],$_POST["medidas_aro"],$_POST["diseno_aro"],$_POST["materiales_aro"],$_POST["cat_venta_aros"],$_POST["categoria_producto"]);
    
    }else{
      $msj = ["result"=>'not'];
      echo json_encode($msj);
    }
 break;
  
case 'guardar_accesorios':

  $productos->registrar_accesorios($_POST["tipo_accesorio"],$_POST["marca_accesorio"],$_POST["desc_accesorio"],$_POST["categoria"],$_POST["codigo"]);

break;

    case "listar_aros":
    $datos=$productos->get_aros();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $row["marca"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = $row["color"];
        $sub_array[] = $row["medidas"];
        $sub_array[] = $row["diseno"];
        $sub_array[] = $row["materiales"];
        $sub_array[] = '<button type="button" class="btn btn-primary btn-sm agrega_aro"  style="border-radius:0px; btn-sm" onClick="agregar_aro('.$row["id_producto"].')"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    /////////////DATA TABLE LENTES EN VENTAS
    case "listar_lentes_venta":////////muestra lentes en modal de ventas
    $datos=$productos->get_lentes_ventas();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){
        $sub_array = array();

        $sub_array[] = $row["desc_producto"];
        $sub_array[] = "$".number_format($row["precio"],2,".",",");

        $sub_array[] = '<button type="button" class="btn btn-primary btn-sm agrega_aro"  style="border-radius:0px" onClick="agregar_detalles_lente_venta('.$row["id_producto"].')"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    ////////////////LISTAR AROS CREADOS
    case "listar_aros_creados":
    $datos=$productos->get_aros();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();
        $descripcion= $row["marca"]." Mod.: ".$row["modelo"]." Med.: ".$row["medidas"]." ".$row["color"];
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $descripcion;
        $sub_array[] = $row["diseno"];
        $sub_array[] = $row["materiales"];
        $sub_array[] = $row["categoria"];
        $sub_array[] = '<button type="button" class="btn btn-edit btn-md edita_aro bg-light" style="text-align:center" onClick="show_datos_aro('.$row["id_producto"].');" data-toggle="modal" data-target="#edit_aro" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

///////////////////////////AROS EN EXISTENCIAS
case "buscar_aros_venta":

 if($_POST["sucursal"]=="Empresarial" and $_POST["sucursal_usuario"]=='San Miguel') {
    $suc=$_POST['sucursal_usuario'];
    $datos=$productos->buscar_aros_ventas_emp($suc);  
  }elseif($_POST["sucursal"] == "Empresarial" and $_POST["sucursal_usuario"] != 'San Miguel'){
    $suc='Empresarial';
    $datos=$productos->buscar_aros_ventas_emp($suc);  
  }else{
    $datos=$productos->buscar_aros_ventas($_POST["sucursal"]);
  }
  
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();         
      //$sub_array[] = $row["id_producto"];
      $sub_array[] = $row["desc_producto"];
      $sub_array[] = $row["stock"];
      $sub_array[] = $row["fecha_ingreso"];
      $sub_array[] = $row["num_compra"];      
      $sub_array[] = "$".number_format($row["precio_venta"],2,".",",");
      $sub_array[] = $row["categoria_ub"];
      $sub_array[] = '<button type="button" name="hola" id="'.$row["id_producto"].'" class="btn btn-primary btn-sm btn-flat" onClick="agregarDetalleVenta('.$row["id_producto"].','.$row["id_ingreso"].')"><i class="fa fa-plus"></i> </button>';
      
        $data[] = $sub_array;
       
      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
     echo json_encode($results);
     break;


  case "buscar_accesorios_venta":

  if ($_POST["sucursal"]=="Empresarial") {
    $sucursal = $_POST["sucursal_usuario"];
  }else{
    $sucursal = $_POST["sucursal"];
  }

  $datos=$productos->buscar_accesorios_ventas($sucursal);
          
  
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();         
      
      $sub_array[] = $row["desc_producto"]." ". $row["marca"];
      $sub_array[] = $row["stock"];
      $sub_array[] = $row["fecha_ingreso"];
      $sub_array[] = $row["num_compra"];      
      $sub_array[] = "$".number_format($row["precio_venta"],2,".",",");
      $sub_array[] = $row["categoria_ub"];
      $sub_array[] = '<button type="button" name="hola" id="'.$row["id_producto"].'" class="btn btn-primary btn-sm btn-flat" onClick="agregarAccVenta('.$row["id_producto"].','.$row["id_ingreso"].')"><i class="fa fa-plus"></i></button>';
      
        $data[] = $sub_array;
       
      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
     break;

  case "registrar_lentes"://registro de lente

    $productos->guardar_lentes($_POST["describe"],$_POST["costo"],$_POST["precio"],$_POST["cat_prod"]);    
//fin mensaje error
  break;

  case "registrar_antireflejantes"://registro de antireflejante
    $productos->guardar_antireflejante($_POST["describe"],$_POST["costo"],$_POST["precio"],$_POST["cat_prod"]);    
      //fin mensaje error
  break;

  
  case "registrar_photosensibles"://registro de antireflejante
    $productos->guardar_photosensible($_POST["describe"],$_POST["costo_photo"],$_POST["precio_photo"],$_POST["cat_prod"]);    
      //fin mensaje error
   break;

/////////////LISTAR ACCESORIOS EN COMPRAS
  case "listar_acc_compras":
    $datos=$productos->get_acc_compras();
    $data= Array();

    foreach($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["marca"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = $row["categoria"];
        $sub_array[] = $row["desc_producto"];
        $sub_array[] = '<button type="button" class="btn btn-primary btn-sm"  style="border-radius:0px" onClick="agregar_accesorio('.$row["id_producto"].')"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    ////////////////LISTAR ACCESORIOS CREADOS
    case "listar_accesorios_creados":
    $datos=$productos->get_accesorios();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $row["marca"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = $row["categoria"];
        $sub_array[] = $row["categoria_producto"];
        $sub_array[] = $row["desc_producto"];
        $sub_array[] = '<button type="button" class="btn btn-edit btn-md edita_acc bg-light" style="text-align:center" onClick="show_datos_acc('.$row["id_producto"].');" data-toggle="modal" data-target="#edit_acc" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
        $sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="eliminar_accesorio('.$row["id_producto"].')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';


        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

// DATATABLE ANTIREFLEJANTES VENTAS
     case "listar_ar_venta":////////muestra antireflejante en modal de ventas
       case "listar_ar_venta":////////muestra antireflejante en modal de ventas
    $datos=$productos->get_ar_ventas();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){
        $sub_array = array();

        $sub_array[] = $row["desc_producto"];
        $sub_array[] = "$".number_format($row["precio"],2,".",",");

        $sub_array[] = '<button type="button" class="btn btn-primary btn-sm agrega_antireflejante"  style="border-radius:0px" onClick="agregar_detalles_lente_venta('.$row["id_producto"].')"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

// DATATABLE PHOTOSENSIBLES VENTAS
     case "listar_photo_venta":////////muestra photosensible en modal de ventas
    $datos=$productos->get_photo_ventas();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){
        $sub_array = array();

        $sub_array[] = $row["desc_producto"];
        $sub_array[] = "$".number_format($row["precio"],2,".",",");

        $sub_array[] = '<button type="button" class="btn btn-primary btn-sm agrega_antireflejante"  style="border-radius:0px" onClick="agregar_detalles_lente_venta('.$row["id_producto"].')"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    /////LENTES + TRATAMIENTOS
     case "lista_lentes_tratamientos":////////muestra photosensible en modal de ventas
    $datos=$productos->get_lente_tratamientos();
    //Vamos a declarar un array
    $data= Array();
    foreach($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $row["categoria_producto"];
        $sub_array[] = "$".number_format($row["categoria"],2,".",",");
        $sub_array[] = $row["desc_producto"];
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    ////EDITAR ARO
    case "editar_aros":
    $productos->editar_aro($_POST["marca_aros"],$_POST["modelo_aro"],$_POST["color_aro"],$_POST["medidas_aro"],$_POST["diseno_aro"],$_POST["materiales_aro"],$_POST["cat_venta_aros"],$_POST["categoria_producto"],$_POST["id_producto"]);

    //fin mensaje error
    break;


    /// VER DATOS DEL PRODUCTO EN MODAL PARA EDITAR
    case "show_datos_aro":
      $datos=$productos->show_datos_aros($_POST["id_producto"]);
      foreach ($datos as $row)
      {
        $output["id_producto"] = $row["id_producto"];
        $output["marca_aros"] = $row["marca"];
        $output["modelo_aro"] = $row["modelo"];
        $output["color_aro"] = $row["color"];
        $output["medidas_aro"] = $row["medidas"];
        $output["diseno_aro"] = $row["diseno"];
        $output["materiales_aro"] = $row["materiales"];
        $output["cat_venta_aros"] = $row["categoria"];
        $output["categoria_producto"] = $row["categoria_producto"];
      }
      echo json_encode($output);
      break;


    // EDITAR ACCESORIOS
    case "editar_accesorios":
    $productos->editar_accesorio($_POST["tipo_accesorio"],$_POST["marca_accesorio"],$_POST["desc_accesorio"],$_POST["categoria"],$_POST["codigo"],$_POST["id_producto"]);
    break;


      ///VER DATOS DE ACCESORIOS
    case "show_datos_acc":
      $datos=$productos->show_datos_acc($_POST["id_producto"]);
      foreach ($datos as $row)
      {
        $output["id_producto"] = $row["id_producto"];
        $output["tipo_accesorio"] = $row["categoria"];
        $output["marca_accesorio"] = $row["marca"];
        $output["desc_accesorio"] = $row["desc_producto"];
        $output["categoria"] = $row["categoria_producto"];
        $output["codigo"] = $row["modelo"];
        }
    echo json_encode($output);
    break;


    ////ELIMINAR ACCESORIOS
    case "eliminar_accesorio":
        $productos->eliminar_accesorio($_POST["id_producto"]);
        $messages[]="ok";
    if (isset($messages)){
     ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
   <?php
 }
    break;
case "listar_productos_traslado":

  $datos=$productos->get_productos_traslados($_POST["sucursal"]);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["bodega"];
    $sub_array[] = $row["desc_producto"];
    $sub_array[] = $row["categoria_ub"];
    $sub_array[] = '<button type="button" onClick="realizar_traslado('.$row["id_producto"].',\''.$row["categoria_ub"].'\');" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';          
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);

 break;

 case "registrar_servicio"://registro de un nuevo servicio
    $productos->guardar_servicio($_POST["tipo_servicio"],$_POST["des_servicio"],$_POST["precio_servicio"],$_POST["cat_servicio"]);    
  break;

   /////////////DATA TABLE LENTES EN VENTAS
    case "listar_servicios_venta":////////muestra lentes en modal de ventas
    $datos=$productos->get_servicios_ventas();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){
        $sub_array = array();
        $sub_array[] = $row["id_producto"];
        $sub_array[] = $row["modelo"];
        $sub_array[] = "$".number_format($row["precio"],2,".",",");
        $sub_array[] = '<button type="button" onClick="agregarServicioVenta('.$row["id_producto"].')" class="btn btn-sm bg-primary"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';          

        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    case "get_aros_creados_ubicar":
      $datos=$productos->get_aros();
      //Vamos a declarar un array
      $data= Array();
  
      foreach($datos as $row){
          $sub_array = array();
          $sub_array[] = $row["id_producto"];
          $sub_array[] = $row["marca"];
          $sub_array[] = $row["modelo"];
          $sub_array[] = $row["color"];
          $sub_array[] = $row["materiales"];
          $sub_array[] = $row["diseno"];
          $sub_array[] = '<button type="button" class="btn btn-edit btn-md edita_aro bg-light" style="text-align:center" onClick="arosUbicarIndividual('.$row["id_producto"].'\''.$row["modelo"].'\',\''.$row["color"].'\',\''.$row["marca"].'\');" data-toggle="modal" data-target="#edit_aro" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
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
