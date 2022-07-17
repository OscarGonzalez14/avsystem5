<?php
//llamo a la conexion de la base de datos
require_once("../config/conexion.php");
//llamo al modelo pacientes
require_once("../modelos/Ventas.php");
 //llamo al modelo Ventas
$ventas = new Ventas();


switch($_GET["op"]){
///////////////////////////AROS EN EXISTENCIAS
  case "agregar_aros_venta":          
  $datos=$ventas->buscar_aros_ventas($_POST["id_producto"],$_POST["id_ingreso"]);
  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row)
    {
      $output["desc_producto"] = $row["desc_producto"];
      $output["precio_venta"] = number_format($row["precio_venta"],2,".",",");
      $output["stock"] = $row["stock"];
      $output["categoria_ub"] = $row["categoria_ub"];
      $output["num_compra"] = $row["num_compra"];
      $output["id_producto"] = $row["id_producto"];
      $output["id_ingreso"] = $row["id_ingreso"];
      $output["categoria_producto"] = $row["categoria_producto"];
          //$output["precio_compra"] = $row["precio_compra"];                   
    }      

  } else {                 
                 //si no existe el registro entonces no recorre el array
    $output["error"]="El producto seleccionado está inactivo, intenta con otro";

  }

  echo json_encode($output);

  break;
///////////////AGREGAR ACCESORIO A DETALLES DE VENTA(agregar a array detalles)
  case "agregar_accesorios_venta":          
  $datos=$ventas->buscar_accesorios_ventas($_POST["id_producto"],$_POST["id_ingreso"]);
  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row)
    {
      $output["desc_producto"] = $row["desc_producto"];
      $output["precio_venta"] = number_format($row["precio_venta"],2,".",",");
      $output["stock"] = $row["stock"];
      $output["categoria_ub"] = $row["categoria_ub"];
      $output["num_compra"] = $row["num_compra"];
      $output["id_producto"] = $row["id_producto"];
      $output["id_ingreso"] = $row["id_ingreso"];
      $output["categoria_producto"] = $row["categoria_producto"];                   
    }      

  } else {                 
                 //si no existe el registro entonces no recorre el array
    $output["error"]="El producto seleccionado está inactivo, intenta con otro";

  }
  echo json_encode($output);

  break;

//////////////DATA AGREGAR LENTES EN VENTA
  case "agregar_lentes_venta":          
  $datos=$ventas->buscar_lentes_ventas($_POST["id_producto"]);
  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row)
    {
      $output["desc_producto"] = $row["desc_producto"];
      $output["precio_venta"] = $row["precio_venta"];
      $output["id_producto"] = $row["id_producto"];
      $output["categoria_producto"] = strtoupper($row["categoria_producto"]);                   
    }      

  } else {                 
                 //si no existe el registro entonces no recorre el array
    $output["error"]="El producto seleccionado está inactivo, intenta con otro";

  }

  echo json_encode($output);

  break;

     ///////////////////////////SERVICIOS EN EXISTENCIAS
  case "agregar_servicios_venta":          
  $datos=$ventas->buscar_servicios_ventas($_POST["id_producto"]);
  if(is_array($datos)==true and count($datos)>0){    
    foreach($datos as $row){
 
    $output["servicio"] = $row["servicio"];
    $output["precio_venta"] = number_format($row["precio_venta"],2,".",","); 
    $output["id_producto"] = $row["id_producto"];       
  }      

} 

echo json_encode($output);

break;

///////////////////////GET MUMERO VENTA
case "get_numero_venta":

$sucursal_act = $_POST["sucursal_correlativo"];
$sucursal_u = $_POST["sucursal_usuario"];

if ($_POST["sucursal_correlativo"]=="Empresarial") {

  $sucursal_usuario = $_POST["sucursal_usuario"];
  $sucursal = "Empresarial-".$_POST["sucursal_usuario"];  
  $datos= $ventas->get_numero_venta($sucursal);  
  $prefijo = "";

  if ($sucursal_usuario=="Metrocentro") {
    $prefijo = "MT";
  }elseif ($sucursal_usuario=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal_usuario=="San Miguel") {
  $prefijo="SM";
  }

  if(is_array($datos)==true and count($datos)>0){
  foreach($datos as $row){                  
    $codigo=$row["numero_venta"];
    $cod=(substr($codigo,5,11))+1;
    $output["correlativo"]="EV".$prefijo."-".$cod;
  }             
}else{
  $output["correlativo"] = "EV".$prefijo."-1";
}

}else{
$datos= $ventas->get_numero_venta($_POST["sucursal_correlativo"]);
$sucursal = $_POST["sucursal_correlativo"];
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
    $codigo=$row["numero_venta"];
    $cod=(substr($codigo,5,11))+1;
    $output["correlativo"]="AV".$prefijo."-".$cod;
  }             
}else{
  $output["correlativo"] = "AV".$prefijo."-1";
}
}

