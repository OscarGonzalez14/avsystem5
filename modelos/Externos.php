<?php 
require_once("config/conexion.php");

class Externos extends conectar
{//inicio de la clase



	public function get_categorias($sucursal){
	    $conectar= parent::conexion();
		parent::set_names();
		 $sql="select id_categoria, nombre from categoria where sucursal=?";
		 $sql=$conectar->prepare($sql);
		 $sql->bindValue(1, $sucursal);
    	 $sql->execute();
    	 return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    	}

	public function get_marca(){
		$conectar= parent::conexion();
		parent::set_names();
		$sql="select id_marca, marca from marca";
		$sql=$conectar->prepare($sql);
		$sql->execute();
		return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_categorias_suc($categoria,$sucursal){
	    $conectar= parent::conexion();
		parent::set_names();
		 $sql="select nombre from categoria where tipo_categoria=? and sucursal=?";
		 $sql=$conectar->prepare($sql);
		 $sql->bindValue(1, $categoria);
		 $sql->bindValue(2, $sucursal);
    	 $sql->execute();
    	 return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    	}
    
   
    public function get_usuarios(){
    	$conectar = parent::conexion();
    	parent::set_names();

    	$sql = "select*from usuarios where estado = 1 and categoria= 'optometra';";
    	$sql=$conectar->prepare($sql);
        $sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuarios_ventas(){
    	$conectar = parent::conexion();
    	parent::set_names();

    	$sql = "select*from usuarios where estado = 1;";
    	$sql=$conectar->prepare($sql);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_usuarios_comision($sucursal){
    	$conectar = parent::conexion();
    	parent::set_names();

    	$sql = "select*from usuarios where estado = 1 and sucursal=?;";
    	$sql=$conectar->prepare($sql);
    	$sql->bindValue(1, $sucursal);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public function get_empresas_creditos(){
    	$conectar = parent::conexion();
    	parent::set_names();
    	$sql = "select*from empresas;";
    	$sql=$conectar->prepare($sql);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

	}/////FIN CLASS

 ?>