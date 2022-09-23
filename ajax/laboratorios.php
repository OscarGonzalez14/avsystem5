<?php
require_once("../config/conexion.php");
// llamada al modelo categoria
require_once("../modelos/Laboratorios.php");

$laboratorios = new Laboratorio();

switch ($_GET["op"]){

 case 'get_correlativo_orden':

  date_default_timezone_set('America/El_Salvador'); $now = date("dmY");
  $fecha = date('d-m-Y');
  $datos= $laboratorios->get_correlativo_orden($fecha);

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){
      $numero_orden = substr($row["cod_orden"],8,15)+1;
      $output["cod_orden"] = $now.$numero_orden;
    }  

  }else{
        $output["cod_orden"] = $now.'1';
  }
  echo json_encode($output);

  break;

  case 'registrarEnvioLab':
  $datos = $laboratorios->valida_existencia_orden($_POST["cod_orden"]);
  if(is_array($datos)==true and count($datos)==0){
    $laboratorios->registrarEnvioLab($_POST["cod_orden"],$_POST["paciente"],$_POST["empresa"],$_POST["laboratorio"],$_POST["lente"],$_POST["modelo_aro"],$_POST["marca_aro"],$_POST["color_aro"],$_POST["diseno_aro"],$_POST["usuario"],$_POST["sucursal"],$_POST["prioridad"],$_POST["observaciones"]);
    $mensaje = "ok";
  }else{
    $laboratorios->editarEnvioLab($_POST["cod_orden"],$_POST["paciente"],$_POST["empresa"],$_POST["laboratorio"],$_POST["lente"],$_POST["modelo_aro"],$_POST["marca_aro"],$_POST["color_aro"],$_POST["diseno_aro"],$_POST["usuario"],$_POST["sucursal"],$_POST["prioridad"],$_POST["observaciones"]);
    $mensaje="editado";
    }

    echo json_encode($mensaje);
    break;

