<?php 
require_once("../config/conexion.php");

class Marca extends conectar 
{//inicio de la clase

	public function registrar_marca($nom_marca){

		$conectar= parent::conexion();
		parent::set_names();
		$sql="insert into marca values(null,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $nom_marca);
		$sql->execute();
	}
/////////////////////VERIFICAR SI EXISTE MARCA
	public function valida_existencia_marca($nom_marca){
		$conectar= parent::conexion();
		parent::set_names();
		$sql="SELECT*from marca WHERE marca=?";
		$sql= $conectar->prepare($sql);
		$sql->bindValue(1, $nom_marca);
		$sql->execute();
		return $resultado=$sql->fetchAll();
	}

	public function get_marcas(){
		$conectar= parent::conexion();
		parent::set_names();
		$sql="select * from marca order by id_marca DESC;";
		$sql=$conectar->prepare($sql);
		$sql->execute();
		return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}
//FIN class

}

 ?>