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

public function reporte_general_ventas_admin($sucurales,$incio,$fin){

    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal."%";

    $sql="select *from ventas where STR_TO_DATE(substr(fecha_venta,1,10), '%d-%m-%Y' ) BETWEEN STR_TO_DATE('01-08-2022','%d-%m-%Y') AND STR_TO_DATE('13-08-2022','%d-%m-%Y') and sucursal in('Metrocentro','Empresarial-Metrocentro') ORDER BY id_ventas DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}
}