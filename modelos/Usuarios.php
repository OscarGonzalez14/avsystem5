<?php
require_once("config/conexion.php");

class Usuarios extends Conectar{

    public function listar_permisos_por_usuario($id_usuario){
       $conectar=parent::conexion();
       $sql="select * from usuario_permiso where id_usuario=?";
       $sql=$conectar->prepare($sql);
       $sql->bindValue(1, $id_usuario);
       $sql->execute();
       return $resultado=$sql->fetchAll();
    }

public function login(){
  $conectar=parent::conexion();
  parent::set_names();
  if(isset($_POST["enviar"])){
//********VALIDACIONES  DE ACCESO*****************
  $password = $_POST["password"];
  $usuario = $_POST["usuario"];
  $sucursal = $_POST["sucursal"];

  if(empty($usuario) or empty($password) or empty($sucursal)){
      header("Location:index.php?m=2");
      exit();
    }else {
      
    $sql= "select * from usuarios where usuario=? and password=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usuario);
        $sql->bindValue(2, $password);
        $sql->execute();
        $resultado = $sql->fetch();

    if(is_array($resultado) and count($resultado)>0){
        $_SESSION["id_usuario"] = $resultado["id_usuario"];           
        $_SESSION["usuario"] = $resultado["usuario"];
        $_SESSION["sucursal"] = $sucursal;
        $_SESSION["sucursal_usuario"] = $resultado["sucursal"];
        $_SESSION["categoria"] = $resultado["categoria"];
        $_SESSION["nombres"] = $resultado["nombres"];
        $_SESSION["id_user_emp"] = $resultado["id_user_emp"];
        require_once("Usuarios.php");

        $usuario = new Usuarios();
       //VERIFICAMOS SI EL USUARIO TIENE PERMISOS A CIERTOS MODULOS
       $marcados = $usuario->listar_permisos_por_usuario($resultado["id_usuario"]);
       //declaramos el array para almacenar todos los registros marcados
       $valores=array();
      //Almacenamos los permisos marcados en el array
          foreach($marcados as $row){
              $valores[]= $row["id_permiso"];
          }
      ////Determinamos los accesos del usuario
      //si los id_permiso estan en el array $valores entonces se ejecuta la session=1, en caso contrario el usuario no tendria acceso al modulo      
      in_array(1,$valores)?$_SESSION['Empresas']=1:$_SESSION['Empresas']=0;
      in_array(2,$valores)?$_SESSION['Compras']=1:$_SESSION['Compras']=0;
      in_array(3,$valores)?$_SESSION['Inventarios']=1:$_SESSION['Inventarios']=0;
      in_array(4,$valores)?$_SESSION['Pacientes&Consultas']=1:$_SESSION['Pacientes&Consultas']=0;
      in_array(5,$valores)?$_SESSION['Ventas']=1:$_SESSION['Ventas']=0;
      in_array(6,$valores)?$_SESSION['Creditos&Cobros']=1:$_SESSION['Creditos&Cobros']=0;
      in_array(7,$valores)?$_SESSION['Caja Chica']=1:$_SESSION['Caja Chica']=0;
      in_array(8,$valores)?$_SESSION['EnviosLab']=1:$_SESSION['EnviosLab']=0;
      in_array(9,$valores)?$_SESSION['Control_labs']=1:$_SESSION['Control_labs']=0;
      in_array(10,$valores)?$_SESSION['Bodega central']=1:$_SESSION['Bodega central']=0;
      in_array(11,$valores)?$_SESSION['reportes_admin']=1:$_SESSION['reportes_admin']=0;         
        
      header("Location:home.php");
      exit();
    } else {                         
    //si no existe el registro entonces le aparece un mensaje
    header("Location:index.php?m=1");
    exit();
    } 
  }//cierre del else
  }//condicion enviar
}///FIN FUNCION LOGIN


}

?>
