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
}