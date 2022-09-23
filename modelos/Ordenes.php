<?php

require_once("../config/conexion.php");
class Ordenes extends Conectar{

	public function get_consultas_orden($sucursal_usuario){
     	$conectar= parent::conexion();
        $sucursal = '%'.$sucursal_usuario.'%';       
     	$sql= "select p.id_paciente,p.nombres,p.empresas,c.fecha_consulta,c.p_evaluado,p.sucursal,c.id_consulta from pacientes as p inner join consulta as c  on c.id_paciente=p.id_paciente where p.sucursal like ? order by c.id_consulta DESC;";
     	$sql=$conectar->prepare($sql);
     	$sql->bindValue(1,$sucursal);
     	$sql->execute();
     	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);         
    }

  public function get_consultas_orden_emp($sucursal){
      $conectar= parent::conexion(); 

      $suc= "%".$sucursal."%";      
      $sql= "select p.id_paciente,p.nombres,p.empresas,c.fecha_consulta,c.p_evaluado,p.sucursal,c.id_consulta from pacientes as p inner join consulta as c  on c.id_paciente=p.id_paciente where p.sucursal like ? order by c.id_consulta DESC;";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$suc);
      $sql->execute();
      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);         
    }

    public function get_numero_venta($id_paciente,$evaluado){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select numero_venta from ventas where id_paciente=? and evaluado=? order by id_ventas DESC limit 1";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$evaluado);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

    public function get_items_venta($id_paciente,$numero_venta){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select id_producto from detalle_ventas where id_paciente=? and numero_venta=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$numero_venta);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_categoria_producto($codProd){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select categoria_producto from productos where id_producto=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$codProd);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
////////////GET NUMERO DE PACIENTE POR SUCURSAL
public function get_numero_orden_lab($sucursal){
    $conectar= parent::conexion();
    $sql= "select numero_orden from envios_lab where sucursal=? order by id_envio DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


public function buscar_existe_orden($numero_orden){
    $conectar= parent::conexion();
    $sql= "select*from envios_lab where numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function registrar_orden($paciente_orden,$laboratorio_orden,$id_pac_orden,$id_consulta_orden,$lente_orden,$tratamiento_orden,$modelo_aro_orden,$marca_aro_orden,$color_aro_orden,$diseno_aro_orden,$med_a,$med_b,$med_c,$med_d,$observaciones_orden,$id_usuario,$fecha,$sucursal,$numero_orden,$prioridad_orden){
    $conectar= parent::conexion();
    $estado="0";
    $sql="insert into envios_lab values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->bindValue(2,$laboratorio_orden);
    $sql->bindValue(3,$id_pac_orden);
    $sql->bindValue(4,$paciente_orden);
    $sql->bindValue(5,$id_consulta_orden);
    $sql->bindValue(6,$lente_orden);
    $sql->bindValue(7,$tratamiento_orden);
    $sql->bindValue(8,$modelo_aro_orden);
    $sql->bindValue(9,$color_aro_orden);
    $sql->bindValue(10,$marca_aro_orden);
    $sql->bindValue(11,$diseno_aro_orden);
    $sql->bindValue(12,$id_usuario);
    $sql->bindValue(13,$med_a);
    $sql->bindValue(14,$med_b);
    $sql->bindValue(15,$med_c);
    $sql->bindValue(16,$med_d);
    $sql->bindValue(17,$fecha);
    $sql->bindValue(18,$estado);
    $sql->bindValue(19,$observaciones_orden);
    $sql->bindValue(20,$sucursal);
    $sql->bindValue(21,$prioridad_orden);
    $sql->execute();

}

/////////////DATATABLE ORDENES
public function listar_ordenes($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.laboratorio,e.evaluado,e.fecha_creacion,u.usuario,e.estado,id_paciente,e.sucursal,e.id_consulta from envios_lab as e inner join usuarios as u on e.id_usuario=u.id_usuario where e.sucursal=? and (e.estado='0' or e.estado='5');";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
   ####ordenes Enviadas
public function listar_ordenes_enviadas($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.evaluado,e.estado,e.prioridad,p.nombres,p.id_paciente,a.tipo_accion,a.fecha,e.prioridad,e.id_consulta from envios_lab as e inner join pacientes as p on e.id_paciente=p.id_paciente join acciones_ordenes_lab as a where e.numero_orden=a.n_orden and a.tipo_accion='Envio a laboratorio' and e.sucursal=? and e.estado='1' group by e.id_envio order by e.id_envio DESC;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
######### Ordenes recibidas
public function listar_ordenes_recibidas($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.evaluado,e.estado,e.prioridad,p.nombres,p.id_paciente,a.tipo_accion,a.fecha,u.usuario,e.id_consulta from envios_lab as e inner join pacientes as p on e.id_paciente=p.id_paciente join acciones_ordenes_lab as a
    inner join usuarios as u on a.id_usuario=u.id_usuario where e.numero_orden=a.n_orden and a.tipo_accion='Recibir de laboratorio' and e.sucursal=? and e.estado>=2 and e.estado<5 group by e.id_envio order by e.id_envio DESC;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////ENVIAR ORDEN DE LABORATORIO
public function enviar_orden_lab(){

$conectar = parent::conexion();
parent::set_names();
////UPDATE ESTADO DE ORDEN
$detalles_envio = array();
$detalles_envio = json_decode($_POST["arrayEnvio"]);
$tipo_accion = $_POST["tipo_accion"];
$id_usuario = $_POST["id_usuario"];
$sucursal = $_POST["sucursal"];

foreach($detalles_envio as $k => $v){
    $id_paciente = $v->id_paciente;
    $numero_orden = $v->numero_orden;

//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='1' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();


///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

}//Fin Foreach
}


//////////////RECIBIR ORDEN DE LABORATORIO
public function recibir_orden_lab(){

$conectar = parent::conexion();
parent::set_names();
////UPDATE ESTADO DE ORDEN
$detalles_recibir = array();
$detalles_recibir = json_decode($_POST["arrayRecibir"]);
$tipo_accion = $_POST["tipo_accion"];
$id_usuario = $_POST["id_usuario"];
$sucursal = $_POST["sucursal"];

foreach($detalles_recibir as $k => $v){
    $id_paciente = $v->id_paciente;
    $numero_orden = $v->numero_orden;

//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='2' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();


///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

}//Fin Foreach
}

public function registrar_control_calidad($numero_orden,$id_paciente,$estado_varilla_f,$estado_frente_f,$codos_flex_f,$graduaciones_f,$productos_f,$observaciones,$id_usuario,$tipo_accion,$sucursal){

    $conectar = parent::conexion();
    parent::set_names();
//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='3' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();


///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

$sql4 = "insert into control_calidad_orden values(null,?,?,?,?,?,?,?,?,?,?);";
$sql4=$conectar->prepare($sql4);
$sql4->bindValue(1,$numero_orden);
$sql4->bindValue(2,$id_paciente);
$sql4->bindValue(3,$estado_varilla_f);
$sql4->bindValue(4,$estado_frente_f);
$sql4->bindValue(5,$codos_flex_f);
$sql4->bindValue(6,$graduaciones_f);
$sql4->bindValue(7,$observaciones);
$sql4->bindValue(8,$productos_f);
$sql4->bindValue(9,$id_usuario);
$sql4->bindValue(10,$hoy);
$sql4->execute();
}

public function rechazar_orden_lab($numero_orden,$id_paciente,$observaciones,$id_usuario,$tipo_accion,$sucursal){

  $conectar = parent::conexion();
  parent::set_names();

  $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
  $sql3=$conectar->prepare($sql3);
  $sql3->bindValue(1,$id_paciente);
  $sql3->bindValue(2,$numero_orden);
  $sql3->execute();
  $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='5' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();
  
  date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
  $sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$tipo_accion);
  $sql->bindValue(2,$hoy);
  $sql->bindValue(3,$id_usuario);
  $sql->bindValue(4,$numero_orden);
  $sql->bindValue(5,$laboratorio);
  $sql->bindValue(6,$id_paciente);
  $sql->bindValue(7,$evaluado);
  $sql->bindValue(8,$sucursal);
  $sql->execute();

  $estado_varilla_f="0";
  $estado_frente_f="0";
  $codos_flex_f="0";
  $graduaciones_f="0";
  $productos_f="0";
  $sql4 = "insert into control_calidad_orden values(null,?,?,?,?,?,?,?,?,?,?);";
  $sql4=$conectar->prepare($sql4);
  $sql4->bindValue(1,$numero_orden);
  $sql4->bindValue(2,$id_paciente);
  $sql4->bindValue(3,$estado_varilla_f);
  $sql4->bindValue(4,$estado_frente_f);
  $sql4->bindValue(5,$codos_flex_f);
  $sql4->bindValue(6,$graduaciones_f);
  $sql4->bindValue(7,"RECHAZO".$observaciones);
  $sql4->bindValue(8,$productos_f);
  $sql4->bindValue(9,$id_usuario);
  $sql4->bindValue(10,$hoy);
  $sql4->execute();

}

public function registrar_contacto($id_paciente,$numero_orden,$observaciones,$tipo_accion,$id_usuario,$sucursal){

    $conectar = parent::conexion();
    parent::set_names();

//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='4' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();

///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

$estado_varilla_f="0";
$estado_frente_f="0";
$codos_flex_f="0";
$graduaciones_f="0";
$productos_f="0";
$sql4 = "insert into control_calidad_orden values(null,?,?,?,?,?,?,?,?,?,?);";
$sql4=$conectar->prepare($sql4);
$sql4->bindValue(1,$numero_orden);
$sql4->bindValue(2,$id_paciente);
$sql4->bindValue(3,$estado_varilla_f);
$sql4->bindValue(4,$estado_frente_f);
$sql4->bindValue(5,$codos_flex_f);
$sql4->bindValue(6,$graduaciones_f);
$sql4->bindValue(7,"LLAMADA".$observaciones);
$sql4->bindValue(8,$productos_f);
$sql4->bindValue(9,$id_usuario);
$sql4->bindValue(10,$hoy);
$sql4->execute();
}


/////////////// GET DATA PACIENTES EN CONTACTO
public function get_data_contacto($id_paciente,$numero_orden){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select p.nombres,p.empresas,p.id_paciente,p.telefono,p.telefono_oficina,p.correo,e.evaluado,e.numero_orden from pacientes as p inner join envios_lab as e on e.id_paciente=p.id_paciente where p.id_paciente = ? and e.numero_orden = ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_paciente);
        $sql->bindValue(2, $numero_orden);
        $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_data_consulta($id_paciente,$numero_orden){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select u.usuario,c.fecha,substring(c.observaciones,8) as observaciones from usuarios as u inner join control_calidad_orden as c on c.id_usuario=u.id_usuario where c.id_paciente=? and c.numero_orden=? and c.observaciones like 'LLAMADA%' order by c.id_revision DESC;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_paciente);
        $sql->bindValue(2, $numero_orden);
        $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_orden($id_paciente,$numero_orden,$evaluado){

    $conectar=parent::conexion();
    parent::set_names();
    $sql="select p.nombres,e.evaluado,e.numero_orden,e.laboratorio,e.id_paciente,e.laboratorio from pacientes as p inner join envios_lab as e on p.id_paciente=e.id_paciente where e.numero_orden=? and e.id_paciente=? and e.evaluado=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $numero_orden);
        $sql->bindValue(2, $id_paciente);
        $sql->bindValue(3, $evaluado);
        $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
public function get_data_envios($id_consulta,$id_paciente,$numero_orden,$evaluado){

    $conectar=parent::conexion();
    parent::set_names();
    $sql="select*from envios_lab where id_consulta=? and id_paciente=? and numero_orden=? and evaluado=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_consulta);
        $sql->bindValue(2, $id_paciente);
        $sql->bindValue(3, $numero_orden);
        $sql->bindValue(4, $evaluado);
        $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_creacion_orden($id_consulta,$id_paciente,$numero_orden,$evaluado){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select u.usuario,e.fecha_creacion,'CREACIÓN' as accion  from usuarios as u inner join envios_lab as e on u.id_usuario=e.id_usuario where e.id_consulta=? and e.id_paciente=? and e.numero_orden=? and e.evaluado=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_consulta);
        $sql->bindValue(2, $id_paciente);
        $sql->bindValue(3, $numero_orden);
        $sql->bindValue(4, $evaluado);
        $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_historial_orden($id_paciente,$numero_orden){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select u.usuario,a.fecha,a.tipo_accion  from usuarios as u inner join acciones_ordenes_lab as a on u.id_usuario=a.id_usuario where a.id_paciente=? and a.n_orden=? group by a.fecha;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_paciente);
        $sql->bindValue(2, $numero_orden);
        $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_data_ccf($id_envio){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select*from envios_lab where id_envio=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_envio);
    $sql->execute();

  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_precio_tratamiento($tratamiento_1){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select materiales as precio from productos where desc_producto=?";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$tratamiento_1);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

  //////////// VALIDAMOS SI EXISTE CCF /////////////
  public function valida_existe_ccf($numero_comprobante){
  $conectar = parent::conexion();
    $sql= "select * from detalle_ccf_laboratorios where ccf=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_comprobante);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }

public function registrar_ccf(){
  $conectar=parent::conexion();
  parent::set_names();
  $detalles = array();
  $detalles = json_decode($_POST["arrayCcf"]);

  $numero_orden = $_POST["numero_orden"];
  $laboratorio = $_POST["laboratorio"];
  $ccf = $_POST["numero_comprobante"];
  $evaluado = $_POST["evaluado_cff"];
  $subtotal = substr($_POST["subtotal"],1);
  $iva = substr($_POST["iva"],1);
  $total_venta = substr($_POST["total_venta"],1);
  $fecha = $_POST["fecha"];
  $id_usuario = $_POST["id_usuario"];
  $sucursal = $_POST["sucursal"];
  $estado = "0";
  $cancelado_por = "*";
  $id_envio = $_POST["id_envio"];

  $sql1="insert into detalle_ccf_laboratorios values(null,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  $sql1=$conectar->prepare($sql1);          
  $sql1->bindValue(1,$numero_orden);
  $sql1->bindValue(2,$laboratorio);
  $sql1->bindValue(3,$ccf);
  $sql1->bindValue(4,$evaluado);
  $sql1->bindValue(5,$subtotal);
  $sql1->bindValue(6,$iva);
  $sql1->bindValue(7,$total_venta);
  $sql1->bindValue(8,$fecha);
  $sql1->bindValue(9,$id_usuario);
  $sql1->bindValue(10,$sucursal);
  $sql1->bindValue(11,$estado);
  $sql1->bindValue(12,$cancelado_por);
  $sql1->bindValue(13,$id_envio);

  $sql1->execute();
}

public function listar_ccf_pagos($fin_fecha,$fecha_inicio,$laboratorio,$sucursal){

    $conectar = parent::conexion();

    $date_inicial = $_POST["fecha_inicio"];
    $date_final = $_POST["fin_fecha"];
    $fecha_inicial = date("Y-m-d", strtotime($date_inicial));
    $fecha_final = date("Y-m-d", strtotime($date_final));
    $sql = "select*from detalle_ccf_laboratorios where laboratorio=? AND fecha between ? AND ? AND sucursal=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$laboratorio);
    $sql->bindValue(2,$fecha_inicial);
    $sql->bindValue(3,$fecha_final);
    $sql->bindValue(4,$sucursal);
    
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    //echo $date_inicial;
}

}