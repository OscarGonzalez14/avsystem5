<?php
require_once("../config/conexion.php");
//llamada al modelo marca
require_once("../modelos/Marcas.php");

$marca = new Marca();

switch ($_GET["op"]) {
  case 'guardar_marca':
     $datos=$marca->valida_existencia_marca($_POST["nom_marca"]);
     if(is_array($datos)==true and count($datos)==0){
      $marca->registrar_marca($_POST["nom_marca"]);
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
  //fin mensaje error
    break;

    case "get_marcas":
    $datos= $marca->get_marcas();  
    $data= Array();

    foreach($datos as $row){
      $sub_array = $row["marca"];
      array_push($data,$sub_array);
    }

    echo json_encode($data);
    break;

}