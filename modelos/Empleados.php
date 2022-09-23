<?php

require_once("../config/conexion.php");

class Empleados extends Conectar{
	
	public function get_level_employee($id_empleado){
		$conectar= parent::conexion();
        	$sql= "select level from usuarios where id_usuario = ?;";
        	$sql=$conectar->prepare($sql);
        	$sql->bindValue(1,$id_empleado);
        	$sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_comision_cat_uno($sucursal,$year,$mes){
		$conectar = parent::conexion();
		$suc = $sucursal;
		$fecha = "%".$mes."-".$year."%";
		$sql = "select sum(monto_total) as total from ventas where sucursal=? and fecha_venta like ?;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$sucursal);
        $sql->bindValue(2,$fecha);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function data_comisiones_cat_uno($sucursal,$year,$mes){
		$conectar = parent::conexion();
		$suc = $sucursal;
		$fecha = "%".$mes."-".$year."%";

		$sql = "select*from ventas where sucursal = ? and fecha_venta like ? order by fecha_venta DESC;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$sucursal);
        $sql->bindValue(2,$fecha);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


	}


/////////////////////// CATEGORIA 2 ///////////////
	public function get_comision_cat_dos($sucursal,$year,$mes,$optometra){
		$conectar = parent::conexion();		
		$fecha = "%".$mes."-".$year."%";
		$suc = "%".$sucursal."%";
		$sql = "select sum(monto_total) as total from ventas where id_usuario = ? and fecha_venta like ? and sucursal like ?;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$optometra);
        $sql->bindValue(2,$fecha);
        $sql->bindValue(3,$suc);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function data_comisiones_cat_dos($sucursal,$year,$mes,$id_empleado){
		$conectar = parent::conexion();

		$fecha = "%".$mes."-".$year."%";
        $suc = "%".$sucursal."%";
		$sql = "select*from ventas where id_usuario = ? and fecha_venta like ? and sucursal like ? order by fecha_venta DESC;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_empleado);
        $sql->bindValue(2,$fecha);
        $sql->bindValue(3,$suc);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

/////////////////////// CATEGORIA 3 ///////////////
	public function get_comision_cat_tres($sucursal,$year,$mes,$optometra){
		$conectar = parent::conexion();
		$suc = $sucursal;
		$suc_empresarial = "Empresarial-".$suc;
		$fecha = "%".$mes."-".$year."%";
		$sql = "select sum(monto_total) as total from ventas where ((sucursal = ?) or (sucursal=? and optometra=?)) and fecha_venta like ?;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$sucursal);
        $sql->bindValue(2,$suc_empresarial);
        $sql->bindValue(3,$optometra);
        $sql->bindValue(4,$fecha);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function data_comisiones_cat_tres($sucursal,$year,$mes,$id_empleado){
		$conectar = parent::conexion();
		$suc = $sucursal;
		$suc_empresarial = "Empresarial-".$suc;
		$fecha = "%".$mes."-".$year."%";

		$sql = "select*from ventas where ((sucursal = ?) or (sucursal=? and optometra=?)) and fecha_venta like ? order by fecha_venta DESC;";
		$sql=$conectar->prepare($sql);
        $sql->bindValue(1,$sucursal);
        $sql->bindValue(2,$suc_empresarial);
        $sql->bindValue(3,$id_empleado);
        $sql->bindValue(4,$fecha);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


	}

}

