<?php

require_once("../config/conexion.php");


class Productos extends Conectar
{ //////inicio de la clase

public function valida_existencia_aros($marca_aros,$modelo_aro,$color_aro,$medidas_aro,$diseno_aro,$materiales_aro,$cat_venta_aros){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select*from productos where marca=? and modelo=? and color=? and medidas=? and diseno=? and materiales=? and categoria=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $marca_aros);
  $sql->bindValue(2, $modelo_aro);
  $sql->bindValue(3, $color_aro);
  $sql->bindValue(4, $medidas_aro);
  $sql->bindValue(5, $diseno_aro);
  $sql->bindValue(6, $materiales_aro);
  $sql->bindValue(7, $cat_venta_aros);
  $sql->execute();
  return $resultado=$sql->fetchAll();
}

public function registrar_aro($marca_aros,$modelo_aro,$color_aro,$medidas_aro,$diseno_aro,$materiales_aro,$cat_venta_aros,$categoria_producto){

    $descripcion=$marca_aros." mod.".$modelo_aro." ".$medidas_aro." ".$color_aro;

    $conectar= parent::conexion();
    parent::set_names();
    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_aros);
    $sql->bindValue(2, $modelo_aro);
    $sql->bindValue(3, $color_aro);
    $sql->bindValue(4, $medidas_aro);
    $sql->bindValue(5, $diseno_aro);
    $sql->bindValue(6, $materiales_aro);
    $sql->bindValue(7, $cat_venta_aros);
    $sql->bindValue(8, $categoria_producto);
    $sql->bindValue(9, $descripcion);
    $sql->execute();

    $last_id = $conectar->lastInsertId();
    $msj = ["result"=>'yes',"last_id"=>$last_id];
    echo json_encode($msj);

}


public function registrar_accesorios($tipo_accesorio,$marca_accesorio,$desc_accesorio,$categoria,$codigo){

    $conectar= parent::conexion();
    parent::set_names();
    
    $color="0";
    $medidas="0";
    $diseno="0";
    $materiales="0";

    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_accesorio);
    $sql->bindValue(2, $codigo);
    $sql->bindValue(3, $color);
    $sql->bindValue(4, $medidas);
    $sql->bindValue(5, $diseno);
    $sql->bindValue(6, $materiales);
    $sql->bindValue(7, $tipo_accesorio);
    $sql->bindValue(8, $categoria);
    $sql->bindValue(9, $desc_accesorio);
    $sql->execute();

}

