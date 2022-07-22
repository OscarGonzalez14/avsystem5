<?php 
require_once("../config/conexion.php");

	class Creditos extends Conectar{

	
public function listar_cpendientes_contado($sucursal,$ver_creditos){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.nombres,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado,c.cancelacion,p.sucursal,u.usuario,SUBSTRING(c.fecha_adquirido,1,10) as fecha_adquirido,p.telefono from creditos as c inner join ventas as v on c.numero_venta=v.numero_venta inner join pacientes as p on v.id_paciente=p.id_paciente inner join usuarios as u on v.id_usuario=u.id_usuario where c.tipo_credito='Contado' and c.saldo > 0 and p.sucursal like ? order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_cfinalizados_contado($sucursal,$ver_credito){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.nombres,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado,c.cancelacion,v.sucursal,u.usuario,c.fecha_adquirido,p.telefono from creditos as c inner join ventas as v on c.numero_venta=v.numero_venta inner join pacientes as p on v.id_paciente=p.id_paciente inner join usuarios as u on v.id_usuario=u.id_usuario where c.tipo_credito='Contado' and c.saldo = 0 and p.sucursal like ? order  by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    } 

/////////////////////////   LISTAR CREDITOS DE CARGO AUTOMATICO  ////////////////////
    public function get_creditos_cauto($sucursal){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado,c.cancelacion
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Cargo Automatico' and v.sucursal like ? order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

//////////////////////LISTAR CREDITOS DE DESCUENTO EN PLANILLA
    public function get_creditos_oid($sucursal,$empresa){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Descuento en Planilla' and v.sucursal=? and p.empresas=? group by c.numero_venta order by c.id_credito DESC;";

    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->bindValue(2,$empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

   //////////////////////LISTAR CREDITOS DE DESCUENTO EN PLANILLA EMPRESARIALES ////////////////
    public function get_creditos_oid_empresarial($sucursal,$empresa,$sucursal_usuario){
    $conectar= parent::conexion();
    /* $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Descuento en Planilla' and (p.sucursal=? or p.sucursal=?) and p.empresas=? group by c.numero_venta order by c.id_credito DESC;";*/
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Descuento en Planilla' group by c.numero_venta order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal_usuario);
    $sql->bindValue(2,"Empresarial-".$sucursal_usuario);
    $sql->bindValue(3,$empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    //////////////////////LISTAR CREDITOS DE DESCUENTO EN PLANILLA
    public function get_ventas_ccf_empresarial($empresa){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where p.empresas=? order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    /////////////GET DATOS DE PACIENTE PARA MODAL GENERICA DE CREDITOS
    public function get_data_paciente_abonos($id_paciente,$id_credito,$numero_venta){
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select c.id_paciente,c.monto/c.plazo as cuotas,c.numero_venta,c.id_credito,c.monto,c.saldo,v.paciente,v.evaluado,p.telefono,p.empresas
        from creditos as c inner join ventas as v on c.numero_venta=v.numero_venta inner join pacientes as p on p.id_paciente=c.id_paciente where c.id_paciente=? and v.numero_venta=?
        and c.numero_venta=? and c.id_paciente=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_paciente);
        $sql->bindValue(2, $numero_venta);
        $sql->bindValue(3, $numero_venta);
        $sql->bindValue(4, $id_paciente);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

        public function get_abono_ant($id_paciente,$numero_venta){
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select sum(monto_abono) as monto_abono from abonos where numero_venta=? and id_paciente=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $numero_venta);
        $sql->bindValue(2, $id_paciente);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    //////LISTAR DETALLE DE ABONOS
     public function get_detalle_abonos($id_paciente,$numero_venta){
    $conectar= parent::conexion();
    $sql= "select a.fecha_abono,a.forma_pago,a.n_recibo,a.monto_abono,a.sucursal,u.usuario,c.monto,p.nombres,p.empresas from abonos as a inner join creditos as c on c.numero_venta=a.numero_venta inner join usuarios as u on a.id_usuario=u.id_usuario inner join pacientes as p on p.id_paciente=a.id_paciente where a.id_paciente=?and a.numero_venta=? group by a.n_recibo order by a.id_abono DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->bindValue(2, $numero_venta);
    $sql->execute();
    return $resultado=$sql->fetchAll();
    }

    //////////////GET DATOS DE PACIENTE DE MODAL ABONOS
    public function get_datos_abonos($id_paciente,$numero_venta){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select c.monto,sum(a.monto_abono) as abonado,p.nombres,c.monto-(sum(a.monto_abono)) as saldo from creditos as c inner join abonos as a on c.numero_venta=a.numero_venta inner join pacientes as p on c.id_paciente=p.id_paciente where a.id_paciente=? and a.numero_venta=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->bindValue(2, $numero_venta);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_creditos_automaticos(){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta where c.forma_pago='Cargo Automatico' and p.sucursal='Metrocentro' order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
   // $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////GET PACIENTES CATEGORIA C
    public function get_creditos_cat_b($sucursal){
    $conectar= parent::conexion();
    $sql= "select p.nombres, p.empresas,p.telefono,r.numero_venta,r.id_paciente,max(r.prox_abono) as prox_abono,r.abono_act, datediff(now(),max(r.prox_abono)) as dif_days,r.monto,max(r.fecha) as fecha_abono,c.saldo,sum(r.abono_act) as abonado,c.forma_pago,c.plazo,c.monto/plazo as cuota  from
pacientes as p inner join recibos as r on r.id_paciente=p.id_paciente join creditos as c where r.sucursal=? and c.numero_venta COLLATE utf8mb4_general_ci =r.numero_venta and c.saldo>0 group by r.numero_venta having dif_days>30 and dif_days<90 and max(r.fecha) order by r.id_recibo DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////GET PACIENTES CATEGORIA C
    public function get_creditos_cat_c($sucursal){
    $conectar= parent::conexion();
    $sql= "select p.nombres, p.empresas,p.telefono,r.numero_venta,r.id_paciente,max(r.prox_abono) as prox_abono,r.abono_act, datediff(now(),max(r.prox_abono)) as dif_days,r.monto,max(r.fecha) as fecha_abono,r.saldo,c.saldo,sum(r.abono_act) as abonado,c.forma_pago from pacientes as p inner join recibos as r on r.id_paciente=p.id_paciente join creditos as c where r.sucursal=? and c.numero_venta COLLATE utf8mb4_general_ci =r.numero_venta group by r.numero_venta and c.saldo>0 having dif_days>90 order by r.id_recibo DESC;
";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    //////////////GET DATOS DE PACIENTE CREDITOS EN MORA
    public function get_datos_creditos_mora($id_paciente){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select*from pacientes where id_paciente=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

/////////////////////GET CORRELATIVO FACTURAS
public function get_correlativo_factura($sucursal){
  $conectar= parent::conexion();
  $suc='%'.$sucursal.'%';
  $sql= "select n_correlativo+1 as n_correlativo from correlativo_factura where sucursal like ? order by id_correlativo desc limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$suc);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

///////// VALIDAR CORRELATIVO 
public function validar_correlativo($correlativo_fac,$sucursal){
    $conectar  = parent::conexion();
    parent::set_names();
    $sql = "select n_correlativo from correlativo_factura where n_correlativo=? and sucursal=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$sucursal);
    $sql->execute();
    return $resultado = $sql->fetchAll();
}

public function registrar_impresion_factura($sucursal,$numero_venta,$id_usuario,$correlativo_fac,$id_paciente){
    $conectar = parent::conexion();
    parent::set_names();


    $sql2 = "select paciente from ventas where id_paciente=? and numero_venta=?;";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1,$id_paciente);
    $sql2->bindValue(2,$numero_venta);
    $sql2->execute();
    
    $paciente = $sql2->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($paciente as $row){
        $titular = $row["paciente"];
    }

    date_default_timezone_set('America/El_Salvador');
    $hoy = date("d-m-Y H:i:s");

    $estado_correlativo = "Impreso";

    $sql ="insert into correlativo_factura values(null,?,?,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$sucursal);
    $sql->bindValue(3,$numero_venta);
    $sql->bindValue(4,$id_usuario);
    $sql->bindValue(5,$hoy);
    $sql->bindValue(6,$titular);
   // $sql->bindValue(7,$estado_correlativo);
    $sql->execute();
    
    //////////////////// UPDATE EN CORTE DIARIO //////////
    $sql = "update corte_diario set n_factura = ? where n_venta =? and id_paciente=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$numero_venta);
    $sql->bindValue(3,$id_paciente);
    $sql->execute();
    ////////////////////// UPDATE CANCELACION FACTURA /////

    $sql2 = "update creditos set cancelacion = '1' where numero_venta =? and id_paciente=?;";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1,$numero_venta);
    $sql2->bindValue(2,$id_paciente);
    $sql2->execute(); 

}
/************************************************************
**ORDENES DE DESCUENTO EN PLANILLA PENDIENTES DE APROBACIÓN**
*************************************************************/
public function get_ordenes_descuento_pendientes($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $suc = '%'.$sucursal.'%';
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='0' and tipo_orden !='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/************************************************************
*******ORDENES DE DESCUENTO EN PLANILLA APROBADAS************
*************************************************************/
public function get_ordenes_descuento_aprobadas($suc){
    $conectar=parent::conexion();
    parent::set_names();
    $sucursal = "%".$suc."%";
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='1' and tipo_orden !='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


public function get_ordenes_descuento_empresarial($sucursal_usuario){
    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal_usuario."%";
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='0' and tipo_orden !='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

/////////////// CARGOS AUTOMATICOS APROBACION///////////////
public function get_ordenes_cauto_pendientes($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $suc = '%'.$sucursal.'%';
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='0' and tipo_orden ='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_ordenes_cauto_empresarial($sucursal_usuario){
    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal_usuario."%";
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='0' and tipo_orden ='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////////GET DATA ORDEN CREDITO
public function get_data_orden_credito($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from orden_credito where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_paciente_id($id_paciente){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select *from pacientes where id_paciente=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_orden_credito($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from detalle_ventas_flotantes where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_det_orden($n_orden_add,$id_paciente){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from orden_credito where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden_add);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_venta_flotante($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from ventas_flotantes where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
///////////APROBAR ORDEN
public function aprobar_orden(){

    $conectar = parent::conexion();
    ///////BENEFICIARIOS ORDEN
    $beneficiarios_oid = array();
    $beneficiarios_oid = json_decode($_POST["beneficiariosArray"]);
    date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");

    $sucursal_usuario = $_POST["sucursal_usuario"];

    foreach ($beneficiarios_oid as $k => $v){///////////GET BENEFICIARIOS
        $estado = $v->estado;
        $evaluado = $v->evaluado;
        $id_orden = $v->id_orden;
        $id_paciente = $v->id_paciente;
        $monto_total = $v->monto_total;
        $nombres = $v->nombres;
        $numero_orden = $v->numero_orden;
        $sucursal = $v->sucursal;

        if ($estado=="Ok"){

        //////////////////////VERIFICAR SI EXISTE N ORDEN EN VENTAS 
        $sql11 = "select numero_venta FROM ventas where id_paciente= ? and n_orden = ?;";
        $sql11=$conectar->prepare($sql11);
        $sql11->bindValue(1,$id_paciente);
        $sql11->bindValue(2,$numero_orden);
        $sql11->execute();

        $data_venta = $sql11->fetchAll(PDO::FETCH_ASSOC);

        if(is_array($data_venta) and count($data_venta)){
            foreach($data_venta as $row){
                $num_venta =$row["numero_venta"];
            }
        }else{
            /////////// GET NUMERO DE VENTA ////////
            require_once("Ventas.php");
            $ventas = new Ventas();
            $correlativo = $ventas->get_numero_venta($sucursal);
            $prefijo = "";
            if ($sucursal=="Metrocentro") {
                $prefijo="AV";
                $sufijo="ME";
            }elseif ($sucursal=="Santa Ana") {
                $prefijo="AV";
                $sufijo="SA";
            }elseif ($sucursal=="San Miguel") {
                $prefijo="AV";
                $sufijo="SM"; 
            }elseif ($sucursal=="Chalatenango") {
                $prefijo="AV";
                $sufijo="CH";
            }elseif ($sucursal=="Ahuachapán") {
                $prefijo="AV";
                $sufijo="AH";
            }elseif ($sucursal=="Cascadas") {
                $prefijo="AV";
                $sufijo="CA";      
            }elseif ($sucursal=="Empresarial-Santa Ana") {/////////////////CORRELATIVOS EMPRESARIALES
                $prefijo="EM";
                $sufijo="SA";
            }elseif ($sucursal=="Empresarial-San Miguel") {
                $prefijo="EM";
                $sufijo="SM";
            }elseif ($sucursal=="Empresarial-Metrocentro") {
                $prefijo="EM";
                $sufijo="MT";
            }elseif ($sucursal=="Empresarial-Chalatenango") {
                $prefijo="EM";
                $sufijo="CH";
            }elseif ($sucursal=="Empresarial-Ahuachapán") {
                $prefijo="EM";
                $sufijo="AH";
            }elseif ($sucursal=="Empresarial-Cascadas") {
                $prefijo="EM";
                $sufijo="CA";
            }

       
            if(is_array($correlativo)==true and count($correlativo)>0){
                foreach($correlativo as $row){                  
                    $codigo=$row["numero_venta"];
                    $cod=(substr($codigo,5,11))+1;
                    $num_venta =$prefijo.$sufijo."-".$cod;
                }///FIN FOREACH             
            }else{
            $num_venta = $prefijo.$sufijo."-1";
            }
        }
        //////////GET ITEMS DE VENTAS FLOTANTES POR BENEFICIARIO   
        $sql = "select*from detalle_ventas_flotantes where numero_orden=? and beneficiario=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$numero_orden);
        $sql->bindValue(2,$evaluado);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

       $suma_pfinal = 0;
       foreach ($resultados as $v => $row) {//Recorrer detalle ventas flotantes
         $id_producto = $row["id_producto"];
         $producto = $row["producto"];
         $precio_venta = $row["precio_venta"];
         $cantidad_venta = $row["cantidad_venta"];
         $descuento = $row["descuento"];
         $precio_final = $row["precio_final"];
         $fecha_venta = $row["fecha_venta"];
         $id_usuario = $row["id_usuario"];
         $id_paciente = $row["id_paciente"];
         $beneficiario = $row["beneficiario"];

        //////////OBETENER LA DESCRIPCION DEL PRODUCTO /////////////
        $sqlp = "select*from productos where id_producto=?;";
        $sqlp = $conectar->prepare($sqlp);
        $sqlp->bindValue(1,$id_producto);
        $sqlp->execute();

        $detalles_producto = $sqlp->fetchAll(PDO::FETCH_ASSOC);

        foreach ($detalles_producto as $item){
        $cat_prod = $item["categoria_producto"];
        if ($cat_prod == "aros") {
            $descripcion = "ARO.: ".$item["marca"]." MOD.:".$item["modelo"]." COLOR.:".$item["color"]." MED.:".$item["medidas"]." ".$item["diseno"];
        }elseif($cat_prod=="Lentes"){
            $descripcion = "LENTE: ".$item["desc_producto"];
        }elseif($cat_prod=="Antireflejante" or $cat_prod=="Photosensible"){
            $descripcion = "TRATAMIENTOS: ".$item["desc_producto"];
        }elseif($cat_prod=="accesorios"){
            $descripcion = "ACC: ".$item["desc_producto"];
        }
        }

       $sql="insert into detalle_ventas values(null,?,?,?,?,?,?,?,?,?,?,?);";
       $sql=$conectar->prepare($sql);
       $sql->bindValue(1,$num_venta);
       $sql->bindValue(2,$id_producto);
       $sql->bindValue(3,$descripcion);
       $sql->bindValue(4,$precio_venta);
       $sql->bindValue(5,$cantidad_venta);
       $sql->bindValue(6,$descuento);
       $sql->bindValue(7,$precio_final);
       $sql->bindValue(8,$hoy);
       $sql->bindValue(9,$id_usuario);
       $sql->bindValue(10,$id_paciente);
       $sql->bindValue(11,$beneficiario);
       $sql->execute();
       $suma_pfinal = $suma_pfinal+$precio_final;
       }///////fin recorrer detalle ventas flotantes

       ///////CONSULTAR VENTA FLOTANTE POR BENEFICIARIO
       $sql1="select * from ventas_flotantes where numero_orden=? and evaluado=?;";
       $sql1=$conectar->prepare($sql1);
       $sql1->bindValue(1,$numero_orden);
       $sql1->bindValue(2,$evaluado);
       $sql1->execute();
       $resultados_vf = $sql1->fetchAll(PDO::FETCH_ASSOC);

       foreach ($resultados_vf as $v => $row) {//Recorrer detalle ventas flotantes
        $paciente = $row["paciente"];
        $vendedor = $row["vendedor"];
        $monto_total = $row["monto_total"];
        $tipo_pago = $row["tipo_pago"];
        $tipo_venta = $row["tipo_venta"];
        $id_usuario = $row["id_usuario"];
        $id_paciente = $row["id_paciente"];
        $sucursal = $row["sucursal"];
        $evaluado = $row["evaluado"];
        $optometra = $row["optometra"];
        $estado = $row["estado"];        
       }
    
    $sql2 = "insert into ventas values(null,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $sql2=$conectar->prepare($sql2);
    $sql2->bindValue(1,$hoy);
    $sql2->bindValue(2,$num_venta);
    $sql2->bindValue(3,$paciente);
    $sql2->bindValue(4,$vendedor);       
    $sql2->bindValue(5,$suma_pfinal);
    $sql2->bindValue(6,$tipo_pago);
    $sql2->bindValue(7,$tipo_venta);          
    $sql2->bindValue(8,$id_usuario);
    $sql2->bindValue(9,$id_paciente);
    $sql2->bindValue(10,$sucursal);
    $sql2->bindValue(11,$evaluado);
    $sql2->bindValue(12,$optometra);
    $sql2->bindValue(13,$numero_orden);
    $sql2->execute();

    $id = "replace correlativo_ventas set id_correlativo=0,numero_venta = ?, sucursal=?;";
    $id = $conectar->prepare($id);
    $id->bindValue(1,$num_venta);
    $id->bindValue(2,$sucursal);
    $id->execute();

    $sql3="update ventas_flotantes set estado='1' where numero_orden=? and evaluado=?;";
    $sql3=$conectar->prepare($sql3);
    $sql3->bindValue(1,$numero_orden);
    $sql3->bindValue(2,$evaluado);
    $sql3->execute();

    $sql4="update orden_credito set estado='1' where numero_orden=?;";
    $sql4=$conectar->prepare($sql4);
    $sql4->bindValue(1,$numero_orden);
    $sql4->execute();

    $sql5 = "select saldo,id_credito,monto from creditos where id_paciente=? and forma_pago='Descuento en Planilla' and numero_orden = ? order by id_credito DESC limit 1;";
    $sql5= $conectar->prepare($sql5);
    $sql5->bindValue(1, $id_paciente);
    $sql5->bindValue(2, $numero_orden);
    $sql5->execute();
    $saldos = $sql5->fetchAll(PDO::FETCH_ASSOC);

    foreach($saldos as $s=>$item){
        $saldo = $item["saldo"];
        $id_credito = $item["id_credito"];
        $monto_credito = $item["monto"];
    }

    if(is_array($saldos)==true and count($saldos)>0){
       $saldo_act = $saldo+$monto_total;
       $nuevo_monto = $monto_credito+$monto_total;
       $sql6 ="update creditos set saldo=?,monto=? where id_credito=?;";
       $sql6= $conectar->prepare($sql6);
       $sql6->bindValue(1,$saldo_act);
       $sql6->bindValue(2,$nuevo_monto);
       $sql6->bindValue(3,$id_credito);
       $sql6->execute();
       
    }else{

    $sql7 = "select plazo from orden_credito where numero_orden=?;";
    $sql7=$conectar->prepare($sql7);
    $sql7->bindValue(1,$numero_orden);
    $sql7->execute();
    $plazo_res = $sql7->fetchAll(PDO::FETCH_ASSOC);

    foreach ($plazo_res as $key => $value) {
        $plazo_orden = $value["plazo"];
    }

       $tipo_venta = "Credito";
       $plazo =12;
       $cancelacion = 0;
       $sql7="insert into creditos values(null,?,?,?,?,?,?,?,?,?,?,?);";
       $sql7= $conectar->prepare($sql7);
       $sql7->bindValue(1,$tipo_venta);
       $sql7->bindValue(2,$suma_pfinal);
       $sql7->bindValue(3,$plazo_orden);
       $sql7->bindValue(4,$monto_total);
       $sql7->bindValue(5,$tipo_pago);
       $sql7->bindValue(6,$num_venta);
       $sql7->bindValue(7,$id_paciente);
       $sql7->bindValue(8,$id_usuario);
       $sql7->bindValue(9,$hoy);
       $sql7->bindValue(10,$cancelacion);
       $sql7->bindValue(11,$numero_orden);

       $sql7->execute();
    }

    $sql14="update abonos set numero_venta=? where numero_venta=? and id_paciente=?;";
    $sql14=$conectar->prepare($sql14);
    $sql14->bindValue(1,$num_venta);
    $sql14->bindValue(2,$numero_orden);
    $sql14->bindValue(3,$id_paciente);
    $sql14->execute();

    }///////FIN COMPROBACION DE ESTADO
    }/////////// FIN GET BENEFICARIOS FOREACH

//////////////////////ORDEN CREDITO ////////
    $n_recibo="";
    $n_factura="";
    $forma_cobro="";
    $monto_cobrado="";
    $abono_anterior="0";
    $abonos_realizados="0";
    $sucursal_cobro="";
    $tipo_ingreso = "Venta";

    $sql2="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql2=$conectar->prepare($sql2);          
    $sql2->bindValue(1,$hoy);
    $sql2->bindValue(2,$n_recibo);
    $sql2->bindValue(3,$num_venta);
    $sql2->bindValue(4,$n_factura);
    $sql2->bindValue(5,$paciente);
    $sql2->bindValue(6,$vendedor);
    $sql2->bindValue(7,$monto_total);
    $sql2->bindValue(8,$forma_cobro);
    $sql2->bindValue(9,$monto_cobrado);
    $sql2->bindValue(10,$monto_total);
    $sql2->bindValue(11,$tipo_venta);
    $sql2->bindValue(12,$tipo_pago);
    $sql2->bindValue(13,$id_usuario);
    $sql2->bindValue(14,$abono_anterior);
    $sql2->bindValue(15,$abonos_realizados);
    $sql2->bindValue(16,$id_paciente);
    $sql2->bindValue(17,$sucursal);
    $sql2->bindValue(18,$sucursal_cobro);
    $sql2->bindValue(19,$tipo_ingreso);

    $sql2->execute();

}


public function denegar_orden($numero_orden){
    $conectar = parent::conexion();
    $sql3 = "update orden_credito set estado='2' where numero_orden=?;";
    $sql3 = $conectar->prepare($sql3);
    $sql3->bindValue(1,$numero_orden);   
    $sql3->execute();    
}

public function buscar_existe_oid($id_paciente){
    $conectar = parent::conexion();
    parent::set_names(); 
    $sql="select p.id_paciente,p.nombres,p.empresas,o.numero_orden from pacientes as p inner join orden_credito as o on o.id_paciente=p.id_paciente where o.id_paciente=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_saldos_oid($id_paciente){
    $conectar = parent::conexion();
    $sql= "select  p.nombres,p.empresas,c.saldo as saldos from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente  where c.id_paciente=? and c.forma_pago='Descuento en Planilla' order by c.id_credito limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function agregar_benefiaciario_oid(){

  $fecha_venta = $_POST["fecha_venta"];
  $numero_venta = $_POST["numero_venta"];
  $paciente = $_POST["paciente"];
  $vendedor = $_POST["vendedor"];
  $monto_total = $_POST["monto_total"];
  $tipo_pago = $_POST["tipo_pago"];
  $tipo_venta = $_POST["tipo_venta"];
  $id_usuario = $_POST["id_usuario"];
  $id_paciente = $_POST["id_paciente"];
  $sucursal = $_POST["sucursal"];
  $evaluado = $_POST["evaluado"];
  $optometra = $_POST["optometra"];
  $plazo = $_POST["plazo"];
  $id_ref = $_POST["id_ref"];
  $numero_orden = $_POST["n_orden_add"];
  $nuevo_saldo_add = $_POST["nuevo_saldo_add"];
  $nuevo_plazo = $_POST["new_plazo"]-1;  

  $str = '';
  $detalles = array();
  $detalles = json_decode($_POST['arrayVenta']);
  $conectar= parent::conexion();
  parent::set_names();

    foreach ($detalles as $k => $v) {
    $cantidad = $v->cantidad;
    $categoria_prod = $v->categoria_prod;
    $categoria_ub = $v->categoria_ub;
    $codProd = $v->codProd;
    $descripcion = $v->descripcion;
    $descuento = $v->descuento;
    $id_ingreso = $v->id_ingreso;
    $num_compra = $v->num_compra;
    $precio_venta = $v->precio_venta;
    $stock = $v->stock;
    $subtotal = $v->subtotal;

    $sql5="insert into detalle_ventas_flotantes values(null,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql5=$conectar->prepare($sql5);
    $sql5->bindValue(1,$numero_orden);
    $sql5->bindValue(2,$codProd);
    $sql5->bindValue(3,$descripcion);
    $sql5->bindValue(4,$precio_venta);
    $sql5->bindValue(5,$cantidad);
    $sql5->bindValue(6,$descuento);
    $sql5->bindValue(7,$subtotal);
    $sql5->bindValue(8,$fecha_venta);
    $sql5->bindValue(9,$id_usuario);
    $sql5->bindValue(10,$id_paciente);
    $sql5->bindValue(11,$evaluado);
    $sql5->bindValue(12,$categoria_ub);
    $sql5->execute();

}//////////////////FIN FOREACH ////////
$estado_ord="0";

$sql5="insert into ventas_flotantes values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql5=$conectar->prepare($sql5);
    $sql5->bindValue(1,$numero_orden);          
    $sql5->bindValue(2,$fecha_venta);
    $sql5->bindValue(3,$numero_venta);
    $sql5->bindValue(4,$paciente);
    $sql5->bindValue(5,$vendedor);       
    $sql5->bindValue(6,$monto_total);
    $sql5->bindValue(7,$tipo_pago);
    $sql5->bindValue(8,$tipo_venta);          
    $sql5->bindValue(9,$id_usuario);
    $sql5->bindValue(10,$id_paciente);
    $sql5->bindValue(11,$sucursal);
    $sql5->bindValue(12,$evaluado);
    $sql5->bindValue(13,$optometra);
    $sql5->bindValue(14,$estado_ord);
    $sql5->execute();

    //$finalizacion = date("d-m-Y",strtotime($fecha_inicio."+ $plazo month"));
    ///GET FECHA INICIO DE ORDEN

    $sql6="select fecha_inicio from orden_credito where numero_orden=? and id_paciente=?;";
    $sql6=$conectar->prepare($sql6);
    $sql6->bindValue(1,$numero_orden);
    $sql6->bindValue(2,$id_paciente);
    $sql6->execute();
    $inicio = $sql6->fetchAll(PDO::FETCH_ASSOC);

    for ($i=0; $i <sizeof($inicio) ; $i++) { 
        $f_inicio = $inicio[$i]["fecha_inicio"];
    }
    
    $finalizacion = date("d-m-Y",strtotime($f_inicio."+ $nuevo_plazo month"));

    $sql12 = "update orden_credito set tipo_orden='agrupada',plazo=?,estado='0',fecha_finalizacion=? where numero_orden=? and id_paciente=?";
    $sql12 = $conectar->prepare($sql12);
    $sql12->bindValue(1,$nuevo_plazo);
    $sql12->bindValue(2,$finalizacion);
    $sql12->bindValue(3,$numero_orden);
    $sql12->bindValue(4,$id_paciente);
    $sql12->execute();

}

public function get_beneficiarios($id_paciente,$numero_orden){
   $conectar= parent::conexion();
  $sql= "select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,v.estado,o.id_orden,o.sucursal,v.evaluado,v.monto_total,o.tipo_orden from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join ventas_flotantes as v on o.numero_orden=v.numero_orden  where v.id_paciente=? and v.numero_orden=?; ";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_paciente);
  $sql->bindValue(2, $numero_orden);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);   
}

public function get_beneficiarios_ventas_flot($id_paciente,$numero_orden){
$conectar= parent::conexion();
  $sql= "select evaluado from ventas_flotantes where id_paciente=? and numero_orden=? and tipo_pago='Descuento en Planilla';";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_paciente);
  $sql->bindValue(2, $numero_orden);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);   
}

public function get_det_f_ben($id_paciente,$numero_orden,$flotante_b){
$conectar= parent::conexion();
  $sql= "select*from detalle_ventas_flotantes where id_paciente=? and numero_orden=? and beneficiario=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $id_paciente);
  $sql->bindValue(2, $numero_orden);
  $sql->bindValue(3, $flotante_b);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);   
}

public function get_det_ventas_flotantes($id_paciente,$numero_orden){

    $conectar= parent::conexion();
    parent::set_names(); 

   $sql = "select evaluado,monto_total from ventas_flotantes where id_paciente=? and numero_orden=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$numero_orden);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    $html="<thead>
        <th colspan='100' style='color:black;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:100%;text-align: center' class='bg-dark'><b>BENEFICIARIOS Y SERVICIOS</b></th>
        </thead>
        <thead>  
        <th colspan='25' style='width:25%;text-align:center;border: solid 1px black;background:#034f84;color: white'>Cantidad</th>
        <th colspan='50' style='width:50%;text-align:center;border: solid 1px black;background:#034f84;color: white'>Producto</th>
        <th colspan='25' style='width:25%;text-align:center;border: solid 1px black;background:#034f84;color: white'>Precio Venta</th>
        </thead>";

      for ($i=0; $i <sizeof($resultado) ; $i++) { 
        $evaluado = $resultado[$i]["evaluado"];
            $sql2 = "select*from detalle_ventas_flotantes where beneficiario=? and numero_orden=?;";
            $sql2 = $conectar->prepare($sql2);
            $sql2->bindValue(1,$evaluado);
            $sql2->bindValue(2,$numero_orden);
            $sql2->execute();
        $det_ventas_flot= $sql2->fetchAll(PDO::FETCH_ASSOC);
        $total=0;
        $html.="<thead><tr><th colspan='100' style='width:100%;text-align:center;border: solid 1px black' bgcolor='#c5e2f6'>".$evaluado."</th></tr></thead>";
        foreach ($det_ventas_flot as $k => $v) {
        $precio= $v["precio_final"];
        $total = $total+$precio;
        $html.="
        <tr>
            <td colspan='25' style='width:25%;text-align:center;border: solid 1px black'>".$v["cantidad_venta"]."</td>
            <td colspan='50' style='width:50%;text-align:center;border: solid 1px black'>".$v["producto"]."</td>
            <td colspan='25' style='width:25%;text-align:center;border: solid 1px black'>"."$".$v["precio_final"]."</td>
        </tr>";
        }
        $html.="<tr>
            <td colspan='75' style='text-align:right;background:#C8C8C8;color;black;'><b>TOTAL<b></td>
            <td colspan='25' style='text-align:center;background:#C8C8C8;color;black;'><b>"."$".number_format($total,2,".",",")."</b></td>
         </tr><tr><td style='color:white;'>H</td></tr>";
}

   echo $html;

}

/////////////// CARGOS AUTOMATICOS APROBADOS///////////////
public function get_cautos_empresarial($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $suc = '%'.$sucursal.'%';
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='1' and tipo_orden ='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function get_cautos_aprob($sucursal_usuario){
    $conectar=parent::conexion();
    parent::set_names();
    $suc = "%".$sucursal_usuario."%";
    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal,u.usuario from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente inner join usuarios as u on o.id_usuario=u.id_usuario where o.sucursal like ? and o.estado='1' and tipo_orden ='Cargo Automatico' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

      //////////////FUNCION PARA ELIMINAR OID SIN APROBAR
  public function eliminar_oid_p($numero_orden){
    $conectar=parent::conexion();
    $sql="delete vf,dvf,oc from ventas_flotantes as vf join detalle_ventas_flotantes as dvf on (dvf.numero_orden=vf.numero_orden) join orden_credito as oc on (oc.numero_orden=vf.numero_orden) where vf.numero_orden = ?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $numero_orden);
    $sql->execute();
    echo 'ok';
  }


//***************************************************//
///CONSULTAR A BD, CREDITOS DEPENDIENDO DE SU FILTRADO
    public function listar_creditos_general($sucursal){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";
    $sql="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? group by c.numero_venta order by c.id_credito desc";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_creditos_empresa($sucursal,$nombre_empresa){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? and p.empresas= ? group by c.numero_venta order by c.id_credito desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->bindValue(2,$nombre_empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_creditos_pendientes($sucursal,$ver_credito){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? and c.saldo > 0 group by c.numero_venta order by c.id_credito desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_creditos_finalizados($sucursal,$ver_credito){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? and c.saldo <= 0 group by c.numero_venta order by c.id_credito desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_creditos_pendientes_emp($sucursal,$nombre_empresa,$ver_credito){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? and p.empresas = ? and saldo > 0 group by c.numero_venta order by c.id_credito desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->bindValue(2,$nombre_empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_creditos_finalizados_emp($sucursal,$nombre_empresa,$ver_credito){
    $conectar= parent::conexion();
    $suc = "%".$sucursal."%";

    $sql ="select c.numero_venta,p.sucursal,p.nombres,p.empresas,oc.fecha_inicio,oc.fecha_finalizacion,c.plazo,c.monto,c.saldo,p.id_paciente,c.id_credito,c.cancelacion from orden_credito as oc inner join creditos as c on oc.id_paciente=c.id_paciente inner join pacientes as p on c.id_paciente=p.id_paciente where c.forma_pago='Descuento en Planilla' and p.sucursal like ? and p.empresas = ? and saldo <= 0 group by c.numero_venta order by c.id_credito desc;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$suc);
    $sql->bindValue(2,$nombre_empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}/////FIN CLASS

?>
