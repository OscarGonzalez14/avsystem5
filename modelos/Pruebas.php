<?php

require_once("../config/conexion.php");

class Pruebas extends Conectar{

	public function getCreditos(){
    $conectar=parent::conexion();
    parent::set_names();
	
  //$sql3 = "select c.monto,c.numero_venta,c.saldo from creditos as c INNER join pacientes as p on c.id_paciente=p.id_paciente where forma_pago='Descuento en Planilla' and (numero_venta like '%AVME%' or numero_venta like '%EMMT%');";
    $sql3 = "select c.numero_venta,c.monto,c.saldo from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and (c.numero_venta like '%AVME%' or c.numero_venta like '%EMMT%');";
  $sql3 = $conectar->prepare($sql3);
  $sql3->execute();

  return $sql3->fetchAll(PDO::FETCH_ASSOC);
}

}

$proof = new Pruebas();

$res = $proof->getCreditos();

foreach($res as $v){
	echo $v['numero_venta']."   ".$v['monto']."   ".$v['saldo'].'<br>';
}
