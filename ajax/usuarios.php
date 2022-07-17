<?php 
// se agrega el enlace de conexión a la base de datos
require_once("../config/conexion.php");
//se invoca el modelo Usuario
require_once("../modelos/Usuario.php");

$usuario = new Usuarios();

switch ($_GET["op"]){

  case "get_numero_usuario":
  $datos= $usuario->get_codigo_usuario();
  
  if(is_array($datos)==true and count($datos)>0){

    foreach($datos as $row){     
      $numero = substr($row["id_user_emp"],3,11)+1;            
      $output["correlativo"] = "AV-".$numero;
    }             
  }
   echo json_encode($output);

  break;

	case 'guardar_usuario':
 
  $valida_usuario = $usuario->comprueba_existe_usuario($_POST["cod_user"]);

  if (is_array($valida_usuario)==true and count($valida_usuario)==0 ){
	$usuario->registrarUsuario($_POST["nom_user"],$_POST["tel_user"],$_POST["correo_user"],$_POST["dir_user"],$_POST["user"],$_POST["pass_user"],$_POST["fecha_ingreso"],$_POST["cat_user"],$_POST["est_user"],$_POST["suc_user"],$_POST["cod_user"],$_POST["permisosUser"]);
      $messages[]="ok";

  }else{
      $usuario->editarUsuario($_POST["nom_user"],$_POST["tel_user"],$_POST["correo_user"],$_POST["dir_user"],$_POST["user"],$_POST["pass_user"],$_POST["fecha_ingreso"],$_POST["cat_user"],$_POST["est_user"],$_POST["suc_user"],$_POST["cod_user"],$_POST["id_usuario"],$_POST["permisosUser"]);
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

	/////////////LISTAR USUARIOS
	 case "listar_usuarios":
    $datos=$usuario->get_usuarios();
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row)
      {
        $sub_array = array();
        $sub_array[] = $row["id_usuario"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $row["categoria"];
        $sub_array[] = $row["telefono"];
        $sub_array[] = $row["correo"];
        $sub_array[] = $row["direccion"];
        $sub_array[] = '<button type="button" class="btn btn-edit btn-md bg-light" style="text-align:center" onClick="show_datos_paciente('.$row["id_usuario"].');" data-toggle="modal" data-target="#nuevo_usuario"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
        $sub_array[] = '<button type="button"  id="'.$row["id_usuario"].'" class="btn btn-power-off btn-md activa_desactiva_usuario bg-light" style="text-align:center" onClick=estado_usuario('.$row["id_usuario"].',\''.$row["estado"].'\');" data-toggle="modal" data-target="#" data-backdrop="static" data-keyboard="false"><i class="fa fa-power-off" aria-hidden="true" style="color:#006600"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;


  /////////////////SHOW DATOS DE USUARIO EN MODAL PARA EDITAR
  case 'show_datos_usuario':    
    $datos=$usuario->show_datos_usuario($_POST["id_usuario"]);
      foreach($datos as $row){
      $output["id_usuario"] = $row["id_usuario"];
      $output["nombres"] = $row["nombres"];
      $output["telefono"] = $row["telefono"];
      $output["correo"] = $row["correo"];
      $output["direccion"] = $row["direccion"];
      $output["usuario"] = $row["usuario"];
      $output["password"] = $row["password"];
      $output["categoria"] = $row["categoria"];
      $output["estado"] = $row["estado"];
      $output["sucursal"] = $row["sucursal"];
      $output["id_user_emp"] = $row["id_user_emp"];
  }
    echo json_encode($output);
  break;

 case 'permisos':
            
    //get todos los permisos de la tabla permisos
    $listar_permisos = $usuario->permisos();

    //Obtener los permisos asignados al usuario
    /*el id_usuario se envía cuando se edita un usuario*/
    $id_usuario=$_GET['id_usuario'];

    $marcados = $usuario->listar_permisos_por_usuario($id_usuario);
    //Declaramos el array para almacenar todos los permisos marcados
    $valores=array();
    //Almacenar los permisos asignados al usuario en el array

    foreach($marcados as $re){
      $valores[]=$re["id_permiso"];
    }
    //Mostramos la lista de permisos en la vista y si están o no marcados

    foreach($listar_permisos as $row){
      $output["id_permiso"]=$row["id_permiso"];
      $output["nombre"]=$row["nombre"];
    /*verificamos si el $row["id_permiso"] estan dentro del array $valores y y si lo está entonces estaría marcado, en caso contrario no estaría marcado*/
                
    $sw = in_array($row['id_permiso'],$valores) ? 'checked':'';                 
      echo '<li><input type="checkbox" '.$sw.' name="permisos_user" value="'.$row["id_permiso"].'"> '.$row["nombre"].'</li>';
    }

  break;

	}
?>

