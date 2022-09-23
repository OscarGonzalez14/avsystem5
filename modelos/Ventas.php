<?php

require_once("../config/conexion.php");


class Ventas extends Conectar{//////inicio de la clase

public function buscar_aros_ventas($id_producto,$id_ingreso){
  $conectar= parent::conexion();
  $sql="select p.desc_producto,p.categoria_producto,e.precio_venta,e.stock,e.categoria_ub,e.num_compra,e.fecha_ingreso,e.id_ingreso,p.id_producto from
productos as p inner join existencias as e on p.id_producto=e.id_producto
where e.id_producto=? and e.id_ingreso=?";

  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$id_ingreso);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function buscar_accesorios_ventas($id_producto,$id_ingreso){
  $conectar= parent::conexion();
  $sql="select p.categoria,p.desc_producto,p.categoria_producto,e.precio_venta,e.stock,e.categoria_ub,e.num_compra,e.fecha_ingreso,e.id_ingreso,p.id_producto from productos as p inner join existencias as e on p.id_producto=e.id_producto where e.id_producto=? and e.id_ingreso=? and p.categoria_producto='accesorios';";

  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$id_ingreso);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function buscar_lentes_ventas($id_producto){
  $conectar= parent::conexion();
  $sql="select categoria as precio_venta,categoria_producto,desc_producto,id_producto from productos where id_producto=?";
  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function buscar_servicios_ventas($id_producto){
  $conectar= parent::conexion();
  $sql="select id_producto,modelo as servicio, categoria as precio_venta from productos where id_producto=?;";

  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function get_numero_venta($sucursal_correlativo){
  $conectar= parent::conexion();
  $sql= "select numero_venta from correlativo_ventas where sucursal=? order by id_correlativo DESC limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal_correlativo);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////VALIDAR SI EXISTE VENTA
public function valida_existencia_venta($numero_venta){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select numero_venta from correlativo_ventas where numero_venta=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $numero_venta);
  //$sql->bindValue(2, $id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll();
}

/////////////////////REGISTRAR VENTA
public function agrega_detalle_venta(){

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
  $sucursal_usuario = $_POST["sucursal_usuario"];

  $str = '';
  $detalles = array();
  $detalles = json_decode($_POST['arrayVenta']);
  $conectar= parent::conexion();
  parent::set_names();

  if($tipo_venta == "Contado"){ ////////////////////VALIDAR SI LA VENTA ES DE CONTADO  ///////////

  if ($sucursal=="Empresarial") {
    $sucursal_act = "Empresarial-".$sucursal_usuario;
    $suc = $_POST["sucursal_usuario"];
  }else{
    $sucursal_act = $sucursal_usuario;
    $suc = $sucursal;
  }

    foreach ($detalles as $k => $v) {
      $cantidad = $v->cantidad;
      $categoria_prod = $v->categoria_prod;
      $categoria_ub = $v->categoria_ub;
      $codProd = $v->codProd;
      $descuento = $v->descuento;
      $id_ingreso = $v->id_ingreso;
      $num_compra = $v->num_compra;
      $precio_venta = $v->precio_venta;
      $stock = $v->stock;
      $subtotal = $v->subtotal;

      //////////OBETENER LA DESCRIPCION DEL PRODUCTO /////////////
      $sqlp = "select*from productos where id_producto=?;";
      $sqlp = $conectar->prepare($sqlp);
      $sqlp->bindValue(1,$codProd);
      $sqlp->execute();

      $detalles_producto = $sqlp->fetchAll(PDO::FETCH_ASSOC);

      foreach ($detalles_producto as $item){
        $cat_prod = $item["categoria_producto"];
        if ($cat_prod == "aros") {
          $descripcion = "ARO: ".$item["marca"]." MOD.: ".$item["modelo"]." COLOR: ".$item["color"]." MED.".$item["medidas"]." ".$item["diseno"];
        }elseif($cat_prod=="Lentes"){
          $descripcion = "LENTE: ".$item["desc_producto"];
        }elseif($cat_prod=="Antireflejante" or $cat_prod=="Photosensible"){
          $descripcion = "TRATAMIENTOS: ".$item["desc_producto"];
        }elseif($cat_prod=="accesorios"){
          $descripcion = "ACC: ".$item["desc_producto"];
        }elseif($cat_prod=="servicio"){
          $descripcion = "Servicios: ".$item["desc_producto"];
        }
      }

   
      $sql="insert into detalle_ventas values(null,?,?,?,?,?,?,?,?,?,?,?);";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$numero_venta);
      $sql->bindValue(2,$codProd);
      $sql->bindValue(3,$descripcion);
      $sql->bindValue(4,$precio_venta);
      $sql->bindValue(5,$cantidad);
      $sql->bindValue(6,$descuento);
      $sql->bindValue(7,$subtotal);
      $sql->bindValue(8,$fecha_venta);
      $sql->bindValue(9,$id_usuario);
      $sql->bindValue(10,$id_paciente);
      $sql->bindValue(11,$evaluado);
     // $sql->bindValue(12,$precio_compra);
     $sql->execute();

    if($categoria_prod=="aros" or $categoria_prod == "accesorios"){
    ////////////////////ACTUALIZAR STOCK DE BODEGA SI PRODUCTO == aros o accesorios
      $sql3="select * from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=? and id_ingreso=?;";           
      $sql3=$conectar->prepare($sql3);
      $sql3->bindValue(1,$codProd);
      $sql3->bindValue(2,$suc);
      $sql3->bindValue(3,$categoria_ub);
      $sql3->bindValue(4,$num_compra);
      $sql3->bindValue(5,$id_ingreso);
      $sql3->execute();

      $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);

      foreach($resultados as $b=>$row){
      $re["existencia"] = $row["stock"];
    }            
    
    $cantidad_totales = $row["stock"] - $cantidad;

    if(is_array($resultados)==true and count($resultados)>0) {                    

      $sql12 = "update existencias set stock=? where id_producto=? and bodega=? and id_ingreso=? and categoria_ub=? and num_compra=?";
      $sql12 = $conectar->prepare($sql12);
      $sql12->bindValue(1,$cantidad_totales);
      $sql12->bindValue(2,$codProd);
      $sql12->bindValue(3,$suc);
      $sql12->bindValue(4,$id_ingreso);
      $sql12->bindValue(5,$categoria_ub);
      $sql12->bindValue(6,$num_compra);
      $sql12->execute();
  }          

  }//////////// fin validar para descontar de inventario     
 

}//FIN DEL FOREACH**************
    $cancelacion = "0";
    $n_orden = '0';
    ///////////////////////INSERTAR CREDITOS
    $sql1="insert into creditos values(null,?,?,?,?,?,?,?,?,?,?,?);";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$tipo_venta);
    $sql1->bindValue(2,$monto_total);
    $sql1->bindValue(3,$plazo);
    $sql1->bindValue(4,$monto_total);
    $sql1->bindValue(5,$tipo_pago);
    $sql1->bindValue(6,$numero_venta);
    $sql1->bindValue(7,$id_paciente);
    $sql1->bindValue(8,$id_usuario);
    $sql1->bindValue(9,$fecha_venta);
    $sql1->bindValue(10,$cancelacion);
    $sql1->bindValue(11,$n_orden);

    $sql1->execute();

    /////////////////////  insert into correlativo ventas

    $id = "replace correlativo_ventas set id_correlativo=0,numero_venta = ?, sucursal=?;";
    $id = $conectar->prepare($id);
    $id->bindValue(1,$numero_venta);
    $id->bindValue(2,$sucursal_act);
    $id->execute();


    $n_orden = '0';
    $sql2="insert into ventas values(null,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql2=$conectar->prepare($sql2);
          
    $sql2->bindValue(1,$fecha_venta);
    $sql2->bindValue(2,$numero_venta);
    $sql2->bindValue(3,$paciente);
    $sql2->bindValue(4,$vendedor);       
    $sql2->bindValue(5,$monto_total);
    $sql2->bindValue(6,$tipo_pago);
    $sql2->bindValue(7,$tipo_venta);          
    $sql2->bindValue(8,$id_usuario);
    $sql2->bindValue(9,$id_paciente);
    $sql2->bindValue(10,$sucursal_act);
    $sql2->bindValue(11,$evaluado);
    $sql2->bindValue(12,$optometra);
    $sql2->bindValue(13,$n_orden);
    $sql2->execute();

    if ($id_ref != "") {
    $sql2="insert referidos values(null,?,?,?,?);";
    $sql2=$conectar->prepare($sql2);
          
    $sql2->bindValue(1,$id_ref);
    $sql2->bindValue(2,$id_paciente);
    $sql2->bindValue(3,$fecha_venta);
    $sql2->bindValue(4,$sucursal);
    $sql2->execute();
  }

    #################  REGISTRAR VENTA EN CORTE DIARIO #####################
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
    $sql2->bindValue(1,$fecha_venta);
    $sql2->bindValue(2,$n_recibo);
    $sql2->bindValue(3,$numero_venta);
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
    $sql2->bindValue(17,$sucursal_act);
    $sql2->bindValue(18,$sucursal_cobro);
    $sql2->bindValue(19,$tipo_ingreso);

    $sql2->execute();



//////////////////////VALIDAR SI VENTA ES CREDITO
  }elseif(($tipo_venta == "Credito" and $tipo_pago == "Descuento en Planilla") or ($tipo_venta == "Credito" and $tipo_pago == "Cargo Automatico")){//////////////////////FIN PARA VALIDAR SI9 VENTA  == CONTADO
  ////////////////////////   SI NO ES  == CONTADO REGISTRAR VENTAS FLOTANTES /////////////
  $detalles_oid = array();
  $detalles_oid = json_decode($_POST['arrayOid']);

  foreach ($detalles_oid as $k => $v) {
      $id_paciente = $v->id_paciente;
      $fecha_inicio = $v->fecha_inicio;
      $plazo_credito = $v->plazo_credito;
      $empresa = $v->empresa;
      $funcion_laboral = $v->funcion_laboral;
      $edad_pac = $v->edad_pac;

      $dui_pac = $v->dui_pac;
      $nit_pac = $v->nit_pac;
      $tel_pac = $v->tel_pac;
      $tel_of_pac = $v->tel_of_pac;
      $corre_pac = $v->corre_pac;
      $direccion_pac = $v->direccion_pac;
      $ref_1 = $v->ref_1;
      $tel_ref1 = $v->tel_ref1;
      $ref_2 = $v->ref_2;
      $tel_ref2 = $v->tel_ref2;
      $codigo = $v->codigo;
      $observaciones_oid = $v->observaciones_oid;
      $sucursal_usuario = $v->sucursal_usuario;
      $tipo_pago = $v->tipo_pago;
      $tipo_tarjeta_c = $v->tipo_tarjeta_c;
      $numero_tarjeta_c = $v->numero_tarjeta_c;
      $vencimiento_tarjeta_c = $v->vencimiento_tarjeta_c;
  }//Fin foreach

    $finalizacion = date("d-m-Y",strtotime($fecha_inicio."+ $plazo month"));

    if ($tipo_pago=="Cargo Automatico") {
      $tipo_orden = "Cargo Automatico";
    }else{
      $tipo_orden = "Individual";
    }

    $estado_orden = "0";
    
    if ($sucursal=="Empresarial") {
      $sucursal_orden = "Empresarial-".$sucursal_usuario;
    }else{
      $sucursal_orden = $sucursal;
    }
    ////////////////////////CPMPROBAR SI NO EXISTE ORDEN CREDITO///////////////////

    $sql8="insert into orden_credito values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql8=$conectar->prepare($sql8);          
    $sql8->bindValue(1,$codigo);
    $sql8->bindValue(2,$id_paciente);
    $sql8->bindValue(3,$ref_1);
    $sql8->bindValue(4,$tel_ref1);
    $sql8->bindValue(5,$ref_2);
    $sql8->bindValue(6,$tel_ref2);
    $sql8->bindValue(7,$fecha_venta);
    $sql8->bindValue(8,$fecha_inicio);
    $sql8->bindValue(9,$finalizacion);
    $sql8->bindValue(10,$estado_orden);
    $sql8->bindValue(11,$id_usuario);
    $sql8->bindValue(12,$sucursal_orden);
    $sql8->bindValue(13,$monto_total);
    $sql8->bindValue(14,$plazo);
    $sql8->bindValue(15,$observaciones_oid);
    $sql8->bindValue(16,$tipo_orden);
    $sql8->bindValue(17,$tipo_tarjeta_c);
    $sql8->bindValue(18,$numero_tarjeta_c);
    $sql8->bindValue(19,$vencimiento_tarjeta_c);

    $sql8->execute();

  ///////////////////////UPDATE DATOS DE PACIENTE
   $sql9 = "update pacientes set telefono=?,ocupacion=?,dui=?,correo=?,empresas=?,nit=?,telefono_oficina=?,direccion=? where id_paciente=?;";
   $sql9 = $conectar->prepare($sql9);
   $sql9->bindValue(1,$tel_pac);
   $sql9->bindValue(2,$funcion_laboral);
   $sql9->bindValue(3,$dui_pac);
   $sql9->bindValue(4,$corre_pac);
   $sql9->bindValue(5,$empresa);
   $sql9->bindValue(6,$nit_pac);
   $sql9->bindValue(7,$tel_of_pac);
   $sql9->bindValue(8,$direccion_pac);
   $sql9->bindValue(9,$id_paciente);
   $sql9->execute();

 ///////////////   insert into detalle ventas flotantes //////////////

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
    $sql5->bindValue(1,$codigo);
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

  } 
  $estado_flotante = 0;
  $sql5="insert into ventas_flotantes values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql5=$conectar->prepare($sql5);
    $sql5->bindValue(1,$codigo);          
    $sql5->bindValue(2,$fecha_venta);
    $sql5->bindValue(3,$numero_venta);
    $sql5->bindValue(4,$paciente);
    $sql5->bindValue(5,$vendedor);       
    $sql5->bindValue(6,$monto_total);
    $sql5->bindValue(7,$tipo_pago);
    $sql5->bindValue(8,$tipo_venta);          
    $sql5->bindValue(9,$id_usuario);
    $sql5->bindValue(10,$id_paciente);
    $sql5->bindValue(11,$sucursal_orden);
    $sql5->bindValue(12,$evaluado);
    $sql5->bindValue(13,$optometra);
    $sql5->bindValue(14,$estado_flotante);
    $sql5->execute();

  }elseif ($tipo_venta == "Credito" and $tipo_pago == "Cargo Automatico") {
    $detalles_oid = array();
    $detalles_oid = json_decode($_POST['arrayOid']);

  foreach ($detalles_oid as $k => $v) {
      $id_paciente = $v->id_paciente;
      $fecha_inicio = $v->fecha_inicio;
      $plazo_credito = $v->plazo_credito;
      $empresa = $v->empresa;
      $funcion_laboral = $v->funcion_laboral;
      $edad_pac = $v->edad_pac;

      $dui_pac = $v->dui_pac;
      $nit_pac = $v->nit_pac;
      $tel_pac = $v->tel_pac;
      $tel_of_pac = $v->tel_of_pac;
      $corre_pac = $v->corre_pac;
      $direccion_pac = $v->direccion_pac;
      $ref_1 = $v->ref_1;
      $tel_ref1 = $v->tel_ref1;
      $ref_2 = $v->ref_2;
      $tel_ref2 = $v->tel_ref2;
      $codigo = $v->codigo;
      $observaciones_oid = $v->observaciones_oid;
      $sucursal_usuario = $v->sucursal_usuario;
  }//Fin foreach

    $finalizacion = date("d-m-Y",strtotime($fecha_inicio."+ $plazo month"));
    $estado_orden = "0";
    $tipo_orden = "Individual";
    if ($sucursal=="Empresarial") {
      $sucursal_orden = "Empresarial-".$sucursal_usuario;
    }else{
      $sucursal_orden = $sucursal;
    }
    ////////////////////////CPMPROBAR SI NO EXISTE ORDEN CREDITO///////////////////

    $sql8="insert into orden_credito values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql8=$conectar->prepare($sql8);          
    $sql8->bindValue(1,$codigo);
    $sql8->bindValue(2,$id_paciente);
    $sql8->bindValue(3,$ref_1);
    $sql8->bindValue(4,$tel_ref1);
    $sql8->bindValue(5,$ref_2);
    $sql8->bindValue(6,$tel_ref2);
    $sql8->bindValue(7,$fecha_venta);
    $sql8->bindValue(8,$fecha_inicio);
    $sql8->bindValue(9,$finalizacion);
    $sql8->bindValue(10,$estado_orden);
    $sql8->bindValue(11,$id_usuario);
    $sql8->bindValue(12,$sucursal_orden);
    $sql8->bindValue(13,$monto_total);
    $sql8->bindValue(14,$plazo);
    $sql8->bindValue(15,$observaciones_oid);
    $sql8->bindValue(16,$tipo_orden);

    $sql8->execute();

  ///////////////////////UPDATE DATOS DE PACIENTE
   $sql9 = "update pacientes set telefono=?,ocupacion=?,dui=?,correo=?,empresas=?,nit=?,telefono_oficina=?,direccion=? where id_paciente=?;";
   $sql9 = $conectar->prepare($sql9);
   $sql9->bindValue(1,$tel_pac);
   $sql9->bindValue(2,$funcion_laboral);
   $sql9->bindValue(3,$dui_pac);
   $sql9->bindValue(4,$corre_pac);
   $sql9->bindValue(5,$empresa);
   $sql9->bindValue(6,$nit_pac);
   $sql9->bindValue(7,$tel_of_pac);
   $sql9->bindValue(8,$direccion_pac);
   $sql9->bindValue(9,$id_paciente);
   $sql9->execute();

  ///////////////   insert into detalle ventas flotantes //////////////
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
    $sql5->bindValue(1,$codigo);
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
  } 

    $estado_flotante = 0;
    $sql5="insert into ventas_flotantes values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql5=$conectar->prepare($sql5);
    $sql5->bindValue(1,$codigo);          
    $sql5->bindValue(2,$fecha_venta);
    $sql5->bindValue(3,$numero_venta);
    $sql5->bindValue(4,$paciente);
    $sql5->bindValue(5,$vendedor);       
    $sql5->bindValue(6,$monto_total);
    $sql5->bindValue(7,$tipo_pago);
    $sql5->bindValue(8,$tipo_venta);          
    $sql5->bindValue(9,$id_usuario);
    $sql5->bindValue(10,$id_paciente);
    $sql5->bindValue(11,$sucursal_orden);
    $sql5->bindValue(12,$evaluado);
    $sql5->bindValue(13,$optometra);
    $sql5->bindValue(14,$estado_flotante);
    $sql5->execute();
  }



}//////////FIN FUNCION REGISTRA VENTA

