<?php 
require_once("../config/conexion.php");

class Laboratorio extends conectar{//inicio de la clase

////////////GET NUMERO DE PACIENTE POR SUCURSAL
public function get_correlativo_orden($fecha){
    $conectar = parent::conexion();
    $fecha_act = $fecha.'%';         
    $sql= "select cod_orden from ordenes_lab where fecha_creacion like ? order by id_orden_lab DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$fecha_act);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

public function valida_existencia_orden($cod_orden){
  	$conectar = parent::conexion();

  	$sql = "select*from ordenes_lab where cod_orden=?;";
  	$sql= $conectar->prepare($sql);
    $sql->bindValue(1, $cod_orden);
    $sql->execute();
    return $resultado=$sql->fetchAll();
  }

public function registrarEnvioLab($cod_orden,$paciente,$empresa,$laboratorio,$lente,$modelo_aro,$marca_aro,$color_aro,$diseno_aro,$usuario,$sucursal,$prioridad,$observaciones){

  	$conectar = parent::conexion();
  	date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y H:i:s");
    $estado = 0;

  	$sql = "insert into ordenes_lab values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  	$sql=$conectar->prepare($sql);
  	$sql->bindValue(1,$cod_orden);
    $sql->bindValue(2,$hoy);
    $sql->bindValue(3,$paciente);
    $sql->bindValue(4,$empresa);
    $sql->bindValue(5,$laboratorio);
    $sql->bindValue(6,$lente);
    $sql->bindValue(7,$modelo_aro);
    $sql->bindValue(8,$marca_aro);
    $sql->bindValue(9,$color_aro);
    $sql->bindValue(10,$diseno_aro);
    $sql->bindValue(11,$usuario);
    $sql->bindValue(12,$sucursal);
    $sql->bindValue(13,$prioridad);
    $sql->bindValue(14,$estado);
    $sql->bindValue(15,$observaciones);
    $sql->execute();

  }

public function editarEnvioLab($cod_orden,$paciente,$empresa,$laboratorio,$lente,$modelo_aro,$marca_aro,$color_aro,$diseno_aro,$usuario,$sucursal,$prioridad,$observaciones){

  	$conectar = parent::conexion();
  	$estado = 0;

  	$edit_envio= "update ordenes_lab set paciente = ?, empresa = ?, laboratorio = ?, lente = ?, modelo_aro = ?, marca_aro = ?, color_aro = ?, diseno_aro = ?, usuario = ?, sucursal = ?, prioridad = ?,observaciones = ? where cod_orden = ?;";

  	$edit_envio = $conectar->prepare($edit_envio);
    $edit_envio->bindValue(1,$paciente);
    $edit_envio->bindValue(2,$empresa);
    $edit_envio->bindValue(3,$laboratorio);
    $edit_envio->bindValue(4,$lente);
    $edit_envio->bindValue(5,$modelo_aro);
    $edit_envio->bindValue(6,$marca_aro);
    $edit_envio->bindValue(7,$color_aro);
    $edit_envio->bindValue(8,$diseno_aro);
    $edit_envio->bindValue(9,$usuario);
    $edit_envio->bindValue(10,$sucursal);
    $edit_envio->bindValue(11,$prioridad);
    $edit_envio->bindValue(12,$observaciones);
    $edit_envio->bindValue(13,$cod_orden);
    $edit_envio->execute();

  }   

public function get_ordenes_creadas($sucursal){
	$conectar = parent::conexion();
	$sql = "select*from ordenes_lab where (estado='0' or estado = '4') and sucursal=? order by id_orden_lab DESC;";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1,$sucursal);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////////////////////////////  ORDENES ENVIADAS  ////////////////////
public function get_ordenes_enviadas($sucursal){
	$conectar = parent::conexion();
	$sql = "select a.id_accion,a.fecha as fecha_envio,o.cod_orden,o.estado,o.paciente,o.empresa,o.sucursal,o.prioridad,o.laboratorio,o.fecha_creacion,o.id_orden_lab from acciones_ordenes_envios as a inner join ordenes_lab as o on a.id_orden_lab=o.id_orden_lab where (o.estado='1' or estado = '6') and sucursal = ? and a.tipo_accion='Envio';";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1,$sucursal);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
//////////ORDENES RECIBIDAS
public function get_ordenes_recibidas(){
	$conectar = parent::conexion();
	$sql = "select a.id_accion,a.fecha as fecha_recibido,o.cod_orden,o.estado,o.paciente,o.empresa,o.sucursal,o.prioridad,o.laboratorio,o.id_orden_lab from acciones_ordenes_envios as a inner join ordenes_lab as o on a.id_orden_lab=o.id_orden_lab where o.estado='2' group by o.cod_orden; ";
	$sql = $conectar->prepare($sql);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////ORDENES RECIBIDAS
public function get_ordenes_aprobadas(){
	$conectar = parent::conexion();
	$sql = "select a.id_accion,a.fecha as fecha_recibido,o.cod_orden,o.estado,o.paciente,o.empresa,o.sucursal,o.prioridad,o.laboratorio,o.id_orden_lab from acciones_ordenes_envios as a inner join ordenes_lab as o on a.id_orden_lab=o.id_orden_lab where o.estado='3' group by o.cod_orden; ";
	$sql = $conectar->prepare($sql);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////// ORDENES ENTREGADAS ////
public function get_ordenes_entregadas(){
	$conectar = parent::conexion();
	$sql = "select a.id_accion,a.fecha as fecha_entregado,o.cod_orden,o.estado,o.paciente,o.empresa,o.sucursal,o.prioridad,o.laboratorio,o.id_orden_lab from acciones_ordenes_envios as a inner join ordenes_lab as o on a.id_orden_lab=o.id_orden_lab where o.estado='5' and a.tipo_accion='Entregar';";
	$sql = $conectar->prepare($sql);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
//////////////////////////ENVIAR ORDENES
public function registrarOrdenEnvio(){
	$conectar = parent::conexion();
	parent::set_names();
	
	$detalle_envio = array();
	$detalle_envio = json_decode($_POST["arrayDetEnvio"]);

	$usuario = $_POST["usuario"];
	$observaciones = "";//$_POST["observaciones"];
	$tipo_accion = "Envio";
	date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y H:i:s");

	foreach ($detalle_envio as $k => $v) {
		$codigo = $v->cod;
		$paciente = $v->paciente;
		$estado = $v->state;

		$sql = "select id_orden_lab from ordenes_lab where cod_orden=? and paciente=?;";
		$sql = $conectar->prepare($sql);
		$sql->bindValue(1,$codigo);
		$sql->bindValue(2,$paciente);
		$sql->execute();

		$resultado = $sql ->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultado as $key => $v) {
			$id_orden_lab = $v["id_orden_lab"];
		}

		if ($estado=="4") {
			$val = 6;
		}elseif($estado=="0"){
			$val = 1;
		}

		///////////INSERTAR EN TABLA ACCIONES //////////

		$sql2= "insert into acciones_ordenes_envios values(null,?,?,?,?,?,?,?);";
		$sql2=$conectar->prepare($sql2);
		$sql2->bindValue(1,$hoy);
		$sql2->bindValue(2,$usuario);
		$sql2->bindValue(3,$codigo);
		$sql2->bindValue(4,$paciente);
		$sql2->bindValue(5,$observaciones);
		$sql2->bindValue(6,$tipo_accion);
		$sql2->bindValue(7,$id_orden_lab);
        $sql2->execute();

        $sql3 = "update ordenes_lab set estado=? where id_orden_lab=? and cod_orden=? and paciente=?;";
        $sql3=$conectar->prepare($sql3);
        $sql3->bindValue(1,$val);
		$sql3->bindValue(2,$id_orden_lab);
		$sql3->bindValue(3,$codigo);
		$sql3->bindValue(4,$paciente);
		$sql3->execute();



	}////////////FIN FOREACH RECORRE DETALLE ENVIO


	//$sql =";";
}

/////////////////RECIBIR ORDENES /////////////
public function recibirOrdenes(){
	$conectar = parent::conexion();
	parent::set_names();
	
	$detalle_envio = array();
	$detalle_envio = json_decode($_POST["arrayDetRecibe"]);

	$usuario = $_POST["usuario"];
	$observaciones = "";
	$tipo_accion = "Recibir";
	date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y H:i:s");

	foreach ($detalle_envio as $k => $v) {
		$codigo = $v->codigo;
		$paciente = $v->paciente;

		$sql = "select id_orden_lab from ordenes_lab where cod_orden=? and paciente=?;";
		$sql = $conectar->prepare($sql);
		$sql->bindValue(1,$codigo);
		$sql->bindValue(2,$paciente);
		$sql->execute();

		$resultado = $sql ->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultado as $key => $v) {
			$id_orden_lab = $v["id_orden_lab"];
		}

		///////////INSERTAR EN TABLA ACCIONES //////////

		$sql2= "insert into acciones_ordenes_envios values(null,?,?,?,?,?,?,?);";
		$sql2=$conectar->prepare($sql2);
		$sql2->bindValue(1,$hoy);
		$sql2->bindValue(2,$usuario);
		$sql2->bindValue(3,$codigo);
		$sql2->bindValue(4,$paciente);
		$sql2->bindValue(5,$observaciones);
		$sql2->bindValue(6,$tipo_accion);
		$sql2->bindValue(7,$id_orden_lab);
        $sql2->execute();

        $sql3 = "update ordenes_lab set estado='2' where id_orden_lab=? and cod_orden=? and paciente=?;";
        $sql3=$conectar->prepare($sql3);
		$sql3->bindValue(1,$id_orden_lab);
		$sql3->bindValue(2,$codigo);
		$sql3->bindValue(3,$paciente);
		$sql3->execute();

	}////////////FIN FOREACH RECORRE DETALLE ENVIO

}
/////////////////////////ENTREGAR ORDENES ////////
public function entregarOrdenes(){
	$conectar = parent::conexion();
	parent::set_names();
	
	$detalle_envio = array();
	$detalle_envio = json_decode($_POST["ordenesEntregarArray"]);

	$usuario = $_POST["usuario"];
	$observaciones = "";
	$tipo_accion = "Entregar";
	date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y H:i:s");

	foreach ($detalle_envio as $k => $v) {
		$codigo = $v->codigo;
		$paciente = $v->paciente;

		$sql = "select id_orden_lab from ordenes_lab where cod_orden=? and paciente=?;";
		$sql = $conectar->prepare($sql);
		$sql->bindValue(1,$codigo);
		$sql->bindValue(2,$paciente);
		$sql->execute();

		$resultado = $sql ->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultado as $key => $v) {
			$id_orden_lab = $v["id_orden_lab"];
		}

		/////////// INSERTAR EN TABLA ACCIONES //////////
		$sql2= "insert into acciones_ordenes_envios values(null,?,?,?,?,?,?,?);";
		$sql2=$conectar->prepare($sql2);
		$sql2->bindValue(1,$hoy);
		$sql2->bindValue(2,$usuario);
		$sql2->bindValue(3,$codigo);
		$sql2->bindValue(4,$paciente);
		$sql2->bindValue(5,$observaciones);
		$sql2->bindValue(6,$tipo_accion);
		$sql2->bindValue(7,$id_orden_lab);
        $sql2->execute();

        $sql3 = "update ordenes_lab set estado='5' where id_orden_lab=? and cod_orden=? and paciente=?;";
        $sql3=$conectar->prepare($sql3);
		$sql3->bindValue(1,$id_orden_lab);
		$sql3->bindValue(2,$codigo);
		$sql3->bindValue(3,$paciente);
		$sql3->execute();

	}////////////FIN FOREACH RECORRE DETALLE ENVIO

}

public function aceptarOrdenes($numero_orden,$paciente,$observaciones,$usuario,$id_orden,$accion){
	$conectar = parent::conexion();
	parent::set_names();

	date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");

    if ($accion=="Aprobado"){
    	$estado='3';
    }elseif($accion=='Reenviado'){
        $estado='4';
    }

	$sql = "update ordenes_lab set estado=? where id_orden_lab=? and cod_orden=? and paciente=?;";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1,$estado);
	$sql->bindValue(2,$id_orden);
	$sql->bindValue(3,$numero_orden);
	$sql->bindValue(4,$paciente);
	$sql->execute();

	$sql2= "insert into acciones_ordenes_envios values(null,?,?,?,?,?,?,?);";
	$sql2=$conectar->prepare($sql2);
	$sql2->bindValue(1,$hoy);
	$sql2->bindValue(2,$usuario);
	$sql2->bindValue(3,$numero_orden);
	$sql2->bindValue(4,$paciente);
	$sql2->bindValue(5,$observaciones);
	$sql2->bindValue(6,$accion);
	$sql2->bindValue(7,$id_orden);
    $sql2->execute();
}

public function get_data_orden($id_orden,$cod_orden){
	$conectar = parent::conexion();
	parent::set_names();

	$sql = "select*from ordenes_lab where id_orden_lab=? and cod_orden=?;";
	$sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_orden);
    $sql->bindValue(2,$cod_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function get_actions_orders($id_orden,$cod_orden){
    $conectar=parent::conexion();
    parent::set_names();
    $sql="select u.nick,a.fecha,a.tipo_accion,a.observaciones from usuarios as u inner join acciones_ordenes_envios as a on a.usuario=u.id_usuario where a.cod_orden=? and a.id_orden_lab=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $cod_orden);
        $sql->bindValue(2, $id_orden);
        $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function state_order($codigo){
	$conectar=parent::conexion();
    parent::set_names();

    $sql="select estado from ordenes_lab where cod_orden=?;";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

////////// ORDENES EN GENERAL ////
public function get_ordenes_general($sucursal){
	$conectar = parent::conexion();
	$sql = "select estado,paciente,empresa,sucursal,laboratorio,id_orden_lab,cod_orden,fecha_creacion from ordenes_lab where sucursal=? group by id_orden_lab;";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1, $sucursal);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function getOrdenesTotal(){
	$conectar = parent::conexion();
	$sql = "select * from ordenes_lab as ol inner join acciones_ordenes_envios as ao on ol.cod_orden=ao.cod_orden order by id_accion desc;";
	$sql = $conectar->prepare($sql);
	$sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

  public function eliminar_orden_lab($cod_orden){
    $conectar=parent::conexion();
    $sql="delete ol,ao from ordenes_lab as ol join acciones_ordenes_envios as ao on (ol.cod_orden=ao.cod_orden) where ol.cod_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $cod_orden);
    $sql->execute();
    echo 'ok';
  }

}////////FIN DE LA CLASE
