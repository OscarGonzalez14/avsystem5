<?php

require_once("../config/conexion.php");

require_once("../modelos/Ordenes.php");
 
$ordenes = new Ordenes();

switch($_GET["op"]){

  case "get_consultas":


	  $datos=$ordenes->get_consultas_orden($_POST["sucursal_usuario"]);


 	$data= Array();
    foreach($datos as $row){
		$sub_array = array();
 		$sub_array[] = $row["id_consulta"];		
		$sub_array[] = $row["nombres"];
		$sub_array[] = $row["p_evaluado"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_consulta"];
        $sub_array[] = '<button type="button"  class="btn btn-outline-secondary btn-xs asigna_datos_orden" onClick="agregaConsultaOrden('.$row["id_paciente"].','.$row["id_consulta"].',\''.$row["p_evaluado"].'\');"><i class="fas fa-plus-circle" style="color: green"></i> Seleccionar</button>';                                 
		$data[] = $sub_array;
	}
        $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

    case 'get_numero_venta':
        
        $datos = $ordenes->get_numero_venta($_POST["id_paciente"],$_POST["evaluado"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["numero_venta"] = $row["numero_venta"];
            }
        echo json_encode($output);
        }

        break;

    case 'get_items_venta':
        $datos = $ordenes->get_items_venta($_POST["id_paciente"],$_POST["numero_venta"]);
        if (is_array($datos)==true and count($datos)>0) {
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id_producto"];
                $data[] = $sub_array;
            }
            echo json_encode($data);
        }
        break;

    case 'get_categoria_producto':
        
        $datos = $ordenes->get_categoria_producto($_POST["codProd"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["categoria_producto"] = $row["categoria_producto"];
            }
        echo json_encode($output);
        }

        break;

    case 'get_detalle_aro':
    
        require_once("../modelos/Productos.php"); 
        $productos = new Productos();
        $datos = $productos->show_datos_aros($_POST["id_producto"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["modelo"] = $row["modelo"];
                $output["marca"] = $row["marca"];
                $output["color"] = $row["color"];
                $output["diseno"] = $row["diseno"];
            }
        echo json_encode($output);
        }
        break;

        case 'get_detalle_tratamientos':
        require_once("../modelos/Productos.php"); 
        $productos = new Productos();
        $datos = $productos->show_datos_producto_id($_POST["id_producto"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["desc_producto"] = $row["desc_producto"];
            }
        echo json_encode($output);
        }
        break;

    case "get_numero_orden":
    $datos= $ordenes->get_numero_orden_lab($_POST["sucursal"]);
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
            $codigo=$row["numero_orden"];
            $cod=substr($codigo,5,11)+1;
            $output["correlativo"]="OD".$prefijo."-".$cod;
        }                           
    }else{
        $output["correlativo"] = "OD".$prefijo."-1";
    }

     echo json_encode($output);

  break;

  case 'registrarEnvio':
      $datos = $ordenes->buscar_existe_orden($_POST["numero_orden"]);
      if(is_array($datos)==true and count($datos)==0){
      $ordenes->registrar_orden($_POST["paciente_orden"],$_POST["laboratorio_orden"],$_POST["id_pac_orden"],$_POST["id_consulta_orden"],$_POST["lente_orden"],$_POST["tratamiento_orden"],$_POST["modelo_aro_orden"],$_POST["marca_aro_orden"],$_POST["color_aro_orden"],$_POST["diseno_aro_orden"],$_POST["med_a"],$_POST["med_b"],$_POST["med_c"],$_POST["med_d"],$_POST["observaciones_orden"],$_POST["id_usuario"],$_POST["fecha"],$_POST["sucursal"],$_POST["numero_orden"],$_POST["prioridad_orden"]);
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
      break;

   case 'listar_ordenes':
       $datos = $ordenes->listar_ordenes($_POST["sucursal"]);

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
          }

          $sub_array = array();
          $sub_array[] = $row["id_envio"];
          $sub_array[] = '<input type="checkbox" class="form-check-input send_orden" value="'.$row["id_paciente"].'" name="'.$row["numero_orden"].'" id="env_lab'.$i.'">Enviar';          
          $sub_array[] = $row["evaluado"];
          $sub_array[] = $row["numero_orden"];
          $sub_array[] = $row["fecha_creacion"];
          $sub_array[] = ucfirst($row["usuario"]);
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          //$sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="acciones_envios_lab('.$row["id_paciente"].',\''.$row["numero_orden"].'\',\''.$row["evaluado"].'\',\''.$row["estado"].'\',\''.$row["laboratorio"].'\')"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
        $data[] = $sub_array;
        $i++;
       }
      // $data[] = $sub_array;
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results); 
       break;