public function get_accesorios(){
    $conectar= parent::conexion();
    $sql= "select*from productos where categoria_producto='accesorios' order by id_producto DESC;";
    $sql=$conectar->prepare($sql);
    //$sql->bindValue(1, $sucursal_correlativo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

public function get_aros(){
    $conectar= parent::conexion();
    $sql= "select*from productos where categoria_producto='aros' order by id_producto DESC;";
    $sql=$conectar->prepare($sql);
    //$sql->bindValue(1, $sucursal_correlativo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////LISTAR AROS EN COMPRAS
public function get_acc_compras(){
    $conectar= parent::conexion();
    $sql= "select*from productos where categoria_producto='accesorios' order by id_producto DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

public function get_lentes_ventas(){
  $conectar= parent::conexion();

  $sql="select id_producto,categoria as precio, categoria_producto, desc_producto from productos where categoria_producto='lentes'";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////////////////////listar aros en MODAL VENTAS
public function buscar_aros_ventas($sucursal){
  $conectar= parent::conexion();
  $suscursal=$_POST["sucursal"];
  $sql="select p.desc_producto,e.precio_venta,e.stock,e.categoria_ub,e.num_compra,e.fecha_ingreso,e.id_ingreso,p.id_producto from
  productos as p inner join existencias as e on p.id_producto=e.id_producto
  where e.bodega=? and e.stock>0 and p.categoria_producto='aros'";

  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$sucursal);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function buscar_aros_ventas_emp($sucursal,$sucursal_usuario){
  $conectar= parent::conexion();
  $suscursal=$_POST["sucursal"];
  $sql="select p.desc_producto,e.precio_venta,e.stock,e.categoria_ub,e.num_compra,e.fecha_ingreso,e.id_ingreso,p.id_producto from
  productos as p inner join existencias as e on p.id_producto=e.id_producto
  where e.bodega=? and e.stock>0 and p.categoria_producto='aros'";

  $sql = $conectar->prepare($sql);
  //$sql->bindValue(1,$sucursal);
  $sql->bindValue(1,$sucursal_usuario);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

}

//////////////LISTAR ACCESORIOS EN MODAL VENTAS
public function buscar_accesorios_ventas($sucursal){
  $conectar= parent::conexion();
  $suscursal=$_POST["sucursal"];

  $sql="select p.marca,p.modelo,p.desc_producto,e.precio_venta,e.stock,e.categoria_ub,e.num_compra,e.fecha_ingreso,e.id_ingreso,p.id_producto from
productos as p inner join existencias as e on p.id_producto=e.id_producto
where e.bodega=? and e.stock>0 and p.categoria_producto='accesorios'";

  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$sucursal);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

}


//////////////////GUARDAR LENTE
public function guardar_lentes($describe,$costo,$precio,$cat_prod){    

    $conectar= parent::conexion();
    parent::set_names();
    $marca_aros="0";
    $modelo_aro="0";
    $color_aro="0";
    $medidas_aro="0";
    $diseno_aro="0";

    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_aros);
    $sql->bindValue(2, $modelo_aro);
    $sql->bindValue(3, $color_aro);
    $sql->bindValue(4, $medidas_aro);
    $sql->bindValue(5, $diseno_aro);
    $sql->bindValue(6, $costo);
    $sql->bindValue(7, $precio);
    $sql->bindValue(8, $cat_prod);
    $sql->bindValue(9, $describe);
    $sql->execute();

}


//////////////////GUARDAR ANTIRREFLEJANTE
public function guardar_antireflejante($describe,$costo,$precio,$cat_prod){    

    $conectar= parent::conexion();
    parent::set_names();
    $marca_aros="0";
    $modelo_aro="0";
    $color_aro="0";
    $medidas_aro="0";
    $diseno_aro="0";

    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_aros);
    $sql->bindValue(2, $modelo_aro);
    $sql->bindValue(3, $color_aro);
    $sql->bindValue(4, $medidas_aro);
    $sql->bindValue(5, $diseno_aro);
    $sql->bindValue(6, $costo);
    $sql->bindValue(7, $precio);
    $sql->bindValue(8, $cat_prod);
    $sql->bindValue(9, $describe);
    $sql->execute();
}

//////////////////GUARDAR ANTIRREFLEJANTE
public function guardar_photosensible($describe,$costo_photo,$precio_photo,$cat_prod){    

    $conectar= parent::conexion();
    parent::set_names();
    $marca_aros="0";
    $modelo_aro="0";
    $color_aro="0";
    $medidas_aro="0";
    $diseno_aro="0";

    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_aros);
    $sql->bindValue(2, $modelo_aro);
    $sql->bindValue(3, $color_aro);
    $sql->bindValue(4, $medidas_aro);
    $sql->bindValue(5, $diseno_aro);
    $sql->bindValue(6, $costo_photo);
    $sql->bindValue(7, $precio_photo);
    $sql->bindValue(8, $cat_prod);
    $sql->bindValue(9, $describe);
    $sql->execute();
}
//////////////////DATOS PARA RECIBOS
public function get_ar_ventas(){
  $conectar= parent::conexion();

  $sql="select id_producto,categoria as precio, categoria_producto, desc_producto from productos where categoria_producto='antireflejante';";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_photo_ventas(){
  $conectar= parent::conexion();

  $sql="select id_producto,categoria as precio, categoria_producto, desc_producto from productos where categoria_producto='photosensible';";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

////FUNCION LISTAR LENTES + TRATAMIENTOS
public function get_lente_tratamientos(){
  $conectar= parent::conexion();
  $sql="select id_producto, categoria, categoria_producto, desc_producto from productos where categoria_producto='lentes' or categoria_producto='antireflejante' or categoria_producto='photosensible';";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

///FUNCION VER DATOS AROS
public function show_datos_aros($id_producto){
    $conectar= parent::conexion();
    $sql="select*from productos where id_producto=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

public function show_datos_producto_id($id_producto){
    $conectar= parent::conexion();
    $sql="select*from productos where id_producto=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

//////FUNCION EDITAR PRODUCTO
public function editar_aro($marca_aros,$modelo_aro,$color_aro,$medidas_aro,$diseno_aro,$materiales_aro,$cat_venta_aros,$categoria_producto,$id_producto){

  $descripcion=$marca_aros." mod.".$modelo_aro." ".$medidas_aro." ".$color_aro;

  $conectar= parent::conexion();
  parent::set_names();
  $sql="update productos set marca=?,modelo=?,color=?,medidas=?,diseno=?,materiales=?,categoria=?,categoria_producto=?,desc_producto=? where id_producto=?;";
 
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $_POST["marca_aros"]);
  $sql->bindValue(2, $_POST["modelo_aro"]);
  $sql->bindValue(3, $_POST["color_aro"]);
  $sql->bindValue(4, $_POST["medidas_aro"]);
  $sql->bindValue(5, $_POST["diseno_aro"]);
  $sql->bindValue(6, $_POST["materiales_aro"]);
  $sql->bindValue(7, $_POST["cat_venta_aros"]);
  $sql->bindValue(8, $_POST["categoria_producto"]);
  $sql->bindValue(9, $descripcion);
  $sql->bindValue(10, $_POST["id_producto"]);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

//FUNCION VER DATOS DE ACCESORIO
public function show_datos_acc($id_producto){
    $conectar= parent::conexion();
    $sql="select*from productos where id_producto=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }
////FUNCION EDITAR ACCESORIOS
public function editar_accesorio($tipo_accesorio,$marca_accesorio,$desc_accesorio,$categoria,$codigo,$id_producto){

    $conectar= parent::conexion();
    parent::set_names();
    $sql="update productos set marca=?,modelo=?,categoria=?,categoria_producto=?,desc_producto=? where id_producto=?;";

    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $_POST["marca_accesorio"]);
    $sql->bindValue(2, $_POST["codigo"]);
    $sql->bindValue(3, $_POST["tipo_accesorio"]);
    $sql->bindValue(4, $_POST["categoria"]);
    $sql->bindValue(5, $_POST["desc_accesorio"]);
    $sql->bindValue(6, $_POST["id_producto"]);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

///FUNCION PARA ELIMINAR ACCESORIO
public function eliminar_accesorio($id_producto){
    $conectar=parent::conexion();
    $sql="delete from productos where id_producto=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
    $sql->execute();
    return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  }
///////////////// 
public function get_productos_traslados($sucursal){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.desc_producto,e.id_producto,e.bodega,e.categoria_ub from productos as p inner join existencias as e on p.id_producto=e.id_producto where e.bodega=? and e.stock>0;";

  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////////GUARDAR LENTE
public function guardar_servicio($tipo_servicio,$des_servicio,$precio_servicio,$cat_servicio){    

    $conectar= parent::conexion();
    parent::set_names();
    $marca_aros="0";
    $color_aro="0";
    $medidas_aro="0";
    $diseno_aro="0";
    $materiales_aro="0";

    $sql="insert into productos values(null,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $marca_aros);
    $sql->bindValue(2, $tipo_servicio);
    $sql->bindValue(3, $color_aro);
    $sql->bindValue(4, $medidas_aro);
    $sql->bindValue(5, $diseno_aro);
    $sql->bindValue(6, $materiales_aro);
    $sql->bindValue(7, $precio_servicio);
    $sql->bindValue(8, $cat_servicio);
    $sql->bindValue(9, $des_servicio);
    $sql->execute();

}

public function get_servicios_ventas(){
  $conectar= parent::conexion();

  $sql="select id_producto, modelo, categoria as precio, categoria_producto, desc_producto from productos where categoria_producto='servicio'";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}


}//////Fin de la clase
