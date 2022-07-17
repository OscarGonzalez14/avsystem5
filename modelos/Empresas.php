<?php 
require_once("../config/conexion.php");

class Empresas extends conectar{//inicio de la clase

 public function comprueba_existe_empresa($nomEmpresa){
  $conectar= parent::conexion();

  $sql= "select*from empresas where nombre=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$nomEmpresa);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function registrarEmpresa($nomEmpresa,$dirEmpresa,$nitEmpresa,$telEmpresa,$respEmpresa,$correoEmpresa,$encargado,$registro,$giro){

  $conectar= parent::conexion();
  parent::set_names();
  $sql="insert into empresas values(null,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $nomEmpresa);
  $sql->bindValue(2, $dirEmpresa);
  $sql->bindValue(3, $nitEmpresa);
  $sql->bindValue(4, $telEmpresa);
  $sql->bindValue(5, $respEmpresa);
  $sql->bindValue(6, $correoEmpresa);
  $sql->bindValue(7, $encargado);
  $sql->bindValue(8, $registro);
  $sql->bindValue(9, $giro);
  $sql->execute();

    //print_r($_POST);
}


public function get_empresas_en_pacientes(){

  $conectar=parent::conexion();
  parent::set_names();
  $sql="select id_empresa, nombre,ubicacion from empresas";
  $sql=$conectar->prepare($sql);
  $sql->execute();

  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function add_empresa_paciente($id_empresa){
  $conectar= parent::conexion();
    //$output = array();
  $sql="select id_empresa,nombre from empresas where id_empresa=?";

  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_empresa);
  $sql->execute();

  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}
///////////////////////GET DATA VENTA CREDITO FISCAL
public function get_contribuyentes(){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.nombres,p.id_paciente,e.nombre as empresa,e.ubicacion,e.nit from pacientes as p join empresas as e where p.empresas=e.nombre ORDER BY p.id_paciente;";
  $sql=$conectar->prepare($sql);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_empresas(){
  $conectar= parent::conexion();
  $sql= "select id_empresa, nombre, ubicacion, telefono, correo, responsable from empresas;";
  $sql=$conectar->prepare($sql);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function show_datos_empresa($id_empresa){
  $conectar= parent::conexion();
  $sql="select*from empresas where id_empresa=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_empresa);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

///editar empresa
public function edit_empresa($nomEmpresa,$dirEmpresa,$nitEmpresa,$telEmpresa,$respEmpresa,$correoEmpresa,$encargado,$registro,$giro,$id_empresa){

  $conectar= parent::conexion();
  parent::set_names();

  $sql="update empresas set nombre=?,ubicacion=?,nit=?,telefono=?,responsable=?,correo=?,encargado_optica=?,registro=?,giro=? where id_empresa=?;";          
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $_POST["nomEmpresa"]);
  $sql->bindValue(2, $_POST["dirEmpresa"]);
  $sql->bindValue(3, $_POST["nitEmpresa"]);
  $sql->bindValue(4, $_POST["telEmpresa"]);
  $sql->bindValue(5, $_POST["respEmpresa"]);
  $sql->bindValue(6, $_POST["correoEmpresa"]);
  $sql->bindValue(7, $_POST["encargado"]);
  $sql->bindValue(8, $_POST["registro"]);
  $sql->bindValue(9, $_POST["giro"]);
  $sql->bindValue(10, $_POST["id_empresa"]);      
  $sql->execute();     

}

////////////VALIDACION, SI PACIENTE ESTA LIGADO A EMPRESA NO ELIMINAR
public function ver_en_pacientes($nomEmpresa){
  $conectar= parent::conexion();
  $sql="select*from pacientes where empresas=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $nomEmpresa);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////VALIDACION PARA ELIMINAR PACIENTE SI EXISTE CONSULTA
public function eliminar_empresa($id_empresa){
  $conectar= parent::conexion();
  $sql="delete from empresas where id_empresa=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_empresa);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

}/////FIN CLASS

?>