public function get_correlativo_orden($sucursal){
 /*GET NUMERO ORDEN */
  $conectar=parent::conexion();
  parent::set_names();
  $sucursal_orden = "%".$sucursal."%";
  $sql="select numero_orden from orden_credito where sucursal like ? and tipo_orden != 'Cargo Automatico' order by id_orden DESC limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$sucursal_orden);
  $sql->execute();
  return $resultado_correlativo = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_correlativo_cargo($sucursal){
 /*GET NUMERO ORDEN */
  $conectar=parent::conexion();
  parent::set_names();
  $sucursal_orden = "%".$sucursal."%";
  $sql="select numero_orden from orden_credito where sucursal like ?  and tipo_orden = 'Cargo Automatico' order by id_orden DESC limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$sucursal_orden);
  $sql->execute();
  return $resultado_correlativo = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LENADO DE RECIBO INICIAL DE LENTE
public function get_detalle_lente_rec_ini($id_paciente,$numero_venta){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where d.numero_venta=? and d.id_paciente=? and p.categoria_producto='lentes'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$numero_venta);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LENADO DE RECIBO INICIAL PHOTO
public function get_detalle_photo_rec_ini($id_paciente,$numero_venta){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where d.numero_venta=? and d.id_paciente=? and p.categoria_producto='photosensible'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$numero_venta);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////LENADO DE RECIBO ANTIREFLEJANTES
public function get_detalle_ar_rec_ini($id_paciente,$numero_venta){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where d.numero_venta=? and d.id_paciente=? and p.categoria_producto='antireflejante'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$numero_venta);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////LENADO DE CAMPOS AROS RECIBO INICIAL
public function get_detalle_aros_rec_ini($id_paciente,$numero_venta){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.marca,p.modelo,p.color,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where d.numero_venta=? and d.id_paciente=? and p.categoria_producto='aros'";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$numero_venta);
  $sql->bindValue(2,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}


  public function get_ventas_gral($sucursal){
  $conectar= parent::conexion();

  $suc = "%".$sucursal."%";
  $sql="select v.id_paciente,v.id_ventas,v.numero_venta,u.usuario,v.optometra,v.fecha_venta,v.paciente,v.evaluado,v.tipo_pago,v.tipo_venta,v.sucursal,v.monto_total from ventas as v inner join usuarios as u on v.id_usuario=u.id_usuario where v.sucursal like ? order by id_ventas DESC;";
  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$suc);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

  public function get_ventas_mora($id_paciente,$numero_venta){
  $conectar= parent::conexion();
  $sql="select p.nombres,v.id_paciente,v.numero_venta,v.paciente,v.evaluado,v.tipo_venta,v.tipo_pago,v.fecha_venta,u.usuario from pacientes as p inner join ventas as v on p.id_paciente=v.id_paciente inner join usuarios as u on u.id_usuario=v.id_usuario where v.id_paciente=? and v.numero_venta=?;";
  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_paciente);
  $sql->bindValue(2,$numero_venta);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////////DETALLE DE VENTAS
public function get_detalle_ventas_paciente($numero_venta,$evaluado,$id_paciente){

  $conectar=parent::conexion();
  parent::set_names();
  $moneda="$";   

  $sql="select producto,cantidad_venta,precio_venta,descuento,precio_final from detalle_ventas where numero_venta=? and id_paciente=? and beneficiario=?";

  $sql=$conectar->prepare($sql);            

  $sql->bindValue(1,$numero_venta);
  $sql->bindValue(2,$id_paciente);
  $sql->bindValue(3,$evaluado);
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  $html= "
     <thead class='bg-success'>
      <th style='text-align:center'>Producto</th>
      <th style='text-align:center'>Cantidad</th>
      <th style='text-align:center'>P/U</th>
      <th style='text-align:center'>Descuento $</th>
      <th style='text-align:center'>Subtotal</th>                                   
    </thead>";           
    $subtotal=0;
    foreach($resultado as $row){         
    $html.="<tr class='filas'>
    <td style='text-align:center'>".$row['producto']."</td>
    <td style='text-align:center'>".$row['cantidad_venta']."</td>
    <td style='text-align:center'>".$moneda." ".$row['precio_venta']."</td> 
    <td style='text-align:center'>"."$".$row['descuento']."</td>
    <td style='text-align:center'>"."$".$row['precio_final']."</td>
    </tr>";
 
   $subtotal= $subtotal+$row["precio_final"];         
              
}
$html .= "<tfoot style='text-align:center'><td colspan='4'><b>Subtotal</b></td><td>".$moneda." ".$subtotal."</td></tfoot>";                                     
echo $html;

}

////////////////GET UTILIDADES
public function get_utilidades(){
  $conectar= parent::conexion();
  $sql="select dc.precio_compra,dv.precio_final,dv.precio_final-dc.precio_compra as utilidad from detalle_ventas as dv join detalle_compras as dc where dv.id_producto=dc.id_producto;";
  $sql = $conectar->prepare($sql);
  // $sql->bindValue(1,$id_paciente);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////get data pacientes en ventas.php modal
public function show_datos_paciente($id_paciente){
    $conectar= parent::conexion();
    $sql="select*from pacientes where id_paciente=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }


}//////Fin de la clase
