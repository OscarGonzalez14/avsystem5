<?php  
//conexion a la base de datos
require_once("../config/conexion.php");


class Proveedor extends Conectar{  
  	public function get_proveedores(){
    	$conectar= parent::conexion();         
    	$sql= "select*from proveedor order by id_proveedor DESC;";
    	$sql=$conectar->prepare($sql);
    	//$sql->bindValue(1, $sucursal_correlativo);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_proveedores_compra($id_proveedor){
    	$conectar= parent::conexion();         
    	$sql= "select*from proveedor where id_proveedor=?;";
    	$sql=$conectar->prepare($sql);
    	$sql->bindValue(1, $id_proveedor);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}