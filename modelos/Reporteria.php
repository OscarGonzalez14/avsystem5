<?php  
//conexion a la base de datos
require_once("config/conexion.php");


class Reporteria extends Conectar{

	public function count_compras_ingresar_bodegas(){
    $conectar= parent::conexion();           
    $sql="SELECT estado FROM `compras` WHERE `estado`<2;";             
    $sql=$conectar->prepare($sql);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    return $sql->rowCount();
}

/////////////////////GET DATOS PARA ECIBO
public function print_recibo_paciente($n_recibo,$n_venta,$id_paciente){
  $conectar=parent::conexion();
  parent::set_names();

  $sql="select*from recibos where numero_recibo=? and numero_venta=? and id_paciente=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$n_recibo);
  $sql->bindValue(2,$n_venta);
  $sql->bindValue(3,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////GET DATOS DESCRIPCION DE PRODUCTOS FACTURA
public function get_datos_factura($n_venta_cf,$id_paciente_cf){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select producto from detalle_ventas where numero_venta=? and id_paciente=? order by id_detalle_ventas ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_venta_cf);
       $sql->bindValue(2,$id_paciente_cf);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
/////////GET DATOS CANTIDAD DE PRODUCTOS FACTURA
public function get_datos_factura_cantidad($n_venta,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select cantidad_venta from detalle_ventas where numero_venta=? and id_paciente=? order by id_detalle_ventas ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_venta);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////GET DATOS PRECIO UNITARIO DE PRODUCTOS FACTURA
public function get_datos_factura_p_unitario($n_venta,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select precio_final from detalle_ventas where numero_venta=? and id_paciente=? order by id_detalle_ventas ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_venta);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
/////////GET DATOS SUBTOTAL DE PRODUCTOS FACTURA
public function get_datos_factura_subtotal($n_venta,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select precio_final as subtotal from detalle_ventas where numero_venta=? and id_paciente=? order by id_detalle_ventas ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_venta);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////GET DATOS CLIENTE DE PRODUCTOS FACTURA
public function get_datos_factura_paciente($id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select *from pacientes where id_paciente=?";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////GET DATOS VENTA FACTURA
public function get_datos_factura_venta($n_venta,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select *from ventas where numero_venta=? and id_paciente=? group by numero_venta";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_venta);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////////////////////////INICIO CORTE DIARIO////////////////////

############GET VENTAS COBRO CONTADO##############
public function get_datos_ventas_cobros_contado($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select  c.n_factura,c.fecha_ingreso,c.n_recibo,c.paciente,u.usuario,c.total_factura,c.forma_cobro,c.monto_cobrado,c.saldo_credito,c.abonos_realizados from
corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario where c.fecha_ingreso like ? and c.abonos_realizados='0' and c.tipo_venta='Contado' AND tipo_ingreso='Venta' and (sucursal_venta=? or sucursal_cobro=?);";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->bindValue(3,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

############GET VENTAS EMPRESARIAL##############
public function get_datos_ventas_empresarial($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select c.fecha_ingreso, c.n_factura,c.n_recibo,p.nombres,p.empresas,u.usuario,c.forma_cobro,c.monto_cobrado,sum(c.total_factura) as total_factura,c.saldo_credito,c.abonos_realizados from corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario inner join pacientes as p on p.id_paciente=c.id_paciente where c.fecha_ingreso like ? and c.abonos_realizados='0' and c.tipo_pago='Descuento en Planilla' and (sucursal_venta=? or sucursal_cobro=?) group by c.n_venta;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->bindValue(3,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

##################GET VENTAS CARGO AUTOMATICO########
public function get_datos_ventas_cargo($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select  c.n_factura,c.fecha_ingreso,c.n_recibo,c.paciente,u.usuario,c.total_factura,c.forma_cobro,c.monto_cobrado,c.saldo_credito,c.abonos_realizados from corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario where c.fecha_ingreso like ? and c.abonos_realizados='0' and c.tipo_pago='Cargo Automatico' and (sucursal_venta=? or sucursal_cobro=?);";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->bindValue(3,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

##################RECUPERADO CONTADO ########
public function get_datos_recuperado_contado($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select  c.n_factura,c.fecha_ingreso,c.n_recibo,c.paciente,u.usuario,c.total_factura,c.abono_anterior,c.saldo_credito+c.monto_cobrado as saldo_anterior,c.forma_cobro,c.monto_cobrado,c.saldo_credito,c.abonos_realizados,c.vendedor from
    corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario where c.fecha_ingreso like ? and c.tipo_ingreso='Recuperado' and c.tipo_venta='Contado' and sucursal_cobro=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

##################RECUPERADO EMPRESARIAL ########
public function get_datos_recuperado_empresarial($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select  c.n_factura,c.fecha_ingreso,c.n_recibo,c.paciente,c.vendedor,u.usuario,c.total_factura,c.abono_anterior,c.saldo_credito+c.monto_cobrado as saldo_anterior,c.forma_cobro,c.monto_cobrado,c.saldo_credito,c.abonos_realizados from
corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario where c.fecha_ingreso like ? and c.tipo_ingreso='Recuperado' and c.tipo_pago='Descuento en Planilla' and c.sucursal_cobro=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

##################RECUPERADO EMPRESARIAL ########
public function get_datos_recuperado_cargo($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$fecha_corte = $fecha."%";
	$sql="select  c.n_factura,c.fecha_ingreso,c.n_recibo,c.paciente,u.usuario,c.total_factura,c.abono_anterior,c.saldo_credito+c.monto_cobrado as saldo_anterior,c.forma_cobro,c.monto_cobrado,c.saldo_credito,c.abonos_realizados,c.vendedor from
corte_diario as c inner join usuarios as u on u.id_usuario=c.id_usuario where c.fecha_ingreso like ? and c.tipo_ingreso='Recuperado' and c.tipo_pago='Cargo Automatico' and sucursal_cobro=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);

	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

#############GET RESUMEN VENTAS Y COBROS
public function get_resumen_ventas_cobros($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names(); 
	$fecha_corte = $fecha."%";
	$sql="select * from corte_diario where fecha_ingreso like ? and (sucursal_venta=? or sucursal_cobro=?);";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha_corte);
	$sql->bindValue(2,$sucursal);
	$sql->bindValue(3,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////GET REQUICISIONES PENDIENTES
public function count_req_pendientes(){
    $conectar= parent::conexion();           
    $sql="select estado from requisicion where estado=0;";             
    $sql=$conectar->prepare($sql);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    return $sql->rowCount();
}

///////////////GET MOVIMIENTOS caja chica
public function get_mov_caja($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names(); 
	$sql="select*from movimientos_caja where fecha=? and sucursal=? order by id_mov_caja DESC limit 1;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$fecha);
	$sql->bindValue(2,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////////////GET DATA CAJA CHICA

public function get_data_caja_chica($fecha,$sucursal){
	$conectar= parent::conexion();
	parent::set_names(); 
	$fecha_corte = $fecha."%";
	$sql="select r.n_requisicion,r.fecha,r.estado,r.aprobado_por,r.sucursal,dr.descripcion,dr.cantidad,dr.precio,dr.usuario,dr.comprobante from requisicion as r join detalle_requisicion as dr where r.n_requisicion=dr.numero_requicision and r.estado='3' AND dr.precio>0 and r.sucursal=? and r.fecha like ?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$sucursal);
	$sql->bindValue(2,$fecha_corte);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}



////////////NOTIFICACION DE GANADORES POR REFERIDOS
public function count_ganadores(){
    $conectar= parent::conexion();           
    $sql="select id_paciente_refiere, count(*) as num from referidos group by id_paciente_refiere having num = 5;";             
    $sql=$conectar->prepare($sql);    
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    return $sql->rowCount();
}

/////////GET DATOS VENTA EMPRESA
public function get_datos_empresa($empresa){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select *from empresas where nombre=?";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$empresa);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

############# GET RESUMEN VENTAS Y COBROS
public function get_saldo_caja($sucursal){
	$conectar= parent::conexion();
	parent::set_names();
 
	$sql="select saldo from caja_chica where sucursal=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$sucursal);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////////////////////DATOS DE VENTA EN CONSULTAS /////////
public function get_ventas_consulta($id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
 
	$sql="select*from ventas where id_paciente=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////////   GET DATA ORDEN CREDITO  /////////////////////////
public function get_data_orden_credito($id_paciente,$n_orden){
	$conectar= parent::conexion();
	parent::set_names(); 
	$sql="select*from orden_credito where id_paciente=? and numero_orden=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$id_paciente);
	$sql->bindValue(2,$n_orden);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_orden_credito($id_paciente,$n_orden){
	$conectar= parent::conexion();
	parent::set_names(); 
	$sql="select*from detalle_ventas_flotantes where id_paciente=? and numero_orden=?;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$id_paciente);
	$sql->bindValue(2,$n_orden);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function beneficiarios_oid($id_paciente,$n_orden){

	$conectar= parent::conexion();
	parent::set_names(); 

	$sql = "select evaluado,monto_total from ventas_flotantes where id_paciente=? and numero_orden=?;";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1,$id_paciente);
	$sql->bindValue(2,$n_orden);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////GET DETALLES DE VENTAS FLOTANTES POR BENEFICIARIO OID

public function get_detalle_vf_beneficiario($evaluado,$n_orden){

	$conectar= parent::conexion();
	parent::set_names(); 

	$sql = "select*from detalle_ventas_flotantes where beneficiario=? and numero_orden=?;";
	$sql = $conectar->prepare($sql);
	$sql->bindValue(1,$evaluado);
	$sql->bindValue(2,$n_orden);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}


/////////////////////DATA RECIBO PRIMA OID  ////////
public function get_data_prima_oid($n_orden,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select cantidad_venta from detalle_ventas_flotantes where numero_orden=? and id_paciente=? order by id_detalle_venta_flotante ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_orden);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_datos_det_vflotante($n_orden,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select producto from detalle_ventas_flotantes where numero_orden=? and id_paciente=? order by id_detalle_venta_flotante ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_orden);
       $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


/////////GET DATOS PRECIO UNITARIO DE PRODUCTOS FACTURA
public function get_datos_prima_p_unitario($n_orden,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select precio_final from detalle_ventas_flotantes where numero_orden=? and id_paciente=? order by id_detalle_venta_flotante ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_orden);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_datos_prima_subtotal($n_orden,$id_paciente){
	$conectar= parent::conexion();
	parent::set_names();
	$sql="select precio_final as subtotal from detalle_ventas_flotantes where numero_orden=?  and id_paciente=? order by id_detalle_venta_flotante ASC;";
	$sql=$conectar->prepare($sql);
	$sql->bindValue(1,$n_orden);
    $sql->bindValue(2,$id_paciente);
	$sql->execute();
	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////////////////PAGOS DE COMISION /////////////

/*public function get_comision_cat_uno(){
	select sum(monto_total) from ventas where sucursal="Metrocentro" and fecha_venta like "%06-2021%";
    select*from ventas where sucursal = "Metrocentro";

}*/

/*public function get_comision_cat_dos(){
	select sum(monto_total) from ventas where id_usuario=3;
    select*from ventas where id_usuario=3;
}*/

/*public function get_comision_cat_3(){
	select sum(monto_total) from ventas where ((sucursal = "Metrocentro") or (sucursal="Empresarial-Metrocentro" and optometra="7")) and fecha_venta like "%06-2021%";
    select*from ventas where ((sucursal = "Metrocentro") or (sucursal="Empresarial-Metrocentro" and optometra="7")) and fecha_venta like "%06-2021%";
}*/

}