////////////////////////////LISTAR ORDENES CREADAS
     case 'listar_ordenes':
     if ($_POST["sucursal"]=="Empresarial") {
      $sucursal = $_POST["sucursal_usuario"];
    }else{
      $sucursal = $_POST["sucursal"];    
      }

      $datos = $laboratorios->get_ordenes_creadas($sucursal);
      $data = Array();
      $i=0;
      $titulo="";
      foreach ($datos as $row) {
        if ($row["estado"]==0) {
          $badge="warning";
          $icon="fa-clock";
          $estado="Pendiente";
          $titulo ="Enviar";
        }elseif($row["estado"]==1){
          $badge="success";
          $icon="fa-share-square";
          $estado="Enviado";
        }elseif ($row["estado"]==4) {
          $badge="danger";
          $icon="fa-share-square";
          $estado="Rechazado";
          $titulo ="Reenviar";
        }

        $sub_array = array();
        $sub_array[] = $row["id_orden_lab"];
        $sub_array[] = '<input type="checkbox"class="form-check-input envio_orden_labs" value="'.$row["cod_orden"].'" name="'.$row["paciente"].'" id="orden_env'.$i.'">'.$titulo.'';
        $sub_array[] = ucwords(strtolower($row["paciente"]));
        $sub_array[] = $row["empresa"];
        $sub_array[] = $row["fecha_creacion"];
        $sub_array[] = $row["laboratorio"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-trash" aria-hidden="true" style="color:red"></i></button>';
       // $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-trash" aria-hidden="true" style="color:red"></i></button>';        
        $data[] = $sub_array;
        $i++;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
      break;


//////////////////////  LISTAR ORDENES ENVIADAS /////////////////

   ////////////////////////////LISTAR ORDENES CREADAS
    case 'listar_ordenes_enviadas':

      $datos = $laboratorios->get_ordenes_enviadas($_POST["sucursal"]);

      $data = Array();
      $i=0;
      foreach ($datos as $row) {
        if ($row["estado"]==0) {
          $badge="warning";
          $icon="fa-clock";
          $estado="Pendiente";
        }elseif($row["estado"]==1){
          $badge="success";
          $icon="fa-share-square";
          $estado="Enviado";
        }elseif ($row["estado"]==5) {
          $badge="danger";
          $icon="fa-share-square";
          $estado="Rechazado";
        }elseif ($row["estado"]==6) {
          $badge="danger";
          $icon="fa-share-square";
          $estado="Reenviado";
        }

      $prioridad = $row["prioridad"];

      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha_envio"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);
        $transcurridos = $fecha_ini->diff($fecha_act);
        $dias_transcurridos=$transcurridos->format('%d Dias');
        $transc = $transcurridos->format('%d'); 
        if ($transc > $prioridad) {
          $badge_transc="danger";
        }else{
          $badge_transc="info";
        }

        $sub_array = array();
          $sub_array[] = $row["id_accion"];
          $sub_array[] = '<input type="checkbox" class="form-check-input receive_ordenes_lab" value="'.$row["cod_orden"].'" name="'.$row["paciente"].'" id="env_lab'.$i.'">Recibir';
          $sub_array[] = ucwords(strtolower($row["paciente"]));          
          $sub_array[] = $row["empresa"];
          $sub_array[] = $row["fecha_envio"];
          $sub_array[] = $row["laboratorio"];
          $sub_array[] = $row["sucursal"];
          $sub_array[] = $estado;
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = $dias_transcurridos;
          $data[] = $sub_array;
          $i++;

      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
  break;
/////////////////LISTAR ORDENES RETRASADAS //////////
case 'listar_ordenes_retrasadas':

      $datos = $laboratorios->get_ordenes_enviadas();

      $data = Array();
      $i=0;
      foreach ($datos as $row) {

      $prioridad = $row["prioridad"];

      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha_envio"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);
        $transcurridos = $fecha_ini->diff($fecha_act);
        $dias_transcurridos=$transcurridos->format('%d Dias');
        $transc = $transcurridos->format('%d');
        $retraso = $transc-$prioridad;

        if ($transc > $prioridad) {
          $sub_array = array();
          $sub_array[] = $row["id_accion"];
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" ria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = ucwords(strtolower($row["paciente"]));
          $sub_array[] = $row["empresa"];
          $sub_array[] = $row["fecha_envio"];        
          $sub_array[] = $row["laboratorio"];
          $sub_array[] = $row["sucursal"];
          $sub_array[] = '<span class="right badge badge-danger"><i class=" fas fa-bell" style="color:white"></i><span> Retraso</span>';
          $sub_array[] = $prioridad.' dias';
          $sub_array[] = $retraso.' dias';         
          $data[] = $sub_array;
          $i++;
        }

      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
  break;

//////////////////////////ORDENES RECIBIDAS //////////
   case 'listar_ordenes_recibidas':

      $datos = $laboratorios->get_ordenes_recibidas();

      $data = Array();
      $i=0;
      $atrib ="";
      foreach ($datos as $row) {
        if($row["estado"]==0) {
          $badge="warning";
          $icon="fa-clock";
          $estado="Pendiente";
        }elseif($row["estado"]==1){
          $badge="info";
          $icon="fa-share-square";
          $estado="Enviado";
        }elseif($row["estado"]==2){
          $badge="info";
          $icon="fa-share-square";
          $estado="Recibido";
          $atrib ="disabled";
        }elseif($row["estado"]==3){
          $badge="success";
          $icon="fa-share-square";
          $estado="Aprobado";
          $atrib ="";
        }elseif ($row["estado"]==5) {
          $badge="danger";
          $icon="fa-share-square";
          $estado="Rechazado";
        }

      $prioridad = $row["prioridad"];

      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha_recibido"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);
        $transcurridos = $fecha_ini->diff($fecha_act);
        $dias_transcurridos=$transcurridos->format('%d Dias');
        $transc = $transcurridos->format('%d'); 
        if ($transc > $prioridad) {
          $badge_transc="danger";
        }else{
          $badge_transc="info";
        }

        $sub_array = array();
          $sub_array[] = $row["id_accion"];
          $sub_array[] = $row["cod_orden"];;
          $sub_array[] = ucwords(strtolower($row["paciente"]));          
          $sub_array[] = $row["empresa"];
          $sub_array[] = $row["fecha_recibido"];
          $sub_array[] = $row["laboratorio"];
          $sub_array[] = $row["sucursal"];
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"  data-toggle="modal" data-target="#modal_ccalidad" data-backdrop="static" data-keyboard="false" onClick="controlCalidad(\''.$row["cod_orden"].'\',\''.ucwords(strtolower($row["paciente"])).'\','.$row["id_orden_lab"].');"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
          $data[] = $sub_array;
          $i++;

      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
  break; 

//////////////////////////ORDENES APROBADAS //////////
   case 'get_ordenes_aprobadas':

      $datos = $laboratorios->get_ordenes_aprobadas();

      $data = Array();
      $i=0;
      $atrib ="";
      foreach ($datos as $row) {
        if ($row["estado"]==0) {
          $badge="warning";
          $icon="fa-clock";
          $estado="Pendiente";
        }elseif($row["estado"]==1){
          $badge="info";
          $icon="fa-share-square";
          $estado="Enviado";
        }elseif($row["estado"]==2){
          $badge="info";
          $icon="fa-share-square";
          $estado="Recibido";
          $atrib ="disabled";
        }elseif($row["estado"]==3){
          $badge="success";
          $icon="fa-share-square";
          $estado="Aprobado";
          $atrib ="";
        }elseif ($row["estado"]==5) {
          $badge="danger";
          $icon="fa-share-square";
          $estado="Rechazado";
        }

      $prioridad = $row["prioridad"];

      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha_recibido"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);
        $transcurridos = $fecha_ini->diff($fecha_act);
        $dias_transcurridos=$transcurridos->format('%d Dias');
        $transc = $transcurridos->format('%d'); 
        if ($transc > $prioridad) {
          $badge_transc="danger";
        }else{
          $badge_transc="info";
        }

        $sub_array = array();
          $sub_array[] = $row["id_accion"];
          $sub_array[] = '<input type="checkbox" class="form-check-input entregar_ordenes_lab" value="'.$row["cod_orden"].'" name="'.$row["paciente"].'" id="env_lab'.$i.'" '.$atrib.'>Entregar';
          $sub_array[] = ucwords(strtolower($row["paciente"]));          
          $sub_array[] = $row["empresa"];
          $sub_array[] = $row["fecha_recibido"];
          $sub_array[] = $row["laboratorio"];
          $sub_array[] = $row["sucursal"];
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"  data-toggle="modal" data-target="#modal_ccalidad" data-backdrop="static" data-keyboard="false" onClick="controlCalidad(\''.$row["cod_orden"].'\',\''.ucwords(strtolower($row["paciente"])).'\','.$row["id_orden_lab"].');"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
          $data[] = $sub_array;
          $i++;

      }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
  break;    
//////////////////// LISTAR ORDENES ENTREGADAS //////////
case 'listar_ordenes_entregadas':
 
  $datos = $laboratorios->get_ordenes_entregadas();
      $data = Array();
      foreach ($datos as $row) {

        $sub_array = array();
        $sub_array[] = $row["id_orden_lab"];
        $sub_array[] = $row["cod_orden"];
        $sub_array[] = ucwords(strtolower($row["paciente"]));
        $sub_array[] = $row["empresa"];
        $sub_array[] = $row["fecha_entregado"];
        $sub_array[] = $row["laboratorio"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = '<span class="right badge badge-success"><i class=" far fa-thumbs-up" style="color:color"></i><span> Entregado</span>';
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
        $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-trash" aria-hidden="true" style="color:red"></i></button>';     
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
      break;
/////////////////////// FIN ORDENES ENTREGADAS ////////////

  case 'registrar_envio':
    $laboratorios->registrarOrdenEnvio();
    $messages[]='ok';
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

/////////////// 
  case 'recibir_ordenes':
    $laboratorios->recibirOrdenes();
    $messages[]='ok';
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

  ////////////////////////ACEPTAR ORDEN ////////////
  case 'aceptar_orden':
    $laboratorios->aceptarOrdenes($_POST["numero_orden"],$_POST["paciente"],$_POST["observaciones"],$_POST["usuario"],$_POST["id_orden"],$_POST["accion"]);
    $messages[]='ok';
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
               echo json_encode($_POST);
             }
           ?>
   <?php
   }
  break;
////////////////// ENTREGAR ORDENES ///////////////
  case 'entregar_ordenes':
    $laboratorios->entregarOrdenes();
    $messages[]='ok';
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
          echo json_encode($_POST);
        }
    ?>
    <?php
  }
  break;
////////////////// 
  case 'count_ordenes_creadas':
    $datos = $laboratorios->get_ordenes_creadas();
    $creadas=0;
    foreach ($datos as $row) {
      $creadas = $creadas+1;
    }
    echo json_encode($creadas);
  break;

  case 'count_ordenes_enviadas':
    $enviadas = $laboratorios->get_ordenes_enviadas();
    $env=0;
    foreach ($enviadas as $row) {
      $env = $env+1;
    }
    echo json_encode($env);
  break;

  case 'count_ordenes_recibidas':
    $recibidas = $laboratorios->get_ordenes_recibidas();
    $env=0;
    foreach ($recibidas as $row) {
      $env = $env+1;
    }
    echo json_encode($env);
  break;

   case 'count_ordenes_aprobadas':
    $aprobadas = $laboratorios->get_ordenes_aprobadas();
    $apr=0;
    foreach ($aprobadas as $row) {
      $apr = $apr+1;
    }
    echo json_encode($apr);
  break;

  case 'count_ordenes_retrasadas':

      $datos = $laboratorios->get_ordenes_enviadas();
      $i=0;
      foreach ($datos as $row) {
      $prioridad = $row["prioridad"];

      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha_envio"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);
        $transcurridos = $fecha_ini->diff($fecha_act);
        $transc = $transcurridos->format('%d');

        if ($transc > $prioridad) {
          $i++;
        }
    }
      echo json_encode($i);
  break;

  case 'count_ordenes_entregadas':
    $entregadas = $laboratorios->get_ordenes_entregadas();
    $env=0;
    foreach ($entregadas as $row) {
      $env = $env+1;
    }
    echo json_encode($env);
  break;

  case 'get_data_orden':
    $datos = $laboratorios->get_data_orden($_POST["id_orden"],$_POST["cod_orden"]);
        if (is_array($datos)==true and count($datos)>0) {
          foreach ($datos as $row) {
            $output["cod_orden"] = $row["cod_orden"];
            $output["fecha_creacion"] = $row["fecha_creacion"];
            $output["paciente"] = ucwords(strtolower($row["paciente"]));
            $output["empresa"] = $row["empresa"];
            $output["laboratorio"] = $row["laboratorio"];
            $output["lente"] = $row["lente"];
            $output["modelo_aro"] = $row["modelo_aro"];
            $output["marca_aro"] = $row["marca_aro"];
            $output["color_aro"] = $row["color_aro"];
            $output["diseno_aro"] = $row["diseno_aro"];
            $output["usuario"] = $row["usuario"];
            $output["sucursal"] = $row["sucursal"];
            $output["prioridad"] = $row["prioridad"];
            $output["estado"] = $row["estado"];
            $output["observaciones"] = $row["observaciones"];
          }
        echo json_encode($output);
    }
  break;

  case 'get_actions_orders':
    
    $datos = $laboratorios->get_actions_orders($_POST["id_orden"],$_POST["cod_orden"]);
      if(is_array($datos)==true and count($datos)>0){
      $data= Array();

      foreach ($datos as $value){
        $accion = $value["tipo_accion"];

        if ($accion=="Envio"){
          $tipo_accion = "Enviado";
        }elseif($accion=="Reenviado"){
          $tipo_accion = "Reenviado";
        }elseif($accion=="Entregar"){
          $tipo_accion = "Entregado";
        }elseif($accion=="Aprobado"){
          $tipo_accion = "Aprobado";
        }elseif($accion=="Recibir"){
          $tipo_accion = "Recibido";
        }

        $output["fecha"] = $value["fecha"];
        $output["tipo_accion"] = ucwords(strtolower($tipo_accion));
        $output["nick"] = ucfirst(strtolower($value["nick"]));
        $output["observaciones"] = ucwords(strtolower($value["observaciones"]));
        $data[] = $output;
       }
     }
  echo json_encode($data);     
  break;

  case 'get_estado_orden':
    $data = $laboratorios->state_order($_POST["codigo"]);
    foreach ($data as $row) {
      $state = $row["estado"];
    }
    echo json_encode($state);
    break;
    
///*******LISTAR ORDENES EN GENERAL ******°°°|||
case 'listar_ordenes_general':

  $datos = $laboratorios->get_ordenes_general($_POST["sucursal_act"]);
      $data = Array();
      $estado = "";

      foreach ($datos as $row) {

        if ($row["estado"]==0) {
          $estado="Pendiente";
        }elseif($row["estado"]==1){
          $estado="Enviado";
        }elseif($row["estado"]==2){
          $estado="Recibido";
        }elseif($row["estado"]==3){
          $estado="Aprobado";
        }elseif($row["estado"]==4){
          $estado="Rechazado";
        }elseif($row["estado"]==5){
          $estado="Entregado";
        }

        $sub_array = array();
        $sub_array[] = $row["id_orden_lab"];
        $sub_array[] = $row["cod_orden"];
        $sub_array[] = ucwords(strtolower($row["paciente"]));
        $sub_array[] = $row["empresa"];
        $sub_array[] = $row["fecha_creacion"];
        $sub_array[] = $row["laboratorio"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $estado;
        $sub_array[] = '<button type="button" class="btn btn-sm btn-outline-secondary btn-sm" onClick="detOrdenes('.$row["id_orden_lab"].',\''.$row["cod_orden"].'\');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
        $sub_array[] = $sub_array[] = '<button type="button"  class="btn btn-sm bg-light" onClick="eliminar_orden_lab('.$row["id_orden_lab"].')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';    
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
      break;
      
    case "eliminar_orden_lab":
       $datos=$laboratorios->eliminar_orden_lab($_POST["cod_orden"]);
    break;

}
 ?>