case 'get_ordenes_retrasadas':
  $datos = $ordenes->listar_ordenes_enviadas($_POST["sucursal"]);
  $data = Array();
  $i=0;
  foreach ($datos as $row) {
    $prioridad = $row["prioridad"];
    date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
    $fecha = $row["fecha"];//strtotime($row["fecha"]);
    $fecha_actual = $hoy;//strtotime($hoy);
    $fecha_ini = new DateTime($fecha);
    $fecha_act = new DateTime($fecha_actual);
    $transcurridos = $fecha_ini->diff($fecha_act);
    $dias_transcurridos=$transcurridos->format('%d Dias');
    $transc = $transcurridos->format('%d');

    if ($transc > $prioridad) {
        $i = $i+1;
    } 
  }
  echo json_encode($i);
  break;

  case 'get_ordenes_recibidas':
    $datos = $ordenes->listar_ordenes_recibidas($_POST["sucursal"]);
    $recibidos=0;
    foreach ($datos as $row) {
      $recibidos = $recibidos+1;
    }
    echo json_encode($recibidos);
    break;
  
  case 'get_ordenes_enviadas':
    $datos = $ordenes->listar_ordenes_enviadas($_POST["sucursal"]);
    $enviadas=0;
    foreach ($datos as $row) {
      $enviadas = $enviadas+1;
    }
    echo json_encode($enviadas);
    break;

    case 'get_ordenes_creadas':
    $datos = $ordenes->listar_ordenes($_POST["sucursal"]);
    $creadas=0;
    foreach ($datos as $row) {
      $creadas = $creadas+1;
    }
    echo json_encode($creadas);
    break;  

///////////////ORDENES ENVIADAS
    case 'listar_ordenes_enviadas':
    $peticion = $_POST["peticion"];
    if($peticion == "envios"){
       $datos = $ordenes->listar_ordenes_enviadas($_POST["sucursal"]);

       $data = Array();
       $i=0;
       foreach ($datos as $row) {

        if ($row["estado"]==0) {
            $badge="secondary";
            $icon="fa-clock";
            $estado="Pendiente";
          }elseif($row["estado"]==1){
            $badge="warning";
            $icon="fa-share-square";
            $estado="Enviado";
          }elseif($row["estado"]==2){
            $badge="success";
            $icon="fa-share-square";
            $estado="Recibido";
          }

        $prioridad = $row["prioridad"];

        date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha"];//strtotime($row["fecha"]);
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
          $sub_array[] = $row["id_envio"];
          $sub_array[] = '<input type="checkbox" class="form-check-input recibir_orden" value="'.$row["id_paciente"].'" name="'.$row["numero_orden"].'" id="env_lab'.$i.'">Recibir';          
          $sub_array[] = $row["evaluado"];
          $sub_array[] = $row["numero_orden"];
          $sub_array[] = $row["fecha"];
          $sub_array[] = '<span class="right badge badge-'.$badge_transc.'">'.$dias_transcurridos.'</span>';
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detalles_orden('.$row["id_paciente"].',\''.$row["numero_orden"].'\',\''.$row["evaluado"].'\','.$row["id_consulta"].');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
        $data[] = $sub_array;
        $i++;
       }
      // $data[] = $sub_array;
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);
      //echo json_encode($i);
      //////////////////ORDENES CREADAS
      }elseif ($peticion == "creadas") {
       $datos = $ordenes->listar_ordenes($_POST["sucursal"]);

       $data = Array();
       $i=0;
       foreach ($datos as $row) {

        if ($row["estado"]==0) {
            $badge="secondary";
            $icon="fa-clock";
            $estado="Pendiente";
          }elseif($row["estado"]==1){
            $badge="warning";
            $icon="fa-share-square";
            $estado="Enviado";
          }elseif($row["estado"]==2){
            $badge="success";
            $icon="fa-share-square";
            $estado="Recibido";
          }elseif ($row["estado"]==5) {
            $badge="danger";
            $icon="fa-share-square";
            $estado="Rechazado";
          }

          $sub_array = array();
          $sub_array[] = $row["id_envio"];
          $sub_array[] = '<input type="checkbox" class="form-check-input send_orden" value="'.$row["id_paciente"].'" name="'.$row["numero_orden"].'" id="send_lab'.$i.'">Enviar';          
          $sub_array[] = $row["evaluado"];
          $sub_array[] = $row["numero_orden"];
          $sub_array[] = $row["fecha_creacion"];
          $sub_array[] = ucfirst($row["usuario"]);
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detalles_orden('.$row["id_paciente"].',\''.$row["numero_orden"].'\',\''.$row["evaluado"].'\','.$row["id_consulta"].');"><i class="fas fa-eye" aria-hidden="true" style="color:blue" ¿></i></button>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
        $data[] = $sub_array;
        $i++;
       }
      // $data[] = $sub_array;
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
      //////////////////ORDENES RECIBIDAS
      }elseif($peticion == "recibidas") {
       $datos = $ordenes->listar_ordenes_recibidas($_POST["sucursal"]);

       $data = Array();
       $i=0;
       foreach ($datos as $row) {

        if($row["estado"]==0) {
            $badge="secondary";
            $icon="fa-clock";
            $estado="Pendiente";
          }elseif($row["estado"]==1){
            $badge="warning";
            $icon="fa-share-square";
            $estado="Enviado";
          }elseif($row["estado"]==2){
            $badge="danger";
            $icon="fas fa-clipboard-check";
            $estado="Recibido";
            $evento = "control_calidad_orden";
            $icono_recibidos = "fa fa-cog";
            $color = "red";
          }elseif($row["estado"]==3){
            $badge="warning";
            $icon="fas fa-clipboard-check";
            $estado="Revisado";
            $evento = "contacto_paciente";
            $icono_recibidos = "fas fa-mobile-alt";
            $color = "orange";
          }
          elseif($row["estado"]==4){
            $badge="success";
            $icon="fas fa-clock";
            $estado="Contactado";
            $evento = "contacto_paciente";
            $icono_recibidos = "fas fa-clock";
            $color = "green";
          }

        date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");  
        $fecha = $row["fecha"];//strtotime($row["fecha"]);
        $fecha_actual = $hoy;//strtotime($hoy);
        $fecha_ini = new DateTime($fecha);
        $fecha_act = new DateTime($fecha_actual);

        $transcurridos = $fecha_ini->diff($fecha_act);
        $dias_transcurridos=$transcurridos->format('%d Dias');
        $transc = $transcurridos->format('%d');

          $sub_array = array();
          $sub_array[] = $row["id_envio"];
          $sub_array[] = '<button type="button"  class="btn btn-edit btn-md bg-light" onClick="'.$evento.'('.$row["id_paciente"].',\''.$row["numero_orden"].'\');"><i class="'.$icono_recibidos.'" aria-hidden="true" style="color:'.$color.'"></i></button>';         
          $sub_array[] = $row["evaluado"];
          $sub_array[] = $row["numero_orden"];
          $sub_array[] = $row["fecha"];
          $sub_array[] =  ucfirst($row["usuario"]);
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="detalles_orden('.$row["id_paciente"].',\''.$row["numero_orden"].'\',\''.$row["evaluado"].'\','.$row["id_consulta"].');"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="get_data_ccf('.$row["id_envio"].');"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
        $data[] = $sub_array;
        $i++;
       }
      // $data[] = $sub_array;
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results);
    }  
  break;
     
  case 'registrar_envio_lab':
      $ordenes->enviar_orden_lab();
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

