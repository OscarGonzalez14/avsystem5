<?php
//llamo a la conexion de la base de datos
require_once("../config/conexion.php");
//llamo al modelo pacientes
require_once("../modelos/Caja.php");
 //llamo al modelo Ventas

$caja = new Caja();
  
switch($_GET["op"]){

	case "get_numero_requisicion":
	$datos= $caja->get_numero_requisicion($_POST["sucursal"]);
    $sucursal = $_POST["sucursal"];
    $prefijo = "";
    if ($sucursal=="Metrocentro") {
    	$prefijo="QME";
    }elseif ($sucursal=="Santa Ana") {
    	$prefijo="QSA";
    }elseif ($sucursal=="San Miguel") {
    	$prefijo="QSM";
    }elseif ($sucursal=="Chalatenango") {
      $prefijo="QCH";
    }elseif ($sucursal=="Ahuachapán") {
      $prefijo="QAH";
    }elseif ($sucursal=="Cascadas") {
      $prefijo="QCA";
    }

    if(is_array($datos)==true and count($datos)>0){

    foreach($datos as $row){                  
      $codigo=$row["n_requisicion"];
      $cod=(substr($codigo,5,20))+1;
      $output["correlativo"]="R".$prefijo."-".$cod;
    }             
    
    }else{
      $output["correlativo"] = "R".$prefijo."-1";    
    }
    echo json_encode($output);
	break;

	case 'registrar_req':		
	$datos=$caja->valida_existe_requisicion($_POST["numero_req"]);
      if(is_array($datos)==true and count($datos)==0){
      $caja->agrega_det_requisicion();
      $messages[]="ok";
      
    }else{
      $errors[]="error";
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

/////////////// LISTADO GENERAL DE REQUICISIONES
case "listar_requisiciones":

  $datos=$caja->get_requisiones($_POST["sucursal"]);
  $data= Array();
    foreach($datos as $row){
  $sub_array = array();
 
  if($row["estado"]==0) {
    $badge="warning";
    $icon="fa-clock";
    $estado="Pendiente";
  }elseif($row["estado"]==1){
    $badge="success";
    $icon="fa-clock";
    $estado="Aprobado";
  }elseif($row["estado"]==2){
    $badge="info";
    $icon="fa-clock";
    $estado="Aceptada";
  }elseif($row["estado"]==3){
    $badge="secondary";
    $icon="fa-ban";
    $estado="Finalizado";
  }


    $sub_array[] = $row["id_requisicion"];
    $sub_array[] = $row["n_requisicion"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
    $sub_array[] = $row["sucursal"];    

    $sub_array[] = '<button type="button"  class="btn btn-edit btn-md bg-light" style="text-align:center" onClick="actions_requisicions('.$row["id_requisicion"].',\''.$row["n_requisicion"].'\',\''.$row["estado"].'\');" data-toggle="modal" data-target="#??" data-backdrop="static" data-keyboard="false"><i class="fa fa-cog" aria-hidden="true" style="color:#006600"></i></button>';

    $sub_array[] = '<button type="button"  class="btn btn-md bg-light"><i class="fa fa-print" aria-hidden="true" style="color:red"></i></button>';               
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);

    break;

  case "listar_requisiciones_pendientes":

  $datos=$caja->get_requisiones_pendiente();
  $data= Array();
    foreach($datos as $row){
  $sub_array = array();
 
  if($row["estado"]==0){
    $badge="danger";
    $icon="fa-clock";
    $estado="Pendiente";
  }


    $sub_array[] = $row["id_requisicion"];
    $sub_array[] = $row["n_requisicion"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
    $sub_array[] = $row["sucursal"];    

    $sub_array[] = '<button type="button"  class="btn btn-edit btn-md bg-light" data-toggle="modal" data-target="#accion_req_admin" data-backdrop="static" data-keyboard="false" style="text-align:center" onClick="show_datos_requi('.$row["id_requisicion"].',\''.$row["n_requisicion"].'\');" ><i class="fa fa-cog" aria-hidden="true" style="color:#006600"></i></button>';

    $sub_array[] = '<button type="button"  class="btn btn-md bg-light"><i class="fa fa-print" aria-hidden="true" style="color:red"></i></button>';               
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);

    break;

    case "get_data_requisicion_admin":

    $datos= $caja->get_data_requisicion_admin($_POST["n_requisicion"]);
      if(is_array($datos)==true and count($datos)>0){

        $data = Array();

        foreach($datos as $row)
        {
          $output = array();
          $output["id_detalle_req"] = $row["id_detalle_req"];
          $output["descripcion"] = $row["descripcion"];
          $output["cantidad"] = $row["cantidad"];
          $output["precio"] = number_format($row["precio"],2,".",",");
          $data[] = $output;
                    
        }      

       } 
  echo json_encode($data);
  break;

  case "data_req_est_uno":

    $datos= $caja->get_detalles_req($_POST["n_requisicion"]);
      if(is_array($datos)==true and count($datos)>0){

        $data = Array();

        foreach($datos as $row){
          $output = array();
          $output["id_detalle_req"] = $row["id_detalle_req"];
          $output["descripcion"] = $row["descripcion"];
          $output["cantidad"] = $row["cantidad"];
          $output["estado"] = $row["estado"];
          $data[] = $output;                    
        }      

       } 
  echo json_encode($data);

  break;
  /////////////////   APROBAR REQUICISION  /////////////////
  case 'aprueba_requisicion':

  $datos = $caja->valida_existe_requisicion($_POST["n_requisicion"]);

      if(is_array($datos)==true and count($datos)>0){
      $caja->aprobar_requisicion();
      $messages[]="ok";
      
    }else{
      $errors[]="error";
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
//////////////////////////ACEPTAR REQUISICION
case 'acepta_requisicion':

  $datos = $caja->valida_existe_requisicion($_POST["n_requisicion"]);

      if(is_array($datos)==true and count($datos)>0){
      $caja->acepta_requisicion($_POST["n_requisicion"]);
      $messages[]="ok";
      
    }else{
      $errors[]="error";
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

/////////////////////////ACEPTAR REQUISICION
case 'finaliza_requisicion':

  $datos = $caja->valida_existe_requisicion($_POST["n_requisicion"]);

    $saldo_caja = $caja->saldo_caja_chica($_POST["sucursal"]);

     foreach($saldo_caja as $row){
       $saldo = number_format($row["saldo"],2,".",",");               
     }

     $gasto_caja = $_POST["monto"];

   if ($gasto_caja < $saldo) {
     if(is_array($datos)==true and count($datos)>0){
      $caja->finalizar_requisicion($_POST["n_requisicion"]);
      $messages[]="ok";
      
    }
  }else{
      $errors[]="error";
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

    case "get_id_caja_chica":

    $datos= $caja->get_id_caja_chica($_POST["sucursal"]);

        foreach($datos as $row){
          $output = array();
          $output["id_caja"] = $row["id_caja"];               
        }      
  echo json_encode($output);

  break;

  //////////////GET SALDO CAJA CHICA
  case "get_saldo_caja":

    $datos= $caja->saldo_caja_chica($_POST["sucursal"]);

        foreach($datos as $row){
          $output = array();
          $output["saldo"] = number_format($row["saldo"],2,".",",");               
        }      
  echo json_encode($output);

  break;

  case 'realiza_deposito_caja':

  //$datos = $caja->ver_ingesos_efectivo($_POST["sucursal"]);

  //if(is_array($datos)==true and count($datos)>0){
  $caja->depositar_caja_chica($_POST["usuario"],$_POST["monto_deposito"],$_POST["fecha"],$_POST["id_caja"]);
  //$messages[]="ok";
      
   /* }else{
      $errors[]="error";
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
   } */

    break;
}