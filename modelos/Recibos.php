<?php 
require_once("../config/conexion.php");

class Recibos extends conectar {//inicio de la clase


  public function get_numero_recibo($sucursal_correlativo){
    $conectar= parent::conexion();
    $sql= "select numero_recibo from recibos where sucursal=? order by id_recibo DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal_correlativo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }


  public function get_datos_pac_rec_ini($n_venta,$id_paciente){

    $conectar= parent::conexion();         
    $sql= "select p.categoria_producto,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where categoria_producto='lentes'
        and d.numero_venta=? and d.id_paciente=?";

    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->bindValue(2, $id_usuario);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////VALIDA NUMERO DE RECIBO
///////////////VERIFICA SI EXISTE RECIBO***********
public function valida_existencia_nrecibo($n_recibo){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select numero_recibo from recibos where numero_recibo=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $n_recibo);
  $sql->execute();
  return $resultado=$sql->fetchAll();
}
///////////////////GREGISTRA RECIBO
public function agrega_detalle_abono($a_anteriores,$n_recibo,$n_venta_recibo_ini,$monto,$fecha,$sucursal,$id_paciente,$id_usuario,$telefono_ini,$recibi_rec_ini,$empresa_ini,$texto,$numero,$saldo,$forma_pago,$marca_aro_ini,$modelo_aro_ini,$color_aro_ini,$lente_rec_ini,$ar_rec_ini,$photo_rec_ini,$observaciones_rec_ini,$pr_abono,$servicio_rec_ini){

$conectar=parent::conexion();

  $sql="insert into recibos values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$n_recibo);
  $sql->bindValue(2,$n_venta_recibo_ini);
  $sql->bindValue(3,$monto);
  $sql->bindValue(4,$fecha);
  $sql->bindValue(5,$sucursal);
  $sql->bindValue(6,$id_paciente);
  $sql->bindValue(7,$id_usuario);
  $sql->bindValue(8,$telefono_ini);
  $sql->bindValue(9,$recibi_rec_ini);
  $sql->bindValue(10,$empresa_ini);
  $sql->bindValue(11,$texto);
  $sql->bindValue(12,$a_anteriores);
  $sql->bindValue(13,$numero);
  $sql->bindValue(14,$saldo);
  $sql->bindValue(15,$forma_pago);
  $sql->bindValue(16,$marca_aro_ini);
  $sql->bindValue(17,$modelo_aro_ini);
  $sql->bindValue(18,$color_aro_ini);
  $sql->bindValue(19,$lente_rec_ini);
  $sql->bindValue(20,$ar_rec_ini);
  $sql->bindValue(21,$photo_rec_ini);
  $sql->bindValue(22,$observaciones_rec_ini);
  $sql->bindValue(23,$pr_abono);
  $sql->bindValue(24,$servicio_rec_ini);  
  $sql->execute();

  ///////////////REGISTRA ABONOS
  $sql2="insert into abonos values(null,?,?,?,?,?,?,?,?);";
  $sql2=$conectar->prepare($sql2);
  $sql2->bindValue(1,$numero);
  $sql2->bindValue(2,$forma_pago);
  $sql2->bindValue(3,$fecha);
  $sql2->bindValue(4,$id_paciente);
  $sql2->bindValue(5,$id_usuario);
  $sql2->bindValue(6,$n_recibo);
  $sql2->bindValue(7,$n_venta_recibo_ini);
  $sql2->bindValue(8,$sucursal);
  $sql2->execute();

  ///////////////ACTUALIZAR SALDO DEL CREDITO
  $sql3="select * from creditos where numero_venta=? AND id_paciente=?;";             
  $sql3=$conectar->prepare($sql3);
  $sql3->bindValue(1,$n_venta_recibo_ini);
  $sql3->bindValue(2,$id_paciente);
  $sql3->execute();

  $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultados as $b=>$row){
      $re["saldo_actual"] = $row["saldo"];
      $re["tipo_credito"] = $row["tipo_credito"];
  }
    //la cantidad total es la suma de la cantidad más la cantidad actual
    $saldo_act = $row["saldo"] - $numero;
    $forma_venta =$row["tipo_credito"];
            
      if(is_array($resultados)==true and count($resultados)>0) {                     
      //actualiza el stock en la tabla producto
        $sql12 = "update creditos set saldo=? where numero_venta=? and id_paciente=?";
        $sql12 = $conectar->prepare($sql12);
        $sql12->bindValue(1,$saldo_act);
        $sql12->bindValue(2,$n_venta_recibo_ini);
        $sql12->bindValue(3,$id_paciente);
        //$sql12->bindValue(3,$sucursal);
        $sql12->execute();               
    }//Fin del if

  ///////////RECORD CORTE DIARIO

  //*************Clasificar por numero de abonos si es venta o recuperado si el numeor de abonos es >0
  $sql15="select count(numero_venta) as cuenta from abonos where numero_venta=? and id_paciente=?;";
             
    $sql15=$conectar->prepare($sql15);
    $sql15->bindValue(1,$n_venta_recibo_ini);
    $sql15->bindValue(2,$id_paciente);
    $sql15->execute();

    $suma_res=0;
    $resultado_num_ventas = $sql15->fetchAll(PDO::FETCH_ASSOC);
      foreach($resultado_num_ventas as $b=>$row){
      $suma_res = $suma_res+$row["cuenta"];        

    }

//print_r($suma_res);exit;
//****************Seleccionar abono Anterior
  $sql16="select sum(monto_abono) as monto_abono from abonos where numero_venta=? and id_paciente=?;";
             
    $sql16=$conectar->prepare($sql16);
    $sql16->bindValue(1,$n_venta_recibo_ini);
    $sql16->bindValue(2,$id_paciente);

    $sql16->execute();

    $suma_abonos_ant='0';
    $resultado_abonos = $sql16 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($resultado_abonos as $b=>$row){
        $suma_abonos_ant = $suma_abonos_ant+$row["monto_abono"];        

    }
/////////////////////EXTRAER EL TIPO DE PAGO
    $sql19="select * from ventas where numero_venta=? and id_paciente=?;";             
    $sql19=$conectar->prepare($sql19);
    $sql19->bindValue(1,$n_venta_recibo_ini);
    $sql19->bindValue(2,$id_paciente);
    $sql19->execute();
    
    $ver_tipo_pago = $sql19 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($ver_tipo_pago as $b=>$row){
      $tipo_pago = $row["tipo_pago"];
      $tipo_venta = $row["tipo_venta"];
      $fecha_venta = substr($row["fecha_venta"],0,10);
    }
  ///////////////verificar abonos realizados de venta en corte
    $sql21="select * from corte_diario where n_venta=? and id_paciente=? order by id_ingreso ASC limit 1;";
             
    $sql21=$conectar->prepare($sql21);
    $sql21->bindValue(1,$n_venta_recibo_ini);
    $sql21->bindValue(2,$id_paciente);
    $sql21->execute();
    
    $abonos_realizados = $sql21 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($abonos_realizados as $b=>$row){
      $total_abonos = $row["abonos_realizados"];
      $fecha_ing = $row["fecha_ingreso"];
      
    }
  ///////////////////////
  $fecha_ingr = substr($fecha_ing, 0,10);
  date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y");

////////////////////GET SUCUSAL VENTA para comisiones/////////

  $sql22 = "select u.usuario,v.sucursal from ventas as v inner join usuarios as u on u.id_usuario=v.id_usuario where v.numero_venta=? and id_paciente=? order by v.id_ventas ASC limit 1;";
  $sql22=$conectar->prepare($sql22);
  $sql22->bindValue(1,$n_venta_recibo_ini);
  $sql22->bindValue(2,$id_paciente);
  $sql22->execute();    
  $sucursal_venta = $sql22 ->fetchAll(PDO::FETCH_ASSOC);

  foreach ($sucursal_venta as $v) {
    $suc_venta = $v["sucursal"];
    $vendedor = $v["usuario"];
  }
  
if (($fecha_ingr != $hoy) or ($fecha_ingr == $fecha_venta and $suma_res>1)){

  $tipo_ingreso = "Recuperado";
  $factura = "";
  $sql17="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $sql17=$conectar->prepare($sql17);
  $sql17->bindValue(1,$fecha);
  $sql17->bindValue(2,$n_recibo);
  $sql17->bindValue(3,$n_venta_recibo_ini);
  $sql17->bindValue(4,$factura);
  $sql17->bindValue(5,$recibi_rec_ini);
  $sql17->bindValue(6,$vendedor);
  $sql17->bindValue(7,$monto);
  $sql17->bindValue(8,$forma_pago);
  $sql17->bindValue(9,$numero);
  $sql17->bindValue(10,$saldo);
  $sql17->bindValue(11,$tipo_venta);
  $sql17->bindValue(12,$tipo_pago);
  $sql17->bindValue(13,$id_usuario);
  $sql17->bindValue(14,$suma_abonos_ant-$numero);
  $sql17->bindValue(15,$suma_res);
  $sql17->bindValue(16,$id_paciente);
  $sql17->bindValue(17,$sucursal);
  $sql17->bindValue(18,$sucursal);
  $sql17->bindValue(19,$tipo_ingreso);
  $sql17->execute();

  }elseif($fecha_ingr == $hoy and $suma_res==1){
    $tipo_ingreso = "Venta";
    $factura='';
    $sql6="update corte_diario set forma_cobro=?,monto_cobrado=?,n_recibo=?,sucursal_cobro=?,saldo_credito=?,tipo_ingreso=?,sucursal_venta=? where id_paciente=? and n_venta=?;";
    $sql6=$conectar->prepare($sql6);
    $sql6->bindValue(1,$forma_pago);
    $sql6->bindValue(2,$numero);
    $sql6->bindValue(3,$n_recibo);
    $sql6->bindValue(4,$sucursal);
    $sql6->bindValue(5,$saldo);
    $sql6->bindValue(6,$tipo_ingreso);
    $sql6->bindValue(7,$sucursal);
    $sql6->bindValue(8,$id_paciente);
    $sql6->bindValue(9,$n_venta_recibo_ini);
    $sql6->execute(); 
    
  }
/*if ($fecha_ingr==$fecha_venta and $suma_res==1) {
    $tipo_ingreso = "Venta";
    $factura='';
    $sql6="update corte_diario set forma_cobro=?,monto_cobrado=?,n_recibo=?,sucursal_cobro=?,saldo_credito=?,tipo_ingreso=? where id_paciente=? and n_venta=?;";
    $sql6=$conectar->prepare($sql6);
    $sql6->bindValue(1,$forma_pago);
    $sql6->bindValue(2,$numero);
    $sql6->bindValue(3,$n_recibo);
    $sql6->bindValue(4,$sucursal);
    $sql6->bindValue(5,$saldo);
    $sql6->bindValue(6,$tipo_ingreso);
    $sql6->bindValue(7,$id_paciente);
    $sql6->bindValue(8,$n_venta_recibo_ini);
    $sql6->execute();           
  
  }elseif(($fecha_ingr==$fecha_venta and $suma_res>1) or ($fecha_ingr!=$fecha_venta)){
  
  $tipo_ingreso = "Recuperado";
  $factura = "";

  $sql17="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $sql17=$conectar->prepare($sql17);
  $sql17->bindValue(1,$fecha);
  $sql17->bindValue(2,$n_recibo);
  $sql17->bindValue(3,$n_venta_recibo_ini);
  $sql17->bindValue(4,$factura);
  $sql17->bindValue(5,$recibi_rec_ini);
  $sql17->bindValue(6,$id_usuario);
  $sql17->bindValue(7,$monto);
  $sql17->bindValue(8,$forma_pago);
  $sql17->bindValue(9,$numero);
  $sql17->bindValue(10,$saldo);
  $sql17->bindValue(11,$tipo_venta);
  $sql17->bindValue(12,$tipo_pago);
  $sql17->bindValue(13,$id_usuario);
  $sql17->bindValue(14,$suma_abonos_ant-$numero);
  $sql17->bindValue(15,$suma_res);
  $sql17->bindValue(16,$id_paciente);
  $sql17->bindValue(17,$sucursal);
  $sql17->bindValue(18,$sucursal);
  $sql17->bindValue(19,$tipo_ingreso);

  $sql17->execute();
  }*/

}
///////////////VERIFICA SALDO***********
public function saldo_venta($n_venta,$id_paciente){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select saldo from creditos where numero_venta=? and id_paciente=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $n_venta);
  $sql->bindValue(2, $id_paciente);
  $sql->execute();
  //return $resultado=$sql->fetchAll();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
////////LISTA RECIBOS EMITIDOS
public function get_recibos_emitidos($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select r.id_recibo,r.sucursal,r.numero_recibo,r.numero_venta,p.id_paciente,p.nombres,r.servicio_para from recibos as r inner join pacientes as p on p.id_paciente = r.id_paciente where r.sucursal=? order by r.id_recibo DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


////////////////GET CREDITOS PARA ABONOS POR LOTE

public function get_creditos_empresarial($empresa){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select p.nombres,p.empresas,c.monto,c.saldo,c.fecha_adquirido,c.id_paciente,c.numero_venta from pacientes as p inner join creditos as c on p.id_paciente=c.id_paciente where forma_pago='Descuento en Planilla' and p.empresas=? and c.saldo>0;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

  public function get_numero_orden_cobro(){

    $conectar= parent::conexion();
    $sql= "select numero_orden from orden_cobro order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }

public function valida_existencia_oc($numero_orden){

    $conectar = parent::conexion();
    $sql= "select * from orden_cobro where numero_orden = ?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC); 
}


public function get_detalle_lente_od($id_paciente,$correlativo_oid){  
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas_flotantes as d on p.id_producto=d.id_producto where d.numero_orden=? and d.id_paciente=? and p.categoria_producto='lentes';";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$correlativo_oid);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_aros_od($id_paciente,$correlativo_oid){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.marca,p.modelo,p.color,d.producto from productos as p inner join detalle_ventas_flotantes as d on p.id_producto=d.id_producto where d.numero_orden=? and d.id_paciente=? and p.categoria_producto='aros';";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$correlativo_oid);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_photo_prima($id_paciente,$correlativo_oid){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas_flotantes as d on p.id_producto=d.id_producto where d.numero_orden=? and d.id_paciente=? and p.categoria_producto='photosensible'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$correlativo_oid);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LENADO DE RECIBO ANTIREFLEJANTES
public function get_detalle_ar_prima($id_paciente,$correlativo_oid){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas_flotantes as d on p.id_producto=d.id_producto where d.numero_orden=? and d.id_paciente=? and p.categoria_producto='antireflejante'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$correlativo_oid);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

///////////////////////////registra prima oid
public function agrega_detalle_prima($a_anteriores,$n_recibo,$n_venta_recibo_ini,$monto,$fecha,$sucursal,$id_paciente,$id_usuario,$telefono_ini,$recibi_rec_ini,$empresa_ini,$texto,$numero,$saldo,$forma_pago,$marca_aro_ini,$modelo_aro_ini,$color_aro_ini,$lente_rec_ini,$ar_rec_ini,$photo_rec_ini,$observaciones_rec_ini,$pr_abono,$servicio_rec_ini,$tipo_recibo,$numero_orden){

$conectar=parent::conexion();

  date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
  $obs = "Abono en concepto de prima/adelanto de credito";
  $sql="insert into recibos values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$n_recibo);
  $sql->bindValue(2,$n_venta_recibo_ini);
  $sql->bindValue(3,$monto);
  $sql->bindValue(4,$hoy);
  $sql->bindValue(5,$sucursal);
  $sql->bindValue(6,$id_paciente);
  $sql->bindValue(7,$id_usuario);
  $sql->bindValue(8,$telefono_ini);
  $sql->bindValue(9,$recibi_rec_ini);
  $sql->bindValue(10,$empresa_ini);
  $sql->bindValue(11,$texto);
  $sql->bindValue(12,$a_anteriores);
  $sql->bindValue(13,$numero);
  $sql->bindValue(14,$saldo);
  $sql->bindValue(15,$forma_pago);
  $sql->bindValue(16,$marca_aro_ini);
  $sql->bindValue(17,$modelo_aro_ini);
  $sql->bindValue(18,$color_aro_ini);
  $sql->bindValue(19,$lente_rec_ini);
  $sql->bindValue(20,$ar_rec_ini);
  $sql->bindValue(21,$photo_rec_ini);
  $sql->bindValue(22,$obs);
  $sql->bindValue(23,$pr_abono);
  $sql->bindValue(24,$servicio_rec_ini);  
  $sql->execute();
  $obs_prima='(prima/adelanto)';
  ///////////////REGISTRA ABONOS
  $sql2="insert into abonos values(null,?,?,?,?,?,?,?,?);";
  $sql2=$conectar->prepare($sql2);
  $sql2->bindValue(1,$numero);
  $sql2->bindValue(2,$forma_pago);
  $sql2->bindValue(3,$hoy);
  $sql2->bindValue(4,$id_paciente);
  $sql2->bindValue(5,$id_usuario);
  $sql2->bindValue(6,$n_recibo);
  $sql2->bindValue(7,$n_venta_recibo_ini);
  $sql2->bindValue(8,$sucursal.$obs_prima);
  $sql2->execute();  
  
  $tipo_ingreso = "Recuperado";
  $factura = "";
  $tipo_venta="Contado";
  //$tipo_pago = "Descuento en Planilla";
  $abono_ant ="0";
  $suma_res ="1";
  $sql17="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $sql17=$conectar->prepare($sql17);
  $sql17->bindValue(1,$hoy);
  $sql17->bindValue(2,$n_recibo);
  $sql17->bindValue(3,$n_venta_recibo_ini);
  $sql17->bindValue(4,$factura);
  $sql17->bindValue(5,$recibi_rec_ini);
  $sql17->bindValue(6,$id_usuario);
  $sql17->bindValue(7,$monto);
  $sql17->bindValue(8,$forma_pago);
  $sql17->bindValue(9,$numero);
  $sql17->bindValue(10,$saldo);
  $sql17->bindValue(11,$tipo_venta);
  $sql17->bindValue(12,$forma_pago);
  $sql17->bindValue(13,$id_usuario);
  $sql17->bindValue(14,$abono_ant);
  $sql17->bindValue(15,$suma_res);
  $sql17->bindValue(16,$id_paciente);
  $sql17->bindValue(17,$sucursal);
  $sql17->bindValue(18,$sucursal);
  $sql17->bindValue(19,$tipo_ingreso);
  $sql17->execute();

  $obs_orden = "Paciente realizó abono de: $".number_format($numero,2,".",",")." en concepto de prima/adelanto";

  $sql8 ="update orden_credito set monto=?,observaciones=? where id_paciente=? and numero_orden=?";
  $sql8 = $conectar->prepare($sql8);
  $sql8->bindValue(1,$saldo);
  $sql8->bindValue(2,$obs_orden);
  $sql8->bindValue(3,$id_paciente);
  $sql8->bindValue(4,$numero_orden);
  $sql8->execute();

  $sql10 ="update ventas_flotantes set monto_total=? where id_paciente=? and numero_orden=?";
  $sql10 = $conectar->prepare($sql10);
  $sql10->bindValue(1,$saldo);
  $sql10->bindValue(2,$id_paciente);
  $sql10->bindValue(3,$numero_orden);
  $sql10->execute();
}

////////LISTA RECIBOS EMITIDOS
public function listar_recibos($sucursal){
    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal."%";
    $sql="select r.id_recibo,r.fecha,r.numero_recibo,r.recibi_de,r.monto,r.a_anteriores,r.abono_act,r.saldo,r.forma_pago,u.usuario,p.empresas,r.observaciones from recibos as r inner join usuarios as u on r.id_usuario=u.id_usuario inner join pacientes as p on r.id_paciente=p.id_paciente where r.sucursal like ? order by r.id_recibo desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

}


 
 