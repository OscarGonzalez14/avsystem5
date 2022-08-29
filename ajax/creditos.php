<?php
require_once("../config/conexion.php");
// llamada al modelo Accesorios
require_once("../modelos/Creditos.php");

$creditos = new Creditos();

switch ($_GET["op"]){

  case 'get_correlativo_factura':

    if($_POST["sucursal"]=="Empresarial") {
      $sucursal = $_POST["sucursal_usuario"];
    }else{
      $sucursal = $_POST["sucursal"];
    }

    $datos=$creditos->get_correlativo_factura($sucursal);

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){
        $output["correlativo"] = $row["n_correlativo"];
      }
    }
    echo json_encode($output);

  break;

//****************************************************************
//**********LISTAR CREDITOS DE VENTAS AL CONTADO********///////
	case 'listar_creditos_contado':
	if ($_POST["sucursal"]=="Empresarial") {
    $sucursal = $_POST["sucursal_usuario"];
  }else{
    $sucursal = $_POST["sucursal"];    
  }

  $datos=$creditos->get_creditos_contado($sucursal);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();

    $icon="";
    $atrib="";
    $txt="";
    $evento="";
    $class="";
    $href="";
    $event = "";
    $event_ccf ='';

    if($row["saldo"] == 0 and $row["cancelacion"]==0){
        $icon="fas fa-print";
        $atrib = "btn btn-info";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
        $event_ccf ='emitir_ccf';
    }elseif($row["saldo"] == 0 and $row["cancelacion"]==1){
      $icon="fas fa-print";
      $atrib = "btn btn-danger";
      $txt = '';
      $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
      $event = 'print_invoices';
      $event_ccf ='emitir_ccf';
    }elseif ($row["saldo"] > 0) {
        $icon=" fas fa-clock";
        $atrib = "btn btn-secondary";
        $txt = '';
        $href='#';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }

    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["fecha_adquirido"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["evaluado"]; 
    $sub_array[] = $row["sucursal"];  
    $sub_array[] = "$".number_format((float)$row["monto"],2,".",","); 
    //$sub_array[] = "$".number_format((float)$row["monto"]-$row["saldo"],2,".",",");
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");
    $sub_array[] = '<button type="button" onClick="realizarAbonos('.$row["id_paciente"].','.$row["id_credito"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-warning" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>

    <button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-success btn-sm"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>

    <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\');"><i class="'.$icon.'"></i>'.$txt.'</button>

    <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event_ccf.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\',\''.$row["nombres"].'\');" ><i class="'.$icon.'"></i>'.$txt.'</button>'; 
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
	break;

///LISTAR PENDIENTES O SALDADOS DE CONTADO
case 'estado_creditos_contado':

if ($_POST["sucursal"]=="Empresarial") {
    $sucursal = $_POST["sucursal_usuario"];
  }else{
    $sucursal = $_POST["sucursal"];    
  }

if ($_POST["estado_credito"]=="contado_pendientes") {
  $datos = $creditos->get_pendientes_contado($_POST["sucursal"]);
}elseif ($_POST["estado_credito"]=="contado_finalizados") {
  $datos = $creditos->get_finalizados_contado($_POST["sucursal"]);
}

  $data= Array();
  foreach($datos as $row){
    $sub_array = array();

    $icon="";
    $atrib="";
    $txt="";
    $evento="";
    $class="";
    $href="";
    $event = "";
    $event_ccf ='';

    if($row["saldo"] == 0 and $row["cancelacion"]==0){
        $icon="fas fa-print";
        $atrib = "btn btn-info";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
        $event_ccf ='emitir_ccf';
    }elseif($row["saldo"] == 0 and $row["cancelacion"]==1){
      $icon="fas fa-print";
      $atrib = "btn btn-danger";
      $txt = '';
      $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
      $event = 'print_invoices';
      $event_ccf ='emitir_ccf';
    }elseif ($row["saldo"] > 0) {
        $icon=" fas fa-clock";
        $atrib = "btn btn-secondary";
        $txt = '';
        $href='#';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }

    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["fecha_adquirido"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["evaluado"]; 
    $sub_array[] = $row["sucursal"];  
    $sub_array[] = "$".number_format((float)$row["monto"],2,".",","); 
    //$sub_array[] = "$".number_format((float)$row["monto"]-$row["saldo"],2,".",",");
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");
    $sub_array[] = '<button type="button" onClick="realizarAbonos('.$row["id_paciente"].','.$row["id_credito"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-warning" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>

    <button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-success btn-sm"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>

    <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\');"><i class="'.$icon.'"></i>'.$txt.'</button>

    <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event_ccf.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\',\''.$row["nombres"].'\');" ><i class="'.$icon.'"></i>'.$txt.'</button>'; 
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break; ///FIN LISTAR ESTADO DE CRED AL CONTADO

  ///////////////////GET CREDITOS CARGO AUTOMATICO

  case 'listar_creditos_cauto':

  if ($_POST["sucursal"]=="Empresarial") {
    $sucursal = $_POST["sucursal_usuario"];
  }else{
    $sucursal = $_POST["sucursal"];    
  }
  $datos=$creditos->get_creditos_cauto($sucursal);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();

    $icon="";
    $atrib="";
    $txt="";
    $evento="";
    $class="";
    $href="";
    $event = "";

    if($row["saldo"] == 0  and $row["cancelacion"]==0){
        $icon="fas fa-print";
        $atrib = "btn btn-info";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }elseif($row["saldo"] == 0 and $row["cancelacion"]==1){
      $icon="fas fa-print";
      $atrib = "btn btn-danger";
      $txt = '';
      $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
      $event = 'print_invoices';
      $event_ccf ='emitir_ccf';
    }elseif ($row["saldo"] > 0) {
        $icon=" fas fa-clock";
        $atrib = "btn btn-secondary";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }

    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["fecha_venta"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["empresas"];
    $sub_array[] = $row["evaluado"];
    $sub_array[] = $row["plazo"]." meses";     
    $sub_array[] = "$".number_format($row["monto"],2,".",","); 
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");    

    $sub_array[] = '<button type="button" onClick="realizarAbonos('.$row["id_paciente"].','.$row["id_credito"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-warning" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>
   
    <button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-success"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>
    
    <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\');"><i class="'.$icon.'"></i>'.$txt.'</button>';          
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break;

   ///////////////////GET CREDITOS DESCUENTO EN PLANILLA

  case 'listar_creditos_oid':


  if ($_POST["sucursal"]=="Empresarial") {    
    $datos=$creditos->get_creditos_oid_empresarial($_POST["sucursal"],$_POST["empresa"],$_POST["sucursal_usuario"]);
  }else{
    $datos=$creditos->get_creditos_oid($_POST["sucursal"],$_POST["empresa"]);
  }
  
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    
    $icon = "";
    $atrib = "";
    $txt = "";
    $evento = "";
    $class = "";
    $href = "";
    $event = "";

    if($row["saldo"] == 0  and $row["cancelacion"]=="0"){
        $icon="fas fa-print";
        $atrib = "btn btn-info";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }elseif($row["saldo"] == 0  and $row["cancelacion"]=="1"){
        $icon="fas fa-print";
        $atrib = "btn btn-danger";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }elseif ($row["saldo"] > 0) {
        $icon=" fas fa-print";
        $atrib = "btn btn-secondary";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = "print_invoices";
    }

    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["empresas"];
    $sub_array[] = $row["evaluado"];    
    $sub_array[] = "$".number_format($row["monto"],2,".",","); 
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");    

    $sub_array[] = '<button type="button" onClick="realizarAbonos('.$row["id_paciente"].','.$row["id_credito"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-warning" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';
     $sub_array[] = '<button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-success"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>';
    $sub_array[] = '<button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\');"><i class="'.$icon.'"></i>'.$txt.'</button>';           
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break;


  case 'listar_cobros_grupal_ccf':
    $datos=$creditos->get_ventas_ccf_empresarial($_POST["empresa"]);
    $data= Array();
    $i=0;
    foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["empresas"];   
    $sub_array[] = "$".number_format($row["monto"],2,".",",");
    $sub_array[] ='<input type="checkbox" class="form-check-input add_item_ccf" id="item_ccf'.$i.'" value="'.$row["monto"].'" name="'.$row["numero_venta"].'">Sel.';
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

  ////////////////GET DATOS DE PACIENTE PARA MODAL ABONOS
  case 'datos_paciente_abono':
      $datos= $creditos->get_data_paciente_abonos($_POST["id_paciente"],$_POST["id_credito"],$_POST["numero_venta"]); 

        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){

            $output["numero_venta"] = $row["numero_venta"];
            $output["paciente"] = $row["paciente"];
            $output["evaluado"] = $row["evaluado"];
            $output["telefono"] = $row["telefono"];
            $output["empresas"] = $row["empresas"];
            $output["monto"] = number_format($row["monto"],2,".",",");
            $output["id_paciente"] = $row["id_paciente"];
            $output["saldo"] = number_format($row["saldo"],2,".",",");
            $output["cuotas"] = number_format($row["cuotas"],2,".",",");
                    
          }       
        echo json_encode($output);
        } 
      break;

    ////////////////GET DATOS DE PACIENTE PARA MODAL ABONOS
  case 'datos_abono_anterior':
      $datos= $creditos->get_abono_ant($_POST["id_paciente"],$_POST["numero_venta"]); 

        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){         
            $output["monto_abono"] = number_format($row["monto_abono"],2,".",",");                
          }       
        echo json_encode($output);
        } 
      break;

  ///////////////////////LISTAR DETALLES DE ABONO
    case "listar_detalle_abonos":
    $datos=$creditos->get_detalle_abonos($_POST["id_paciente"],$_POST["numero_venta"]);
    //Vamos a declarar un array
    $data= Array();
    foreach($datos as $row){

        $sub_array = array();

        $sub_array[] = $row["fecha_abono"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["n_recibo"];
        $sub_array[] = $row["forma_pago"];
        $sub_array[] = "$".number_format($row["monto_abono"],2,".",",");
               
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);

    break;

    case 'get_datos_credito_abono':
  
    $datos= $creditos->get_datos_abonos($_POST["id_paciente"],$_POST["numero_venta"]); 

        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){         
            $output["monto"] = number_format($row["monto"],2,".",",");
            $output["abonado"] = number_format($row["abonado"],2,".",",");
            $output["nombres"] = $row["nombres"];
            $output["saldo"] = number_format($row["saldo"],2,".",",");                
          }       
        echo json_encode($output);
        } 
      break;

############## CREDITOS POR CATEGORÍA #######################
    case "show_cat_creditos":

   //$sucursal = $_POST['sucursal'];
    if ($_POST["categoria"]=="cat_b") {
      $datos = $creditos->get_creditos_cat_b($_POST["sucursal"]);
    }elseif ($_POST["categoria"]=="cat_c") {
      $datos = $creditos->get_creditos_cat_c($_POST["sucursal"]);
    }
    //Vamos a declarar un array
  $data= Array();
    foreach($datos as $row){
    $sub_array = array();       
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["empresas"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["forma_pago"];
    $sub_array[] = "$".number_format($row["monto"],2,".",",");
    $sub_array[] = $row["plazo"]." meses";
    $sub_array[] = "$".number_format($row["cuota"],2,".",",");
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");
    $sub_array[] = "$".number_format($row["abonado"],2,".",",");
    $sub_array[] = date("d-m-Y",strtotime($row["fecha_abono"]));
    $sub_array[] = date("d-m-Y",strtotime($row["prox_abono"]));
    $sub_array[] = $row["dif_days"]." dias";
    $sub_array[] = '<button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-sm btn-flat bg-success"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>';
    //$sub_array[] = '<button class="btn btn-sm btn-flat bg-light" onClick="info_pacientes_mora('.$row["id_paciente"].',\''.$row["numero_venta"].'\')" data-toggle="modal" data-target="#info_pac_mora"><i class="fas fa-eye" style="color:green"></i></button>';                                 
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    //print_r($sub_array);
    break;

/////////////////////GET DATOS PACIENTES ATRASADOS
    case 'get_datos_creditos_mora':
  
    $datos= $creditos->get_datos_creditos_mora($_POST["id_paciente"]); 

        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){         
            $output["nombres"] = ucfirst($row["nombres"]);
            $output["telefono"] = ucfirst($row["telefono"]);
            $output["direccion"] = ucfirst($row["direccion"]);
            $output["empresas"] = ucfirst($row["empresas"]);                
          }       
        echo json_encode($output);
        } 
      break;

      ///////////////

  case 'get_datos_venta_mora':  
  require_once("../modelos/Ventas.php");
  //llamo al modelo Ventas
  $ventas = new Ventas();
  $datos=$ventas->get_ventas_mora($_POST["id_paciente"],$_POST["numero_venta"]);

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){         
        $output["numero_venta"] = ucfirst($row["numero_venta"]);
        $output["paciente"] = ucfirst($row["paciente"]);
        $output["evaluado"] = ucfirst($row["evaluado"]);
        $output["fecha_venta"] = ucfirst($row["fecha_venta"]);
        $output["tipo_venta"] = ucfirst($row["tipo_venta"]);
        $output["tipo_pago"] = ucfirst($row["tipo_pago"]);
        $output["usuario"] = ucfirst($row["usuario"]);                
      }       
    echo json_encode($output);
    } 
  break;

  case 'save_correlativo_factura':
  if ($_POST["sucursal"]== "Empresarial") {
    $sucursal="Empresarial-".$_POST["sucursal_usuario"];
  }else{
    $sucursal=$_POST["sucursal"];
  }
      $datos = $creditos->validar_correlativo($_POST["correlativo_fac"],$sucursal);
        if(is_array($datos)==true and count($datos)==0){  
        $creditos->registrar_impresion_factura($sucursal,$_POST["numero_venta"],$_POST["id_usuario"],$_POST["correlativo_fac"],$_POST["id_paciente"]);
        $messages[]="ok";
      }else{
        $errors[]="error";
      }

      if (isset($messages)){ ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
      <?php
      }

      if (isset($errors)){ ?>
         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
      <?php
   }

    break;

    case 'get_finaliza_fecha':
      $inicio = $_POST["inicio"];
      $plazo_credito = $_POST["plazo_credito"];
      $finalizacion = date("d-m-Y",strtotime($inicio."+ $plazo_credito month"));
      echo json_encode($finalizacion);
      break;


    /************************************************************
    *****************ORDENES DE DESCUENTO EN PLANILLA PENDIENTES************
    *************************************************************/
    case 'listar_oid_pendientes':    

    if ($_POST["sucursal"]=="Empresarial") {
      $datos=$creditos->get_ordenes_descuento_empresarial($_POST["sucursal_usuario"]);
    }else{
      $datos=$creditos->get_ordenes_descuento_pendientes($_POST["sucursal"]);
    }
   
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

      $sub_array = array();
        if ($row['estado']==0){
          $estado = 'Pendiente';
        }

        $sub_array = array();
        $sub_array[] = $row["numero_orden"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_registro"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $estado;  
        $sub_array[] = '<i class="fas fa-cog" style="border-radius:0px;color:black" onClick="acciones_oid(\''.$row["numero_orden"].'\','.$row["id_paciente"].','.$row["estado"].')"></i>

        <a href="imprimir_oid_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:blue"></i></button></a>

        <a href="imprimir_pagare_descPlanilla_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:#1B4F72"></i></button></a>

        <button type="button"  class="btn btn-xs bg-light" onClick="eliminar_oid_p(\''.$row["numero_orden"].'\')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);
      //echo json_encode($datos);      
    break;


case 'listar_oid_aprobadas':
if ($_POST['sucursal']=="Empresarial") {
  $suc = $_POST["sucursal_usuario"];
}else{
  $suc = $_POST["sucursal"];
}
    $datos=$creditos->get_ordenes_descuento_aprobadas($suc);
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

        $sub_array = array();
        if ($row['estado']==1){
          $estado = 'Aprobada';
        }
        $sub_array[] = $row["numero_orden"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_registro"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $estado;  
        $sub_array[] = '<i class="fas fa-eye ocultar_btns_oid" style="border-radius:0px;color:black" onClick="acciones_oid(\''.$row["numero_orden"].'\','.$row["id_paciente"].','.$row["estado"].')"></i>

        <a href="imprimir_oid_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button" class="btn btn-link btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:blue"></i></button></a>

        <a href="imprimir_pagare_descPlanilla_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:#1B4F72"></i></button></a>';
        $data[] = $sub_array;
        //<button type="button"  class="btn btn-xs bg-light" onClick="eliminar_oid('.$row["id_orden"].',\''.$row["numero_orden"].'\','.$row["id_paciente"].')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);      
    break;
    
    /////eliminar oid sin aprobar
    case "eliminar_oid_p":
       $datos=$creditos->eliminar_oid_p($_POST["numero_orden"]);
    break;

     /************************************************************
    *****************ORDENES DE CARGOS AUTOMATICOS ************
    *************************************************************/
    case 'listar_cautos_pendientes'://Pendientes de aprobación

    if ($_POST["sucursal"]=="Empresarial") {
      $datos=$creditos->get_ordenes_cauto_pendientes($_POST["sucursal_usuario"]);
    }else{
      $datos=$creditos->get_ordenes_cauto_empresarial($_POST["sucursal"]);
    }
   
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

      $sub_array = array();
        if ($row['estado']==0){
          $estado = 'Pendiente';
        }

        $sub_array = array();
        $sub_array[] = $row["numero_orden"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_registro"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $estado;  
        $sub_array[] = '<i class="fas fa-cog" style="border-radius:0px;color:black" onClick="acciones_oid(\''.$row["numero_orden"].'\','.$row["id_paciente"].','.$row["estado"].')"></i>

        <a href="print_cauto.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:blue"></i></button></a>

        <a href="imprimir_pagare_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:#1B4F72"></i></button></a>

        <button type="button"  class="btn btn-xs bg-light" onClick="eliminar_oid_p(\''.$row["numero_orden"].'\')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);
      //echo json_encode("salida prueba: ".$sucursal_usuario);      
    break; 

    case 'listar_cautos_aprob'://Cargos Aprobados

    if ($_POST["sucursal"]=="Empresarial") {
      $datos=$creditos->get_cautos_aprob($_POST["sucursal_usuario"]);
    }else{
      $datos=$creditos->get_cautos_empresarial($_POST["sucursal"]);
    }
   
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

      $sub_array = array();
        if ($row['estado']==1){
          $estado = 'Aprobado';
        }

        $sub_array = array();
        $sub_array[] = $row["numero_orden"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_registro"];
        $sub_array[] = $row["sucursal"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $estado;  
        $sub_array[] = '<i class="fas fa-cog" style="border-radius:0px;color:black" onClick="acciones_oid(\''.$row["numero_orden"].'\','.$row["id_paciente"].','.$row["estado"].')"></i>

        <a href="print_cauto.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:blue"></i></button></a>

        <a href="imprimir_pagare_pdf.php?n_orden='.$row["numero_orden"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button"  class="btn btn-bg-ligth btn-xs"><i class="fa fa-print" aria-hidden="true" style="color:#1B4F72"></i></button></a>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);
      //echo json_encode("salida prueba: ".$sucursal_usuario);      
    break;     


case 'get_detalles_orden_oid':
  
  $datos=$creditos->get_data_orden_credito($_POST["id_paciente"],$_POST["numero_orden"]);

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){         
        $output["monto"] = "$".number_format($row["monto"],2,".",",");
        $output["plazo"] = $row["plazo"];
        $output["cuota"] = "$".number_format(($row["monto"]/$row["plazo"]),2,".",",");
        $output["referencia_uno"] = $row["ref_uno"]." Tel.:".$row["tel_ref_uno"];
        $output["referencia_dos"] = $row["ref_dos"]." Tel.:".$row["tel_ref_dos"];
        
      }       
    echo json_encode($output);
    } 
  break;

case 'get_detalles_orden_paciente':
  
$datos=$creditos->get_paciente_id($_POST["id_paciente"]);

    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){         
        $output["nombres"] = $row["nombres"];
        $output["ocupacion"] = $row["ocupacion"];
        $output["dui"] = $row["dui"];
        $output["edad"] = $row["edad"];
        $output["nit"] = $row["nit"];
        $output["telefono"] = $row["telefono"];
        $output["telefono_oficina"] = $row["telefono_oficina"];
        $output["correo"] = $row["correo"];
        $output["direccion"] = $row["direccion"];
        $output["empresas"] = $row["empresas"];
      //  $output["plazo"] = $row["plazo"];
       
      }       
    echo json_encode($output);
    } 
  break;

case 'get_det_orden':
  
$datos=$creditos->get_det_orden($_POST["n_orden_add"],$_POST["id_paciente"]);

    if(is_array($datos)==true and count($datos)>0){

      foreach($datos as $row){
        $output["ref_uno"] = $row["ref_uno"];
        $output["tel_ref_uno"] = $row["tel_ref_uno"];
        $output["ref_dos"] = $row["ref_dos"];
        $output["tel_ref_dos"] = $row["tel_ref_dos"];
        $output["fecha_registro"] = $row["fecha_registro"];
        $output["fecha_inicio"] = $row["fecha_inicio"];
        $output["fecha_finalizacion"] = $row["fecha_finalizacion"];
        $output["estado"] = $row["estado"];
        $output["id_usuario"] = $row["id_usuario"];
        $output["sucursal"] = $row["sucursal"];
        $output["monto"] = $row["monto"];
        $output["plazo"] = $row["plazo"];
        $output["observaciones"] = $row["observaciones"];
        $output["tipo_orden"] = $row["tipo_orden"];               
      }
    echo json_encode($output);

    } 
  break;

 case 'get_detalle_productos_orden':

    $datos= $creditos->get_detalle_orden_credito($_POST["id_paciente"],$_POST["numero_orden"]);

    if(is_array($datos)==true and count($datos)>0){
      
      $data = Array();

      foreach($datos as $row){
        $output = array();
        $output["id_producto"] = $row["id_producto"];
        $output["cantidad"] = $row["cantidad_venta"];
        $output["producto"] = strtoupper($row["producto"]);
        $output["precio_venta"] = strtoupper($row["precio_venta"]);
        $output["descuento"] = strtoupper($row["descuento"]);
        $output["precio_final"] = "$".number_format($row["precio_final"],2,".",",");
        $output["descuento"] = $row["descuento"];
        $output["fecha_venta"] = $row["fecha_venta"];
        $output["id_usuario"] = $row["id_usuario"];
        $output["id_paciente"] = $row["id_paciente"];
        $output["beneficiario"] = $row["beneficiario"];
        $output["categoria_ub"] = $row["categoria_ub"];
        $data[] = $output;                    
      }      

    } 
  echo json_encode($data);
  break;

 case 'get_beneficiarios':

    $datos= $creditos->get_beneficiarios($_POST["id_paciente"],$_POST["numero_orden"]);

    if(is_array($datos)==true and count($datos)>0){
      $data = Array();

      foreach($datos as $row){
       
       if ($row["estado"]==1) {
         $estado= "Aprobado";
         $badge="success";
         $est="Aprobado";
       }else{
        $estado="Sin aprobar";
        $badge="warning";
        $est="Sin aprobar";
       }


        $output = array();


        $output["numero_orden"] = $row["numero_orden"];
        $output["nombres"] = $row["nombres"];
        $output["empresas"] = $row["empresas"];
        $output["id_paciente"] = $row["id_paciente"];
        $output["estado"] = $estado;
        //$output["estado"] = '<span class="right badge badge-'.$badge.'">'.$est.'</span>';
        $output["id_orden"] = $row["id_orden"];
        $output["sucursal"] = $row["sucursal"];
        $output["evaluado"] = $row["evaluado"];
        $output["monto_total"] = strtoupper($row["monto_total"]);
        $output["tipo_orden"] = $row["tipo_orden"];
        $data[] = $output;                    
      }      

    } 
  echo json_encode($data);
   break;


 case 'get_detalle_venta_flotante':
   $datos = $creditos->get_detalle_venta_flotante($_POST["id_paciente"],$_POST["numero_orden"]);
   if (is_array($datos)==true and count($datos)>0) {
      $data = Array();

      foreach($datos as $row){
        $output = array();
        $output["fecha_venta"] = $row["fecha_venta"];
        $output["paciente"] = $row["paciente"];
        $output["vendedor"] = $row["vendedor"];
        $output["monto_total"] = $row["monto_total"];
        $output["tipo_pago"] = $row["tipo_pago"];
        $output["tipo_venta"] = $row["tipo_venta"];
        $output["id_usuario"] = $row["id_usuario"];
        $output["id_paciente"] = $row["id_paciente"];
        $output["sucursal"] = $row["sucursal"];
        $output["evaluado"] = $row["evaluado"];
        $output["optometra"] = $row["optometra"];

        $data[]= $output;
      }
  }

  echo json_encode($data);

  break;

   case 'get_beneficiarios_ventas_flot':
   $datos = $creditos->get_beneficiarios_ventas_flot($_POST["id_paciente"],$_POST["numero_orden"]);
   if (is_array($datos)==true and count($datos)>0) {
      $data = Array();
      foreach($datos as $row){
        $output = array();
        $output["evaluado"] = $row["evaluado"];
        $data[]= $output;
      }
   }
   echo json_encode($data);
  break;

  case 'get_det_f_ben':
   $datos = $creditos->get_det_f_ben($_POST["id_paciente"],$_POST["numero_orden"],$_POST["flotante_b"]);
   if (is_array($datos)==true and count($datos)>0) {
      foreach($datos as $row){

        $output["numero_orden"] = $row["numero_orden"];
        $output["id_producto"] = $row["id_producto"];
        $output["producto"] = $row["producto"];
        $output["precio_venta"] = $row["precio_venta"];
        $output["cantidad_venta"] = $row["cantidad_venta"];
        $output["beneficiario"] = $row["beneficiario"];
        $output["precio_final"] = $row["precio_final"];
        $output["fecha_venta"] = $row["fecha_venta"];
        $output["id_usuario"] = $row["id_usuario"];
        $output["id_paciente"] = $row["id_paciente"];
        $output["beneficiario"] = $row["beneficiario"];
        $output["categoria_ub"] = $row["categoria_ub"];

      }
   }
   echo json_encode($output);
  break;

  
  case 'aprobar_orden_planilla':

    $creditos->aprobar_orden();
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

     case "denegar_orden":

    $creditos->denegar_orden($_POST["numero_orden"]);
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
    //mensaje error

  break;


  case 'buscar_existe_oid':
  $datos = $creditos->buscar_existe_oid($_POST["id_paciente"]);
   if (is_array($datos)==true and count($datos)>0) {
      $data = Array();
      foreach($datos as $row){
       $output["numero_orden"] = $row["numero_orden"];
       $output["empresas"] = $row["empresas"];
      }
   }else{
    $output = "No";
   }
   echo json_encode($output);
  break;


  case 'get_saldos_oid':
  $datos = $creditos->get_saldos_oid($_POST["id_paciente"]);
   if(is_array($datos)==true and count($datos)>0) {
      $data = Array();
      foreach($datos as $row){
      $output["nombres"] = $row["nombres"];
      $output["empresas"] = $row["empresas"];
      $output["saldos"] = number_format($row["saldos"],2,".",",");
      }
   }else{
    $output["error"]="El paciente no posee credito activo";
   }
   echo json_encode($output);
  break;


    /////eliminar oid aprobada
    case "eliminar_oid":
        $creditos->eliminar_oid($_POST["id_orden"],$_POST["numero_orden"],$_POST["id_paciente"]);
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

  case "get_det_ventas_flotantes":
  $datos = $creditos->get_det_ventas_flotantes($_POST["id_paciente"],$_POST["numero_orden"]);  
  break;

//*********FILTRADO DE CREDITOS EN PLANILLA*********
case 'filtra_creditos':

if ($_POST["sucursal"]=="Empresarial") {
    $sucursal = $_POST["sucursal_usuario"];
  }else{
    $sucursal = $_POST["sucursal"];    
  }

  if ($_POST["ver_credito"]=="" and $_POST["nombre_empresa"]=="" ) {
    $datos=$creditos->listar_creditos_general($sucursal);
  }elseif($_POST["ver_credito"]=="" and $_POST["nombre_empresa"]!==""){
    $datos=$creditos->listar_creditos_empresa($sucursal,$_POST["nombre_empresa"]); 
  }elseif($_POST["ver_credito"]=="Creditos_Pendientes" and $_POST["nombre_empresa"]==""){
    $datos=$creditos->listar_creditos_pendientes($sucursal,$_POST["ver_credito"]);
  }elseif($_POST["ver_credito"]=="Creditos_Finalizados" and $_POST["nombre_empresa"]==""){
    $datos=$creditos->listar_creditos_finalizados($sucursal,$_POST["ver_credito"]);
  }elseif($_POST["ver_credito"]=="Creditos_Pendientes" and $_POST["nombre_empresa"] !=""){
    $datos=$creditos->listar_creditos_pendientes_emp($sucursal,$_POST["nombre_empresa"],$_POST["ver_credito"]);
  }elseif($_POST["ver_credito"]=="Creditos_Finalizados" and $_POST["nombre_empresa"] !=""){
    $datos=$creditos->listar_creditos_finalizados_emp($sucursal,$_POST["nombre_empresa"],$_POST["ver_credito"]);
  }

  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    
    $icon = "";
    $atrib = "";
    $txt = "";
    $evento = "";
    $class = "";
    $href = "";
    $event = "";

    if($row["saldo"] == 0  and $row["cancelacion"]=="0"){
        $icon="fas fa-print";
        $atrib = "btn btn-info";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }elseif($row["saldo"] == 0  and $row["cancelacion"]=="1"){
        $icon="fas fa-print";
        $atrib = "btn btn-danger";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = 'print_invoices';
    }elseif ($row["saldo"] > 0) {
        $icon=" fas fa-print";
        $atrib = "btn btn-secondary";
        $txt = '';
        $href='imprimir_factura_pdf.php?n_venta='.$row['numero_venta'].'&id_paciente='.$row['id_paciente'].'';
        $event = "print_invoices";
    }

    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["empresas"];
    $sub_array[] = date("d-m-Y",strtotime($row["fecha_inicio"]));
    $sub_array[] = $row["fecha_finalizacion"];
    $sub_array[] = $row["plazo"]." meses"; 
    $sub_array[] = $row["sucursal"]; 
    $sub_array[] = "$".number_format($row["monto"],2,".",",");
    $sub_array[] = "$".number_format($row["monto"]/$row["plazo"],2,".",",");
    $sub_array[] = "$".number_format($row["saldo"],2,".",",");    

    $sub_array[] = '<button type="button" onClick="realizarAbonos('.$row["id_paciente"].','.$row["id_credito"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-warning" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>

    <button type="button" onClick="verDetAbonos('.$row["id_paciente"].',\''.$row["numero_venta"].'\');" id="'.$row["id_paciente"].'" class="btn btn-xs bg-success"><i class="fas fa-file-invoice-dollar" aria-hidden="true" style="color:white"></i></button>
    
   <button type="button"  class="btn '.$atrib.' btn-xs" onClick="'.$event.'('.$row["id_paciente"].',\''.$row["numero_venta"].'\');"><i class="'.$icon.'"></i>'.$txt.'</button>';


    $data[] = $sub_array;
  }
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break;



}//Fin case

 ?>