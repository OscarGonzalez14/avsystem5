<?php
require_once("../config/conexion.php");

class Reporteria extends Conectar{

	////////LISTA FACTURAS DATATABLE REPORTE
public function listar_facturas($sucursal){
    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal."%";

    $sql="select cf.id_correlativo,cf.n_correlativo,cf.fecha,cf.titular,c.monto,cf.sucursal from correlativo_factura as cf inner join creditos as c on cf.n_venta=c.numero_venta where cf.sucursal like ? order by cf.id_correlativo desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function reporte_general_ventas_admin($sucursales,$rango,$consolidado){

    $conectar=parent::conexion();
    parent::set_names();
    $rango_fecha = explode("*",$rango);
    $inicio = $rango_fecha[0];
    $fin = $rango_fecha[1];
    $in_suc = explode(',',$sucursales);
    if($consolidado=='false'){
    $sql="select v.id_ventas,v.numero_venta,v.fecha_venta,c.forma_pago,c.monto,c.saldo,c.plazo,c.monto/c.plazo as cuota,v.paciente,v.sucursal from ventas as v INNER join creditos as c on v.numero_venta=c.numero_venta where STR_TO_DATE(substr(v.fecha_venta,1,10), '%d-%m-%Y' ) BETWEEN STR_TO_DATE(?,'%d-%m-%Y') AND STR_TO_DATE(?,'%d-%m-%Y') and v.sucursal in('".implode("','",$in_suc)."') ORDER BY id_ventas DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$inicio);
    $sql->bindValue(2,$fin);

    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $sql="select v.id_ventas,v.numero_venta,v.fecha_venta,c.forma_pago,sum(c.monto) as monto,sum(c.saldo) as saldo,v.paciente,c.plazo,c.monto/c.plazo as cuota,v.sucursal from ventas as v INNER join creditos as c on v.numero_venta=c.numero_venta where STR_TO_DATE(substr(v.fecha_venta,1,10), '%d-%m-%Y' ) BETWEEN STR_TO_DATE(?,'%d-%m-%Y') AND STR_TO_DATE(?,'%d-%m-%Y') and v.sucursal in('".implode("','",$in_suc)."') group by v.sucursal ORDER BY id_ventas DESC;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$inicio);
        $sql->bindValue(2,$fin);
    
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    //$data = ["inicio"=>$inicio,"fin"=>$fin,"consolidado"=>$consolidado];
    //echo json_encode($data);

}
}