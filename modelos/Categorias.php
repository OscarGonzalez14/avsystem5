<?php 
require_once("../config/conexion.php");

class Categoria extends conectar
{//inicio de la clase
	public function valida_existencia_categoria($cat_nombre,$cat_sucursal,$tipo_categoria){
		$conectar= parent::conexion();
		parent::set_names();
		$sql="select*from categoria where tipo_categoria=? and nombre=? and sucursal=?";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $tipo_categoria);
		$sql->bindValue(2, $cat_nombre);
		$sql->bindValue(3, $cat_sucursal);
		$sql->execute();
		return $resultado=$sql->fetchAll();
	}



	public function registrar_categoria($cat_nombre,$cat_sucursal,$cat_descripcion,$tipo_categoria){

		$conectar= parent::conexion();
		parent::set_names();
		$sql="insert into categoria values(null,?,?,?,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $tipo_categoria);
		$sql->bindValue(2, $cat_nombre);
		$sql->bindValue(3, $cat_sucursal);
		$sql->bindValue(4, $cat_descripcion);
		$sql->execute();

		//print_r($_POST);
	}

	public function get_categorias($sucursal){
	    $conectar= parent::conexion();
		parent::set_names();
		 $sql="select id_categoria, nombre from categoria where sucursal=?";
		 $sql=$conectar->prepare($sql);
		 $sql->bindValue(1, $sucursal);
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
		public function get_categorias_traslados($sucursal){
	    $conectar= parent::conexion();
		parent::set_names();
		 $sql="select nombre,sucursal from categoria where sucursal=?";
		 $sql=$conectar->prepare($sql);
		 $sql->bindValue(1, $sucursal);
    	 $sql->execute();
    	 return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    	}
	}

 ?>