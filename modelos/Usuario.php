<?php 
require_once("../config/conexion.php");

//INICIO DE FUNCION "CREAR NUEVO USUARIO"////Cod. Empleado	
class Usuarios extends conectar{  // inicio de la clase

	public function registrarUsuario($nom_user,$tel_user,$correo_user,$dir_user,$user,$pass_user,$fecha_ingreso,$cat_user,$est_user,$suc_user,$cod_user){

		$conectar= parent::conexion();
		parent::set_names();      

		$sql="insert into usuarios values (null,?,?,?,?,?,?,?,?,?,?,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $nom_user);
		$sql->bindValue(2, $tel_user);
		$sql->bindValue(3, $correo_user);
		$sql->bindValue(4, $dir_user);
		$sql->bindValue(5, $user);
		$sql->bindValue(6, $pass_user);
		$sql->bindValue(7, $fecha_ingreso);
		$sql->bindValue(8, $cat_user);
		$sql->bindValue(9, $est_user);
		$sql->bindValue(10, $suc_user);
		$sql->bindValue(11, $cod_user);

		$sql->execute();

		$id_usuario = $conectar->lastInsertId();

        $str = '';
        $detalles = array();
        $detalles = json_decode($_POST['permisosUser']);
   
        foreach($detalles as $d=>$v){
        $permisos = $v->permisos;
        $sql_detalle= "insert into usuario_permiso values(null,?,?)";
            $sql_detalle=$conectar->prepare($sql_detalle);
            $sql_detalle->bindValue(1, $id_usuario);
            $sql_detalle->bindValue(2, $permisos);
            $sql_detalle->execute();
	    }
	//fin, función registrarUsuario
    }////// funcion listar usuarios

    public function editarUsuario($nom_user,$tel_user,$correo_user,$dir_user,$user,$pass_user,$fecha_ingreso,$cat_user,$est_user,$suc_user,$id_usuario){
    	$conectar=parent::conexion();
      parent::set_names();
      $sql="update usuarios set nombres=?,telefono=?,correo=?,direccion=?,usuario=?,password=?,fecha_ingreso=?,categoria=?,estado=?,sucursal=? where id_usuario=?;";


      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $_POST["nom_user"]);
      $sql->bindValue(2, $_POST["tel_user"]);
      $sql->bindValue(3, $_POST["correo_user"]);
      $sql->bindValue(4, $_POST["dir_user"]);
      $sql->bindValue(5, $_POST["user"]);
      $sql->bindValue(6, $_POST["pass_user"]);
      $sql->bindValue(7, $_POST["fecha_ingreso"]);
      $sql->bindValue(8, $_POST["cat_user"]);
      $sql->bindValue(9, $_POST["est_user"]); 
      $sql->bindValue(10, $_POST["suc_user"]);
      $sql->bindValue(11, $_POST["id_usuario"]);

      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        //Eliminamos todos los permisos asignados para volverlos a registrar
        $sql_delete="delete from usuario_permiso where id_usuario=?";
        $sql_delete=$conectar->prepare($sql_delete);
        $sql_delete->bindValue(1,$_POST["id_usuario"]);
        $sql_delete->execute();

        //////SE REGISTRAN LOS NUEVOS PERMISOS

        $str = '';
        $detalles = array();
        $detalles = json_decode($_POST['permisosUser']);
   
        foreach($detalles as $d=>$v){
        $permisos = $v->permisos;
        $sql_detalle= "insert into usuario_permiso values(null,?,?)";
            $sql_detalle=$conectar->prepare($sql_detalle);
            $sql_detalle->bindValue(1, $id_usuario);
            $sql_detalle->bindValue(2, $permisos);
            $sql_detalle->execute();
	    }

    }


	public function get_usuarios(){
 		$conectar= parent::conexion();
  		$sql="select * from usuarios;";
  		$sql = $conectar->prepare($sql);
  		$sql->execute();
  		return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
	}

   // esta function alista los permisos (NO MARCADOS)
   public function permisos(){
       $conectar=parent::conexion();
       $sql="select * from permisos;";
       $sql=$conectar->prepare($sql);
       $sql->execute();
    return $resultado=$sql->fetchAll();
   } 

    public function listar_permisos_por_usuario($id_usuario){
       $conectar=parent::conexion();
       $sql="select * from usuario_permiso where id_usuario=?";
       $sql=$conectar->prepare($sql);
       $sql->bindValue(1, $id_usuario);
       $sql->execute();
       return $resultado=$sql->fetchAll();
    }

  public function show_datos_usuario($id_usuario){
    $conectar= parent::conexion();
    $sql="select*from usuarios where id_usuario=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_usuario);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_codigo_usuario(){
  	$conectar= parent::conexion();
    $sql= "select id_user_emp from usuarios order by id_usuario DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function comprueba_existe_usuario($cod_user){
    $conectar= parent::conexion();

    $sql= "select*from usuarios where id_user_emp=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$cod_user);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

}////////////////FIN DE LA CLASE

