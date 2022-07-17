<?php
require_once("../config/conexion.php");

class Caja extends Conectar{

  public function get_numero_requisicion($sucursal){
    $conectar= parent::conexion();
    $sql = "select n_requisicion from requisicion where sucursal=? order by id_requisicion DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //////////// VALIDAMOS SI EXISTE REQUISICION /////////////
  public function valida_existe_requisicion($n_requisicion){

	$conectar = parent::conexion();

    $sql= "select * from requisicion where n_requisicion = ?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }

/////////////////////REGISTRA REQUISICION  //////////////

  public function agrega_det_requisicion(){

  	$str = '';
	$detalles = array();
	$detalles = json_decode($_POST['arrayRequisicion']);
	$conectar= parent::conexion();
	parent::set_names();

	foreach ($detalles as $k => $v) {
	  $descripcion = $v->descripcion;
      $cantidad = $v->cantidad;

      $fecha_req = $_POST["fecha_req"];
      $numero_req = $_POST["numero_req"];
      $usuario = $_POST["usuario"];
      $sucursal = $_POST["sucursal"];

      $sql="insert into detalle_requisicion values(null,?,?,?,'0',?,?,'No','0000');";
      $sql=$conectar->prepare($sql);

    	$sql->bindValue(1,$numero_req);
    	$sql->bindValue(2,$descripcion);
    	$sql->bindValue(3,$cantidad);
    	$sql->bindValue(4,$usuario);
    	$sql->bindValue(5,$sucursal);
    	$sql->execute();
    
    }///////////////FIN FOREACH

    $estado = 0;
    $aprobado_por = "";

    $sql1="insert into requisicion values(null,?,?,?,?,?,?);";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_req);
    $sql1->bindValue(2,$fecha_req);
    $sql1->bindValue(3,$estado);
    $sql1->bindValue(4,$usuario);
    $sql1->bindValue(5,$aprobado_por);
    $sql1->bindValue(6,$sucursal);
    $sql1->execute();


  }
//////////////////LISTADO GENERAL DE REQUISICIONES
   public function get_requisiones($sucursal){
    $conectar= parent::conexion();
    $sql= "select*from requisicion where sucursal=? order by id_requisicion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //////////////////	REQUICISIONES PENDIENTES
   public function get_requisiones_pendiente(){
    $conectar= parent::conexion();
    $sql= "select*from requisicion where estado='0' order by id_requisicion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////// GET DATA ARRAY ADMIN 

    public function get_data_requisicion_admin($n_requisicion){
    $conectar= parent::conexion();         
    $sql= "select id_detalle_req,descripcion,cantidad,precio from detalle_requisicion where numero_requicision=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_detalles_req($n_requisicion){
    $conectar= parent::conexion();         
    $sql= "select * from detalle_requisicion where numero_requicision=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

////////////////////////////////APROBARREQUISICION

    public function aprobar_requisicion(){

    $str = '';
    $detalles = array();
    $detalles = json_decode($_POST['arrayAprobados']);
    $conectar= parent::conexion();
    parent::set_names();

  foreach ($detalles as $k => $v) {

    $estado = $v->estado;
    $cantidad = $v->cantidad;
    $id_detalle = $v->id_detalle;

    $usuario = $_POST["usuario"];
    $n_requisicion = $_POST["n_requisicion"];

    if ($estado=="Ok") {       
       $sql ="update detalle_requisicion set estado='Si', cantidad=? where id_detalle_req=?;";
       $sql =$conectar->prepare($sql);
       $sql->bindValue(1,$cantidad);
       $sql->bindValue(2,$id_detalle);
       $sql->execute();
    }
         
    }///////////////FIN FOREACH

    $sql1="update requisicion set aprobado_por=?,estado='1' where n_requisicion=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$usuario);
    $sql1->bindValue(2,$n_requisicion);
    $sql1->execute();

//print_r($_POST);
  }

  public function acepta_requisicion($n_requisicion){

     $conectar= parent::conexion($n_requisicion);
    $sql= "update requisicion set estado='2' where n_requisicion=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
  }


//////////////////////FINZALIZAR REQUISICION

   public function finalizar_requisicion(){

    $str = '';
    $detalles = array();
    $detalles = json_decode($_POST['arrayFinalizarReq']);
    $conectar= parent::conexion();
    parent::set_names();

  foreach ($detalles as $k => $v) {
    $precio = $v->precio;
    $id_detalle = $v->id_detalle;
    $comprobante = $v->comprobante;

    $usuario = $_POST["usuario"];
    $n_requisicion = $_POST["n_requisicion"];
    $sucursal = $_POST["sucursal"];
    $monto = $_POST["monto"];


      
    $sql ="update detalle_requisicion set precio=?,comprobante=?,usuario=? where id_detalle_req=?;";
    $sql =$conectar->prepare($sql);
    $sql->bindValue(1,$precio);
    $sql->bindValue(2,$comprobante);
    $sql->bindValue(3,$usuario);
    $sql->bindValue(4,$id_detalle);
    $sql->execute();
         
    }///////////////FIN FOREACH

    $sql1="update requisicion set estado='3' where n_requisicion=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$n_requisicion);
    $sql1->execute();

    $sql2 = "select*from caja_chica where sucursal=?;";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1,$sucursal);
    $sql2->execute();
    $resultados = $sql2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $b => $row) {
      $re["saldo_caja_c"] = $row["saldo"];
    }

    $saldo_act = $row["saldo"];
    $sobrante = $saldo_act - $monto;
    $observaciones = "0";
    $tipo_movimiento = "Egreso";
    date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y");

    $nuevo_saldo = $saldo_act - $monto;

    $sql4="insert into movimientos_caja values(null,?,?,?,?,?,?,?,?);";
    $sql4=$conectar->prepare($sql4);
    $sql4->bindValue(1,$tipo_movimiento);
    $sql4->bindValue(2,$usuario);
    $sql4->bindValue(3,$monto);
    $sql4->bindValue(4,$hoy);
    $sql4->bindValue(5,$observaciones);
    $sql4->bindValue(6,$saldo_act);
    $sql4->bindValue(7,$sobrante);
    $sql4->bindValue(8,$sucursal);
    $sql4->execute();

    $sql3 = "update caja_chica set saldo=? where sucursal=?;";
    $sql3 = $conectar->prepare($sql3);
    $sql3->bindValue(1,$nuevo_saldo);
    $sql3->bindValue(2,$sucursal);
    $sql3->execute();

}


public function get_id_caja_chica($sucursal){
  $conectar= parent::conexion();
  $sql="select id_caja from caja_chica where sucursal=?;";
  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$sucursal);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////// GET DATA EFECTIVO DIARIO

public function ver_ingesos_efectivo($sucursal){
    $conectar= parent::conexion();

    date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y");

    $fecha_abonos = $hoy."%";

    $sql= "select sum(monto_abono) as efectivo from abonos where forma_pago='Efectivo' and sucursal=? and fecha_abono like ?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->bindValue(2,$fecha_abonos);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    echo $resultado;
}

public function depositar_caja_chica($usuario,$monto_deposito,$fecha,$id_caja){

$conectar= parent::conexion();
  $sql = "select*from caja_chica where id_caja=?";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_caja);
  $sql->execute();
  $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

  foreach($resultados as $b=>$row){
      $re["saldo"] = $row["saldo"];
  }

  $nuevo_saldo = $row["saldo"] + $monto_deposito;
  
  if(is_array($resultados)==true and count($resultados)>0) {                    
    $sql12 = "update caja_chica set saldo=? where id_caja=?;";
    $sql12 = $conectar->prepare($sql12);
    $sql12->bindValue(1,$nuevo_saldo);
    $sql12->bindValue(2,$id_caja);
    $sql12->execute();      
  }

}


//////GET SALDO CAJA CHICA
public function saldo_caja_chica($sucursal){
    $conectar= parent::conexion();           
    $sql="select saldo from caja_chica where sucursal=?;";             
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
   }

}