case 'registrar_entrega_lab':
    $ordenes->recibir_orden_lab();
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

case 'registrar_control_calidad':
  $ordenes->registrar_control_calidad($_POST["numero_orden"],$_POST["id_paciente"],$_POST["estado_varilla_f"],$_POST["estado_frente_f"],$_POST["codos_flex_f"],$_POST["graduaciones_f"],$_POST["productos_f"],$_POST["observaciones"],$_POST["id_usuario"],$_POST["tipo_accion"],$_POST["sucursal"]);
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

      case 'rechazar_orden_lab':
         $ordenes->rechazar_orden_lab($_POST["numero_orden"],$_POST["id_paciente"],$_POST["observaciones"],$_POST["id_usuario"],$_POST["tipo_accion"],$_POST["sucursal"]);
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

      case 'registrar_contacto':
         $ordenes->registrar_contacto($_POST["id_paciente"],$_POST["numero_orden"],$_POST["observaciones"],$_POST["tipo_accion"],$_POST["id_usuario"],$_POST["sucursal"]);
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

      case 'get_datos_contacto':
       $datos = $ordenes->get_data_contacto($_POST["id_paciente"],$_POST["numero_orden"]);
        if (is_array($datos)==true and count($datos)>0) {
        foreach($datos as $row){
         $output["nombres"] = $row["nombres"];
         $output["empresas"] = $row["empresas"];
         $output["id_paciente"] = $row["id_paciente"];
         $output["telefono"] = $row["telefono"];
         $output["evaluado"] = $row["evaluado"];
         $output["numero_orden"] = $row["numero_orden"];
         $output["telefono_oficina"] = $row["telefono_oficina"];
         $output["correo"] = $row["correo"];
        }
        echo json_encode($output);
        }else{
          json_encode("Hola");
        }
      break;

    case 'get_notas_contacto':
        $datos = $ordenes->get_data_consulta($_POST["id_paciente"],$_POST["numero_orden"]);
        if(is_array($datos)==true and count($datos)>0){
        $data= Array();
        foreach($datos as $row){
          $output["usuario"] = strtoupper($row["usuario"]);
          $output["fecha"] = $row["fecha"];
          $output["observaciones"] = strtoupper($row["observaciones"]);

          $data[] = $output;
      }
    }

  echo json_encode($data);     
      
    break;

  case 'get_detalles_orden':  
    $datos= $ordenes->get_detalle_orden($_POST["id_paciente"],$_POST["numero_orden"],$_POST["evaluado"]);
        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){         
            $output["numero_orden"] = $row["numero_orden"];
            $output["nombres"] = $row["nombres"];
            $output["evaluado"] = $row["evaluado"];
            $output["id_paciente"] = $row["id_paciente"];
            $output["laboratorio"] = $row["laboratorio"];                
          }        
        }
  echo json_encode($output);
  break;

  case 'get_data_envios':  
  $datos= $ordenes->get_data_envios($_POST["id_consulta"],$_POST["id_paciente"],$_POST["numero_orden"],$_POST["evaluado"]);
      if(is_array($datos)==true and count($datos)>0){
         foreach($datos as $row){         
          $output["lente"] = $row["lente"];
          $output["tratamientos"] = $row["tratamientos"];
          $output["modelo_aro"] = $row["modelo_aro"];
          $output["color_aro"] = $row["color_aro"];
          $output["marca_aro"] = $row["marca_aro"];
          $output["diseno"] = $row["diseno"];
          $output["med_a"] = $row["med_a"];
          $output["med_b"] = $row["med_b"];
          $output["med_c"] = $row["med_c"];
          $output["med_d"] = $row["med_d"];
          $output["observaciones"] = strtoupper($row["observaciones"]);
          $output["prioridad"] = $row["prioridad"];
        }        
      }
  echo json_encode($output);
  break;
  
  case 'get_creacion_orden':  
  $datos= $ordenes->get_creacion_orden($_POST["id_consulta"],$_POST["id_paciente"],$_POST["numero_orden"],$_POST["evaluado"]);
      if(is_array($datos)==true and count($datos)>0){
         foreach($datos as $row){         
          $output["usuario"] = strtoupper($row["usuario"]);
          $output["fecha_creacion"] = $row["fecha_creacion"];
          $output["accion"] = $row["accion"];
      }
    }
  echo json_encode($output);
  break;
    
  case 'get_historial_orden':
      $datos = $ordenes->get_historial_orden($_POST["id_paciente"],$_POST["numero_orden"]);
      if(is_array($datos)==true and count($datos)>0){

      $data= Array();
      foreach($datos as $row){
        $tipo_acc = $row["tipo_accion"];
        if($tipo_acc == "Envio a laboratorio"){
          $accion = "ENVIADO";
        }elseif($tipo_acc == "Recibir de laboratorio"){
          $accion = "RECIBIDO";
        }elseif($tipo_acc == "Rechazar"){
          $accion = "RECHAZADO";
        }elseif($tipo_acc == "Control de calidad"){
          $accion = "REVISADO";
        }elseif($tipo_acc == "LLamada"){
          $accion = "LLAMADA A PACIENTE";
        }


        $output["usuario"] = strtoupper($row["usuario"]);
        $output["fecha"] = $row["fecha"];
        $output["tipo_accion"] = strtoupper($accion);
        $data[] = $output;
    }
  }
