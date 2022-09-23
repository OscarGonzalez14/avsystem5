<?php
require_once("../config/conexion.php");
//llamada al modelo marca
require_once("../modelos/Recibos.php");

$recibos = new Recibos();

switch ($_GET["op"]) {
  case 'get_detalle_lente_rec_ini':
     
  break;
///////////////////////GET NUMERO RECIBO
  case "get_numero_recibo":
  
  $sucursal = $_POST["sucursal_correlativo"];
  
  if($sucursal=="Empresarial"){
      $sucursal_usuario = $_POST["sucursal_usuario"];
      $suc = "Empresarial-".$sucursal_usuario; 
      $datos= $recibos->get_numero_recibo($suc);
      $prefijo = "";
      if ($sucursal_usuario == "Metrocentro") {
        $prefijo="MT";
      }elseif ($sucursal_usuario == "Santa Ana") {
        $prefijo="SA";
      }elseif ($sucursal_usuario == "San Miguel") {
        $prefijo="SM";
      }elseif ($sucursal_usuario == "Chalatenango") {
        $prefijo="CH";
      }elseif ($sucursal_usuario == "Ahuachapan") {
        $prefijo="AH";
      }elseif ($sucursal_usuario == "Cascadas") {
        $prefijo="CA";
      }
        if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){                  
          $codigo=$row["numero_recibo"];
          $cod=(substr($codigo,4,11))+1;
          $output["correlativo"]="E".$prefijo."-".$cod;
        }             
      }else{
      $output["correlativo"] = "E".$prefijo."-1";
  }
  }else{/////////////FIN VALIDACION SI ES EMPRESARIAL/////////////

      $datos= $recibos->get_numero_recibo($_POST["sucursal_correlativo"]);
      $prefijo = "";
      if ($sucursal=="Metrocentro") {
        $prefijo="ME";
      }elseif ($sucursal=="Santa Ana") {
        $prefijo="SA";
      }elseif ($sucursal=="San Miguel") {
        $prefijo="SM";
      }elseif ($sucursal=="Chalatenango") {
        $prefijo="CH";
      }elseif ($sucursal=="Ahuachapan") {
        $prefijo="AH";
      }elseif ($sucursal=="Cascadas") {
        $prefijo="CA";
      }
        if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){                  
          $codigo=$row["numero_recibo"];
          $cod=(substr($codigo,4,11))+1;
          $output["correlativo"]="R".$prefijo."-".$cod;
        }             
      }else{
      $output["correlativo"] = "R".$prefijo."-1";
  }  
  }  

  echo json_encode($output);

  break;

  case 'registrar_recibo':

  $datos=$recibos->valida_existencia_nrecibo($_POST["n_recibo"]);
  if(is_array($datos)==true and count($datos)==0){

    if ($_POST["sucursal"]=="Empresarial") {
       $sucursal = "Empresarial-".$_POST["sucursal_usuario"];
    }else{
       $sucursal = $_POST["sucursal"];
    }

    $recibos->agrega_detalle_abono($_POST['a_anteriores'],$_POST['n_recibo'],$_POST['n_venta_recibo_ini'],$_POST['monto'],$_POST['fecha'],$sucursal,$_POST['id_paciente'],$_POST['id_usuario'],$_POST['telefono_ini'],$_POST['recibi_rec_ini'],$_POST['empresa_ini'],$_POST['texto'],$_POST['numero'],$_POST['saldo'],$_POST['forma_pago'],$_POST['marca_aro_ini'],$_POST['modelo_aro_ini'],$_POST['color_aro_ini'],$_POST['lente_rec_ini'],$_POST['ar_rec_ini'],$_POST['photo_rec_ini'],$_POST['observaciones_rec_ini'],$_POST['pr_abono'],$_POST['servicio_rec_ini']);
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

//////////////////////////// REGISTRAR ABONO DE PRIMA
  case 'registrar_prima':

  $datos=$recibos->valida_existencia_nrecibo($_POST["n_recibo"]);
  if(is_array($datos)==true and count($datos)==0){

    if ($_POST["sucursal"]=="Empresarial") {
       $sucursal = "Empresarial-".$_POST["sucursal_usuario"];
    }else{
       $sucursal = $_POST["sucursal"];
    }

    $recibos->agrega_detalle_prima($_POST['a_anteriores'],$_POST['n_recibo'],$_POST['n_venta_recibo_ini'],$_POST['monto'],$_POST['fecha'],$sucursal,$_POST['id_paciente'],$_POST['id_usuario'],$_POST['telefono_ini'],$_POST['recibi_rec_ini'],$_POST['empresa_ini'],$_POST['texto'],$_POST['numero'],$_POST['saldo'],$_POST['forma_pago'],$_POST['marca_aro_ini'],$_POST['modelo_aro_ini'],$_POST['color_aro_ini'],$_POST['lente_rec_ini'],$_POST['ar_rec_ini'],$_POST['photo_rec_ini'],$_POST['observaciones_rec_ini'],$_POST['pr_abono'],$_POST['servicio_rec_ini'],$_POST["tipo_recibo"],$_POST["numero_orden"]);
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

  /////////////COMPROBAR SALDOS PARA IMPRIMIR FACTURA CONTADO
  case "consultar_saldo":
  $datos= $recibos->saldo_venta($_POST["n_venta"],$_POST["id_paciente"]);
  
    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){                  
        $output["saldo"]=$row["saldo"];
      }             
    }

   echo json_encode($output);

  break;

  case 'listar_recibos_emitidos':

    $sucursal = $_POST['sucursal'];

    if ($sucursal=="Empresarial"){
      $suc = $_POST["sucursal_usuario"];
    }else{
      $suc = $_POST["sucursal"];
    }

    $datos=$recibos->get_recibos_emitidos($_POST["sucursal"]);

    $data= Array();

    foreach($datos as $row){

        $sub_array = array();

        $sub_array[] = $row["id_recibo"];
        $sub_array[] = $row["numero_recibo"];
        $sub_array[] = $row["numero_venta"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["servicio_para"];
        $sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="editar_recibo('.$row["id_recibo"].',\''.$row["numero_recibo"].'\',\''.$row["numero_venta"].'\','.$row["nombres"].')"><i class="fa fa-edit" aria-hidden="true" style="color:green"></i></button>';
        $sub_array[] = '<a href="imprimir_recibo_pdf.php?n_recibo='.$row["numero_recibo"].'&'."nombres=".$row["nombres"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button" class="btn btn-link btn-md imprimir_recibo"><i class="fa fa-print" aria-hidden="true" style="color:green"></i></button></a>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);      
    break;

 ///////////////    GET DATA PRODUCTOS   /////////////////

  case 'get_datos_lentes_prima':
  $datos= $recibos->get_detalle_lente_od($_POST["id_paciente"],$_POST["correlativo_oid"]); 
  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;
  //////////////////////////////   GET DATA AROS 
  case 'get_datos_aros_prima':
  $datos= $recibos->get_detalle_aros_od($_POST["id_paciente"],$_POST["correlativo_oid"]);
  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["marca"] = $row["marca"];
      $output["modelo"] = $row["modelo"];
      $output["color"] = $row["color"];                
    }       
    echo json_encode($output);

  } 
  break;

  case 'get_datos_photo_prima':
  $datos= $recibos->get_detalle_photo_prima($_POST["id_paciente"],$_POST["correlativo_oid"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;

  //////////GET DATA ANTIREFLEJANTE RECIBO INICIAL 
  case 'get_datos_prima':
  $datos= $recibos->get_detalle_ar_prima($_POST["id_paciente"],$_POST["correlativo_oid"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;

  ////LISTAR RECIBOS EN DATATABLE REPORTE
  case 'listar_recibos':  
  $sucursal = $_POST['sucursal'];

    if ($sucursal=="Empresarial"){
      $suc = $_POST["sucursal_usuario"];
    }else{
      $suc = $_POST["sucursal"];
    }

  $datos=$recibos->listar_recibos($suc);

  $data= Array();

  foreach($datos as $row)
  {
    $sub_array = array();
    $sub_array[] = $row["id_recibo"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = $row["numero_recibo"];
    $sub_array[] = $row["recibi_de"];
    $sub_array[] = "$".number_format((float)$row["monto"],2,".",",");
    $sub_array[] = "$".number_format((float)$row["a_anteriores"],2,".",",");
    $sub_array[] = "$".number_format((float)$row["abono_act"],2,".",",");
    $sub_array[] = "$".number_format((float)$row["saldo"],2,".",",");
    $sub_array[] = $row["forma_pago"];
    $sub_array[] = $row["empresas"];
    $sub_array[] = $row["observaciones"];

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