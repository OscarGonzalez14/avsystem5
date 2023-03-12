<?php

require_once("../config/conexion.php");

class Paciente extends Conectar{

    ////////////GET NUMERO DE PACIENTE POR SUCURSAL
    public function get_numero_paciente($sucursal_correlativo){
        $conectar= parent::conexion();
        $sql= "select codigo from pacientes where sucursal=? order by id_paciente DESC limit 1;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $sucursal_correlativo);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }


	public function registrar_paciente(){

      $data =  json_decode($_POST["dataSend"]);
      $conectar = parent::conexion();
      parent::set_names();
      date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");

      try {
        $conectar->beginTransaction();
        
        $sql="insert into pacientes values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $sql=$conectar->prepare($sql);
    
        $sql->bindValue(1, "-");
        $sql->bindValue(2, $data->nombres->value);
        $sql->bindValue(3, $data->telefono->value);
        $sql->bindValue(4, $data->edad->value);
        $sql->bindValue(5, '');
        $sql->bindValue(6, $_SESSION["sucursal"]);
        $sql->bindValue(7, NULL);
        $sql->bindValue(8, NULL);
        $sql->bindValue(9, $hoy);
        $sql->bindValue(10, $_SESSION["usuario"]);
        $sql->bindValue(11, NULL);
        $sql->bindValue(12, NULL);
        $sql->bindValue(13, NULL);
        $sql->bindValue(14, NULL);
        $sql->bindValue(15, NULL);
        $sql->bindValue(16, NULL);
        $sql->bindValue(17, NULL);
        $sql->bindValue(18, NULL);
        $sql->bindValue(19, NULL);
    
        $sql->execute();    
        // Confirmar la transacción si no ha habido errores
        $conectar->commit();
        if ($sql->rowCount()>0) {
          $msj = "InsertPac";          
        }else{
          $msj = "ErrorInsertPac";
        }
        echo json_encode($msj);
        
    } catch(PDOException $e) {
        // Revertir la transacción si ha habido algún error
        $conectar->rollBack();        
        echo "Error: " . $e->getMessage();
    }
          
}

//////////////////VALIDAR SI EXISTE PACIENTE
public function validar_codigo_paciente($codigo_paciente){
    $conectar= parent::conexion();
    $sql= "select*from pacientes where codigo=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$codigo_paciente);
   // $sql->bindValue(2,$dui);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
//////////////////////****************
    public function validar_dui_paciente($dui){
    $conectar= parent::conexion();
    $sql= "select*from pacientes where dui=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$dui);
   // $sql->bindValue(2,$dui);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

//////////////LISTAR PACIENTES
public function get_pacientes($sucursal_paciente,$sucursal_usuario){
    $conectar= parent::conexion();
    $sql= "select*from pacientes where sucursal=? order by id_paciente DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
///////////////////////////////////////////////////////

    public function get_pacientes_empresarial($sucursal_paciente,$sucursal_usuario){
    $conectar= parent::conexion();

    $sql= "select*from pacientes where sucursal=? or sucursal=? order by id_paciente DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal_usuario);
    $sql->bindValue(2,$sucursal_paciente."-".$sucursal_usuario);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

/////////////////LISTAR PACIENTES REFIEREN

public function get_pacientes_refieren(){
    $conectar= parent::conexion();
    $sql= "select*from pacientes order by id_paciente DESC;";
    $sql=$conectar->prepare($sql);
   
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
public function get_pacientes_refieren_data($id_paciente){
    $conectar= parent::conexion();
    $sql= "select*from pacientes where id_paciente=? order by id_paciente DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }      
//////////////// FIN LISTAR PACIENTES REFIEREN
public function get_paciente_refieren(){
    $conectar= parent::conexion();
    $sql= "select*from pacientes order by id_paciente DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

 public function get_paciente_por_id($id_paciente){
    $conectar= parent::conexion();
    $sql="select id_paciente,nombres,telefono from pacientes where id_paciente=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

 public function show_datos_paciente($id_paciente,$codigo){
    $conectar= parent::conexion();
    $sql="select*from pacientes where id_paciente=? and codigo=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->bindValue(2, $codigo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }
////////SE VALIDA SI EXISTE PACIENTE PARA LA EDICION
   public function valida_paciente($codigo){
    $conectar= parent::conexion();
    $sql="select*from pacientes where codigo=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function editar_paciente($codigo_paciente,$nombres,$telefono,$edad,$ocupacion,$sucursal,$dui,$correo,$usuario,$empresa,$nit,$tel_oficina,$direccion_completa,$tipo_paciente,$empresa_paciente,$codigo_emp,$departamento){

    $conectar= parent::conexion();
    parent::set_names();

    $sql="update pacientes set 
        nombres=?,telefono=?,edad=?,ocupacion=?,dui=?,correo=?,empresas=?,telefono_oficina=?,direccion=?,tipo_paciente=?,nit=?,empresa_dept=?,departamento=?,codigo_emp=? where codigo=?";          
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $_POST["nombres"]);
        $sql->bindValue(2, $_POST["telefono"]);
        $sql->bindValue(3, $_POST["edad"]);
        $sql->bindValue(4, $_POST["ocupacion"]);
        $sql->bindValue(5, $_POST["dui"]);
        $sql->bindValue(6, $_POST["correo"]);
        $sql->bindValue(7, $_POST["empresa"]);
        $sql->bindValue(8, $_POST["tel_oficina"]);
        $sql->bindValue(9, $_POST["direccion_completa"]);
        $sql->bindValue(10, $_POST["tipo_paciente"]);
        $sql->bindValue(11, $_POST["nit"]);
        $sql->bindValue(12, $_POST["empresa_paciente"]);
        $sql->bindValue(13, $_POST["codigo_emp"]);
        $sql->bindValue(14, $_POST["departamento"]);
        $sql->bindValue(15, $_POST["codigo_paciente"]);
        $sql->execute();     
         
}

////////////VALIDACION PARA ELIMINAR PACIENTE SI EXISTE CONSULTA
   public function valida_paciente_consulta($id_paciente){
    $conectar= parent::conexion();
    $sql="select*from consulta where id_paciente=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //////////////FUNCION PARA ELIMINAR PACIENTE
  public function eliminar_paciente($id_paciente){
    $conectar=parent::conexion();
    $sql="delete from pacientes where id_paciente=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  }

////////LISTAR PACIENTES EN VENTAS CON CONSULTAS
public function get_pacientes_con_consulta($sucursal){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.id_paciente,p.nombres,p.codigo,e.id_consulta,e.fecha_consulta,e.p_evaluado from 
    pacientes as p inner join consulta as e on e.id_paciente=p.id_paciente where p.sucursal=? ORDER BY e.id_consulta DESC;";

  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LISTAR PACIENTES EN VENTAS CON CONSULTAS
public function get_pacientes_con_consulta_emp($sucursal,$sucursal_usuario){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.id_paciente,p.nombres,p.codigo,e.id_consulta,e.fecha_consulta,e.p_evaluado from 
    pacientes as p inner join consulta as e on e.id_paciente=p.id_paciente where p.sucursal=? or p.sucursal=? ORDER BY e.id_consulta DESC;";

  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal_usuario);
  $sql->bindValue(2, $sucursal."-".$sucursal_usuario);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LISTAR PACIENTES EN VENTAS SIN CONSULTAS
public function get_pacientes_sin_consulta($sucursal){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select*from pacientes where sucursal=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

/////GET DATA PACIENTES CONSULTAS EN VENTAS
public function get_data_con_consulta($id_paciente,$id_consulta){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.nombres,p.id_paciente,p.codigo,c.id_consulta,c.p_evaluado,c.id_usuario from consulta as c inner join pacientes as p on p.id_paciente=c.id_paciente where p.id_paciente=? and c.id_consulta=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_paciente);
  $sql->bindValue(2, $id_consulta);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

/////GET DATA PACIENTES SIN CONSULTAS EN VENTAS
public function get_data_sin_consulta($id_paciente){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select nombres,codigo,id_paciente from pacientes where id_paciente=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////GET DATOS PAIENTE RECIBO INICIAL
public function get_detalle_paciente_rec_ini($id_paciente){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select telefono,empresas from pacientes where id_paciente=?";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}
public function count_referidos($id_paciente){
    $conectar= parent::conexion();           
    $sql="select id_paciente_refiere from referidos where id_paciente_refiere=?;";             
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    return $sql->rowCount();
}
}///////FIN DE LA CLASE