echo json_encode($output);

break;

////////////////////////COMBOX DINAMICOS PARA VENTAS
case 'tipo_pago';

if ($_POST['id_tipo']=='Contado' or $_POST['id_tipo']=='Credito Fiscal') {
  $html="
  <option value='Contado'>Contado</option>
  <option value='Efectivo'>Efectivo</option>
  <option value='Tarjeta de Credito'>Tarjeta de Crédito</option>      
  <option value='Cheque'>Cheque</option>";
  echo $html;

}elseif($_POST['id_tipo']=='Credito'){

  $html= "
  <option value=''>Selecione</option>
  <option value='Descuento en Planilla'> Descuento en Planilla</option>
  <option value='Cargo Automatico'>Cargo Automático</option>
  <option value='Creditos Personales'>Créditos Personales</option>
  <option value='Tarjeta de Credito'>Tarjeta de Crédito</option>
  <option value='Tasa cero'>Tasa cero</option>
  <option value='Cheque'>Cheque</option>";
  
  echo $html;
}else{

  $html= "<option value=''>Seleccione</option>
  ";
  
  echo $html;
}

break;

case "monto_cuotas":

if($_POST['m_cuotas']=='Descuento en Planilla' or $_POST['m_cuotas']=='Tasa cero'){

  $html="

  <option value='0'>Seleccione</>
  <option value='2'> 2 Meses</>
  <option value='3'> 3 Meses</>
  <option value='4'> 4 Meses</>
  <option value='5'> 5 Meses</>
  <option value='6'> 6 Meses</>
  <option value='7'> 7 Meses</>
  <option value='8'> 8 Meses</>
  <option value='9'> 9 Meses</>
  <option value='10'> 10 Meses</>
  <option value='11'> 11 Meses</>
  <option value='12'> 12 Meses</>

  ";

  echo $html;

}else if($_POST['m_cuotas']=='Cargo Automatico'){

  $html="

  <option value='0'>Seleccione</>
  <option value='2'> 2 Meses</>
  <option value='3'> 3 Meses</>
  <option value='4'> 4 Meses</>
  <option value='5'> 5 Meses</>
  <option value='6'> 6 Meses</>
  <option value='7'> 7 Meses</>
  <option value='8'> 8 Meses</>
  <option value='9'> 9 Meses</>
  <option value='10'> 10 Meses</>
  <option value='11'> 11 Meses</>
  <option value='12'> 12 Meses</>

  ";

  echo $html;

}else if($_POST['m_cuotas']=='Creditos Personales'){
  $html="
  <option value=''>Seleccione</>
  <option value='1'> 1 Meses</>
  <option value='2'> 2 Meses</>
  <option value='3'> 3 Meses</>
  <option value='4'> 4 Meses</>
  <option value='5'> 5 Meses</>
  <option value='6'> 6 Meses</>";
  echo $html;
}

break;

//////////////////////////SE REGISTRA VENTA O PRIMER REGISTRO DE CREDITO /////////////////////
case 'registrar_venta':