echo json_encode($data);          
    break;

case 'get_data_ccf':  
  $datos= $ordenes->get_data_ccf($_POST["id_envio"]);
    if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){         
        $output["laboratorio"] = strtoupper($row["laboratorio"]);
        $output["evaluado"] = $row["evaluado"];
        $output["lente"] = $row["lente"];
        $output["tratamientos"] = $row["tratamientos"];
        $output["numero_orden"] = $row["numero_orden"];
    }
  }
  echo json_encode($output);
  break;

  case 'get_precio_tratamiento':
  $datos= $ordenes->get_precio_tratamiento($_POST["tratamiento_1"]); 

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){         
        $output["precio"] = $row["precio"];
              
      }       
    

    } 
    echo json_encode($output);
  break;

  case 'registrar_ccf_labs':

  $datos = $ordenes->valida_existe_ccf($_POST["numero_comprobante"]);
  if(is_array($datos)==true and count($datos)==0){
   $ordenes->registrar_ccf();
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

 case "listar_ccf_pagos":

  $datos=$ordenes->listar_ccf_pagos($_POST["fin_fecha"],$_POST["fecha_inicio"],$_POST["laboratorio"],$_POST["sucursal"]);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["id_ccf"];
    $sub_array[] = date("d-m-Y",strtotime($row["fecha"]));    
    $sub_array[] = $row["laboratorio"]; 
    $sub_array[] = $row["evaluado"];
    $sub_array[] = "$".number_format($row["subtotal"],2,".",",");
    $sub_array[] = "$".number_format($row["iva"],2,".",",");
    $sub_array[] = "$".number_format($row["total_venta"],2,".",",");

                                                
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