$sucursal_act = $_POST["sucursal"];
$tipo_pago = $_POST["tipo_pago"]; 
if($tipo_pago=="Descuento en Planilla" or $tipo_pago=="Cargo Automatico"){
  $ventas->agrega_detalle_venta();
  $messages[]="ok";
}else{
$datos=$ventas->valida_existencia_venta($_POST["numero_venta"]);
if(is_array($datos)==true and count($datos)==0){
  $ventas->agrega_detalle_venta();
  $messages[]="ok";

}else{
  $errors[]="error";
}
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
break;   ////////// GET DATA LENTES RECIBO INICIAL

/////////////////// SE REGISTRA UNA APROBACION DE OID /////////////////////

case 'agregar_benefiaciario_oid':


require_once("../modelos/Creditos.php");
 //llamo al modelo Ventas
  $creditos = new Creditos();
  $creditos->agregar_benefiaciario_oid();
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


  case 'get_datos_lentes_rec_ini':
  $datos= $ventas->get_detalle_lente_rec_ini($_POST["id_paciente"],$_POST["numero_venta"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;

  //////////GET DATA PHOTOSENSIBLES RECIBO INICIAL 
  
  case 'get_datos_photo_rec_ini':
  $datos= $ventas->get_detalle_photo_rec_ini($_POST["id_paciente"],$_POST["numero_venta"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;

            //////////GET DATA ANTIREFLEJANTE RECIBO INICIAL 
  case 'get_datos_ar_rec_ini':
  $datos= $ventas->get_detalle_ar_rec_ini($_POST["id_paciente"],$_POST["numero_venta"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["producto"] = $row["producto"];                
    }       
    echo json_encode($output);
  } 
  break;

  case 'get_datos_aros_rec_ini':
  $datos= $ventas->get_detalle_aros_rec_ini($_POST["id_paciente"],$_POST["numero_venta"]); 

  if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){         
      $output["marca"] = $row["marca"];
      $output["modelo"] = $row["modelo"];
      $output["color"] = $row["color"];                
    }       
    echo json_encode($output);

  } 
  break;

  /// INICIO LISTAR TODAS LAS VENTAS
  case "listar_ventas_gral":
  
  $sucursal = $_POST["sucursal"];

  if ($sucursal=="Empresarial") {
    $suc = $_POST["sucursal_usuario"];
  }else{
    $suc = $_POST["sucursal"];
  }

  $datos=$ventas->get_ventas_gral($suc);
  //Vamos a declarar un array
  $data= Array();

  foreach($datos as $row)
  {
    $sub_array = array();
    $sub_array[] = $row["id_ventas"];
    $sub_array[] = $row["numero_venta"];
    $sub_array[] = $row["usuario"];
    $sub_array[] = $row["optometra"];
    $sub_array[] = $row["fecha_venta"];
    $sub_array[] = $row["paciente"];
    $sub_array[] = $row["evaluado"];
    $sub_array[] = $row["tipo_venta"];
    $sub_array[] = $row["tipo_pago"];
    $sub_array[] = $row["sucursal"];
    $sub_array[] = "$".number_format($row["monto_total"],2,".",",");        
    $sub_array[] = '<i class="fas fa-eye fa-2x" style="border-radius:0px;color:blue" data-toggle="modal" data-target="#detalle_ventas" onClick="detalleVentas(\''.$row["numero_venta"].'\',\''.$row["evaluado"].'\','.$row["id_paciente"].')"></i>';
    $data[] = $sub_array;
  }

  $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
  echo json_encode($results);      
  break;
    /// FIN LISTAR TODAS LAS VENTAS
  case "ver_detalle_venta":
  $datos= $ventas->get_detalle_ventas_paciente($_POST["numero_venta"],$_POST['evaluado'],$_POST["id_paciente"]);
  break;
    //////////////////// GET DATA PACIENTE PARA MODAL CREDITOS EN VENTAS.PHP
  case 'show_datos_paciente':    
  $datos=$ventas->show_datos_paciente($_POST["id_paciente"]);
  foreach($datos as $row){
    $output["id_paciente"] = $row["id_paciente"];
    $output["nombres"] = $row["nombres"];
    $output["telefono"] = $row["telefono"];
    $output["edad"] = $row["edad"];
    $output["ocupacion"] = $row["ocupacion"];
    $output["dui"] = $row["dui"];
    $output["correo"] = $row["correo"]; 
    $output["empresas"] = $row["empresas"]; 
    $output["nit"] = $row["nit"];
    $output["telefono_oficina"] = $row["telefono_oficina"];
    $output["direccion"] = $row["direccion"];

  }
  echo json_encode($output);
  break;

case 'get_correlativo_orden':

 if ($_POST["sucursal"]=="Empresarial") {
  $sucursal = $_POST["sucursal_usuario"];

 }else{
  $sucursal = $_POST["sucursal"];
 }
////////////// VALIDACIO N  TIPO PAGO  ///////////
if ($_POST["tipo_pago"]=="Cargo Automatico") {
    $prefijo = "";
  if ($sucursal == "Metrocentro") {
    $prefijo = "ME";
  }elseif($sucursal == "Santa Ana") {
    $prefijo = "SA";
  }elseif($sucursal == "San Miguel") {
    $prefijo = "SM";
  }
  ########## FIN PREFIJOS #######  
  $resultado_correlativo = $ventas->get_correlativo_cargo($sucursal);
  if(is_array($resultado_correlativo) == true and count($resultado_correlativo) > 0){
    foreach($resultado_correlativo as $row){
      $correlativo = $row["numero_orden"];
      $cod = substr($correlativo,4,11)+1;
      $codigo = "C".$prefijo."-".($cod);
    }
  }else{
      $codigo = "C".$prefijo."-1";
  }
}else{
  $prefijo = "";
  if ($sucursal=="Metrocentro") {
    $prefijo="ME";
  }elseif ($sucursal=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal=="San Miguel") {
    $prefijo="SM";
  }
  ########## FIN PREFIJOS #######  
  $resultado_correlativo = $ventas->get_correlativo_orden($sucursal);
  if(is_array($resultado_correlativo) == true and count($resultado_correlativo) > 0){
    foreach($resultado_correlativo as $row){
      $correlativo = $row["numero_orden"];
      $cod = substr($correlativo,4,11)+1;
      $codigo = "O".$prefijo."-".($cod);
    }
  }else{
    $codigo = "O".$prefijo."-1";
  }
}  
echo json_encode($codigo);
  break;
}
?>
